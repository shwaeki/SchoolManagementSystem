@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow mb-3">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>تعديل معلومات الملف الشخصي</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{route('profile.update')}}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label"> الاسم </label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{old('name',$user->name)}}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label"> البريد الاكتروني </label>
                            <input type="email" id="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{old('email' ,$user->email)}}" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label"> رقم الهاتف </label>
                            <input type="text" id="phone" name="phone"
                                   class="form-control only-integer @error('phone') is-invalid @enderror"
                                   value="{{old('phone',$user->phone)}}">
                            @error('phone')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="birth_date" class="form-label"> تاريخ الميلاد </label>
                            <input type="date" id="birth_date" name="birth_date"
                                   class="form-control  @error('birth_date') is-invalid @enderror"
                                   value="{{old('birth_date',$user->birth_date)}}">
                            @error('birth_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                </div>


                <button type="submit" class="btn btn-primary ml-3">تعديل</button>

            </form>


        </div>
    </div>

    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>تعديل كلمة المرور </h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{route('profile.password')}}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">

                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="current_password" class="form-label"> كلمة المرور الحالية </label>
                            <input type="password" id="current_password" name="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror" required>
                            @error('current_password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="new_password" class="form-label"> كلمة المرور الجديدة </label>
                            <input type="password" id="new_password" name="new_password"
                                   class="form-control @error('new_password') is-invalid @enderror" required>
                            @error('new_password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="new_confirm_password" class="form-label"> تاكيد كلمة المرور الجديدة </label>
                            <input type="password" id="new_confirm_password" name="new_confirm_password"
                                   class="form-control @error('new_confirm_password') is-invalid @enderror" required>
                            @error('new_confirm_password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                </div>


                <button type="submit" class="btn btn-primary ml-3">تعديل</button>

            </form>


        </div>
    </div>
@endsection
