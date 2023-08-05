@extends('layouts.auth')

@section('content')

    <div class="container mx-auto align-self-center">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row">

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12 mb-3">

                                    <h2 class="text-center mb-3">تسجيل الدخول</h2>
                                    <p>ادخل البريد الاكتروني و كلمة المرور لتسجيل الدخول.</p>

                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="email">البريد الاكتروني</label>
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="password"> كلمة المرور</label>
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password"
                                               required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="form-check form-check-primary form-check-inline">
                                            <input class="form-check-input me-3" type="checkbox" name="remember"
                                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                تذكر معلوماتي ؟
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-secondary w-100">تسجيل الدخول</button>
                                    </div>
                                </div>
                                @if (Route::has('password.request'))
                                    <hr>
                                    <div class="col-12 text-center">
                                        <a href="{{ route('password.request') }}">
                                            لقد نسيت كلمة المرور.
                                        </a>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

@endsection
