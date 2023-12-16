<?php

namespace App\Http\Controllers;

use App\DataTables\ClassesDataTable;
use App\Models\AcademicYear;
use App\Models\Certificate;
use App\Models\SchoolClass;
use App\Http\Requests\StoreSchoolClassRequest;
use App\Http\Requests\UpdateSchoolClassRequest;
use App\Models\Student;
use App\Models\Teacher;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\DB;
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
        $activeAcademicYear = Session::get('activeAcademicYear');
     //   $adminActiveAcademicYear = AcademicYear::where('status', true)->get()->first();

        $current_year_class = $schoolClass->yearClasses()->where('academic_year_id', $activeAcademicYear->id)->get()->first();

        $all_students = [];

        if ($current_year_class != null) {
            $all_students = DB::table('student_classes')
                ->select('student_id')
                ->join('year_classes', 'year_classes.id', '=', 'student_classes.year_class_id')
                ->where('academic_year_id', '=', $current_year_class->id)
                ->where('school_class_id', '=', $schoolClass->id)
                ->get()->pluck('student_id')->toArray();
        }

        $data = [
            "class" => $schoolClass,
            "class_years" => $schoolClass->yearClasses,
            "current_year_class" => $current_year_class,
            "teachers" => Teacher::all(),
            "certificates" => Certificate::all(),
            "students" => Student::whereNotIn('id', $all_students)->get(),
        ];

        if ($current_year_class != null) {
            $data['class_year_students'] = $current_year_class->students;
            $data['certificate'] = $current_year_class->certificate;
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
