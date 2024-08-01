<?php

namespace App\Http\Controllers;

use App\DataTables\ClassesDataTable;
use App\Models\AcademicYear;
use App\Models\Certificate;
use App\Models\SchoolClass;
use App\Http\Requests\StoreSchoolClassRequest;
use App\Http\Requests\UpdateSchoolClassRequest;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\Teacher;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SchoolClassController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('auth:web,teacher')->only(['show']);
        $this->middleware('auth:web')->except(['show']);
    }


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
        $date = request('date', now());
        $week = request('weekSelect', Carbon::now()->format('o-\WW'));

        $current_year_class = $schoolClass->yearClasses()
            ->where('academic_year_id', getUserActiveAcademicYearID())
            ->first();

        if (Auth::guard('teacher')->check() && $current_year_class && $current_year_class->supervisor != auth()->id()) {
            return redirect()->route('home');
        }

        $all_students = [];
        $assistants = [];
        $studentsAttendance = [];
        $class_year_students = [];
        $weeklyPrograms = [];

        if ($current_year_class) {
            // Get all student IDs
            $all_students = DB::table('student_classes')
                ->select('student_id')
                ->join('year_classes', 'year_classes.id', '=', 'student_classes.year_class_id')
              /*  ->where('academic_year_id', $current_year_class->academic_year_id)*/
                ->whereNull('student_classes.deleted_at')
                ->pluck('student_id')
                ->toArray();

            // Get assistants
            $assistants = Teacher::where('teacher_type', 'assistant')
                ->whereDoesntHave('yearClassAssistants', function ($query) use ($current_year_class) {
                    $query->where('year_class_id', $current_year_class->id);
                })
                ->get();

            // Get student attendance
            $studentsAttendance = StudentAttendance::where('year_class_id', $current_year_class->id)
                ->whereDate('date', $date)
                ->pluck('status', 'student_id')
                ->toArray();

            // Get class year students with their related data
            $class_year_students = $current_year_class->students()
                ->whereHas('student', function ($query) {
                    $query->whereNull('deleted_at');
                })
                ->with('student', 'addedBy')
                ->get();

            // Get the certificate and weekly programs
          //  $certificate = $current_year_class->certificate;
            $weeklyPrograms = $current_year_class->weeklyPrograms
                ->where('week', $week)
                ->groupBy('subject')
                ->toArray();
        }


        [$year, $week] = sscanf($week, '%d-W%d');

        $start =  Carbon::now()->setISODate($year, $week)->startOfWeek();
        $end = $start->copy()->endOfWeek();

        $data = [
            'class' => $schoolClass,
            'class_years' => $schoolClass->yearClasses,
            'current_year_class' => $current_year_class,
            'teachers' => Teacher::where('teacher_type', 'teacher')->get(),
            'assistants' => $assistants,
            'studentsAttendance' => $studentsAttendance,
            'certificates' => Certificate::all(),
            'students' => Student::whereNotIn('id', $all_students)->orderBy('name', 'asc')->get(),
            'class_year_students' => $class_year_students,
            'weekFirstDate' => $start->toDateString(),
            'weekLastDate' => $end->toDateString(),
            'weeklyPrograms' => $weeklyPrograms,
        ];

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
/*        $schoolClass->delete();
        Session::flash('message', 'تم حذف الفصل التعليمي بنجاح!');*/
        return redirect()->route('school-classes.index');
    }


}
