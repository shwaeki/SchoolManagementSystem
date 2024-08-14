<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Report;
use App\Models\SalarySlip;
use App\Models\TeacherMonthlyPlan;
use App\Http\Requests\StoreTeacherMonthlyPlanRequest;
use App\Http\Requests\UpdateTeacherMonthlyPlanRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class TeacherMonthlyPlanController extends Controller
{

    public function index()
    {
        $monthDate = request('monthSelect', Carbon::now()->format('Y-m'));

        $data = [
            "monthly_plans" => auth()->user()?->monthlyPlans->where('month', $monthDate)->groupBy('subject')->toArray() ?? [],
        ];

        return view('teacher_views.monthly_plan', $data);
    }

    public function store(StoreTeacherMonthlyPlanRequest $request)
    {
        $month = request('month');
        $methods = request('methods');

        foreach (request('objectives') as $subject => $objectives) {
            $data = [
                'objectives' => $objectives,
                'methods' => $methods[$subject],
                'subject' => $subject,
                'month' => $month,
            ];
            auth()->user()->monthlyPlans()->create($data);
        }

        Session::flash('message', 'تم إنشاء الخطة الشهرية  بنجاح.');
        return redirect()->back();
    }


    public function update(UpdateTeacherMonthlyPlanRequest $request, TeacherMonthlyPlan $teacher_plan)
    {
        $teacher_plan->update([
            'objectives' => request('objectives'),
            'methods' => request('methods'),
        ]);

        Session::flash('message', 'تم تعديل الخطة الشهرية  بنجاح.');
        return redirect()->back();
    }

}
