@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>تعديل معلومات المستخدم - {{$user->name}}</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{route('users.update',['user'=>$user])}}" method="POST">
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
                            <label for="role" class="form-label"> الدور </label>
                            <select class="form-select @error('role') is-invalid @enderror"
                                    id="role" name="role" required>
                                <option selected disabled value="">اختر ...</option>
                                @foreach($roles as $key=>$role)
                                    <option
                                        {{old('role',$user->roles->pluck('id')[0]) == $key ? 'selected' : '' }} value="{{$key}}">
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
                                   value="{{old('phone',$user->phone)}}">
                            @error('phone')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-3">
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
@endsection
