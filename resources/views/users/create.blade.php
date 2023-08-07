@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>اضافة مستخدم جديد</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{route('users.store')}}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label"> الاسم </label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{old('name')}}" required>
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
                                   value="{{old('email')}}" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="role" class="form-label"> الدور </label>
                            <select class="form-select @error('role') is-invalid @enderror"
                                    id="role" name="role" required>
                                <option selected disabled value="">اختر ...</option>
                                @foreach($roles as $key=>$role)
                                    <option
                                        {{old('role') == $key ? 'selected' : '' }} value="{{$key}}">
                                        {{$role}}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="phone" class="form-label"> رقم الهاتف </label>
                            <input type="text" id="phone" name="phone"
                                   class="form-control only-integer @error('phone') is-invalid @enderror"
                                   value="{{old('phone')}}">
                            @error('phone')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="birth_date" class="form-label">  تاريخ الميلاد </label>
                            <input type="date" id="birth_date" name="birth_date"
                                   class="form-control  @error('birth_date') is-invalid @enderror"
                                   value="{{old('birth_date')}}">
                            @error('birth_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>



                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور </label>
                            <input type="password" id="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   value="{{old('password')}}" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">كلمة المرور </label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="form-control" value="{{old('password_confirmation')}}" required>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary ml-3">اضافة</button>

            </form>
        </div>
    </div>
@endsection
