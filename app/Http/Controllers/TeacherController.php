<?php

namespace App\Http\Controllers;

use App\DataTables\TeachersDataTable;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Support\Facades\Session;

class TeacherController extends Controller
{

    public function index(TeachersDataTable $dataTable)
    {
        return $dataTable->render('teacher.index');
    }

    public function create()
    {
        $data = [
            "schoolClasses" => SchoolClass::all(),
        ];

        return view('teacher.create', $data);
    }


    public function store(StoreTeacherRequest $request)
    {
        $data = request()->all() + ['added_by' => auth()->id()];
        Teacher::create($data);
        Session::flash('message', 'تم اضافة معلم جديد بنجاح.');

        return redirect()->route('teachers.index');
    }


    public function show(Teacher $teacher)
    {
        $data = [
            "teacher" => $teacher,
        ];

        Session::put('fileManagerConfig', "Teacher_" . $teacher->id);
        return view('teacher.show', $data);
    }


    public function edit(Teacher $teacher)
    {
        $data = [
            "teacher" => $teacher,
            "schoolClasses" => SchoolClass::all(),
        ];

        return view('teacher.edit', $data);
    }


    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->update(request()->all());
        Session::flash('message', 'تم تعديل معلومات المعلم بنجاح.');
        return redirect()->route('teachers.index');
    }


    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        Session::flash('message', 'تم حذف المعلم بنجاح!');
        return redirect()->route('teachers.index');
    }
}
