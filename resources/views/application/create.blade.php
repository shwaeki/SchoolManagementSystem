@extends('layouts.auth')

@section('content')
    <div class="container mx-auto align-self-center">

        <div class="row">

            <div class="col-md-8 col-12 d-flex flex-column align-self-center mx-auto">
                <div class="card bg-white mt-3 mb-3">
                    <div class="card-body">

                        <form action="{{ route('application.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3 text-center">
                                    <img src="{{ asset("assets/img/logo.png") }}" width="180px">
                                    
                                    <h2 class="text-center"> طلب التسجيل لطالب جديد </h2>
                                    <p class="text-center mb-3">روضات المجد </p>
                                </div>

                                <div class="col-12 mt-3">
                                    <h4> معلومات الطالب</h4>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class=" form-floating mb-3">
                                        <input type="text" id="name" name="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               value="{{old('name')}}"  placeholder="" required>
                                        <label for="name" class="form-label">الاسم</label>
                                        @error('name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="identification" name="identification"
                                               class="form-control only-integer @error('identification') is-invalid @enderror"
                                               maxlength="9" value="{{old('identification')}}"  placeholder="" required>
                                        <label for="identification" class="form-label">رقم الهوية</label>
                                        @error('identification')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="birth_date" name="birth_date"
                                               class="form-control  @error('birth_date') is-invalid @enderror"
                                               value="@if(old('birth_date')) {{date('d/m/Y', strtotime(old('birth_date'))) }} @endif"  placeholder="" required>
                                        <label for="birth_date" class="form-label">تاريخ الميلاد </label>
                                        @error('birth_date')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="birth_place" name="birth_place"
                                               class="form-control @error('birth_place') is-invalid @enderror"
                                               value="{{old('birth_place')}}"  placeholder="" required>
                                        <label for="birth_place" class="form-label">مكان الولادة </label>
                                        @error('birth_place')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="address" name="address"
                                               class="form-control @error('address') is-invalid @enderror"
                                               value="{{old('address')}}"  placeholder="" required>
                                        <label for="address" class="form-label">العنوان </label>
                                        @error('address')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="address_street" name="address_street"
                                               class="form-control @error('address_street') is-invalid @enderror"
                                               value="{{old('address_street')}}"  placeholder="" required>
                                        <label for="address_street" class="form-label"> الشارع </label>
                                        @error('address_street')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="address_house_no" name="address_house_no"
                                               class="form-control @error('address_house_no') is-invalid @enderror"
                                               value="{{old('address_house_no')}}"  placeholder="" required>
                                        <label for="address_house_no" class="form-label"> رقم البيت </label>
                                        @error('address_house_no')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="zipcode" name="zipcode"
                                               class="form-control @error('zipcode') is-invalid @enderror"
                                               value="{{old('zipcode')}}"  placeholder="" required>
                                        <label for="zipcode" class="form-label"> الرمز البريدي (Zip) </label>
                                        @error('zipcode')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select @error('gender') is-invalid @enderror"
                                                id="gender" name="gender" required>
                                            <option selected disabled value="">اختر ...</option>
                                            <option {{old('gender') == 'male' ? 'selected' : '' }} value="male">
                                                ذكر
                                            </option>
                                            <option {{old('gender') == 'female' ? 'selected' : '' }} value="female">
                                                انثى
                                            </option>
                                        </select>
                                        <label for="gender" class="form-label"> الجنس </label>
                                        @error('gender')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="postal_code" name="postal_code"
                                               class="form-control only-integer @error('postal_code') is-invalid @enderror"
                                               value="{{old('postal_code')}}"  placeholder="" required>
                                        <label for="postal_code" class="form-label"> رقم صندوق البريد </label>
                                        @error('postal_code')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-12  mt-3">
                                    <h4>معلومات العائلة</h4>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="mother_name" name="mother_name"
                                               class="form-control  @error('mother_name') is-invalid @enderror"
                                               value="{{old('mother_name')}}"  placeholder="" required>
                                        <label for="mother_name" class="form-label"> اسم الام </label>
                                        @error('mother_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="mother_phone" name="mother_phone"
                                               class="form-control only-integer @error('mother_phone') is-invalid @enderror"
                                               value="{{old('mother_phone')}}" maxlength="10"  placeholder="" required>
                                        <label for="mother_phone" class="form-label"> رقم هاتف الام </label>
                                        @error('mother_phone')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="mother_id" name="mother_id"
                                               class="form-control only-integer @error('mother_id') is-invalid @enderror"
                                               value="{{old('mother_id')}}"  placeholder="" required>
                                        <label for="mother_id" class="form-label"> رقم هوية الام </label>
                                        @error('mother_id')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="father_name" name="father_name"
                                               class="form-control  @error('father_name') is-invalid @enderror"
                                               value="{{old('father_name')}}"  placeholder="" required>
                                        <label for="father_name" class="form-label"> اسم الاب </label>
                                        @error('father_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="father_phone" name="father_phone"
                                               class="form-control only-integer @error('father_phone') is-invalid @enderror"
                                               value="{{old('father_phone')}}" maxlength="10"  placeholder="" required>
                                        <label for="father_phone" class="form-label"> رقم هاتف الاب </label>
                                        @error('father_phone')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="father_id" name="father_id"
                                               class="form-control only-integer @error('father_id') is-invalid @enderror"
                                               value="{{old('father_id')}}"  placeholder="" required>
                                        <label for="father_id" class="form-label"> رقم هوية الاب </label>
                                        @error('father_id')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select @error('family_status') is-invalid @enderror"
                                                id="family_status" name="family_status" required>
                                            <option selected disabled value="">اختر ...</option>
                                            <option
                                                {{old('family_status') == 'unspecified' ? 'selected' : '' }} value="unspecified">
                                                غير
                                                محدد
                                            </option>
                                            <option
                                                {{old('family_status') == 'divorced' ? 'selected' : '' }} value="divorced">
                                                مطلقين
                                            </option>
                                        </select>
                                        <label for="family_status" class="form-label"> الحالة الاجتماعية
                                            للعائلة </label>
                                        @error('family_status')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select @error('custody') is-invalid @enderror"
                                                id="custody" name="custody"  required>
                                            <option selected disabled value="">اختر ...</option>
                                            <option
                                                {{old('custody') == 'unspecified' ? 'selected' : '' }} value="unspecified">
                                                غير
                                                محدد
                                            </option>
                                            <option {{old('custody') == 'mother' ? 'selected' : '' }} value="mother">
                                                الام
                                            </option>
                                            <option {{old('custody') == 'father' ? 'selected' : '' }} value="father">
                                                الاب
                                            </option>
                                        </select>
                                        <label for="custody" class="form-label"> حضانة الطالب </label>
                                        @error('custody')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" id="family_members" name="family_members"
                                               class="form-control only-integer @error('family_members') is-invalid @enderror"
                                               value="{{old('family_members')}}"  placeholder="" required>
                                        <label for="family_members" class="form-label"> عدد افراد العائلة </label>
                                        @error('family_members')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12  mt-3">
                                    <h4>المرفقات</h4>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="personal_photo" class="form-label">صورة شخصية </label>
                                        <input class="form-control @error('personal_photo') is-invalid @enderror"
                                               type="file" name="personal_photo" id="personal_photo" required>
                                        @error('personal_photo')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="birth_certificate" class="form-label">شهادة الملاد</label>
                                        <input class="form-control @error('birth_certificate') is-invalid @enderror"
                                               type="file" name="birth_certificate" id="birth_certificate" required>
                                        @error('birth_certificate')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary mt-3 w-100">تقديم الطلب</button>


                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $("#birth_date").datepicker({
            dateFormat: 'dd/mm/yy',
        });
    </script>
@endpush
