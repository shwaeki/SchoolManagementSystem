@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>اضافة فصل دراسي جديد</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{ route('school-classes.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم</label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{old('name')}}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="code" class="form-label"> الكود</label>
                            <input type="text" id="code" name="code"
                                   class="form-control @error('code') is-invalid @enderror"
                                  value="{{old('code')}}" required>
                            @error('code')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="alphabetical_name" class="form-label"> الكود الابجدي</label>
                            <input type="text" id="alphabetical_name" name="alphabetical_name"
                                   class="form-control @error('alphabetical_name') is-invalid @enderror"
                                  value="{{old('alphabetical_name')}}" required>
                            @error('alphabetical_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>



                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="address" class="form-label">العنوان </label>
                            <input type="text" id="address" name="address"
                                   class="form-control @error('address') is-invalid @enderror"
                                   value="{{old('address')}}" required>
                            @error('address')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>



                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="phone" class="form-label"> رقم الهاتف </label>
                            <input type="text" id="phone" name="phone"
                                   class="form-control only-integer @error('phone') is-invalid @enderror"
                                   value="{{old('phone')}}" required>
                            @error('phone')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>





                    <div class="col-6 col-md-3">
                        <div class="mb-3">
                            <label for="supervisor" class="form-label">  المعلم المشرف </label>
                            <select class="form-select @error('school_class_id') is-invalid @enderror"
                                    id="supervisor" name="supervisor">
                                <option selected disabled value="">اختر ...</option>
                                @foreach($teachers as $teacher)
                                    <option
                                        {{old('supervisor') == $teacher->name ? 'selected' : '' }} value="{{$teacher->id}}">
                                        {{$teacher->name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('supervisor')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="capacity" class="form-label"> الطاقة الاستيعابة </label>
                            <input type="text" id="capacity" name="capacity"
                                   class="form-control only-integer @error('capacity') is-invalid @enderror"
                                   value="{{old('capacity')}}" required>
                            @error('capacity')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="student_start_age" class="form-label"> الحد الادنى لعمر الطلاب </label>
                            <input type="text" id="student_start_age" name="student_start_age"
                                   class="form-control only-integer @error('student_start_age') is-invalid @enderror"
                                   value="{{old('student_start_age')}}" >
                            @error('student_start_age')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="student_end_age" class="form-label"> الحد الاعلى لعمر الطلاب </label>
                            <input type="text" id="student_end_age" name="student_end_age"
                                   class="form-control only-integer @error('student_end_age') is-invalid @enderror"
                                   value="{{old('student_end_age')}}" >
                            @error('student_end_age')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                </div>

                <button type="submit" class="btn btn-primary ml-3">اضافة</button>
            </form>

        </div>
    </div>
@endsection
