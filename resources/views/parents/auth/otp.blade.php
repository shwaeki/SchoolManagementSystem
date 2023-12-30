@extends('layouts.auth')

@section('content')
    <div class="container mx-auto align-self-center">
        <form method="POST" action="{{ route('otp.verification') }}">
            @csrf
            <div class="row">

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <h2 class="text-center mb-3">التحقق ثنائي الخطوة</h2>
                                    @if (session('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif


                                    @if (session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <p class="mb-0 text-center"> تم ارسال كود التحقق الى رقم الهاتف : </p>
                                    <p class="text-center" style="direction: ltr">
                                        {{ substr(Session::get('otpVerifyPhone'), 0, 3) . '****' . substr(Session::get('otpVerifyPhone'),  -3) }}
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="code"> الرمز</label>
                                        <input id="text" type="code"
                                               class="form-control @error('code') is-invalid @enderror" name="code"
                                               value="{{ old('code') }}" required autocomplete="off" >

                                        @error('code')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3 ms-2">
                                        <a class="link-primary" href="{{route('otp.resend')}}">ارسل الرمز مرة اخرى.</a>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-primary w-100">
                                            تحقق
                                        </button>
                                    </div>
                                    <div class="mb-4">
                                        <a class="btn btn-danger w-100" href="{{route('otp.cancel')}}">
                                            تسجيل الدخول الى طالب اخر
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
