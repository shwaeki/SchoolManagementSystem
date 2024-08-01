<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDailyProgramRequest;
use App\Http\Requests\StoreWeeklyProgramRequest;
use App\Http\Requests\UpdateStudentAttendanceRequest;
use App\Models\DailyProgram;
use App\Models\SchoolClass;
use App\Models\StudentAttendance;
use App\Models\Teacher;
use App\Models\WeeklyProgram;
use App\Models\YearClass;
use App\Http\Requests\StoreYearClassRequest;
use App\Http\Requests\UpdateYearClassRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use function Psy\debug;

class YearClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreYearClassRequest $request)
    {
        $data = request()->all() + ['added_by' => auth()->id()];
        YearClass::create($data);
        Session::flash('message', 'تم اضافة فصل التعليمي جديد بنجاح.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(YearClass $yearClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(YearClass $yearClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateYearClassRequest $request, YearClass $yearClass)
    {
        $yearClass->update(request()->all());
        Session::flash('message', 'تم تعديل معلومات الفصل التعليمي بنجاح.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(YearClass $yearClass)
    {
        //
    }

    public function storeAssistant(Request $request, YearClass $yearClass)
    {
        $yearClass->assistants()->attach(request('assistant_id'));
        Session::flash('message', 'تم اضافة مساعدة جديدة بنجاح.');
        return redirect()->back();
    }

    public function destroyAssistant(Request $request, YearClass $yearClass, Teacher $assistant)
    {

        $yearClass->assistants()->detach($assistant->id);
        Session::flash('message', 'تم حذف المساعدة بنجاح.');
        return redirect()->back();
    }

    public function storeDailyProgram(StoreDailyProgramRequest $request, YearClass $yearClass)
    {

/*        $conflict = DailyProgram::where('year_class_id', $yearClass->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [request('start_time'), request('end_time')])
                    ->orWhereBetween('end_time', [request('start_time'), request('end_time')]);
            })->exists();

        if ($conflict) {
            Session::flash('warnings', 'الفترة الزمنية محجوزة بالفعل لهذا الصف في اليوم المحدد.');
            return redirect()->back();
        }*/

        $dailyProgram = $yearClass->dailyPrograms()->create($request->all());


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->storeAs('public/images/daily_programs', $image->getClientOriginalName());
            $dailyProgram->update(['image' => $path]);
        }

        Session::flash('message', 'تم إنشاء البرنامج اليومي بنجاح.');
        return redirect()->back();
    }

    public function destroyDailyProgram(Request $request, DailyProgram $day)
    {
        $day->delete();
        Session::flash('message', 'تم حذف البرنامج اليومي بنجاح.');
        return redirect()->back();
    }


    public function storeWeeklyProgram(StoreWeeklyProgramRequest $request, YearClass $yearClass)
    {

        $start_date = request('start_date');
        foreach (request('content') as $subject => $content) {
            if ($content != null && $content != "") {
                $data = [
                    'content' => $content,
                    'subject' => $subject,
                    'start_date' => $start_date,
                ];
                $yearClass->weeklyPrograms()->create($data);
            }
        }

        Session::flash('message', 'تم إنشاء الخطوة الاسبوعية  بنجاح.');
        return redirect()->back();
    }

    public function destroyWeeklyProgram(Request $request, WeeklyProgram $week)
    {
        $week->delete();
        Session::flash('message', 'تم حذف الخطة الاسبوعية بنجاح.');
        return redirect()->back();
    }


    public function updateStudentAttendance(UpdateStudentAttendanceRequest $request, YearClass $yearClass)
    {


        DB::transaction(function () use ($yearClass) {
            $students = request('students', []);
            $date = request('date', now());


            foreach ($students as $student => $status) {
                StudentAttendance::updateOrCreate(
                    [
                        'year_class_id' => $yearClass->id,
                        'student_id' => $student,
                        'date' => $date,
                    ],
                    [
                        'status' => $status,
                        'added_by' => auth()->id(),
                    ]);
            }
        });

        Session::flash('message', 'تم تسجيل حضور الطلاب بنجاح');
        return redirect()->back();
    }
}
