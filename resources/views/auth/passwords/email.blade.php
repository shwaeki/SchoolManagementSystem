@extends('layouts.auth')

@section('content')
    <div class="container mx-auto align-self-center">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="row">

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <h2 class="text-center mb-3">إعادة تعيين كلمة المرور</h2>
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <p>ادخل البريد الاكتروني لكي تتمكن من اعادة تعين كلمة المرور.</p>

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
                                        <button type="submit" class="btn btn-primary w-100">
                                            إرسال رابط إعادة تعيين كلمة المرور
                                        </button>
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
