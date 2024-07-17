<?php

namespace App\Http\Controllers;

use App\DataTables\StudentsDataTable;
use App\Models\AcademicYear;
use App\Models\Product;
use App\Models\Report;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\StudentCertificate;
use App\Models\StudentClass;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Smalot\PdfParser\Parser;
use TCPDI;

class StudentController extends Controller
{

    public function index(StudentsDataTable $dataTable)
    {
        return $dataTable->render('student.index');
    }

    public function create()
    {
        return view('student.create');
    }


    public function report()
    {
        return view('student.report');
    }


    public function store(StoreStudentRequest $request)
    {

        $all_data = request()->all();

        $date = str_replace('/', '-', request('birth_date'));
        $all_data['birth_date'] = date('Y-m-d', strtotime($date));
        $data = $all_data + ['added_by' => auth()->id()];
        $student = Student::create($data);


        if ($request->hasFile('personal_photo')) {
            $extension = $request->file('personal_photo')->getClientOriginalExtension();
            $fileName = "الصورة الشخصية" . '.' . $extension;
            $filePath = "files/Student_" . $student->id;
            $request->file('personal_photo')->storeAs('public/' . $filePath, $fileName);
            $image_data['personal_photo'] = $filePath . '/' . $fileName;
            $student->update($image_data);
        }


        if ($request->hasFile('birth_certificate')) {
            $extension = $request->file('birth_certificate')->getClientOriginalExtension();
            $fileNameToStore = "شهادة الميلاد " . '.' . $extension;
            $request->file('birth_certificate')->storeAs("public/files/Student_" . $student->id, $fileNameToStore);
        }


        Session::flash('message', 'تم اضافة الطالب بنجاح.');
        return redirect()->route('students.index');
    }


    public function show(Student $student)
    {


        $adminActiveAcademicYear = AcademicYear::where('status', true)->get()->first();
        $activeAcademicYear = Session::get('activeAcademicYear');

        $current_student_class = $student->studentClasses()->whereHas('yearClass', function ($query) use ($activeAcademicYear) {
            $query->where('academic_year_id', $activeAcademicYear->id);
        })->get()->first();


        $data = [
            "student" => $student,
            "student_logs" => $student->activities,
            "student_classes" => $student->studentClasses,
            "reports" => Report::where('type', 'student')->get(),
            "student_reports" => $student->reports,
            "student_purchases" => $current_student_class?->purchases,
            "student_payments" => $current_student_class?->payments,
            "products" => Product::where('status', true)?->get(),
            "current_student_class" => $current_student_class,
        ];

        Session::put('fileManagerConfig', "Student_" . $student->id);
        return view('student.show', $data);
    }


    public function edit(Student $student)
    {
        $data = [
            "student" => $student,
        ];

        return view('student.edit', $data);
    }


    public function update(UpdateStudentRequest $request, Student $student)
    {

        $addedData = [
            'can_login' => request()->has('can_login') ? 1 : 0,
        ];

        $all_data = request()->all() + $addedData;

        $date = str_replace('/', '-', request('birth_date'));
        $all_data['birth_date'] = date('Y-m-d', strtotime($date));


        if ($request->hasFile('personal_photo')) {
            $extension = $request->file('personal_photo')->getClientOriginalExtension();
            $fileName = "الصورة الشخصية" . '.' . $extension;
            $filePath = "files/Student_" . $student->id;
            $request->file('personal_photo')->storeAs('public/' . $filePath, $fileName);
            $all_data['personal_photo'] = $filePath . '/' . $fileName;
        }


        $student->update($all_data);
        Session::flash('message', 'تم تعديل معلومات الطالب بنجاح.');
        return redirect()->route('students.show', $student);
    }


    public function destroy(Student $student)
    {
        $student->delete();

        Session::flash('message', 'تم حذف الطالب بنجاح!');
        return redirect()->route('students.index');
    }

