@extends('layouts.app')


@push('styles')
    <link href="{{ asset("assets/plugins/src/apex/apexcharts.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/light/dashboard/dash_1.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/dashboard/dash_1.css")  }}" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @auth("teacher")
        @if(isset($teacherClasses) && count($teacherClasses) == 0)
            @if(auth()->user()->teacher_type == "teacher")
                <div class="alert alert-icon-left alert-light-warning alert-dismissible fade show mb-4"
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
                    لا يوجد فصول دراسية تتبع لك !
                </div>
            @endif
        @endif

        مرحبا بك
    @endauth

    @auth("web")
    <div class="row layout-top-spacing">

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-card-four">
                <div class="widget-content">
                    <div class="w-header">
                        <div class="w-info">
                            <h6 class="value"> الطلاب المسجلين لهذه السنة</h6>
                        </div>
                    </div>
                    <div class="w-content" style="    margin-top: 10px;">
                        <div class="w-info">
                            <p class="value">{{ $registered_students_count }}<span> طالب </span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-card-four">
                <div class="widget-content">
                    <div class="w-header">
                        <div class="w-info">
                            <h6 class="value"> عدد الطلاب</h6>
                        </div>
                    </div>
                    <div class="w-content" style="    margin-top: 10px;">
                        <div class="w-info">
                            <p class="value">{{  $students_count}} <span> طالب </span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-card-four">
                <div class="widget-content">
                    <div class="w-header">
                        <div class="w-info">
                            <h6 class="value"> مجموع المدفوعات الشهرية</h6>
                        </div>
                    </div>
                    <div class="w-content" style="    margin-top: 10px;">
                        <div class="w-info">
                            <p class="value">₪{{ $total_purchases_this_month }} <span>شيكل</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-card-four">
                <div class="widget-content">
                    <div class="w-header">
                        <div class="w-info">
                            <h6 class="value">مجموع المبيعات الشهرية</h6>
                        </div>
                    </div>
                    <div class="w-content" style="    margin-top: 10px;">
                        <div class="w-info">
                            <p class="value">₪{{ $total_payment_this_months }} <span>شيكل</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <hr>
        <div class="col-12 mb-3">
            <div class="row cols-4 cols-md-2 g-2">
                <div class="col">
                    <a href="{{ route('students.create') }}" class="btn btn-primary btn-lg w-100 h-100 ">
                        اضافة طالب جديد
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('teachers.create') }}" class="btn btn-primary btn-lg w-100 h-100 ">
                        اضافة معلمة جديد
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('workers.create') }}" class="btn btn-primary btn-lg w-100 h-100 ">
                        اضافة موظف جديد
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('assistants.create') }}" class="btn btn-primary btn-lg w-100 h-100 ">
                        اضافة مساعدة جديد
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg w-100 h-100 ">
                        اضافة منتج جديد
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('messages.index') }}" class="btn btn-primary btn-lg w-100 h-100 ">
                        ارسال رسالة
                    </a>
                </div>
            </div>
        </div>



        <div class="col-12"></div>

        <div class="col-xl-9 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-activity-five">

                <div class="widget-heading">
                    <h5 class="">المبيعات و المدفوعات حسب الشهر</h5>
                </div>

                <div class="widget-content">

                    <div class="w-shadow-top"></div>

                    <div class="mt-container mx-auto">
                        <div id="PaymentsAndPruchases"></div>
                    </div>

                    <div class="w-shadow-bottom"></div>
                </div>
            </div>
        </div> {{-- DONE--}}


        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-activity-five">

                <div class="widget-heading">
                    <h5 class="">اخر الرسائل (SMS)</h5>
                </div>

                <div class="widget-content">

                    <div class="w-shadow-top"></div>

                    <div class="mt-container mx-auto">
                        <div class="timeline-line">


                            @foreach($last_smss as $sms)

                                <div class="item-timeline timeline-new">
                                    <div class="t-dot">
                                        <div class="t-primary">
                                            <i class="fa fa-message text-white mt-1"></i>
                                        </div>
                                    </div>
                                    <div class="t-content">
                                        <div class="t-uppercontent">
                                            <h5>{{ $sms->message }}</h5>
                                        </div>
                                        <p>{{ $sms->created_at->diffForHumans() }} - {{ $sms->phone }}</p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="w-shadow-bottom"></div>
                </div>
            </div>
        </div>
{{--
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget-four">
                <div class="widget-heading">
                    <h5 class="">عدد الموظفين</h5>
                </div>
                <div class="widget-content">
                    <div class="vistorsBrowser">
                        <div class="browser-list">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-chrome">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <circle cx="12" cy="12" r="4"></circle>
                                    <line x1="21.17" y1="8" x2="12" y2="8"></line>
                                    <line x1="3.95" y1="6.06" x2="8.54" y2="14"></line>
                                    <line x1="10.88" y1="21.94" x2="15.46" y2="14"></line>
                                </svg>
                            </div>
                            <div class="w-browser-details">
                                <div class="w-browser-info">
                                    <h6>Chrome</h6>
                                    <p class="browser-count">65%</p>
                                </div>
                                <div class="w-browser-stats">
                                    <div class="progress">
                                        <div class="progress-bar bg-gradient-primary" role="progressbar"
                                             style="width: 65%" aria-valuenow="90" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="browser-list">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-compass">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polygon
                                        points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
                                </svg>
                            </div>
                            <div class="w-browser-details">

                                <div class="w-browser-info">
                                    <h6>Safari</h6>
                                    <p class="browser-count">25%</p>
                                </div>

                                <div class="w-browser-stats">
                                    <div class="progress">
                                        <div class="progress-bar bg-gradient-danger" role="progressbar"
                                             style="width: 35%" aria-valuenow="65" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="browser-list">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-globe">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="2" y1="12" x2="22" y2="12"></line>
                                    <path
                                        d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                </svg>
                            </div>
                            <div class="w-browser-details">

                                <div class="w-browser-info">
                                    <h6>Others</h6>
                                    <p class="browser-count">15%</p>
                                </div>

                                <div class="w-browser-stats">
                                    <div class="progress">
                                        <div class="progress-bar bg-gradient-warning" role="progressbar"
                                             style="width: 15%" aria-valuenow="15" aria-valuemin="0"
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row widget-statistic">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                    <div class="widget widget-one_hybrid widget-followers">
                        <div class="widget-heading">
                            <div class="w-title">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-users">
                                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    </svg>
                                </div>
                                <div class="">
                                    <p class="w-value">31.6K</p>
                                    <h5 class="">Followers</h5>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content">
                            <div class="w-chart">
                                <div id="hybrid_followers"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                    <div class="widget widget-one_hybrid widget-referral">
                        <div class="widget-heading">
                            <div class="w-title">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-link">
                                        <path
                                            d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                        <path
                                            d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                    </svg>
                                </div>
                                <div class="">
                                    <p class="w-value">1,900</p>
                                    <h5 class="">Referral</h5>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content">
                            <div class="w-chart">
                                <div id="hybrid_followers1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 layout-spacing">
                    <div class="widget widget-one_hybrid widget-engagement">
                        <div class="widget-heading">
                            <div class="w-title">
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                         stroke-linecap="round" stroke-linejoin="round"
                                         class="feather feather-message-circle">
                                        <path
                                            d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                                    </svg>
                                </div>
                                <div class="">
                                    <p class="w-value">18.2%</p>
                                    <h5 class="">Engagement</h5>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content">
                            <div class="w-chart">
                                <div id="hybrid_followers3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}

    </div>
    @endauth

@endsection


@push('scripts')

    <script>
        var months = {!! json_encode(array_reverse($months)) !!};
        var totalPayments = {!! json_encode(array_reverse($total_payments)) !!};
        var totalPurchases = {!! json_encode(array_reverse($total_purchases)) !!};
    </script>
    <script src="{{ asset("assets/plugins/src/apex/apexcharts.min.js")  }}"></script>
    <script src="{{ asset("assets/js/dashboard/dash_1.js")  }}"></script>
@endpush
