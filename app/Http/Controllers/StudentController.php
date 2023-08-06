<?php

namespace App\Http\Controllers;

use App\DataTables\StudentsDataTable;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
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
        //   dd(request()->all());

        Student::create(request()->all());

        Session::flash('message', 'تم اضافة الطالب بنجاح.');
        return redirect()->route('students.index');
    }


    public function show(Student $student)
    {
        $data = [
            "student" => $student,
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