    public function showMarks(StudentClass $studentClass)
    {

        $studentCertificate = StudentCertificate::where('student_class_id', $studentClass->id)->first();
        $marks = $studentCertificate?->marks ?? [];

        $organizedMarks = [];
        foreach ($marks as $mark) {
            $organizedMarks[$mark->semester][$mark->certificate_category_id] = $mark;
        }

        $data = [
            "studentCertificate" => $studentCertificate,
            "marks" => $organizedMarks,
            "studentClass" => $studentClass,
            "certificate" => $studentClass->yearClass->certificate,
        ];

        return view('student.marks', $data);
    }

    public function showMarksPdf(StudentClass $studentClass)
    {

        $studentCertificate = StudentCertificate::where('student_class_id', $studentClass->id)->first();
        $marks = $studentCertificate?->marks ?? [];

        $organizedMarks = [];
        foreach ($marks as $mark) {
            $organizedMarks[$mark->semester][$mark->certificate_category_id] = $mark;
        }

        $data = [
            "studentCertificate" => $studentCertificate,
            "marks" => $organizedMarks,
            "studentClass" => $studentClass,
            "certificate" => $studentClass->yearClass->certificate,
        ];


        $tcpdf = new TCPDI();

        $company_name = 'ריאד אלמגד אלאהליה בעיימ';
        $company_address = 'עיסוויה ירושלים';
        $student_name = "اسم طالب تجريبي";
        $idNumber = "123456789";


        $tcpdf->AddPage();

        $html = view('student.marks_pdf',$data);

        $tcpdf->writeHTML($html, true, false, true, false, '');
        $tcpdf->SetRTL(true);
        $tcpdf->SetFont('DejaVuSans', 'B', 10);
        $tcpdf->SetXY(45, 67);
        $tcpdf->Write(0, $company_name);
        $tcpdf->SetXY(48, 75);
        $tcpdf->Write(0, $company_address);

        $tcpdf->SetFont('aealarabiya', 'B', 12);
        $tcpdf->SetXY(35, 107);
        $tcpdf->Write(0, $student_name);

        $ImageW = 100; //WaterMark Size
        $ImageH = 100;
        $myPageWidth = $tcpdf->getPageWidth();
        $myPageHeight = $tcpdf->getPageHeight();
        $myX = ($myPageWidth / 2) + 50;  //WaterMark Positioning
        $myY = ($myPageHeight / 2) - 50;

        $tcpdf->SetAlpha(0.35);
        $tcpdf->Image("assets/img/watermark.png", $myX, $myY, $ImageW, $ImageH, '', '', 'C', true, 300);
        $tcpdf->SetAlpha(1);
        $tcpdf->SetFooterMargin(0);



        return $tcpdf->Output($idNumber . '.pdf', 'I');


        //  return view('student.marks', $data);
    }




    public function getStudentMarks(StudentClass $studentClass)
    {

        $studentCertificate = StudentCertificate::where('student_class_id', $studentClass->id)->first();
        $marks = $studentCertificate?->marks ?? [];

        $organizedMarks = [];
        foreach ($marks as $mark) {
            $organizedMarks[$mark->semester][$mark->certificate_category_id] = $mark;
        }

        return response()->json(['result' => true, 'studentCertificate' => $studentCertificate, 'marks' => $organizedMarks]);

    }


