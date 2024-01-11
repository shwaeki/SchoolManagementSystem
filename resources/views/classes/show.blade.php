@extends('layouts.app')

@push('styles')
    <link href="{{ asset("assets/css/light/users/account-setting.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/users/account-setting.css")  }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset("assets/css/light/components/tabs.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/components/tabs.css")  }}" rel="stylesheet" type="text/css"/>

@endpush

@section('content')

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2 class="mb-3"> معلومات الفصل الدراسي - {{$class->name}}</h2>

                    @if($current_year_class == null)
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
                                لا يوجد فصل دراسي مسجل لهذه السنة {{$adminActiveAcademicYear->name}} .
                                <a href="#classYearModal" data-bs-toggle="modal"
                                   class="alert-link">اضغط هنا لاضافة الفصل الى السنة الدراسية الحالية.</a>.
                            </div>
                        @endpush
                    @endif

                    <ul class="nav nav-pills" id="animateLine" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="class-info-tab" data-bs-toggle="tab"
                                    href="#class-info" role="tab" aria-controls="class-info" aria-selected="true">
                                <i class="fas fa-info-circle"></i>
                                بيانات الفصل الدراسي
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="class-years-tab" data-bs-toggle="tab" href="#class-years"
                                    role="tab" aria-controls="class-years" aria-selected="false" tabindex="-1">
                                <i class="fas fa-history"></i>
                                السنوات السابقة
                            </button>
                        </li>

                        @if($current_year_class != null)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="class-students-tab" data-bs-toggle="tab"
                                        href="#class-students"
                                        role="tab" aria-controls="class-students" aria-selected="false"
                                        tabindex="-1">
                                    <i class="fas fa-user-graduate"></i>
                                    قائمة الطلاب
                                </button>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>

            <div class="tab-content" id="animateLineContent-4">
                <div class="tab-pane fade show active" id="class-info" role="tabpanel"
                     aria-labelledby="class-info-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <div class="row">
                                        <div class="col-9">
                                            <h6> بيانات الفصل الدراسي </h6>
                                        </div>
                                        @auth("web")
                                            <div class="col-3 text-end">
                                                <a href="{{route('school-classes.edit',$class)}}"
                                                   class="btn btn-primary"> تعديل </a>
                                            </div>
                                        @endauth
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">الاسم</label>
                                                <input type="text" id="name" class="form-control"
                                                       value="{{$class->name}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="mb-3">
                                                <label for="code" class="form-label"> الكود</label>
                                                <input type="text" id="code" class="form-control"
                                                       value="{{$class->code}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="mb-3">
                                                <label for="alphabetical_name" class="form-label"> الكود الابجدي</label>
                                                <input type="text" id="alphabetical_name" class="form-control"
                                                       value="{{$class->alphabetical_name}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">العنوان </label>
                                                <input type="text" id="address" class="form-control"
                                                       value="{{$class->address}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label"> رقم الهاتف </label>
                                                <input type="text" id="code" class="form-control"
                                                       value="{{$class->phone}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="mb-3">
                                                <label for="capacity" class="form-label"> الطاقة الاستيعابة </label>
                                                <input type="text" id="capacity" class="form-control"
                                                       value="{{$class->capacity}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="mb-3">
                                                <label for="student_start_age" class="form-label"> الحد الادنى لعمر
                                                    الطلاب </label>
                                                <input type="text" id="student_start_age" class="form-control"
                                                       value="{{$class->student_start_age}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="mb-3">
                                                <label for="student_end_age" class="form-label"> الحد الاعلى لعمر
                                                    الطلاب </label>
                                                <input type="text" id="student_end_age" class="form-control"
                                                       value="{{$class->student_end_age}}" disabled>
                                            </div>
                                        </div>


                                    </div>


                                </div>
                            </div>
                        </div>
                        @if($current_year_class != null)
                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <div class="section general-info">
                                    <div class="info">
                                        <div class="row">
                                            <div class="col-9">
                                                <h6> بيانات الفصل الدراسي لسنة
                                                    - {{$current_year_class->academicYear->name}} </h6>
                                            </div>
                                            @auth("web")
                                                <div class="col-3 text-end">
                                                    <a href="#editCertificateModal" data-bs-toggle="modal"
                                                       class="btn btn-primary">تعديل </a>.
                                                </div>
                                            @endauth
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">السنة الدراسية</label>
                                                    <input type="text" id="name" class="form-control"
                                                           value="{{$current_year_class->academicYear->name}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">المدرس المشرف</label>
                                                    <input type="text" id="name" class="form-control"
                                                           value="{{$current_year_class->supervisorTeacher->name}}"
                                                           disabled>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">عدد الطلاب</label>
                                                    <input type="text" id="name" class="form-control"
                                                           value="{{count($current_year_class->students)}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">اضيف بواسطة</label>
                                                    <input type="text" id="name" class="form-control"
                                                           value="{{$current_year_class->addedBy->name}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">نوع الشهادة</label>
                                                    <input type="text" id="name" class="form-control"
                                                           value="{{$current_year_class->certificate?->name}}" disabled>
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
                                                <h6>قائمة المساعدات </h6>
                                            </div>
                                            @auth("web")
                                                <div class="col-3 text-end">
                                                    <a href="#addAssistantModal" data-bs-toggle="modal"
                                                       class="btn btn-primary">اضافة </a>.
                                                </div>
                                            @endauth
                                        </div>

                                        <div class="row">

                                            <div class="table-responsive">
                                                <table class="table table-hover table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col"> اسم المساعدة</th>
                                                        <th scope="col"> رقم الهاتف</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($current_year_class->assistants as $assistant)
                                                        <tr>
                                                            <td>{{$assistant->name}}</td>
                                                            <td>{{$assistant->phone}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade" id="class-years" role="tabpanel"
                     aria-labelledby="years-info-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section general-info">
                                <div class="info">
                                    <div class="row">
                                        <div class="col-9">
                                            <h6> السنوات السابقة</h6>
                                        </div>

                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th scope="col">السنة الدراسية</th>
                                                <th scope="col">المدرس المشرف</th>
                                                <th scope="col">عدد الطلاب</th>
                                                <th scope="col">اضيف بواسطة</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($class_years as $year)
                                                <tr>
                                                    <td>{{$year->academicYear->name}}</td>
                                                    <td>{{$year->supervisorTeacher->name}}</td>
                                                    <td>{{count($year->students)}}</td>
                                                    <td>{{$year->addedBy->name}}</td>
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
                @if($current_year_class != null)
                    <div class="tab-pane fade" id="class-students" role="tabpanel"
                         aria-labelledby="class-students-tab">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <form class="section general-info">
                                    <div class="info">
                                        <div class="row">
                                            <div class="col-9">
                                                <h6 class="mb-0"> قائمة الطلاب</h6>
                                            </div>
                                            <div class="col-3 text-end">
                                                @auth("web")
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target="#classStudentModal">
                                                        اضافة
                                                    </button>
                                                @endauth
                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <table
                                                class="table table-hover table-striped table-bordered dataTableCustomTitleConfig">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">الاسم</th>
                                                    <th scope="col">رقم الهوية</th>
                                                    <th scope="col">عنوان السكن</th>
                                                    <th scope="col">تاريخ الميلاد</th>
                                                    <th scope="col">تاريخ الاضافة</th>
                                                    <th scope="col"> اضيف بواسطة</th>
                                                    <th scope="col">خيارات</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($class_year_students as $data)
                                                    <tr>
                                                        <td>{{$data->id}} </td>
                                                        <td> {{$data->student?->name}}</td>
                                                        <td>{{$data->student?->identification}}</td>
                                                        <td>{{$data->student?->address}}</td>
                                                        <td>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24"
                                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                 stroke-width="2"
                                                                 stroke-linecap="round" stroke-linejoin="round"
                                                                 class="feather feather-calendar">
                                                                <rect x="3" y="4" width="18" height="18" rx="2"
                                                                      ry="2"></rect>
                                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                                            </svg>
                                                            <span
                                                                class="table-inner-text">{{$data->student?->birth_date}}</span>
                                                        </td>
                                                        <td>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                 height="24"
                                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                 stroke-width="2"
                                                                 stroke-linecap="round" stroke-linejoin="round"
                                                                 class="feather feather-calendar">
                                                                <rect x="3" y="4" width="18" height="18" rx="2"
                                                                      ry="2"></rect>
                                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                                            </svg>
                                                            <span
                                                                class="table-inner-text">{{$data->created_at->format('Y-m-d')}}</span>
                                                        </td>
                                                        <td>{{$data->addedBy?->name}}</td>
                                                        <td>
                                                            @auth("web")
                                                                <button type="button"
                                                                        class="btn btn-light-danger text-danger"
                                                                        onclick="deleteItem(this)"
                                                                        data-item="{{route('student-classes.destroy', $data)}}">
                                                                    <i class="far fa-trash-alt"></i>
                                                                </button>
                                                            @endauth
                                                            @if($current_year_class->certificate)
                                                                <button type="button"
                                                                        data-student_class_year-id="{{$data->id}}"
                                                                        class="btn btn-light-warning text-warning  editStudentCertification">
                                                                    <i class="fas fa-certificate"></i>
                                                                </button>
                                                                <a href="{{route('students.marks',$data->id)}}"
                                                                   target="_blank"
                                                                   class="btn btn-light-primary text-primary">
                                                                    <i class="fas fa-certificate"></i>
                                                                </a>

                                                            @endif
                                                                <a href="{{route('students.yearlyFile',$data->id)}}"
                                                                   target="_blank"
                                                                   class="btn btn-light-success text-success">
                                                                    <i class="fas fa-file-alt"></i>
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
                @endif
            </div>
        </div>
    </div>



    @auth("web")

        <div class="modal fade" id="classYearModal">
            <div class="modal-dialog" role="document">
                <form action="{{route('year-classes.store')}}" method="POST">
                    @csrf

                    <input type="hidden" name="school_class_id" value="{{$class->id}}">
                    <input type="hidden" name="academic_year_id" value="{{$activeAcademicYear->id}}">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">تسجل في السنة الحالية</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                X
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">الفصل الدراسي</label>
                                <input type="text" id="name" class="form-control"
                                       value="{{$class->name}}" disabled>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label"> السنة الدراسية</label>
                                <input type="text" id="name" class="form-control"
                                       value="{{$activeAcademicYear->name}}" disabled>
                            </div>


                            <div class="mb-3">
                                <label for="supervisor" class="form-label"> المعلم المشرف </label>
                                <select class="form-select"
                                        id="supervisor" name="supervisor" required>
                                    <option selected disabled value="">اختر ...</option>
                                    @foreach($teachers as $teacher)
                                        <option
                                            {{old('supervisor') == $teacher->name ? 'selected' : '' }} value="{{$teacher->id}}">
                                            {{$teacher->name}}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="mb-3">
                                <label for="certificate_id" class="form-label"> الشهادة </label>
                                <select class="form-select"
                                        id="certificate_id" name="certificate_id">
                                    <option selected disabled value="">اختر ...</option>
                                    @foreach($certificates as $certificate)
                                        <option
                                            {{old('certificate_id') == $certificate->name ? 'selected' : '' }} value="{{$certificate->id}}">
                                            {{$certificate->name}}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn btn-light-dark" data-bs-dismiss="modal">
                                <i class="flaticon-cancel-12"></i> اغلاق
                            </button>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endauth

    @if($current_year_class != null)

        <div class="modal fade" id="addAssistantModal">
            <div class="modal-dialog" role="document">
                <form action="{{route('year-classes.storeAssistant',$current_year_class)}}" method="POST">
                    @csrf

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">اضافة مساعدة جديدة</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="assistant_id" class="form-label"> المساعدة </label>
                                <select class="form-select"
                                        id="assistant_id" name="assistant_id" required>
                                    <option selected disabled value="">اختر ...</option>
                                    @foreach($assistants as $assistant)
                                        <option
                                            {{old('assistant_id') == $assistant->name ? 'selected' : '' }} value="{{$assistant->id}}">
                                            {{$assistant->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn btn-light-dark" data-bs-dismiss="modal">
                                <i class="flaticon-cancel-12"></i> اغلاق
                            </button>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @auth("web")
            <div class="modal fade" id="classStudentModal">
                <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                    <form action="{{route('student-classes.store')}}" method="POST" id="addStudentsForm">
                        @csrf

                        <input type="hidden" name="school_class_id" value="{{$class->id}}">
                        <input type="hidden" name="year_class_id" value="{{$current_year_class->id}}">
                        <input type="hidden" name="academic_year_id" value="{{$activeAcademicYear->id}}">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">تسجل الطلاب في السنة الحالية</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    X
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>قائمة الطلاب .</p>


                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered dataTableConfigNoData">
                                        <thead>
                                        <tr>
                                            <th class="checkbox-area" scope="col">
                                            </th>
                                            <th scope="col">الاسم</th>
                                            <th scope="col">رقم الهوية</th>
                                            <th scope="col">عنوان السكن</th>
                                            <th scope="col">تاريخ الميلاد</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-primary">
                                                        <input class="form-check-input checkbox_child striped_child"
                                                               type="checkbox" name="students[]"
                                                               value="{{$student->id}}">
                                                    </div>
                                                </td>
                                                <td>{{$student->name}}</td>
                                                <td>{{$student->identification}}</td>
                                                <td>{{$student->address}}</td>
                                                <td>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                         stroke-width="2"
                                                         stroke-linecap="round" stroke-linejoin="round"
                                                         class="feather feather-calendar">
                                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                                    </svg>
                                                    <span class="table-inner-text">{{$student->birth_date}}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn btn-light-dark" data-bs-dismiss="modal">
                                    <i class="flaticon-cancel-12"></i> اغلاق
                                </button>
                                <button type="submit" class="btn btn-primary">حفظ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endauth

        @if($current_year_class->certificate)
            <div class="modal fade" id="studentCertificateModal" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-xl">
                    <form action="{{route('student-marks.store')}}" method="POST">
                        @csrf

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">اضافة مجال جديد</h5>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">


                                    <input type="hidden" name="student_class_year" id="student_class_year" value="">
                                    <input type="hidden" name="year_class" value="{{$current_year_class->id}}">

                                    <table class="table table-sm table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col">المجال</th>
                                            <th scope="col">علامة الفصل الاول</th>
                                            <th scope="col">علامة الفصل الثاني</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($current_year_class->certificate?->fields as $field)
                                            <tr class="table-primary">
                                                <td><strong>{{ $field->field_name }}</strong></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            @if(count($field->categories) > 0)
                                                @foreach($field->mainCategories as $category)
                                                    <tr class="{{count($category->subcategories) > 0 ? 'table-warning' : ''}}">
                                                        <td>{{ $category->name }}</td>
                                                        <td>
                                                            <select class="form-select form-select-sm"
                                                                    name="marks[first_semester][{{ $category->id }}]">
                                                                <option value="" selected>اختر العلامة</option>
                                                                <option value="Always">دائماً</option>
                                                                <option value="Sometimes">أحياناً</option>
                                                                <option value="Rarely">نادراً</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-select form-select-sm"
                                                                    name="marks[second_semester][{{ $category->id }}]">
                                                                <option value="" selected>اختر العلامة</option>
                                                                <option value="Always">دائماً</option>
                                                                <option value="Sometimes">أحياناً</option>
                                                                <option value="Rarely">نادراً</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    @if($category->subcategories->isNotEmpty())
                                                        @foreach($category->subcategories as $subcategory)
                                                            <tr>
                                                                <td>{{ $subcategory->name }}</td>
                                                                <td>
                                                                    <select class="form-select form-select-sm"
                                                                            name="marks[first_semester][{{ $subcategory->id }}]">
                                                                        <option value="" selected>اختر العلامة</option>
                                                                        <option value="Always">دائماً</option>
                                                                        <option value="Sometimes">أحياناً</option>
                                                                        <option value="Rarely">نادراً</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-select form-select-sm"
                                                                            name="marks[second_semester][{{ $subcategory->id }}]">
                                                                        <option value="" selected>اختر العلامة</option>
                                                                        <option value="Always">دائماً</option>
                                                                        <option value="Sometimes">أحياناً</option>
                                                                        <option value="Rarely">نادراً</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>


                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="first_notes" class="form-label">ملاحظات مربية الفصل الدراسي
                                                الاول</label>
                                            <textarea class="form-control" id="first_notes" name="first_notes"
                                                      rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="second_notes" class="form-label">ملاحظات مربية الفصل الدراسي
                                                الثاني</label>
                                            <textarea class="form-control" id="second_notes" name="second_notes"
                                                      rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-delete" data-bs-dismiss="modal">اغلاق</button>
                                <button type="submit" class="btn btn-primary">حفظ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        @auth("web")
            <div class="modal fade" id="editCertificateModal">
                <div class="modal-dialog" role="document">
                    <form action="{{route('year-classes.update',$current_year_class)}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">تعديل بيانات الفصل الدراسي السنوية </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    X
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">الفصل الدراسي</label>
                                    <input type="text" id="name" class="form-control"
                                           value="{{$class->name}}" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="supervisor" class="form-label"> المعلم المشرف </label>
                                    <select class="form-select"
                                            id="supervisor" name="supervisor" required>
                                        <option selected disabled value="">اختر ...</option>
                                        @foreach($teachers as $teacher)
                                            <option
                                                {{old('supervisor', $current_year_class->supervisor) == $teacher->id ? 'selected' : '' }}
                                                value="{{$teacher->id}}">
                                                {{$teacher->name}}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="mb-3">
                                    <label for="certificate_id" class="form-label"> الشهادة </label>
                                    <select class="form-select"
                                            id="certificate_id" name="certificate_id">
                                        <option selected disabled value="">اختر ...</option>
                                        @foreach($certificates as $certificate)
                                            <option
                                                {{old('certificate_id', $current_year_class->certificate_id) == $certificate->id ? 'selected' : '' }} value="{{$certificate->id}}">
                                                {{$certificate->name}}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn btn-light-dark" data-bs-dismiss="modal">
                                    <i class="flaticon-cancel-12"></i> اغلاق
                                </button>
                                <button type="submit" class="btn btn-primary">حفظ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endauth
    @endif
@endsection

@push("scripts")
    <script>

        $("#addStudentsForm").on('submit', function (e) {
            var table = $('.dataTableConfigNoData').DataTable();

            var $form = $(this);
            console.log("true");
            table.$('input[type="checkbox"]').each(function () {
                if (!$.contains(document, this)) {
                    if (this.checked) {
                        $form.append(
                            $('<input>')
                                .attr('type', 'hidden')
                                .attr('name', this.name)
                                .val(this.value)
                        );
                    }
                }
            });
        });

        $('.editStudentCertification').on('click', function () {
            var studentId = $(this).data('student_class_year-id');
            $('#student_class_year').val(studentId);

            var url = '{{ route("students.ajax.marks", ":studentId") }}';
            url = url.replace(':studentId', studentId);

            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                success: function (response) {
                    $('select[name="marks"]').val("");
                    $('#first_notes').val("");
                    $('#second_notes').val("");

                    if (response.marks && response.marks && response.marks.first) {
                        $.each(response.marks.first, function (key, value) {
                            $('select[name="marks[first_semester][' + key + ']"]').val(value.mark);
                        });
                    }

                    if (response.marks && response.marks && response.marks.second) {
                        $.each(response.marks.second, function (key, value) {
                            $('select[name="marks[second_semester][' + key + ']"]').val(value.mark);
                        });
                    }

                    if (response.studentCertificate) {
                        if (response.studentCertificate.first_notes) {
                            $('#first_notes').val(response.studentCertificate.first_notes);
                        }
                        if (response.studentCertificate.second_notes) {
                            $('#second_notes').val(response.studentCertificate.second_notes);
                        }


                    }
                    $("#studentCertificateModal").modal('show');
                },

            });
        });


        $('.dataTableCustomTitleConfig').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'B><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "language": {"url": "{{asset('assets/datatable_arabic.json')}}"},

            buttons: [

                {
                    extend: 'excel',
                    messageTop: 'طلاب روضة - {{$class->name}} - المعلمة : {{$current_year_class?->supervisorTeacher?->name}} : رقم الروضة : {{$class->code}}',

                },

                {
                    extend: 'print',
                    messageTop: function () {
                        return 'طلاب روضة - {{$class->name}} - المعلمة : {{$current_year_class?->supervisorTeacher?->name}} : رقم الروضة : {{$class->code}}';
                    },
                    messageBottom: null
                }
            ],
            "pageLength": 25
        });

    </script>
@endpush
