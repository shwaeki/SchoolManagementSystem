@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>تعديل معلومات المعلم - {{$teacher->name}}</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{ route('teachers.update',['teacher'=>$teacher]) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم</label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{old('name',$teacher->name)}}" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="identification" class="form-label">رقم الهوية</label>
                            <input type="text" id="identification" name="identification"
                                   class="form-control only-integer @error('identification') is-invalid @enderror"
                                   maxlength="9" value="{{old('identification',$teacher->identification)}}" required>
                            @error('identification')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="birth_date" class="form-label">تاريخ الميلاد </label>
                            <input type="date" id="birth_date" name="birth_date"
                                   class="form-control  @error('birth_date') is-invalid @enderror"
                                   value="{{old('birth_date',$teacher->birth_date)}}" required>
                            @error('birth_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="address" class="form-label">العنوان </label>
                            <input type="text" id="address" name="address"
                                   class="form-control @error('address') is-invalid @enderror"
                                   value="{{old('address',$teacher->address)}}" required>
                            @error('address')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="email" class="form-label"> البريد الاكتروني </label>
                            <input type="email" id="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{old('email',$teacher->email)}}" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="phone_1" class="form-label"> رقم الهاتف </label>
                            <input type="text" id="phone_1" name="phone_1"
                                   class="form-control only-integer @error('phone_1') is-invalid @enderror"
                                   value="{{old('phone_1',$teacher->phone_1)}}" required>
                            @error('phone_1')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="phone_2" class="form-label"> رقم هاتف احتياطي </label>
                            <input type="text" id="phone_2" name="phone_2"
                                   class="form-control only-integer @error('phone_2') is-invalid @enderror"
                                   value="{{old('phone_2',$teacher->phone_2)}}">
                            @error('phone_2')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="star_work_date" class="form-label">تاريخ بدأ العمل </label>
                            <input type="date" id="star_work_date" name="star_work_date"
                                   class="form-control  @error('star_work_date') is-invalid @enderror"
                                   value="{{old('star_work_date',$teacher->star_work_date)}}" required>
                            @error('star_work_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="mb-3">
                            <label for="school_class_id" class="form-label"> فصل المدرس </label>
                            <select class="form-select @error('school_class_id') is-invalid @enderror"
                                    id="school_class_id" name="school_class_id">
                                <option selected disabled value="">اختر ...</option>
                                @foreach($schoolClasses as $class)
                                    <option
                                        {{old('school_class_id',$teacher->school_class_id) == $class->name ? 'selected' : '' }} value="{{$class->id}}">
                                        {{$class->name}}
                                    </option>
                                @endforeach
                            </select>
                            @error('school_class_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-6 col-md-3">
                        <div class="mb-3">
                            <label for="gender" class="form-label"> الجنس </label>
                            <select class="form-select @error('gender') is-invalid @enderror"
                                    id="gender" name="gender" required>
                                <option selected disabled value="">اختر ...</option>
                                <option {{old('gender',$teacher->gender) == 'male' ? 'selected' : '' }} value="male">ذكر</option>
                                <option {{old('gender',$teacher->gender) == 'female' ? 'selected' : '' }} value="female">انثى</option>
                            </select>
                            @error('gender')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-6 col-md-3">
                        <div class="mb-3">
                            <label for="status" class="form-label"> حالة المعلم </label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                <option selected disabled value="">اختر ...</option>
                                <option {{old('status',$teacher->status) == 'persistent' ? 'selected' : '' }} value="persistent">
                                    مستمر
                                </option>
                                <option {{old('status',$teacher->status) == 'maternity_leave' ? 'selected' : '' }} value="maternity_leave">
                                    اجازة ولادة
                                </option>
                                <option {{old('status',$teacher->status) == 'unpaid_vacation' ? 'selected' : '' }} value="unpaid_vacation">
                                    اجازة بدون راتب
                                </option>
                                <option {{old('status',$teacher->status) == 'sick_leave' ? 'selected' : '' }} value="sick_leave">
                                    اجازة مرضية
                                </option>
                                <option {{old('status',$teacher->status) == 'substitute_teacher' ? 'selected' : '' }} value="substitute_teacher">
                                    معلم بديل
                                </option>
                                <option {{old('status',$teacher->status) == 'quit_working' ? 'selected' : '' }} value="quit_working">
                                    ترك العمل
                                </option>

                            </select>
                            @error('status')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="mb-3">
                            <label for="notes" class="form-label"> ملاحظات اضافية </label>
                            <textarea type="text" id="notes" name="notes"
                                      class="form-control  @error('notes') is-invalid @enderror"
                                      rows="3">{{old('notes',$teacher->notes)}}</textarea>
                            @error('notes')
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
