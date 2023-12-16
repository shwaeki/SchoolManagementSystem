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
        $all_data['birth_date'] = date('Y-m-d',strtotime($date));

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
            $query->where('academic_year_id',$activeAcademicYear->id);
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
        $all_data['birth_date'] = date('Y-m-d',strtotime($date));


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

            return response()->json(['result'=> true, 'studentCertificate' => $studentCertificate, 'marks' => $organizedMarks ]);

    }
}
