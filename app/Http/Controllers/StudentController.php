<?php

namespace App\Http\Controllers;

use App\DataTables\StudentsDataTable;
use App\Models\AcademicYear;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\StudentCertificate;
use App\Models\StudentClass;
use App\Models\StudentMark;
use App\Models\StudentReport;
use Carbon\Carbon;
use App\Models\Teacher;
use Illuminate\Support\Facades\Session;
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
            $fileNameToStore = "الصورة الشخصية" . '.' . $extension;
            $request->file('personal_photo')->storeAs("public/files/Student_" . $student->id, $fileNameToStore);
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
            "student_reports" => StudentReport::all(),
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
        $all_data = request()->all();
        $date = str_replace('/', '-', request('birth_date'));
        $all_data['birth_date'] = date('Y-m-d', strtotime($date));


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
        $birth_day = date('d', strtotime( $student->birth_date));
        $birth_month = date('m', strtotime( $student->birth_date));
        $birth_year = date('y', strtotime( $student->birth_date));
        $school_name =  $class->name;
        $school_name_small =  $class->name;
        $school_address = $class->address;
        $idNumber = $student->identification;
        $manager_name = 'חמדאן יוסרי';
        $schoolNum = '503256';


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
            $tcpdf->SetXY(108, 219);
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

            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="'.$idNumber.'.pdf"');

            $tcpdf->Output($idNumber . '.pdf', 'D');
            $tcpdf->endTemplate();
        }

    }
}
