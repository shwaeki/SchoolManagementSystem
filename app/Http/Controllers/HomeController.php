<?php

namespace App\Http\Controllers;

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
}
