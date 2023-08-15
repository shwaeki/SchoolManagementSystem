<?php

namespace App\Http\Controllers;

use App\DataTables\ClassesDataTable;
use App\Models\AcademicYear;
use App\Models\SchoolClass;
use App\Http\Requests\StoreSchoolClassRequest;
use App\Http\Requests\UpdateSchoolClassRequest;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Session;

class SchoolClassController extends Controller
{

    public function index(ClassesDataTable $dataTable)
    {
        return $dataTable->render('classes.index');
    }

    public function create()
    {
        $data = [
            "teachers" => Teacher::all(),
        ];

        return view('classes.create', $data);
    }


    public function store(StoreSchoolClassRequest $request)
    {
        $data = request()->all() + ['added_by' => auth()->id()];
        SchoolClass::create($data);
        Session::flash('message', 'تم اضافة فصل التعليمي جديد بنجاح.');
        return redirect()->route('school-classes.index');
    }


    public function show(SchoolClass $schoolClass)
    {
        $adminActiveAcademicYear = AcademicYear::where('status', true)->get()->first();

        $current_year_class = $schoolClass->yearClasses()->where('academic_year_id',$adminActiveAcademicYear->id)->get()->first();
        $data = [
            "class" => $schoolClass,
            "class_years" => $schoolClass->yearClasses,
            "current_year_class" => $current_year_class,
            "teachers" => Teacher::all(),
            "students" => Student::all(),
        ];
        if ($current_year_class !=null){
            $data['class_year_students'] = $current_year_class->students;
        }
        return view('classes.show', $data);
    }


    public function edit(SchoolClass $schoolClass)
    {

        $data = [
            "class" => $schoolClass,
            "teachers" => Teacher::all(),
        ];

        return view('classes.edit', $data);
    }


    public function update(UpdateSchoolClassRequest $request, SchoolClass $schoolClass)
    {
        $schoolClass->update(request()->all());
        Session::flash('message', 'تم تعديل معلومات الفصل التعليمي بنجاح.');
        return redirect()->route('school-classes.index');
    }


    public function destroy(SchoolClass $schoolClass)
    {
        $schoolClass->delete();
        Session::flash('message', 'تم حذف الفصل التعليمي بنجاح!');
        return redirect()->route('school-classes.index');
    }

}
