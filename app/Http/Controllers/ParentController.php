<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Otp;
use App\Http\Requests\CheckOTPRequest;
use App\Models\Student;
use App\Models\StudentCertificate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ParentController extends Controller
{

    public function index()
    {

        $student = Student::findOrFail(auth('parent')->id());
        $adminActiveAcademicYear = AcademicYear::where('status', true)->get()->first();

        $current_student_class = $student->studentClasses()->whereHas('yearClass', function ($query) use ($adminActiveAcademicYear) {
            $query->where('academic_year_id', $adminActiveAcademicYear->id);
        })->get()->first();


        $studentCertificate = null;
        $organizedMarks = [];

        if ($current_student_class != null) {
            $studentCertificate = StudentCertificate::where('student_class_id', $current_student_class->id)->first();

            $marks = $studentCertificate?->marks ?? [];

            $organizedMarks = [];
            foreach ($marks as $mark) {
                $organizedMarks[$mark->semester][$mark->certificate_category_id] = $mark;
            }
        }

        $data = [
            "studentCertificate" => $studentCertificate,
            "marks" => $organizedMarks,
            "studentClass" => $current_student_class,
            "certificate" => $current_student_class?->yearClass->certificate,
            "current_student_class" => $current_student_class,
        ];


        return view('parents.home', $data);
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

            if ($student->can_login == false){
                Session::flash('error', 'لا يمكن تسجيل الدخول !.');
                return back();
            }

            Session::put('otpVerifyID', $student->id);
            Session::put('otpVerifyPhone', request('phone'));
         //   Session::put('otpVerifyPhone', "0548331236");
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
        $student = Student::findOrFail(session('otpVerifyID'));
        if ($student) {
            $student->generateCode();
            Session::flash('success', 'تم ارسال الرمز الى رقم هاتفك.');
        }

        return back();
    }

    public function cancel()
    {
        Session::forget(['otpVerifyID', 'otpVerifyPhone']);
        return back();
    }


}
