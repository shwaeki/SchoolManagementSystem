@extends('layouts.app')

@push('styles')
    <link href="{{ asset("assets/css/light/users/account-setting.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/users/account-setting.css")  }}" rel="stylesheet" type="text/css"/>

    <style>

        iframe {
            width: 100%;
            height: 300px;
            overflow: hidden;
            border: none;
            box-shadow: 0 0 2rem 0 rgb(136 152 170 / 15%);
            border-radius: 0.375rem;
        }
    </style>

@endpush

@section('content')

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="row mb-3">
                <div class="col-12 col-md-6">
                    <h2 class="mb-3"> معلومات الطلب - {{$studentRequest->name}}</h2>
                </div>
                <div class="col-12 col-md-6 align-self-center text-end">
                    <form id="copyDataForm" action="{{ route("students-request.accept",$studentRequest) }}"
                          method="POST">
                        @csrf
                        @method('PUT')
                        <button type="button" id="submitButton" class="btn btn-primary">الموافقة على الطلب</button>
                    </form>
                </div>
            </div>

            @if ($errors->has('identification'))
                <div class="alert alert-danger">
                    هذا الطلب مسجل مسبقا في النظام الرجاء التحقق من رقم الهوية.
                </div>
            @endif

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                    <div class="section general-info">
                        <div class="info">
                            <div class="row">
                                <div class="col-9">
                                    <h6> البيانات الشخصية </h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">الاسم</label>
                                        <input type="text" id="name" class="form-control"
                                               value="{{$studentRequest->name}}" disabled>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="identification" class="form-label">رقم الهوية</label>
                                        <input type="text" id="identification" class="form-control"
                                               value="{{$studentRequest->identification}}" disabled>

                                    </div>
                                </div>

                                <div class="col-12 col-md-3">
                                    <div class="mb-3">
                                        <label for="birth_date" class="form-label">تاريخ الميلاد </label>
                                        <input type="text" id="birth_date" class="form-control"
                                               value="{{ date('d/m/Y', strtotime($studentRequest->birth_date))}}"
                                               disabled>
                                    </div>
                                </div>

                                <div class="col-12 col-md-3">
                                    <div class="mb-3">
                                        <label for="birth_place" class="form-label">مكان الولادة </label>
                                        <input type="text" id="birth_place" class="form-control"
                                               value="{{$studentRequest->birth_place}}" disabled>
                                    </div>
                                </div>

                                <div class="col-12 col-md-3">
                                    <div class="mb-3">
                                        <label for="address" class="form-label"> العنوان </label>
                                        <input type="text" id="address" class="form-control"
                                               value="{{$studentRequest->address}}" disabled>
                                    </div>
                                </div>


                                <div class="col-12 col-md-3">
                                    <div class="mb-3">
                                        <label for="address_street" class="form-label"> الشارع </label>
                                        <input type="text" id="address" class="form-control"
                                               value="{{$studentRequest->address_street}}" disabled>
                                    </div>
                                </div>

                                <div class="col-12 col-md-3">
                                    <div class="mb-3">
                                        <label for="address_house_no" class="form-label"> رقم البيت </label>
                                        <input type="text" id="address" class="form-control"
                                               value="{{$studentRequest->address_house_no}}" disabled>
                                    </div>
                                </div>

                                <div class="col-12 col-md-3">
                                    <div class="mb-3">
                                        <label for="zipcode" class="form-label"> الرمز البريدي (Zip) </label>
                                        <input type="text" id="zipcode" class="form-control"
                                               value="{{$studentRequest->zipcode}}" disabled>
                                    </div>
                                </div>


                                <div class="col-6 col-md-3">
                                    <div class="mb-3">
                                        <label for="gender" class="form-label"> الجنس </label>
                                        <input type="text" id="gender" class="form-control"
                                               value="{{trans('options.'.$studentRequest->gender)  }}" disabled>
                                    </div>
                                </div>


                                <div class="col-12 col-md-3">
                                    <div class="mb-3">
                                        <label for="postal_code" class="form-label">رقم صندوق البريد </label>
                                        <input type="text" id="postal_code" class="form-control"
                                               value="{{$studentRequest->postal_code}}" disabled>
                                    </div>
                                </div>


                                <div class="col-12 col-md-3">
                                    <div class="mb-3">
                                        <label for="old_school" class="form-label"> الروضة السابقة </label>
                                        <input type="text" id="old_school" class="form-control"
                                               value="{{$studentRequest->old_school}}" disabled>
                                    </div>
                                </div>

                                <div class="col-12 col-md-3">
                                    <div class="mb-3">
                                        <label for="school_class_id" class="form-label"> الروضة المراج التسجيبل بها </label>
                                        <input type="text" id="school_class_id" class="form-control"
                                               value="{{$studentRequest->schoolClass->name}} - {{$studentRequest->schoolClass->address}}" disabled>
                                    </div>
                                </div>



                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                    <div class="section general-info">
                        <div class="info">
                            <div class="row">
                                <div class="col-9">
                                    <h6> معلومات العائلة</h6>
                                </div>
                            </div>

                            <div class="row">


                                <div class="col-6 col-md-4">
                                    <div class="mb-3">
                                        <label for="mother_name" class="form-label"> اسم الام </label>
                                        <input type="text" id="mother_name" class="form-control"
                                               value="{{$studentRequest->mother_name}}" disabled>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="mb-3">
                                        <label for="mother_phone" class="form-label"> رقم هاتف الام </label>
                                        <input type="text" id="mother_phone" class="form-control"
                                               value="{{$studentRequest->mother_phone}}" disabled>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="mb-3">
                                        <label for="mother_id" class="form-label"> رقم هوية الام </label>
                                        <input type="text" id="mother_id" class="form-control"
                                               value="{{$studentRequest->mother_id}}" disabled>
                                    </div>
                                </div>


                                <div class="col-6 col-md-4">
                                    <div class="mb-3">
                                        <label for="father_name" class="form-label"> اسم الاب </label>
                                        <input type="text" id="father_name" class="form-control"
                                               value="{{$studentRequest->father_name}}" disabled>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="mb-3">
                                        <label for="father_phone" class="form-label"> رقم هاتف الاب </label>
                                        <input type="text" id="father_phone" class="form-control"
                                               value="{{$studentRequest->father_phone}}" disabled>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="mb-3">
                                        <label for="father_id" class="form-label"> رقم هوية الاب </label>
                                        <input type="text" id="father_id" class="form-control"
                                               value="{{$studentRequest->father_id}}" disabled>
                                    </div>
                                </div>


                                <div class="col-6 col-md-4">
                                    <div class="mb-3">
                                        <label for="family_status" class="form-label"> الحالة الاجتماعية
                                            للعائلة </label>
                                        <input type="text" id="family_status" class="form-control"
                                               value="{{trans('options.'.$studentRequest->family_status)}}" disabled>
                                    </div>
                                </div>


                                <div class="col-6 col-md-4">
                                    <div class="mb-3">
                                        <label for="custody" class="form-label"> حضانة الطالب </label>
                                        <input type="text" id="gender" class="form-control"
                                               value="{{trans('options.'.$studentRequest->custody)}}" disabled>
                                    </div>
                                </div>

                                <div class="col-6 col-md-4">
                                    <div class="mb-3">
                                        <label for="family_members" class="form-label"> عدد افراد
                                            العائلة </label>
                                        <input type="text" id="family_members" class="form-control"
                                               value="{{$studentRequest->family_members}}" disabled>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                    <div class="section general-info">
                        <div class="info">
                            <div class="row">
                                <div class="col-9">
                                    <h6> المرفقات</h6>
                                </div>
                            </div>

                            <div class="row">


                                <div class="col-12">
                                    <iframe src="/filemanager"></iframe>
                                </div>



                            </div>


                        </div>
                    </div>
                </div>


            </div>

        </div>

    </div>

@endsection

@push('scripts')

    <script>
        $(document).ready(function () {
            $('#submitButton').click(function (event) {
                event.preventDefault();

                Swal.fire({
                    title: 'هل أنت متأكد؟',
                    text: 'هل انت متاكد من انك ترغب في تحويل بيانات الطلب الى طالب مسجل ؟',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#copyDataForm').submit();
                    }
                });
            });
        });
    </script>
@endpush
