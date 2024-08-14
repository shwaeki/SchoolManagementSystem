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

    @if($teacher->archived)
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
                تمت ارشفة بيانات هذا الموظف

            </div>
        @endpush
    @endif

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2 class="mb-3"> معلومات الموظف - {{$teacher->name}}
                        {!! trans('options.'.$teacher->teacher_type.'_badge') !!}
                    </h2>

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
                                الملفات
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="teacher-salaries-tab" data-bs-toggle="tab"
                                    href="#teacher-salaries"
                                    role="tab" aria-controls="teacher-salaries" aria-selected="false" tabindex="-1">
                                <i class="fas fa-file-archive"></i>
                                قسائم الرواتب
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="teacher-reports-tab" data-bs-toggle="tab"
                                    href="#teacher-reports"
                                    role="tab" aria-controls="teacher-reports" aria-selected="false" tabindex="-1">
                                <i class="fas fa-file-alt"></i>
                                التقارير
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="teacher-messages-tab" data-bs-toggle="tab"
                                    href="#teacher-messages"
                                    role="tab" aria-controls="teacher-messages" aria-selected="false" tabindex="-1">
                                <i class="fas fa-sms"></i>
                                الرسائل
                            </button>
                        </li>

                        @if($teacher->teacher_type == "teacher")
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="teacher-monthly-plan-tab" data-bs-toggle="tab"
                                        href="#monthly-plan-messages"
                                        role="tab" aria-controls="monthly-plan-messages" aria-selected="false"
                                        tabindex="-1">
                                    <i class="fas fa-calendar-days"></i>
                                    الخطة الشهرية
                                </button>
                            </li>
                        @endif

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
                                                <label for="status" class="form-label"> الحالة </label>
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

                                        <div class="col-6 col-md-3">
                                            <div class="mb-3">
                                                <label for="show_salary_slip" class="form-label"> اظهار قسائم الرواتب في
                                                    الملف الشخصي</label>
                                                <input type="text" id="show_salary_slip" class="form-control"
                                                       value="{{$teacher->show_salary_slip ? 'نعم' : 'لا'}}" disabled>
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

                <div class="tab-pane fade " id="teacher-files" role="tabpanel"
                     aria-labelledby="teacher-files-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section general-info">
                                <div class="info">
                                    <h6> ملفات خاصبة بالموظف </h6>
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

                <div class="tab-pane fade " id="teacher-salaries" role="tabpanel"
                     aria-labelledby="teacher-salaries-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section general-info">
                                <div class="info">
                                    <div class="row">
                                        <div class="col-9">
                                            <h6> قسائم الرواتب </h6>
                                        </div>
                                        <div class="col-3 text-end">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#addSalarySlap"
                                                    class="btn btn-primary"> اضافة
                                            </button>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th scope="col"> #</th>
                                                <th scope="col"> التاريخ</th>
                                                <th scope="col"> خيارات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($salaries as $salary)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$salary->date}}</td>
                                                    <td>
                                                        <a href="{{route('teachers.downloadSlip',$salary)}}"
                                                           target="_blank" class="btn btn-light-primary text-primary">
                                                            <i class="far fa-eye"></i>
                                                        </a>

                                                        <button class="btn btn-light-danger text-danger "
                                                                onclick="deleteItem(this)"
                                                                data-item="{{route('teachers.deleteSlip',$salary)}}">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
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

                <div class="tab-pane fade " id="teacher-reports" role="tabpanel"
                     aria-labelledby="teacher-reports-tab">
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
                                            <button type="button" class="btn btn-primary btn-lg"
                                                    id="reportExportButton">
                                                تصدير
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                    <h6> تقارير الموظف </h6>
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
                                            @foreach($teacher_reports as $report)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{$report->name}}</td>
                                                    <td>{{$report->addedBy->name}}</td>
                                                    <td>{{$report->created_at->format('Y-m-d')}}</td>
                                                    <td>
                                                        <a target="_blank"
                                                           href="{{route('teacher-reports.show',['teacher_report'=>$report])}}"
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

                <div class="tab-pane fade " id="teacher-messages" role="tabpanel"
                     aria-labelledby="teacher-messages-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section general-info">
                                <div class="info">

                                    <h6> الرسال التي تم ارسائلها الى الموظف </h6>

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
                                            @foreach($teacher_messages as $message)
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

                @if($teacher->teacher_type == "teacher")
                    <div class="tab-pane fade " id="monthly-plan-messages" role="tabpanel"
                     aria-labelledby="teacher-messages-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">

                                    @php($monthlySubjects = ["غايات في مجال التنوير اللغوي", "غايات في مجال التفكير الرياضي", "غايات في مجال العلوم", "غايات في مجال الفنون", "غايات في مجال المهارات الحياتية", "غايات في مجال التراث والحضارة", "غايات في مجال ادب الاطفال", "غايات في المجال الحركي", "غايات في مجال اللغة الانجليزية" ])


                                    <form method="GET" id="monthSelectForm" class="d-print-none">
                                        <div class="mb-3">
                                            <label for="monthSelect" class="form-label">التاريخ</label>
                                            <input type="month" id="monthSelect" name="monthSelect"
                                                   class="form-control custom-date"
                                                   value="{{ request('monthSelect', Carbon\Carbon::now()->format('Y-m')) }}">
                                        </div>
                                    </form>

                                    <hr>
                                    @if(count($monthly_plans) > 0)

                                        <div class="row">
                                            @foreach ( $monthlySubjects as $key)

                                                @if ( !isset($monthly_plans[$key]))
                                                    @continue
                                                @endif


                                                <div class="col-12 col-md-6 mb-3">
                                                    <div class="card">
                                                        <div class="card-header py-2 bg-transparent d-flex justify-content-between">
                                                            <p class="fs-5 mb-0">{{ $key }}</p>
                                                        </div>
                                                        <div class="card-body">

                                                            <p class="mb-1 fw-bold fs-6">الأهداف:</p>
                                                            <p class="preserveLines"> {!! $monthly_plans[$key][0]['objectives'] !!}</p>
                                                            <hr>
                                                            <p class="mb-1 fw-bold fs-6">الفعاليات:</p>
                                                            <p class="preserveLines">{!! $monthly_plans[$key][0]['methods'] !!}</p>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                    @else

                                        <h4 class="text-center py-5">
                                            لا يوجد خطة شهرية لهذا الشهر
                                        </h4>
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>


    <div class="modal fade" id="addSalarySlap">
        <form action="{{ route('teachers.storeSlip') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="teacher" value="{{$teacher->id}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="attributeModalLabel">اضافة قسيمة راتب جديدة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label"> التاريخ </label>
                            <input type="text" id="date" name="date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">قسيمة الراتب</label>
                            <input type="file" id="file" name="file" class="form-control" accept="application/pdf"
                                   required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">غلاق</button>
                        <button type="submit" class="btn btn-primary">اضافة</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

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
@endsection

@push('scripts')
    <script>
        var attributes = {!! json_encode($attributes ?? []) !!};

        $("#reportExportButton").on("click", function () {
            var selectedReportId = $("#reportSelect").val();

            if (selectedReportId == null) {
                Swal.fire({title: "خطأ!", text: "يرجى اختيار تقرير", icon: "error"});
                return;
            }

            console.log(selectedReportId)
            if (attributes[selectedReportId]) {
                $("#inputContainer").empty();

                var attributeValues = attributes[selectedReportId];
                attributeValues.forEach(function (value) {
                    $("#inputContainer").append('<input type="text" class="form-control mb-3" placeholder="' + value + '" date-name="' + value + '">');
                });
                $("#attributeModal").modal('show');
            } else {

                /*                var showTeacherReportRoute = '{{route('reports.show',['report'=> ':id', 'teacher'=> $teacher])}}';
                var showTeacherReportUrl = showTeacherReportRoute.replace(':id', selectedReportId);
                window.open(showTeacherReportUrl, '_blank');*/


                $.ajax({
                    url: '{{route('teacher-reports.generate')}}',
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        report: selectedReportId,
                        teacher: '{{$teacher->id}}',
                        date: {},
                    },
                    success: function (response) {
                        console.log('Ajax request successful:', response);
                        var showTeacherReportRoute = '{{ route('teacher-reports.show', ['teacher_report' => ':id']) }}';
                        var showTeacherReportUrl = showTeacherReportRoute.replace(':id', response.data.id);
                        window.open(showTeacherReportUrl, '_blank');
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
                url: '{{route('teacher-reports.generate')}}',
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    report: selectedReportId,
                    teacher: '{{$teacher->id}}',
                    date: postData
                },
                success: function (response) {
                    console.log('Ajax request successful:', response);
                    var showTeacherReportRoute = '{{ route('teacher-reports.show', ['teacher_report' => ':id']) }}';
                    var showTeacherReportUrl = showTeacherReportRoute.replace(':id', response.data.id);
                    window.open(showTeacherReportUrl, '_blank');
                    location.reload();
                },
                error: function (error) {
                    Swal.fire({title: "خطأ!", text: "حدث خطا ما الرجاء المحاولة مرى اخرى", icon: "error"});
                }
            });

        });

        $("#monthSelect").change(function () {
            $("#monthSelectForm").submit();
        });
    </script>
@endpush
