<?php

namespace App\Http\Controllers;

use App\Models\OTP;
use App\Http\Requests\CheckOTPRequest;
use App\Http\Requests\UpdateOTPRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OtpController extends Controller
{

    public function index()
    {
        return view('auth.otp');
    }


    public function verification(CheckOTPRequest $request)
    {
        $request->validate([
            'code'=>'required',
        ]);

        $check = Otp::where('user_id', auth()->user()->id)
            ->where('code', $request->code)
            ->where('updated_at', '>=', now()->subMinutes(2))
            ->first();

        if (!is_null($check)) {
            Session::put('otpVerify', auth()->user()->id);
            return redirect()->route('home');
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


}
