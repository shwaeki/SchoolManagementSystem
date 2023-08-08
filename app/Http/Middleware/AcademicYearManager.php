<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Models\AcademicYear;
use Closure;
use Illuminate\Support\Facades\Session;

class AcademicYearManager
{

    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('activeAcademicYear')) {
            Session::put('activeAcademicYear', AcademicYear::where('status', true)->get()->first());
        }
        return $next($request);

    }
}
