@extends('layouts.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>اضافة موظف جديد</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{ route('workers.store') }}" method="POST"
                  enctype="multipart/form-data">
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

                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="identification" class="form-label">رقم الهوية</label>
                            <input type="text" id="identification" name="identification"
                                   class="form-control only-integer @error('identification') is-invalid @enderror"
                                   maxlength="9" value="{{old('identification')}}" required>
                            @error('identification')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="birth_date" class="form-label">تاريخ الميلاد </label>
                            <input type="text" id="birth_date" name="birth_date"
                                   class="form-control  @error('birth_date') is-invalid @enderror"
                                   value="{{date('d/m/Y', strtotime(old('birth_date')))}}" required>

                            @error('birth_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="id_photo" class="form-label">صورة الهوية </label>
                            <input class="form-control @error('id_photo') is-invalid @enderror"
                                   type="file" name="id_photo" id="id_photo">
                            @error('id_photo')
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


                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="bank_name" class="form-label"> اسم البنك </label>
                            <input type="text" id="bank_name" name="bank_name"
                                   class="form-control  @error('bank_name') is-invalid @enderror"
                                   value="{{old('bank_name')}}">
                            @error('bank_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="bank_branch" class="form-label"> فرع البنك </label>
                            <input type="text" id="bank_branch" name="bank_branch"
                                   class="form-control  @error('bank_branch') is-invalid @enderror"
                                   value="{{old('bank_branch')}}">
                            @error('bank_branch')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="bank_account" class="form-label"> رقم الحساب </label>
                            <input type="text" id="bank_account" name="bank_account"
                                   class="form-control  @error('bank_account') is-invalid @enderror"
                                   value="{{old('bank_account')}}">
                            @error('bank_account')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
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


                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="phone_2" class="form-label"> رقم هاتف احتياطي </label>
                            <input type="text" id="phone_2" name="phone_2"
                                   class="form-control only-integer @error('phone_2') is-invalid @enderror"
                                   value="{{old('phone_2')}}">
                            @error('phone_2')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="star_work_date" class="form-label">تاريخ بدأ العمل </label>
                            <input type="text" id="star_work_date" name="star_work_date"
                                   class="form-control  @error('star_work_date') is-invalid @enderror"
                                   value="{{date('d/m/Y', strtotime(old('star_work_date')))}}"  required>
                            @error('star_work_date')
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
                                <option {{old('gender') == 'male' ? 'selected' : '' }} value="male">ذكر</option>
                                <option {{old('gender') == 'female' ? 'selected' : '' }} value="female">انثى</option>
                            </select>
                            @error('gender')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-6 col-md-3">
                        <div class="mb-3">
                            <label for="job_type" class="form-label"> نوع الوظيفة </label>
                            <select class="form-select @error('job_type') is-invalid @enderror"
                                    id="job_type" name="job_type" required>
                                <option selected disabled value="">اختر ...</option>
                                <option {{old('job_type') == 'fullJob' ? 'selected' : '' }} value="fullJob">وظيفة
                                    كاملة
                                </option>
                                <option {{old('job_type') == 'partTime' ? 'selected' : '' }} value="partTime">وظيفة
                                    جزئية
                                </option>
                            </select>
                            @error('job_type')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-3">
                        <div class="mb-3">
                            <label for="password" class="form-label"> كلمة المرور  </label>
                            <input type="password" id="password" name="password" value="{{old('password')}}"
                                   class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="mb-3">
                            <label for="notes" class="form-label"> ملاحظات اضافية </label>
                            <textarea type="text" id="notes" name="notes"
                                      class="form-control  @error('notes') is-invalid @enderror"
                                      rows="3">{{old('notes')}}</textarea>
                            @error('notes')
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

@push('scripts')
    <script>
        $( "#birth_date" ).datepicker({dateFormat: 'dd/mm/yy',});
        $( "#star_work_date" ).datepicker({dateFormat: 'dd/mm/yy',});
    </script>
@endpush
