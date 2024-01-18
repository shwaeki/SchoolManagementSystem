<?php

namespace App\Http\Controllers;

use App\Models\SalarySlip;
use App\Models\SchoolClass;
use App\Models\Teacher;
use App\Models\YearClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('home', $data);
    }

    public function mysalries()
    {
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
