<?php

namespace App\Http\Controllers;

use App\Models\OTP;
use App\Http\Requests\CheckOTPRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ParentController extends Controller
{

    public function index()
    {
        return view('parents.home');
    }

    public function login()
    {
        if (Auth::guard('parent')->check()) {
            return redirect()->route('parents.index');
        }

        if (Session::has('otpVerifyID') || Session::has('otpVerifyPhone')) {
            return redirect()->route('parents.otp');
        }

        return view('parents.auth.login');
    }

    public function otp()
    {
        if (Auth::guard('parent')->check()) {
            return redirect()->route('parents.index');
        }

        if (!Session::has('otpVerifyID') || !Session::has('otpVerifyPhone')) {
            return redirect()->route('parents.login');
        }

        return view('parents.auth.otp');
    }

    public function loginCheck(Request $request)
    {
        $request->validate([
            'identification' => 'required|exists:students,identification',
            'phone' => 'required',
        ]);


        $student = Student::where('identification', request('identification'))->where(function ($query) use ($request) {
            $query->where('father_phone', request('phone'))->orWhere('mother_phone', request('phone'));
        })->first();

        if (!is_null($student)) {
            Session::put('otpVerifyID', $student->id);
            Session::put('otpVerifyPhone', request('phone'));
            $student->generateCode();
            return redirect()->route('parents.otp');
        }

        Session::flash('error', 'لا يوجد بيانات متطابقة في النظام !.');
        return back();


    }


    public function verification(CheckOTPRequest $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $studentOTP = Otp::where('student_id', session('otpVerifyID'))
            ->where('code', $request->code)
            ->where('phone', session('otpVerifyPhone'))
            ->where('updated_at', '>=', now()->subMinutes(2))
            ->first();

        if (!is_null($studentOTP)) {
            $student = Student::findOrFail(session('otpVerifyID'));
            if ($student) {
                Auth::guard('parent')->login($student);

                Session::put('otpVerify', session('otpVerifyPhone'));
                return redirect()->route('parents.index');
            }

        }
        Session::flash('error', 'الرمز الذي ادخلته غير صحيح.');
        return back();
    }

    public function resend()
    {
        auth()->user()->generateCode();
        Session::flash('success', 'تم ارسال الرمز الى رقم هاتفك.');
        return back();
    }

    public function cancel()
    {
        Session::forget(['otpVerifyID', 'otpVerifyPhone']);
        return back();
    }


}