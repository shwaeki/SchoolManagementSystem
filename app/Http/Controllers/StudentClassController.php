<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentClass;
use App\Http\Requests\StoreStudentClassRequest;
use App\Http\Requests\UpdateStudentClassRequest;
use App\Models\YearClass;
use Illuminate\Support\Facades\Session;

class StudentClassController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('auth:web,teacher')->only(['store','destroy']);
        $this->middleware('auth:web')->except(['store','destroy']);
    }

    public function index()
    {

    }



    public function create()
    {

    }


    public function store(StoreStudentClassRequest $request)
    {
        $yearClass = YearClass::findOrFail(request('year_class_id'));
        $students = request('students');

        foreach ($students as $student){
            $data = [
                'student_id' => $student,
                'teacher_id' => $yearClass->supervisor,
                'year_class_id' => $yearClass->id,
                'added_by' => auth()->id(),
            ];
            StudentClass::create($data);
        }


        Session::flash('message', 'تم اضافة الطلاب الى الفصل التعليمي بنجاح.');
        return redirect()->back();
    }


    public function show(StudentClass $studentClass)
    {
        //
    }


    public function edit(StudentClass $studentClass)
    {
        //
    }


    public function update(UpdateStudentClassRequest $request, StudentClass $studentClass)
    {
        //
    }


    public function destroy(StudentClass $studentClass)
    {
        $studentClass->delete();

        Session::flash('message', 'تم حذف الطالب من الفصل الدراسي  بنجاح!');
        return redirect()->back();
    }
}
