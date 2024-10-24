<?php

namespace App\Http\Controllers;

use App\DataTables\ClassesArchiveDataTable;
use App\DataTables\ClassesDataTable;
use App\DataTables\StudentsArchiveDataTable;
use App\Models\AcademicYear;
use App\Models\Certificate;
use App\Models\Post;
use App\Models\SchoolClass;
use App\Http\Requests\StoreSchoolClassRequest;
use App\Http\Requests\UpdateSchoolClassRequest;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\Teacher;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
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

    public function archives(ClassesArchiveDataTable $dataTable)
    {
        return $dataTable->render('classes.archives');
    }

    public function create()
    {
        $data = [
            "teachers" => Teacher::where('archived',false)->get(),
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
        $attendanceDate = request('date', now());

        $weekDate = Carbon::parse(request('weekSelect', Carbon::now()));
        $monthDate = request('monthSelect', Carbon::now()->format('Y-m'));

        $weekStartDate = $weekDate->startOfWeek(Carbon::SUNDAY)->toDateString();
        $weekEndDate = $weekDate->endOfWeek(Carbon::SATURDAY)->toDateString();


        $current_year_class = $schoolClass->yearClasses()
            ->where('academic_year_id', getUserActiveAcademicYearID())
            ->first();


        if (Auth::guard('teacher')->check() && $current_year_class && ( $current_year_class->supervisor != auth()->id()  &&  !$current_year_class->assistants->contains('id', auth()->id()) )) {
            return redirect()->route('home');
        }

        $all_students = [];
        $assistants = [];
        $studentsAttendance = [];
        $class_year_students = [];
        $weeklyPrograms = [];
        $monthlyPlans = [];
        $posts = [];

        if ($current_year_class) {
            // Get all student IDs
            $all_students = DB::table('student_classes')
                ->select('student_id')
                ->join('year_classes', 'year_classes.id', '=', 'student_classes.year_class_id')
                ->where('academic_year_id', $current_year_class->academic_year_id)
                ->whereNull('student_classes.deleted_at')
                ->pluck('student_id')
                ->toArray();

            // Get assistants
            $assistants = Teacher::where('teacher_type', 'assistant')
                ->whereDoesntHave('yearClassAssistants', function ($query) use ($current_year_class) {
                    $query->where('year_class_id', $current_year_class->id);
                })
                ->get();

            // Get class year students with their related data
            $class_year_students = $current_year_class->students()
                ->whereHas('student', function ($query) {
                    $query->whereNull('deleted_at');
                    $query->where('students.archived', false);
                })
                ->with('student', 'addedBy')
                ->get();

            // Get student attendance
            $studentIds = $class_year_students->pluck('student_id')->toArray();
            $studentsAttendance = StudentAttendance::whereIn('student_id', $studentIds)
                ->whereDate('date', $attendanceDate)
                ->get(['student_id', 'status', 'notes'])
                ->keyBy('student_id')
                ->toArray();

            $weeklyPrograms = $current_year_class->weeklyPrograms
                ->where('start_date', $weekStartDate)
                ->groupBy('subject')
                ->toArray();

            $monthlyPlans = $current_year_class->studentMonthlyPlans
                ->where('month', $monthDate)
                ->groupBy('subject')
                ->toArray();

            $posts = Post::where('year_class_id', $current_year_class->id)->orWhereNull('year_class_id')->get();
        }


        $data = [
            'class' => $schoolClass,
            'class_years' => $schoolClass->yearClasses,
            'current_year_class' => $current_year_class,
            'teachers' => Teacher::where('teacher_type', 'teacher')->where('archived',false)->get(),
            'assistants' => $assistants,
            'studentsAttendance' => $studentsAttendance,
            'certificates' => Certificate::all(),
            'students' => Student::whereNotIn('id', $all_students)->where('students.archived', false)->orderBy('name', 'asc')->get(),
            'class_year_students' => $class_year_students,
            'weekFirstDate' => $weekStartDate,
            'weekLastDate' => $weekEndDate,
            'weeklyPrograms' => $weeklyPrograms,
            'monthlyPlans' => $monthlyPlans,
            'posts' => $posts,
        ];

        return view('classes.show', $data);
    }

    public function edit(SchoolClass $schoolClass)
    {
        $data = [
            "class" => $schoolClass,
            "teachers" => Teacher::where('archived',false)->get(),
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

    public function archive( Request $request, SchoolClass $schoolClass)
    {
        $schoolClass->archived = true;
        $schoolClass->save();
        Session::flash('message', 'تم ارشفة الفصل الدراسي بنجاح!');
        return redirect()->route('school-classes.index');
    }

    public function restore( Request $request, SchoolClass $schoolClass)
    {
        $schoolClass->archived = false;
        $schoolClass->save();
        Session::flash('message', 'تم استعادة الفصل الدراسي بنجاح!');
        return redirect()->route('students.index');
    }

}
