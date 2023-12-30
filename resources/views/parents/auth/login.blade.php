@extends('layouts.auth')

@section('content')
    <div class="container mx-auto align-self-center">
        <form method="POST" action="{{ route('parents.login') }}">
            @csrf
            <div class="row">

                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3 text-center ">
                                    <img src="{{ asset("assets/img/logo.png") }}" width="200px" class="mb-3">

                                    <h2 class="mb-3">تسجيل الدخول</h2>
                                    <p>رقم هوية الطالب و رقم احد الوالدين.</p>
                                    @if (session('error'))
                                        <div class="alert alert-light-danger fade show mb-4" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="identification"> رقم الهوية</label>
                                        <input id="identification" type="text"
                                               class="form-control @error('identification') is-invalid @enderror"
                                               name="identification"
                                               value="{{ old('identification') }}" required autocomplete="off">

                                        @error('identification')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-4">
                                        <label for="phone">رقم الهاتف</label>
                                        <input id="phone" type="text"
                                               class="form-control @error('phone') is-invalid @enderror"
                                               name="phone"
                                               required autocomplete="off">

                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-primary w-100">تسجيل الدخول</button>
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
