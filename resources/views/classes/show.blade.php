@extends('layouts.app')

@push('styles')
    <link href="{{ asset("assets/css/light/users/account-setting.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/users/account-setting.css")  }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset("assets/css/light/components/tabs.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/components/tabs.css")  }}" rel="stylesheet" type="text/css"/>

    <style>
        #DataTables_Table_1_wrapper {
            margin-top: 30px;
        }
    </style>
@endpush


@section('content')
    @if($class->archived)
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
                تمت ارشفة بيانات هذا الفصل الدراسي

            </div>
        @endpush
    @endif

    @if(!(Auth::guard('teacher')->check() && auth()->user()->teacher_type == 'assistant'))
        @can('view-school-class')
            @include('classes.tabs.class-info')
        @endcan

        @can('view-school-class-class-years')
            @include('classes.tabs.class-years')
        @endcan

        @can('view-school-class-students')
            @includeWhen($current_year_class != null, 'classes.tabs.class-students')
        @endcan
    @endif

    @can('view-school-class-attendances')
        @includeWhen($current_year_class != null, 'classes.tabs.class-student-attendance')
    @endcan

    @can('view-school-class-daily-reports')
        @if(!(Auth::guard('teacher')->check() && auth()->user()->teacher_type == 'assistant'))
            @includeWhen($current_year_class != null, 'classes.tabs.class-daily-program')
        @endif
    @endcan

    @can('view-school-class-weekly-reports')
        @includeWhen($current_year_class != null, 'classes.tabs.class-weekly-program')
    @endcan

    @can('view-school-class-monthly-reports')
        @includeWhen($current_year_class != null, 'classes.tabs.class-monthly-plan')
    @endcan

    @can('view-school-class-posts')
        @if(Auth::guard('web')->check() )
            @includeWhen($current_year_class != null, 'classes.tabs.class-posts')
        @endif
    @endcan



    <div class="account-settings-container layout-top-spacing">
        <div class="account-content">
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2 class="mb-3 d-print-none"> معلومات الفصل الدراسي - {{$class->name}}</h2>

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


                    @if (session('warnings'))
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

                                {{ session('warnings')  }}
                            </div>
                        @endpush
                    @endif


                    <ul class="nav nav-pills" id="animateLine" role="tablist">
                        @stack("tab_button")
                    </ul>
                </div>
            </div>

            <div class="tab-content" id="animateLineContent-4">
                @stack('tab_content')
            </div>
        </div>
    </div>


    @stack('html')

    @auth("web")
        @can('update-school-class')
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

                                <div class="mb-3">
                                    <label for="code" class="form-label"> الكود </label>
                                    <input type="text" id="code" name="code" class="form-control">
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
        @endcan
    @endauth
@endsection
