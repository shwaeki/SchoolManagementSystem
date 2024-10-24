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

        .select2-container--bootstrap-5 .select2-selection {
            min-height: calc(1.5em + 1.25rem + 2px) !important;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            line-height: 1.8 !important;
        }

    </style>
@endpush

@section('content')

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2 class="mb-3"> معلومات الطالب - {{$student->name}}</h2>

                    @if($current_student_class == null)
                        @push('warnings')
                            <div class="alert alert-dismissible alert-icon-left alert-light-warning fade mb-4 show"
                                 role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" data-bs-dismiss="alert" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-x close">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-alert-triangle">
                                    <path
                                        d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                    <line x1="12" y1="9" x2="12" y2="13"></line>
                                    <line x1="12" y1="17" x2="12" y2="17"></line>
                                </svg>
                                الطالب غير مسجل لهذه السنة {{$activeAcademicYear->name}} .

                            </div>
                        @endpush
                    @endif

                    @if($student->archived)
                        @push('warnings')
                            <div class="alert alert-dismissible alert-icon-left alert-light-warning fade mb-4 show"
                                 role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <svg xmlns="http://www.w3.org/2000/svg" data-bs-dismiss="alert" width="24"
                                         height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-x close">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-alert-triangle">
                                    <path
                                        d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                    <line x1="12" y1="9" x2="12" y2="13"></line>
                                    <line x1="12" y1="17" x2="12" y2="17"></line>
                                </svg>
                                تمت ارشفة بيانات هذا الطالب

                            </div>
                        @endpush
                    @endif


                    <ul class="nav nav-pills" id="animateLine" role="tablist">
                        @can('view-student')
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="student-info-tab" data-bs-toggle="tab"
                                        href="#student-info" role="tab" aria-controls="student-info"
                                        aria-selected="true">
                                    <i class="fas fa-info-circle"></i>
                                    البيانات الشخصية
                                </button>
                            </li>
                        @endcan

                        @can('view-student-files')
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="student-files-tab" data-bs-toggle="tab"
                                        href="#student-files"
                                        role="tab" aria-controls="student-files" aria-selected="false" tabindex="-1">
                                    <i class="fas fa-folder-open"></i>
                                    ملفات الطالب
                                </button>
                            </li>
                        @endcan

                        @can('view-student-classes')
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="student-classes-tab" data-bs-toggle="tab"
                                        href="#student-classes" role="tab" aria-controls="student-classes"
                                        aria-selected="false" tabindex="-1">
                                    <i class="fas fa-graduation-cap"></i>
                                    السنوات الدراسية
                                </button>
                            </li>
                        @endcan

                        @can('view-student-reports')
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="student-reports-tab" data-bs-toggle="tab"
                                        href="#student-reports"
                                        role="tab" aria-controls="student-reports" aria-selected="false" tabindex="-1">
                                    <i class="fas fa-file-alt"></i>
                                    التقارير
                                </button>
                            </li>
                        @endcan

                        @can('view-student-sales')
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="student-purchases-tab" data-bs-toggle="tab"
                                        href="#student-purchases"
                                        role="tab" aria-controls="student-purchases" aria-selected="false"
                                        tabindex="-1">
                                    <i class="fas fa-cart-shopping"></i>
                                    المبيعات
                                </button>
                            </li>
                        @endcan

                        @can('view-student-attendances')
                            @if($current_student_class != null)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="student-attendance-tab" data-bs-toggle="tab"
                                            href="#student-attendance"
                                            role="tab" aria-controls="student-attendance" aria-selected="false"
                                            tabindex="-1">
                                        <i class="fas fa-user-alt-slash"></i>
                                        الحضور والغياب
                                    </button>
                                </li>
                            @endif
                        @endcan

                        @can('view-student-sms')
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="student-messages-tab" data-bs-toggle="tab"
                                        href="#student-messages"
                                        role="tab" aria-controls="student-messages" aria-selected="false" tabindex="-1">
                                    <i class="fas fa-sms"></i>
                                    الرسائل
                                </button>
                            </li>
                        @endcan

                        @can('view-student-history')
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="student-log-tab" data-bs-toggle="tab" href="#student-log"
                                        role="tab" aria-controls="student-log" aria-selected="false" tabindex="-1">
                                    <i class="fas fa-history"></i>
                                    سجل الطالب
                                </button>
                            </li>
                        @endcan


                    </ul>
                </div>
            </div>

            <div class="tab-content" id="animateLineContent-4">
                @can('view-student')
                    <div class="tab-pane fade show active" id="student-info" role="tabpanel"
                         aria-labelledby="student-info-tab">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <div class="section general-info">
                                    <div class="info">
                                        <div class="row">
                                            <div class="col-9">
                                                <h6> البيانات الشخصية </h6>
                                            </div>
                                            <div class="col-3 text-end">
                                                @can('update-student')
                                                    <a href="{{route('students.edit',['student'=>$student])}}"
                                                       class="btn btn-primary"> تعديل </a>
                                                @endcan
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">الاسم</label>
                                                    <input type="text" id="name" class="form-control"
                                                           value="{{$student->name}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <div class="mb-3">
                                                    <label for="identification" class="form-label">رقم الهوية</label>
                                                    <input type="text" id="identification" class="form-control"
                                                           value="{{$student->identification}}" disabled>
                                                </div>
                                            </div>


                                            <div class="col-6 col-md-3">
                                                <div class="mb-3">
                                                    <label for="identification_type" class="form-label"> نوع رقم
                                                        الهوية </label>
                                                    <input type="text" id="identification_type" class="form-control"
                                                           value="{{ trans('options.'.$student->identification_type) }}"
                                                           disabled>
                                                </div>
                                            </div>


                                            <div class="col-12 col-md-3">
                                                <div class="mb-3">
                                                    <label for="birth_date" class="form-label">تاريخ الميلاد </label>
                                                    <input type="text" id="birth_date" class="form-control"
                                                           value="{{ date('d/m/Y', strtotime($student->birth_date))}}"
                                                           disabled>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <div class="mb-3">
                                                    <label for="birth_place" class="form-label">مكان الولادة </label>
                                                    <input type="text" id="birth_place" class="form-control"
                                                           value="{{$student->birth_place}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <div class="mb-3">
                                                    <label for="address" class="form-label"> العنوان </label>
                                                    <input type="text" id="address" class="form-control"
                                                           value="{{$student->address}}" disabled>
                                                </div>
                                            </div>


                                            <div class="col-12 col-md-3">
                                                <div class="mb-3">
                                                    <label for="address_street" class="form-label"> الشارع </label>
                                                    <input type="text" id="address" class="form-control"
                                                           value="{{$student->address_street}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <div class="mb-3">
                                                    <label for="address_house_no" class="form-label"> رقم البيت </label>
                                                    <input type="text" id="address" class="form-control"
                                                           value="{{$student->address_house_no}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <div class="mb-3">
                                                    <label for="zipcode" class="form-label"> الرمز البريدي
                                                        (Zip) </label>
                                                    <input type="text" id="zipcode" class="form-control"
                                                           value="{{$student->zipcode}}" disabled>
                                                </div>
                                            </div>


                                            <div class="col-12 col-md-3">
                                                <div class="mb-3">
                                                    <label for="gender" class="form-label"> الجنس </label>
                                                    <input type="text" id="gender" class="form-control"
                                                           value="{{trans('options.'.$student->gender)  }}" disabled>
                                                </div>
                                            </div>


                                            <div class="col-12 col-md-3">
                                                <div class="mb-3">
                                                    <label for="postal_code" class="form-label">رقم صندوق
                                                        البريد </label>
                                                    <input type="text" id="postal_code" class="form-control"
                                                           value="{{$student->postal_code}}" disabled>
                                                </div>
                                            </div>

                                            @if($student->transportation_type)
                                                <div class="col-6 col-md-3">
                                                    <div class="mb-3">
                                                        <label for="transportation_type" class="form-label">طريقة
                                                            النقل </label>
                                                        <input type="text" id="transportation_type" class="form-control"
                                                               value="{{ trans('options.'.$student->transportation_type) }}"
                                                               disabled>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="notes" class="form-label"> ملاحظات اضافية </label>
                                                    <textarea id="notes" class="form-control" rows="3"
                                                              disabled>{{ $student->notes }}</textarea>
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


                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="mb-3">
                                                    <label for="mother_name" class="form-label"> اسم الام </label>
                                                    <input type="text" id="mother_name" class="form-control"
                                                           value="{{$student->mother_name}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="mb-3">
                                                    <label for="mother_phone" class="form-label"> رقم هاتف الام </label>
                                                    <input type="text" id="mother_phone" class="form-control"
                                                           value="{{$student->mother_phone}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="mb-3">
                                                    <label for="mother_id" class="form-label"> رقم هوية الام </label>
                                                    <input type="text" id="mother_id" class="form-control"
                                                           value="{{$student->mother_id}}" disabled>
                                                </div>
                                            </div>


                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="mb-3">
                                                    <label for="father_name" class="form-label"> اسم الاب </label>
                                                    <input type="text" id="father_name" class="form-control"
                                                           value="{{$student->father_name}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="mb-3">
                                                    <label for="father_phone" class="form-label"> رقم هاتف الاب </label>
                                                    <input type="text" id="father_phone" class="form-control"
                                                           value="{{$student->father_phone}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="mb-3">
                                                    <label for="father_id" class="form-label"> رقم هوية الاب </label>
                                                    <input type="text" id="father_id" class="form-control"
                                                           value="{{$student->father_id}}" disabled>
                                                </div>
                                            </div>


                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="mb-3">
                                                    <label for="family_status" class="form-label"> الحالة الاجتماعية
                                                        للعائلة </label>
                                                    <input type="text" id="family_status" class="form-control"
                                                           value="{{trans('options.'.$student->family_status)}}"
                                                           disabled>
                                                </div>
                                            </div>


                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="mb-3">
                                                    <label for="custody" class="form-label"> حضانة الطالب </label>
                                                    <input type="text" id="gender" class="form-control"
                                                           value="{{trans('options.'.$student->custody)}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6 col-md-4">
                                                <div class="mb-3">
                                                    <label for="family_members" class="form-label"> عدد افراد
                                                        العائلة </label>
                                                    <input type="text" id="family_members" class="form-control"
                                                           value="{{$student->family_members}}" disabled>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>

                            @if($current_student_class != null)

                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div class="section general-info">
                                        <div class="info">
                                            <div class="row">
                                                <div class="col-9">
                                                    <h6> بيانات الفصل الدراسي لسنة
                                                        - {{$current_student_class->yearClass->academicYear->name}} </h6>
                                                </div>
                                                <div class="col-3 text-end">
                                                    @can('update-student-fees')
                                                        <button type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editFeesModal">
                                                            تعديل
                                                        </button>
                                                    @endcan
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">الفصل الدراسي </label>
                                                        <input type="text" id="name" class="form-control"
                                                               value="{{$current_student_class->yearClass->schoolClass->name}}"
                                                               disabled>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-3">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">السنة الدراسية</label>
                                                        <input type="text" id="name" class="form-control"
                                                               value="{{$current_student_class->yearClass->academicYear->name}}"
                                                               disabled>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-3">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">المدرس المشرف</label>
                                                        <input type="text" id="name" class="form-control"
                                                               value="{{ $current_student_class->YearClass->supervisorTeacher->name }}"
                                                               disabled>
                                                    </div>
                                                </div>


                                                <div class="col-12 col-md-3">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">اضيف بواسطة</label>
                                                        <input type="text" id="name" class="form-control"
                                                               value="{{$current_student_class->addedBy->name}}"
                                                               disabled>
                                                    </div>
                                                </div>


                                                <div class="col-12 col-md-3">
                                                    <div class="mb-3">
                                                        <label for="study_fees" class="form-label">القسط
                                                            الدراسي </label>
                                                        <input type="text" id="study_fees" class="form-control"
                                                               value="{{$current_student_class->study_fees}}" disabled>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-3">
                                                    <div class="mb-3">
                                                        <label for="register_fees" class="form-label">رسوم
                                                            التسجيل</label>
                                                        <input type="text" id="register_fees" class="form-control"
                                                               value="{{$current_student_class->register_fees}}"
                                                               disabled>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                @endcan

                @can('view-student-files')
                    <div class="tab-pane fade" id="student-files" role="tabpanel"
                         aria-labelledby="student-files-tab">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <form class="section general-info">
                                    <div class="info">
                                        <h6> ملفات خاصبة بالطالب </h6>
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
                @endcan

                @can('view-student-classes')
                    <div class="tab-pane fade" id="student-classes" role="tabpanel"
                         aria-labelledby="student-classes-tab">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <div class="section general-info">
                                    <div class="info">
                                        <h6> السنوات الدراسية </h6>

                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">الفصل</th>
                                                    <th scope="col">السنة الدراسية</th>
                                                    <th scope="col">المدرس</th>
                                                    <th scope="col">اضيف بواسطة</th>
                                                    <th scope="col">تاريخ الاضافة</th>
                                                    <th scope="col">خيارات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($i = 0)
                                                @foreach($student_classes as $class)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            {{$class->yearClass?->schoolClass?->name}}

                                                            @if($class->yearClass?->schoolClass?->archived)
                                                                <span class="badge badge-warning px-2 ms-1">مؤرشف</span>
                                                            @endif

                                                        </td>
                                                        <td>{{$class->yearClass?->academicYear?->name}}</td>
                                                        <td>{{$class->YearClass?->supervisorTeacher?->name}}</td>
                                                        <td>{{$class->addedBy->name}}</td>
                                                        <td>{{$class->created_at->format('d/m/Y')}}</td>
                                                        <td>
                                                            @can('update-student-classes')
                                                                @if($current_student_class?->year_class_id == $class?->year_class_id)
                                                                    <button type="button" data-bs-toggle="modal"
                                                                            data-bs-target="#editYearClassModal"
                                                                            class="btn btn-light-warning text-warning">
                                                                        <i class="far fa-edit"></i>
                                                                    </button>
                                                                @endif

                                                            @endcan
                                                            @can('destroy-student-classes')
                                                                <button type="button"
                                                                        class="btn btn-light-danger text-danger"
                                                                        onclick="deleteItem(this)"
                                                                        data-item="{{route('student-classes.destroy', $class)}}">
                                                                    <i class="far fa-trash-alt"></i></button>
                                                            @endcan

                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endcan

                @can('view-student-history')
                    <div class="tab-pane fade" id="student-log" role="tabpanel"
                         aria-labelledby="student-log-tab">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <form class="section general-info">
                                    <div class="info">
                                        <h6> سجل الطالب </h6>

                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">الحقل</th>
                                                    <th scope="col">القيمة القديمة</th>
                                                    <th scope="col">القيمة الجديدة</th>
                                                    <th scope="col">المستخدم</th>
                                                    <th scope="col">تاريخ التعديل</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($i = 0)
                                                @foreach($student_logs as $logs)
                                                    @if($logs->event == 'updated')
                                                        @foreach($logs->properties['attributes'] as $key=>$log)
                                                            @php($i++)
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ trans('validation.attributes.'.$key) }}</td>

                                                                @if (trans()->has('options.'.$logs->properties['old'][$key]))
                                                                    <td>{{ trans('options.'.$logs->properties['old'][$key])  }}</td>
                                                                @else
                                                                    <td>{{ $logs->properties['old'][$key]  }}</td>
                                                                @endif

                                                                @if (trans()->has('options.'.$log))
                                                                    <td>{{ trans('options.'.$log)  }}</td>
                                                                @else
                                                                    <td>{{ $log  }}</td>
                                                                @endif

                                                                <td>{{$logs->causer->name}}</td>
                                                                <td>{{$logs->created_at->format('d/m/Y')}}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                @endcan

                @can('view-student-reports')
                    <div class="tab-pane fade" id="student-reports" role="tabpanel"
                         aria-labelledby="student-reports-tab">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <form class="section general-info">
                                    <div class="info">
                                        <h6> التقارير </h6>
                                        <div class="d-flex">
                                            <div class="mb-3 me-3 flex-grow-1">
                                                <label for="reportSelect" class="form-label">اختر التقرير:</label>
                                                <select class="form-select" id="reportSelect">
                                                    <option selected disabled value="">اختر ...</option>
                                                    @foreach($reports as $report)
                                                            <?php

                                                            preg_match_all("/\[dynamic name='(.*?)'\]/", $report->content, $matches);

                                                            if (isset($matches[1])) {
                                                                foreach ($matches[1] as $name) {
                                                                    if (!isset($attributes[$report->id])) {
                                                                        $attributes[$report->id] = [];
                                                                    }
                                                                    $attributes[$report->id][] = $name;
                                                                }
                                                            }
                                                            ?>
                                                        <option value="{{ $report->id }}">{{ $report->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3 align-self-end">
                                                @can('create-student-report')
                                                    <button type="button" class="btn btn-primary btn-lg"
                                                            id="reportExportButton">
                                                        تصدير
                                                    </button>
                                                @endcan
                                            </div>
                                        </div>
                                        <hr>
                                        <h6> تقارير الطالب </h6>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">الاسم</th>
                                                    <th scope="col">اضيف بواسطة</th>
                                                    <th scope="col">تاريخ الاضافة</th>
                                                    <th scope="col">خيارات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($student_reports as $report)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{$report->name}}</td>
                                                        <td>{{$report->addedBy->name}}</td>
                                                        <td>{{$report->created_at->format('Y-m-d')}}</td>
                                                        <td>
                                                            <a target="_blank"
                                                               href="{{route('student-reports.show',['student_report'=>$report])}}"
                                                               type="button" class="btn btn-delete">
                                                                عرض
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                @endcan

                @can('view-student-sales')
                    <div class="tab-pane fade" id="student-purchases" role="tabpanel"
                         aria-labelledby="student-purchases-tab">
                        <div class="row">
                            <div class="col-12 text-center mb-3">
                                <div class="row g-2">
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"> {{  $student_purchases?->sum('price') + $current_student_class?->register_fees + $current_student_class?->study_fees}}</h5>
                                                <p class="card-text">المشتريات </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $student_payments?->sum('amount')}}</h5>
                                                <p class="card-text">مدفوعات</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"> {{  ( $student_purchases?->sum('price') + $current_student_class?->register_fees + $current_student_class?->study_fees) - $student_payments->sum('amount') }}</h5>
                                                <p class="card-text">الرصيد</p>
                                            </div>
                                        </div>
                                    </div>

                                    @if($current_student_class)
                                        <div class="col">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title"> {{  ( $current_student_class?->register_fees + $current_student_class?->study_fees) - $student_payments->whereIn('payment_for',['القسط الدراسي','رسوم التسجيل'])->sum('amount')  }}</h5>
                                                    <p class="card-text">القسط الدراسي المتبقي</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                </div>
                            </div>
                            <div class="col-12 col-md-12 layout-spacing">
                                <form class="section general-info">
                                    <div class="info">

                                        <div class="row">
                                            <div class="col-9">
                                                <h6> المشتريات </h6>
                                            </div>
                                            <div class="col-3 text-end">
                                                @can('create-student-purchases')
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#purchasesModal">
                                                        اضافة
                                                    </button>
                                                @endcan
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th scope="col">المنتج</th>
                                                    <th scope="col">السعر</th>
                                                    <th scope="col">اضيف بواسطة</th>
                                                    <th scope="col">تاريخ الاضافة</th>
                                                    <th scope="col"> خيارات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($student_purchases as $purchases)
                                                    <tr>
                                                        <td>{{$purchases->product->name}}</td>
                                                        <td>{{$purchases->price}}₪</td>
                                                        <td>{{$purchases->addedBy->name}}</td>
                                                        <td>{{$purchases->created_at->format('Y-m-d')}}</td>
                                                        <td>
                                                            @can('update-student-purchases')
                                                                <button type="button" data-id="{{ $purchases->id }}"
                                                                        data-product="{{ $purchases->product->name }}"
                                                                        data-price="{{ $purchases->price }}"
                                                                        class="btn btn-light-warning text-warning edit-purchase">
                                                                    <i class="far fa-edit"></i>
                                                                </button>
                                                            @endcan
                                                            @can('destroy-student-purchases')
                                                                <button type="button"
                                                                        class="btn btn-light-danger text-danger"
                                                                        onclick="deleteItem(this)"
                                                                        data-item="{{route('purchases.destroy', $purchases)}}">
                                                                    <i class="far fa-trash-alt"></i></button>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <div class="col-12 col-md-12 layout-spacing">
                                <form class="section general-info">
                                    <div class="info">

                                        <div class="row">
                                            <div class="col-9">
                                                <h6> الدفعات </h6>
                                            </div>
                                            <div class="col-3 text-end">
                                                @can('create-student-payments')
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#addPaymentModal">
                                                        اضافة
                                                    </button>
                                                @endcan
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th scope="col">المبلغ</th>
                                                    <th scope="col"> طريقة الدفع</th>
                                                    <th scope="col"> نوع الدفع</th>
                                                    <th scope="col">اضيف بواسطة</th>
                                                    <th scope="col">تاريخ الاضافة</th>
                                                    <th scope="col"> خيارات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($student_payments ?? [] as $payment)
                                                    <tr>
                                                        <td>{{$payment->amount}}₪</td>
                                                        <td>{{$payment->payment_way}}</td>
                                                        <td>{{$payment->payment_for}}</td>
                                                        <td>{{$payment->payment_date}}</td>
                                                        <td>{{$payment->addedBy->name}}</td>
                                                        <td>
                                                            @can('update-student-payments')
                                                                <button type="button"
                                                                        class="btn btn-light-warning text-warning btn-edit-payment"
                                                                        data-id="{{ $payment->id }}"
                                                                        data-amount="{{ $payment->amount }}"
                                                                        data-payment-way="{{ $payment->payment_way }}"
                                                                        data-payment-for="{{ $payment->payment_for }}"
                                                                        data-payment-date="{{ $payment->payment_date }}">
                                                                    <i class="far fa-edit"></i>
                                                                </button>
                                                            @endcan

                                                            @can('destroy-student-payments')
                                                                <button type="button"
                                                                        class="btn btn-light-danger text-danger"
                                                                        onclick="deleteItem(this)"
                                                                        data-item="{{ route('payments.destroy', $payment) }}">
                                                                    <i class="far fa-trash-alt"></i>
                                                                </button>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endcan

                @can('view-student-sms')
                    <div class="tab-pane fade" id="student-messages" role="tabpanel"
                         aria-labelledby="student-messages-tab">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <form class="section general-info">
                                    <div class="info">

                                        <h6> الرسال التي تم ارسائلها الى الطالب </h6>

                                        <div class="table-responsive">
                                            <table class="table table-hover table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th scope="col"> تم الارسال بواسطة</th>
                                                    <th scope="col"> تاريخ الارسال</th>
                                                    <th scope="col"> نص الرسالة</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($student_messages as $message)
                                                    <tr>
                                                        <td>{{$message->addedBy?->name }}</td>
                                                        <td>{{$message->created_at->format('Y-m-d')}}</td>
                                                        <td style="-webkit-user-modify: read-write-plaintext-only">
                                                            {{$message->message}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                @endcan

                @can('view-student-attendances')
                    @if($current_student_class != null)
                        <div class="tab-pane fade" id="student-attendance" role="tabpanel"
                             aria-labelledby="student-attendance-tab">

                            <div class="section general-info">
                                <div class="info">
                                    <h6> الحضور و الغياب </h6>
                                    <div class="table-responsive">

                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th scope="col">التاريخ</th>
                                                <th scope="col">عدد ايام الحضور</th>
                                                <th scope="col">عدد ايام الغياب</th>
                                                <th scope="col">خيارات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($attendanceData as $monthYear => $data)
                                                <tr>
                                                    <td>{{ $monthYear }}</td>
                                                    <td>{{ $data['attended']['count'] }}</td>
                                                    <td>{{ $data['missed']['count'] }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-light-primary text-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#attendanceDetailsModal"
                                                                data-attended='@json($data['attended']['dates'])'
                                                                data-missed='@json($data['missed']['dates'])'>
                                                            <i class="far fa-eye"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                @endcan

            </div>

        </div>

    </div>


    @if($current_student_class != null)
        @can('update-student-fees')
            <div class="modal fade" id="editFeesModal">
                <div class="modal-dialog">
                    <form action="{{ route('student-classes.update',['student_class'=>$current_student_class]) }}"
                          method="post">
                        @method('PUT')
                        @csrf

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> تعديل الرسوم</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="register_fees" class="form-label">رسوم التسجيل:</label>
                                    <input type="text" class="form-control only-integer" id="register_fees"
                                           name="register_fees"
                                           value="{{ $current_student_class->register_fees }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="study_fees" class="form-label">القسط الدراسي :</label>
                                    <input type="text" class="form-control only-integer" id="study_fees"
                                           name="study_fees"
                                           value="{{ $current_student_class->study_fees }}" required>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">اغلاق</button>
                                <button type="submit" class="btn btn-primary">حفظ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endcan

        @can('update-student-classes')
            <div class="modal fade" id="editYearClassModal">
                <div class="modal-dialog">
                    <form action="{{ route('student-classes.update',['student_class'=>$current_student_class]) }}"
                          method="post">
                        @method('PUT')
                        @csrf

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> تعديل الفصل الدراسي </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">


                                <div class="mb-3">
                                    <label for="year_class_id" class="form-label">الفصل الدراسي :</label>
                                    <select name="year_class_id" id="year_class_id" class="form-select select2"
                                            required>
                                        <option value="" disabled selected>اختر الفصل الدراسي</option>
                                        @foreach($year_classes as $class)
                                            <option value="{{ $class->id }}"
                                                    @if($class->id == $current_student_class->year_class_id) selected @endif>
                                                {{ $class->SchoolClass?->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">اغلاق</button>
                                <button type="submit" class="btn btn-primary">حفظ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endcan

        @can('view-student-attendances')
            <div class="modal fade" id="attendanceDetailsModal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">تفاصيل الايام</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="ccl-12 col-md-6">
                                    <h6> ايام الحضور:</h6>
                                    <ul id="attendanceDetailsList" class="list-unstyled"></ul>
                                </div>
                                <div class="ccl-12 col-md-6">
                                    <h6> ايام الغياب:</h6>
                                    <ul id="missedDaysDetailsList" class="list-unstyled"></ul>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        @endcan

    @endif


    @can('create-student-payments')
        <div class="modal fade" id="addPaymentModal">
            <div class="modal-dialog">
                <form action="{{ route('payments.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> اضافة دفعة جديدة</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3 ">
                                <label for="payment_way" class="form-label">طريقة الدفع:</label>
                                <select class="form-select" id="payment_way" name="payment_way" required>
                                    <option selected disabled value="">اختر ...</option>
                                    <option value="cash">كاش</option>
                                    <option value="check">شيك</option>
                                    <option value="transfer">تحويل</option>
                                </select>
                            </div>

                            <div class="mb-3 ">
                                <label for="payment_for" class="form-label"> نوع الدفع:</label>
                                <select class="form-select" id="payment_for" name="payment_for" required>
                                    <option selected disabled value="">اختر ...</option>
                                    <option>رسوم التسجيل</option>
                                    <option>القسط الدراسي</option>
                                    <option>مبيعات</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">المبلغ:</label>
                                <input type="text" class="form-control only-integer" id="amount" name="amount"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="payment_date" class="form-label">تاريخ الدفع:</label>
                                <input type="date" class="form-control" id="payment_date" name="payment_date"
                                       value="{{ date('Y-m-d') }}" required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endcan

    @can('update-student-payments')
        <div class="modal fade" id="editPaymentModal" data-bs-backdrop="static">
            <div class="modal-dialog">
                <form id="editPaymentForm" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="payment_id" id="editPaymentId">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">تعديل الدفعة</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit_payment_way" class="form-label">طريقة الدفع:</label>
                                <select class="form-select" id="edit_payment_way" name="payment_way" required>
                                    <option selected disabled value="">اختر ...</option>
                                    <option value="cash">كاش</option>
                                    <option value="check">شيك</option>
                                    <option value="transfer">تحويل</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="edit_payment_for" class="form-label">نوع الدفع:</label>
                                <select class="form-select" id="edit_payment_for" name="payment_for" required>
                                    <option selected disabled value="">اختر ...</option>
                                    <option>رسوم التسجيل</option>
                                    <option>القسط الدراسي</option>
                                    <option>مبيعات</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="edit_amount" class="form-label">المبلغ:</label>
                                <input type="text" class="form-control" id="edit_amount" name="amount" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_payment_date" class="form-label">تاريخ الدفع:</label>
                                <input type="date" class="form-control" id="edit_payment_date" name="payment_date"
                                       required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endcan

    @can('create-student-purchases')
        <div class="modal fade" id="purchasesModal" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <form action="{{ route('purchases.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">عملية شراء جديدة</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="productContainer">

                            </div>
                            <hr>
                            <p>
                                المجموع : <span class="totalPrices">0</span>
                            </p>
                            <button type="button" class="btn btn-primary w-100" onclick="addRow()">
                                اضافة منتج اخر
                            </button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endcan

    @can('update-student-purchases')
        <div class="modal fade" id="editPurchasesModal" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered">

                <div class="modal-content">
                    <form id="editPurchaseForm" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="purchase_id" id="editPurchaseId">

                        <div class="modal-header">
                            <h5 class="modal-title">تعديل عملية شراء</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="editProduct" class="form-label">المنتج</label>
                                <input type="text" class="form-control" id="editProduct" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="editPrice" class="form-label">السعر</label>
                                <input type="text" class="form-control" id="editPrice" name="price" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal">إغلاق</button>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    @endcan

    @can('create-student-report')
        <div class="modal fade" id="attributeModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="attributeModalLabel">قيمة العناصر المتغيرة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="inputContainer"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">غلاق</button>
                        <button type="button" class="btn btn-primary" id="reportDynamicExport">تصدير</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/i18n/ar.js"></script>


    <script>
        $(document).ready(function () {
            $('#attendanceDetailsModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var attendedDetails = button.data('attended');
                var missedDetails = button.data('missed');

                console.log('Attended Details:', attendedDetails);
                console.log('Missed Details:', missedDetails);


                console.log(attendedDetails)
                console.log(attendedDetails.length)

                var attendanceModalBody = $('#attendanceDetailsList');
                var missedModalBody = $('#missedDaysDetailsList');

                attendanceModalBody.empty();
                missedModalBody.empty();

                if (attendedDetails.length > 0) {
                    attendedDetails.forEach(function (date) {
                        var formattedDate = new Date(date).toISOString().split('T')[0];
                        attendanceModalBody.append('<li>' + formattedDate + '</li>');
                    });
                } else {
                    attendanceModalBody.append('<li>لا يوجد</li>');
                }

                if (missedDetails.length > 0) {
                    missedDetails.forEach(function (date) {
                        var formattedDate = new Date(date).toISOString().split('T')[0];
                        missedModalBody.append('<li>' + formattedDate + '</li>');
                    });
                } else {
                    missedModalBody.append('<li>لا يوجد</li>');
                }
            });
        });
    </script>


    <script>

        var attributes = {!! json_encode($attributes ?? []) !!};

        $('.btn-edit-payment').on('click', function () {

            var paymentId = $(this).data('id');
            var amount = $(this).data('amount');
            var paymentWay = $(this).data('payment-way');
            var paymentFor = $(this).data('payment-for');
            var paymentDate = $(this).data('payment-date');

            $('#editPaymentId').val(paymentId);
            $('#edit_amount').val(amount);
            $('#edit_payment_way').val(paymentWay).change();
            $('#edit_payment_for').val(paymentFor).change();
            $('#edit_payment_date').val(paymentDate);

            var routeUrl = "{{ route('payments.update', ':id') }}";
            routeUrl = routeUrl.replace(':id', paymentId);
            $('#editPaymentForm').attr('action', routeUrl);


            $('#editPaymentModal').modal('show');
        });

        $('.edit-purchase').on('click', function () {
            var purchaseId = $(this).data('id');
            var productName = $(this).data('product');
            var price = $(this).data('price');


            $('#editProduct').val(productName);
            $('#editPrice').val(price);

            $('#editPurchaseForm').attr('action', '/purchases/' + purchaseId);
            $('#editPurchasesModal').modal('show');
        });


        $("#reportExportButton").on("click", function () {
            var selectedReportId = $("#reportSelect").val();

            if (selectedReportId == null) {
                Swal.fire({title: "خطأ!", text: "يرجى اختيار تقرير", icon: "error"});
                return;
            }


            if (attributes[selectedReportId]) {
                $("#inputContainer").empty();

                var attributeValues = attributes[selectedReportId];
                attributeValues.forEach(function (value) {
                    $("#inputContainer").append('<input type="text" class="form-control mb-3" placeholder="' + value + '" date-name="' + value + '">');
                });
                $("#attributeModal").modal('show');
            } else {

                $.ajax({
                    url: '{{route('student-reports.generate')}}',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        report: selectedReportId,
                        student: '{{$student->id}}',
                        date: {},
                    },
                    success: function (response) {
                        console.log('Ajax request successful:', response);
                        var showStudentReportRoute = '{{ route('student-reports.show', ['student_report' => ':id']) }}';
                        var showStudentReportUrl = showStudentReportRoute.replace(':id', response.data.id);
                        window.open(showStudentReportUrl, '_blank');
                        location.reload();
                    },
                    error: function (error) {
                        Swal.fire({title: "خطأ!", text: "حدث خطا ما الرجاء المحاولة مرى اخرى", icon: "error"});
                    }
                });
            }
        });

        $("#reportDynamicExport").on("click", function () {
            var selectedReportId = $("#reportSelect").val();
            var allInputsFilled = true;
            var postData = {};

            $("#inputContainer input").each(function () {
                var inputValue = $(this).val();
                var dateNameAttribute = $(this).attr('date-name');

                if (!inputValue) {
                    allInputsFilled = false;
                    return false;
                }
                postData[dateNameAttribute] = inputValue;
            });

            if (!allInputsFilled) {
                Swal.fire({title: "خطأ!", text: "يرجى ملء جميع الحقول", icon: "error"});
                return;
            }


            console.log("Exporting values:", postData);

            $("#attributeModal").modal('hide');

            $.ajax({
                url: '{{route('student-reports.generate')}}',
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    report: selectedReportId,
                    student: '{{$student->id}}',
                    date: postData
                },
                success: function (response) {
                    console.log('Ajax request successful:', response);
                    var showStudentReportRoute = '{{ route('student-reports.show', ['student_report' => ':id']) }}';
                    var showStudentReportUrl = showStudentReportRoute.replace(':id', response.data.id);
                    window.open(showStudentReportUrl, '_blank');
                    location.reload();
                },
                error: function (error) {
                    Swal.fire({title: "خطأ!", text: "حدث خطا ما الرجاء المحاولة مرى اخرى", icon: "error"});
                }
            });

        });


        function initializeSelect2(selector = '.searchSelect') {
            $(selector).select2({
                dropdownParent: $("#purchasesModal"),
                theme: 'bootstrap-5',
                dir: 'rtl',
                language: 'ar',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: {
                    id: "",
                    text: "اختر منتج ...",
                    selected: 'selected'
                },
                minimumInputLength: 2,
                ajax: {
                    url: "{{route('products.ajax')}}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id,
                                    price: item.price,
                                    barcode: item.barcode,
                                }
                            })
                        };
                    },
                    cache: true
                }
            });


            $(selector).on('select2:select', function (e) {
                var select = $(e.currentTarget);
                var product_id = e.params.data.id;
                var product_price = e.params.data.price;
                var product_barcode = e.params.data.barcode;
                select.parent().parent().find('.price').val(product_price);
                select.parent().parent().find('.barcode').val(product_barcode);
                getTotalPrices();
            });

            getTotalPrices();
        }


        function addRow(data) {
            let index = $('.productContainer .row').length + 1;
            let productID = data ? data.id : '';
            let productName = data ? data.name : '';
            let barcode = data ? data.barcode : '';
            let price = data ? data.price : '';

            $('.productContainer').append(`
            <div class="row mt-3">
                <div class="col-4">
                    <select class="form-select searchSelect" name="order[` + index + `][product]" required>
                        <option value="" selected disabled>اختر ...</option>
                        <option value="` + productID + `" selected>` + productName + `</option>
                    </select>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control barcode" name="order[` + index + `][barcode]" placeholder="الباركود" value="` + barcode + `" required readonly>
                </div>
                <div class="col-3">
                    <input type="text" class="form-control price" name="order[` + index + `][price]" placeholder="السعر" value="` + price + `" required>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-danger w-100 h-100 delete">
                        X
                    </button>
                </div>
            </div>
        `);
            var select2 = $("select[name='order[" + index + "][product]']");
            initializeSelect2(select2);
        }


        function getTotalPrices() {
            var total = 0;
            $('.price').each(function () {
                total += +$(this).val();
            });
            $('.totalPrices').html(total);
        }

        $(document).on('click', '.delete', function () {
            if ($('.productContainer .row').length == 1) {
                Swal.fire({title: "خطأ!", text: "لا يمكن حذف هذا المنتج", icon: "error"});
                return;
            }
            $(this).parent().parent().remove();
            getTotalPrices();
        });


        $(document).ready(function () {
            addRow();
        });


        var barcode = "";
        $(document).keydown(function (e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if (code == 16 || code == 220) {
                return;
            }
            if (code == 13) {
                event.preventDefault();
                if (barcode.length > 6) {
                    var cleanBarcode = barcode.replace(/[\x00-\x1F\x10\x7F]/g, '');
                    addBarcodeProduct(cleanBarcode);
                }
                barcode = "";
            } else {
                barcode = barcode + String.fromCharCode(code);
            }
        });

        function removeEmptyRows() {
            $('.productContainer .row').each(function (index, row) {
                let productName = $(row).find('select[name^="order["]').val();
                if (!productName) {
                    $(row).remove();
                }
            });
        }


        function addBarcodeProduct(barcode) {
            console.log(barcode);

            $.ajax({
                url: "{{route('products.ajax')}}",
                method: 'get',
                data: {barcode: barcode, q: "barcode"},
                success: function (response) {
                    addRow(response[0]);
                    removeEmptyRows();
                },
                error: function (xhr) {
                    console.error("Product not found");
                }
            });

        }

    </script>
@endpush