    public function yearlyFile(StudentClass $studentClass)
    {

        $student = $studentClass->student;
        $class = $studentClass->yearClass->schoolClass;

        $uploadedFilePath = public_path('assets/template.pdf');

        $tcpdf = new TCPDI();
        $parser2 = new Parser();
        $pdfParsed = $parser2->parseFile($uploadedFilePath);
        $pageCount = $tcpdf->setSourceFile($uploadedFilePath);

        $company_name = 'ריאד אלמגד אלאהליה בעיימ';
        $company_address = 'עיסוויה ירושלים';
        $full_address = 'עיסוויה  ירושלים ת.ד 66872';
        $phone = 'נייד 0522037243';
        $student_name = $student->name;

        $fatherNumber = $student->father_id ?? $student->mother_id;
        $student_Father_name = $student->father_name ?? $student->mother_name;

        $birth_day = date('d', strtotime($student->birth_date));
        $birth_month = date('m', strtotime($student->birth_date));
        $birth_year = date('y', strtotime($student->birth_date));
        $school_name = $class->name;
        $school_name_small = $class->name;
        $school_address = $class->address;
        $idNumber = $student->identification;
        if (strlen($idNumber) <= 9) {
            $idNumber = "0" . $idNumber;
        }
        $manager_name = 'חמדאן יוסרי';
        $schoolNum = $studentClass->yearClass?->code;


        $imagePath = public_path('assets/img/sign.png');

        foreach ($pdfParsed->getPages() as $pageNumber => $page) {
            $text = $page->getText();

            $tcpdf->AddPage();

            $tplIndex = $tcpdf->importPage($pageNumber + 1);

            $tcpdf->useTemplate($tplIndex);
            $tcpdf->SetRTL(true);
            $tcpdf->SetFont('DejaVuSans', 'B', 10);
            $tcpdf->SetXY(45, 67);
            $tcpdf->Write(0, $company_name);
            $tcpdf->SetXY(48, 75);
            $tcpdf->Write(0, $company_address);

            $tcpdf->SetFont('aealarabiya', 'B', 12);
            $tcpdf->SetXY(35, 107);
            $tcpdf->Write(0, $student_name);

            $tcpdf->SetRTL(false);
            $tcpdf->SetFont('DejaVuSans', 'B', 12);
            $tcpdf->setFontSpacing(2.1);
            $tcpdf->SetXY(36, 112);
            $tcpdf->Write(0, $idNumber);

            $tcpdf->SetRTL(true);
            $tcpdf->setFontSpacing(0);
            $tcpdf->SetFont('DejaVuSans', '', 10);
            $tcpdf->SetXY(59, 123);
            $tcpdf->Write(0, $birth_day);
            $tcpdf->SetXY(51, 123);
            $tcpdf->Write(0, $birth_month);
            $tcpdf->SetXY(44, 123);
            $tcpdf->Write(0, $birth_year);


            $tcpdf->SetFont('aealarabiya', 'B', 12);
            $tcpdf->SetXY(90, 123);
            $tcpdf->Write(0, $school_name);

            $tcpdf->SetFont('aealarabiya', 'B', 12);
            $tcpdf->SetXY(41, 134);
            $tcpdf->Write(0, $school_address);

            $tcpdf->SetFont('DejaVuSans', 'B', 12);
            $tcpdf->SetXY(30, 173);
            $tcpdf->Write(0, $manager_name);

            $tcpdf->SetFont('aealarabiya', 'B', 12);
            $tcpdf->SetXY(104, 218);
            $tcpdf->Write(0, $school_name_small);

            $tcpdf->SetRTL(false);
            $tcpdf->SetFont('DejaVuSans', 'B', 12);
            $tcpdf->setFontSpacing(2.1);
            $tcpdf->SetXY(43.5, 95);
            $tcpdf->Write(0, $schoolNum);

            $tcpdf->SetRTL(false);
            $tcpdf->SetFont('DejaVuSans', 'B', 12);
            $tcpdf->setFontSpacing(0);
            $tcpdf->SetXY(25, 221);
            $tcpdf->Write(0, $schoolNum);

            $tcpdf->Image($imagePath, 90, 165, 35, 24);

            $tcpdf->SetRTL(true);
            $tcpdf->SetFont('aealarabiya', 'B', 12);
            $tcpdf->SetXY(50, 207);
            $tcpdf->Write(0, $student_Father_name);

            $tcpdf->SetRTL(false);
            $tcpdf->SetFont('DejaVuSans', 'B', 12);
            $tcpdf->SetXY(80, 207);
            $tcpdf->Write(0, $fatherNumber);

            $tcpdf->SetFont('aealarabiya', 'B', 12);
            $tcpdf->SetXY(65, 243);
            $tcpdf->Write(0, $student_Father_name);

            /*
                        header('Content-Type: application/pdf');
                        header('Content-Disposition: attachment; filename="' . $idNumber . '.pdf"');
            */
            return $tcpdf->Output($idNumber . '.pdf', 'I');
            // $tcpdf->endTemplate();
        }

    }
}
