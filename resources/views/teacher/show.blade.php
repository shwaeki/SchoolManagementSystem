@extends('layouts.app')

@push('styles')
    <link href="{{ asset("assets/css/light/users/account-setting.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/users/account-setting.css")  }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset("assets/css/light/components/tabs.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/components/tabs.css")  }}" rel="stylesheet" type="text/css"/>

    <style>

        iframe {
            width: 100%;
            height: 700px;
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
                <div class="col-md-12">
                    <h2 class="mb-3"> معلومات المعلم - {{$teacher->name}}</h2>

                    <ul class="nav nav-pills" id="animateLine" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="teacher-info-tab" data-bs-toggle="tab"
                                    href="#teacher-info" role="tab" aria-controls="teacher-info" aria-selected="true">
                                <i class="fas fa-info-circle"></i>
                                البيانات الشخصية
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="teacher-files-tab" data-bs-toggle="tab" href="#teacher-files"
                                    role="tab" aria-controls="teacher-files" aria-selected="false" tabindex="-1">
                                <i class="fas fa-folder-open"></i>
                                ملفات المعلم
                            </button>
                        </li>


                        {{--                        <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="teacher-log-tab" data-bs-toggle="tab" href="#teacher-log"
                                                            role="tab" aria-controls="teacher-log" aria-selected="false" tabindex="-1">
                                                        <i class="fas fa-history"></i>
                                                        سجل الطالب
                                                    </button>
                                                </li>--}}


                    </ul>
                </div>
            </div>

            <div class="tab-content" id="animateLineContent-4">
                <div class="tab-pane fade show active" id="teacher-info" role="tabpanel"
                     aria-labelledby="teacher-info-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section general-info">
                                <div class="info">
                                    <div class="row">
                                        <div class="col-9">
                                            <h6> البيانات الشخصية </h6>
                                        </div>
                                        <div class="col-3 text-end">
                                            <a href="{{route('teachers.edit',['teacher'=>$teacher])}}"
                                               class="btn btn-primary"> تعديل </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">الاسم</label>
                                                <input type="text" id="name" class="form-control"
                                                       value="{{$teacher->name}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="identification" class="form-label">رقم الهوية</label>
                                                <input type="text" id="identification" class="form-control"
                                                       value="{{$teacher->identification}}" disabled>

                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="birth_date" class="form-label">تاريخ الميلاد </label>
                                                <input type="text" id="birth_date" class="form-control"
                                                       value="{{$teacher->birth_date}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="address" class="form-label"> العنوان </label>
                                                <input type="text" id="address" class="form-control"
                                                       value="{{$teacher->address}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <div class="mb-3">
                                                <label for="bank_name" class="form-label"> اسم البنك </label>
                                                <input type="text" id="bank_name" class="form-control"
                                                       value="{{$teacher->bank_name}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <div class="mb-3">
                                                <label for="bank_branch" class="form-label"> فرع البنك </label>
                                                <input type="text" id="bank_branch" class="form-control"
                                                       value="{{$teacher->bank_branch}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <div class="mb-3">
                                                <label for="bank_account" class="form-label"> رقم الحساب </label>
                                                <input type="text" id="bank_account" class="form-control"
                                                       value="{{$teacher->bank_account}}" disabled>
                                            </div>
                                        </div>


                                        <div class="col-12 col-md-3">
                                            <div class="mb-3">
                                                <label for="email" class="form-label"> البريد الاكتروني </label>
                                                <input type="text" id="email" class="form-control"
                                                       value="{{$teacher->email}}" disabled>
                                            </div>
                                        </div>


                                        <div class="col-6 col-md-3">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label"> رقم الهاتف </label>
                                                <input type="text" id="phone" class="form-control"
                                                       value="{{$teacher->phone}}" disabled>
                                            </div>
                                        </div>


                                        <div class="col-6 col-md-3">
                                            <div class="mb-3">
                                                <label for="phone_2" class="form-label"> رقم هاتف احتياطي </label>
                                                <input type="text" id="phone_2" class="form-control"
                                                       value="{{$teacher->phone_2}}" disabled>
                                            </div>
                                        </div>


                                        <div class="col-6 col-md-3">
                                            <div class="mb-3">
                                                <label for="star_work_date" class="form-label">تاريخ بدأ العمل </label>
                                                <input type="text" id="star_work_date" class="form-control"
                                                       value="{{$teacher->star_work_date}}" disabled>
                                            </div>
                                        </div>

{{--

                                        <div class="col-6 col-md-3">
                                            <div class="mb-3">
                                                <label for="gender" class="form-label"> فصل المدرس </label>
                                                <input type="text" id="gender" class="form-control"
                                                       value="{{$teacher?->schoolClass?->name }}" disabled>
                                            </div>
                                        </div>
--}}


                                        <div class="col-6 col-md-3">
                                            <div class="mb-3">
                                                <label for="gender" class="form-label"> الجنس </label>
                                                <input type="text" id="gender" class="form-control"
                                                       value="{{trans('options.'.$teacher->gender)  }}" disabled>
                                            </div>
                                        </div>


                                        <div class="col-6 col-md-3">
                                            <div class="mb-3">
                                                <label for="status" class="form-label">نوع الوظيفة </label>
                                                <input type="text" id="status" class="form-control"
                                                       value="{{trans('options.'.$teacher->job_type)}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-3">
                                            <div class="mb-3">
                                                <label for="status" class="form-label"> حالة المعلم </label>
                                                <input type="text" id="status" class="form-control"
                                                       value="{{trans('options.'.$teacher->status)}}" disabled>
                                            </div>
                                        </div>


                                        <div class="col-6 col-md-3">
                                            <div class="mb-3">
                                                <label for="status" class="form-label"> يعمل/تعمل بعد الظهيرة ؟ </label>
                                                <input type="text" id="status" class="form-control"
                                                       value="{{$teacher->work_afternoon ? 'نعم' : 'لا'}}" disabled>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="notes" class="form-label"> ملاحظات اضافية </label>
                                                <textarea id="notes" class="form-control" rows="3"
                                                          disabled>{{ $teacher->notes }}</textarea>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="tab-pane fade " id="teacher-files" role="tabpanel" aria-labelledby="teacher-files-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section general-info">
                                <div class="info">
                                    <h6> ملفات خاصبة بالمعلم </h6>
                                    <div class="row">
                                        <div class="col-12">
                                            <iframe src="/filemanager"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>


                {{--
                                <div class="tab-pane fade " id="teacher-log" role="tabpanel" aria-labelledby="teacher-log-tab">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                            <form class="section general-info">
                                                <div class="info">
                                                    <h6> سجل الطالب </h6>

                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                --}}

            </div>

        </div>

    </div>

@endsection
