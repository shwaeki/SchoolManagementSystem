<?php

namespace App\Http\Middleware;

use App\Models\AcademicYear;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class OtpStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('otpVerifyID') || !Session::has('otpVerifyPhone')) {
            return redirect()->route('parents.login');
        }

        return $next($request);
    }
}
