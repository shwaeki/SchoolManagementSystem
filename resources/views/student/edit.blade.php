@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>تعديل معلومات الطالب - {{$student->name}}</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{ route('students.update',['student'=>$student]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم</label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{old('name',$student->name)}}" required>
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
                                   maxlength="9" value="{{old('identification',$student->identification)}}" required>
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
                                   value="{{old('birth_date',$student->birth_date)}}" required>
                            @error('birth_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="birth_place" class="form-label">مكان الولادة </label>
                            <input type="text" id="birth_place" name="birth_place"
                                   class="form-control @error('birth_place') is-invalid @enderror"
                                   value="{{old('birth_place',$student->birth_place)}}">
                            @error('birth_place')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="address" class="form-label"> العنوان </label>
                            <input type="text" id="address" name="address"
                                   class="form-control @error('address') is-invalid @enderror"
                                   value="{{old('address',$student->address)}}" required>
                            @error('address')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="address_street" class="form-label"> الشارع </label>
                            <input type="text" id="address_street" name="address_street"
                                   class="form-control @error('address_street') is-invalid @enderror"
                                   value="{{old('address_street',$student->address_street)}}">
                            @error('address_street')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="address_house_no" class="form-label"> رقم البيت </label>
                            <input type="text" id="address_house_no" name="address_house_no"
                                   class="form-control @error('address_house_no') is-invalid @enderror"
                                   value="{{old('address_house_no',$student->address_house_no)}}">
                            @error('address_house_no')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-6 col-md-3">
                        <div class="mb-3">
                            <label for="mother_name" class="form-label"> اسم الام </label>
                            <input type="text" id="mother_name" name="mother_name"
                                   class="form-control  @error('mother_name') is-invalid @enderror"
                                   value="{{old('mother_name',$student->mother_name)}}" maxlength="10" required>
                            @error('mother_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="mb-3">
                            <label for="mother_phone" class="form-label"> رقم هاتف الام </label>
                            <input type="text" id="mother_phone" name="mother_phone"
                                   class="form-control only-integer @error('mother_phone') is-invalid @enderror"
                                   value="{{old('mother_phone',$student->mother_phone)}}" required>
                            @error('mother_phone')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-6 col-md-3">
                        <div class="mb-3">
                            <label for="father_name" class="form-label"> اسم الاب </label>
                            <input type="text" id="father_name" name="father_name"
                                   class="form-control  @error('father_name') is-invalid @enderror"
                                   value="{{old('father_name',$student->father_name)}}" maxlength="10" required>
                            @error('father_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="mb-3">
                            <label for="father_phone" class="form-label"> رقم هاتف الاب </label>
                            <input type="text" id="father_phone" name="father_phone"
                                   class="form-control only-integer @error('father_phone') is-invalid @enderror"
                                   value="{{old('father_phone',$student->father_phone)}}" required>
                            @error('father_phone')
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
                                <option {{old('sex',$student->gender) == 'male' ? 'selected' : '' }} value="male">ذكر
                                </option>
                                <option {{old('gender',$student->gender) == 'female' ? 'selected' : '' }} value="female">
                                    انثى
                                </option>
                            </select>
                            @error('gender')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="mb-3">
                            <label for="family_status" class="form-label"> الحالة الاجتماعية للعائلة </label>
                            <select class="form-select @error('family_status') is-invalid @enderror"
                                    id="family_status" name="family_status" required>
                                <option selected disabled value="">اختر ...</option>
                                <option
                                    {{old('family_status',$student->family_status) == 'unspecified' ? 'selected' : '' }} value="unspecified">
                                    غير محدد
                                </option>
                                <option
                                    {{old('family_status',$student->family_status) == 'divorced' ? 'selected' : '' }} value="divorced">
                                    مطلقين
                                </option>
                            </select>
                            @error('family_status')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-6 col-md-3">
                        <div class="mb-3">
                            <label for="custody" class="form-label"> حضانة الطالب </label>
                            <select class="form-select @error('custody') is-invalid @enderror"
                                    id="custody" name="custody" required>
                                <option selected disabled value="">اختر ...</option>
                                <option
                                    {{old('custody',$student->custody) == 'unspecified' ? 'selected' : '' }} value="unspecified">
                                    غير محدد
                                </option>
                                <option
                                    {{old('custody',$student->custody) == 'mother' ? 'selected' : '' }} value="mother">
                                    الام
                                </option>
                                <option
                                    {{old('custody',$student->custody) == 'father' ? 'selected' : '' }} value="father">
                                    الاب
                                </option>
                            </select>
                            @error('custody')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="mb-3">
                            <label for="notes" class="form-label"> ملاحظات اضافية </label>
                            <textarea type="text" id="notes" name="notes"
                                      class="form-control  @error('notes') is-invalid @enderror"
                                      rows="3">{{old('notes',$student->notes)}}</textarea>
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
