<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\SalarySlip;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\YearClass;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    public function index()
    {
        $data = [];
        if (Auth::guard('teacher')->check()) {

            $activeAcademicYear = Session::get('activeAcademicYear');

            $data['teacherClasses'] = auth()->user()->supervisorYearClasses()->with('schoolClass')
                ->whereHas('schoolClass', function ($query) {
                    $query->whereNull('deleted_at');
                })
                ->where('academic_year_id', $activeAcademicYear->id)
                ->get();
        }

        // Last 5 SMS Messages
        $data['last_smss'] = Message::orderBy('id', 'desc')->limit(5)->get();
        $data['students_count'] = Student::count();
        $data['teachers_count'] = Teacher::count();


        $activeAcademicYear = getUserActiveAcademicYearID();

        $data['registered_students_count'] = YearClass::where('academic_year_id', $activeAcademicYear)
            ->withCount(['students' => function ($query) {
                $query->whereNull('deleted_at');
            }])
            ->get()->sum('students_count');




        $startDate = Carbon::now()->subMonths(11)->startOfMonth();

        $months = [];
        $totalPaymentsData = array_fill(0, 12, 0);
        $totalPurchasesData = array_fill(0, 12, 0);


        $totalPayments = DB::table('payments')
            ->select(DB::raw('SUM(amount) as total_amount'), DB::raw('DATE_FORMAT(payment_date, "%Y-%m") as month'))
            ->where('payment_date', '>=', $startDate)
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();


        $totalPurchases = DB::table('purchases')
            ->select(DB::raw('SUM(price) as total_amount'), DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'))
            ->where('created_at', '>=', $startDate)
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();


        for ($i = 0; $i < 12; $i++) {
            $month = $startDate->copy()->addMonths($i)->format('Y-m');
            $months[] = $startDate->copy()->addMonths($i)->format('M'); // For chart categories

            foreach ($totalPayments as $payment) {
                if ($payment->month == $month) {
                    $totalPaymentsData[$i] = $payment->total_amount;
                }
            }

            foreach ($totalPurchases as $purchase) {
                if ($purchase->month == $month) {
                    $totalPurchasesData[$i] = $purchase->total_amount;
                }
            }
        }

        $data['months'] = $months;
        $data['total_payments'] = $totalPaymentsData;
        $data['total_purchases'] = $totalPurchasesData;


        $data['total_payment_this_months']  = DB::table('payments')
            ->whereMonth('payment_date', Carbon::now()->month)
            ->whereYear('payment_date', Carbon::now()->year)
            ->sum('amount');



        $data['total_purchases_this_month'] =  DB::table('purchases')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('price');


        return view('home', $data);
    }

    public function mysalries()
    {

        if(!auth()->user()->show_salary_slip){
            return redirect()->route('home');
        }

        $data = [];
        if (Auth::guard('teacher')->check()) {
            $data['salaries'] = SalarySlip::where('identification', auth()->user()->identification)->get();
        }

        return view('mysalries', $data);
    }

    public function showSalary(SalarySlip $salarySlip)
    {
        $path = public_path('storage/'.$salarySlip->file_path);
        return response()->file($path);
    }
}
