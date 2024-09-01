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







    <div class="row layout-top-spacing">
        @livewire('attendance-component')


        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-card-four">
                <div class="widget-content">
                    <div class="w-header">
                        <div class="w-info">
                            <h6 class="value"> عدد الساعات هذا الشهر</h6>
                        </div>
                    </div>
                    <div class="w-content" style="    margin-top: 10px;">
                        <div class="w-info">
                            <p class="value"> {{ $totalHoursThisMonth }}<span> ساعة </span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-12 layout-spacing">
            <div class="widget widget-activity-five">

                <div class="widget-heading">
                    <h5 class="">الحضور</h5>
                </div>

                <div class="widget-content">

                    <div class="w-shadow-top"></div>

                    <div class="mx-auto">
                        <div id="attendanceChart"></div>

                    </div>

                    <div class="w-shadow-bottom"></div>
                </div>
            </div>
        </div>

    </div>

@endsection



@push('scripts')
    <script src="{{ asset("assets/plugins/src/apex/apexcharts.min.js")  }}"></script>
    <script>
        var options = {
            chart: {
                height: 350,
                type: 'line',
                toolbar: {
                    show: false,
                }
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                name: 'مجموع الساعات',
                data: @json($totalHours)
            }],
            xaxis: {
                categories: @json($dates)
            },
            yaxis: {
                title: {
                    text: 'ساعات'
                }
            },
            title: {
                text: 'مجموع الساعات في اليوم'
            },
            responsive: [
                {
                    breakpoint: 767,
                    options: {
                        stroke: {
                            width: 2 // Adjust stroke width for smaller screens
                        }
                    }
                },
            ]
        };

        var chart = new ApexCharts(document.querySelector("#attendanceChart"), options);
        chart.render();
    </script>
@endpush
