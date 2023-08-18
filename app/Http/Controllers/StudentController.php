<?php

namespace App\Http\Controllers;

use App\DataTables\StudentsDataTable;
use App\Models\AcademicYear;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
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


    public function store(StoreStudentRequest $request)
    {
        $data = request()->all() + ['added_by' => auth()->id()];
        Student::create($data);
        Session::flash('message', 'تم اضافة الطالب بنجاح.');
        return redirect()->route('students.index');
    }


    public function show(Student $student)
    {


        $adminActiveAcademicYear = AcademicYear::where('status', true)->get()->first();
        $current_student_class = $student->studentClasses()->where('year_class_id',$adminActiveAcademicYear->id)->get()->first();

        $data = [
            "student" => $student,
            "student_logs" => $student->activities,
            "student_classes" => $student->studentClasses,
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
        $student->update(request()->all());
        Session::flash('message', 'تم تعديل معلومات الطالب بنجاح.');
        return redirect()->route('students.index');
    }


    public function destroy(Student $student)
    {
        $student->delete();

        Session::flash('message', 'تم حذف الطالب بنجاح!');
        return redirect()->route('students.index');
    }
}
