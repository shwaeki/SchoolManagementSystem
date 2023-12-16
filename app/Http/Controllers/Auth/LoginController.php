<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;


/*    protected function authenticated(Request $request, $user)
    {

        if (auth()->guard('teacher')->check()) {
            return redirect('/teacher');
        }


        return redirect(RouteServiceProvider::HOME);
    }*/


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected function attemptLogin(Request $request)
    {



        $attemptWeb = Auth::guard()->attempt($this->credentials($request));


        if ($attemptWeb) {
            return true;
        }

        $attemptTeacher = Auth::guard('teacher')->attempt($this->credentials($request));

        return $attemptTeacher;
    }


    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        if (Auth::guard('teacher')->check()) {
            Auth::guard('teacher')->logout();
        }

        $request->session()->invalidate();

        return redirect('login');
    }
}
