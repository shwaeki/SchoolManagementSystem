@push("tab_button")
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="class-monthly-plan-tab" data-bs-toggle="tab"
                href="#class-monthly-plan"
                role="tab" aria-controls="class-monthly-plan" aria-selected="false"
                tabindex="-1">
            <i class="fas fa-calendar-day"></i>
            الخطة الشهرية
        </button>
    </li>
@endpush

@php($monthlySubjects = [ "غايات في مجال القيم التربية الاسلامية والاجتماعية", "التنوير اللغوي", "العلوم", "التفكير الرياضي", "الحسي الحركي", "اللغة الانجليزية"])


@push("tab_content")
    <div class="tab-pane fade" id="class-monthly-plan" role="tabpanel"
         aria-labelledby="class-students-tab">


        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">

                <div class="section general-info">
                    <div class="info">
                        <div class="text-center d-none d-print-block">
                            <img src="{{ asset('assets/img/logo.png') }}" height="150px" alt="logo">
                            <h6 class="mb-1">الخطة الشهرية</h6>
                            <h6 class="mb-1">{{ $class->name }}</h6>
                        </div>

                        <div class="row mb-4 d-print-none">
                            <div class="col-9">
                                <h6 class="mb-0 ">الخطة الشهرية</h6>
                            </div>
                            <div class="col-3 text-end">
                                <button type="button" class="btn btn-warning" onclick="window.print()">
                                    طباعة
                                </button>
                                @if(count($monthlyPlans) == 0)
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addMonthlyPlanModal">
                                        اضافة
                                    </button>
                                @endif
                            </div>
                        </div>

                        <form method="GET" id="monthSelectForm" class="d-print-none">
                            <div class="mb-3">
                                <label for="monthSelect" class="form-label">التاريخ</label>
                                <input type="month" id="monthSelect" name="monthSelect"
                                       class="form-control custom-date"
                                       value="{{ request('monthSelect', Carbon\Carbon::now()->format('Y-m')) }}">
                            </div>
                        </form>

                        <hr>
                        @if(count($monthlyPlans) > 0)

                            <div class="row d-print-none">
                                @foreach ( $monthlySubjects as $key)

                                    @if ( !isset($monthlyPlans[$key]))
                                        @continue
                                    @endif


                                    <div class="col-12 col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-header py-2 bg-transparent d-flex justify-content-between">
                                                <p class="fs-5 mb-0">{{ $key }}</p>
                                                <div class="d-print-none">
                                                    <button type="button"
                                                            data-id="{{ $monthlyPlans[$key][0]['id']  }}"
                                                            data-title="{{ $key }}"
                                                            data-objectives=" {!! $monthlyPlans[$key][0]['objectives'] !!}"
                                                            data-methods=" {!! $monthlyPlans[$key][0]['methods'] !!}"
                                                            class="btn btn-light-warning text-warning rounded-circle editMonthlyPlan">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">

                                                <p class="mb-1 fw-bold fs-6">الأهداف:</p>
                                                <p class="preserveLines"> {!! $monthlyPlans[$key][0]['objectives'] !!}</p>
                                                <hr>
                                                <p class="mb-1 fw-bold fs-6">الوسائل:</p>
                                                <p class="preserveLines">{!! $monthlyPlans[$key][0]['methods'] !!}</p>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>

                            <div class="row d-none d-print-block">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>المادة</th>
                                        <th>الأهداف</th>
                                        <th>الوسائل</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($monthlySubjects as $key)
                                        @if (!isset($monthlyPlans[$key]))
                                            @continue
                                        @endif

                                        <tr>
                                            <td>{{ $key }}</td>
                                            <td>{!! $monthlyPlans[$key][0]['objectives'] !!}</td>
                                            <td>{!! $monthlyPlans[$key][0]['methods'] !!}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
@endpush



@push("html")
    <div class="modal fade" id="addMonthlyPlanModal">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('year-classes.monthlyPlan.store',$current_year_class) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">اضافة خطة الشهرية </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="month" class="form-label">الشهر</label>
                            <input type="month" id="month" name="month"
                                   class="form-control"
                                   value="{{ request('monthSelect', Carbon\Carbon::now()->format('Y-m')) }}">

                            @error('month')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <hr>
                        <div class="row">
                            @foreach($monthlySubjects as $subject)
                                <div class="col-12">
                                    <div class="mb-3">
                                        <p class="fs-5">{{ $subject  }} </p>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label for="objectives">الأهداف </label>
                                                    <textarea id="objectives" name="objectives[{{$subject}}]"
                                                              class="form-control preserveLines" rows="2"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-3">
                                                    <label for="methods">الوسائل </label>
                                                    <textarea id="methods" name="methods[{{$subject}}]"
                                                              class="form-control preserveLines" rows="2"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!$loop->last)
                                    <hr>
                                @endif
                            @endforeach
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

    <div class="modal fade" id="editMonthlyPlanModal">
        <div class="modal-dialog modal-lg" role="document">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تعديل الخطة الشهرية </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editMonthPlanSubject">العنوان </label>
                            <input type="text" id="editMonthPlanSubject" class="form-control" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="editMonthPlanObjectives">الأهداف </label>
                            <textarea id="editMonthPlanObjectives" name="objectives" class="form-control preserveLines"
                                      rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="editMonthPlanMethods">الوسائل </label>
                            <textarea id="editMonthPlanMethods" name="methods" class="form-control preserveLines"
                                      rows="3"></textarea>
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
@endpush


@push("scripts")
    <script>

        $(document).on("click", ".editMonthlyPlan", function () {
            var id = $(this).data("id");
            var title = $(this).data("title");
            var objectives = $(this).data("objectives");
            var methods = $(this).data("methods");

            $("#editMonthPlanSubject").val(title);
            $("#editMonthPlanObjectives").val(objectives);
            $("#editMonthPlanMethods").val(methods);

            var url = '{{ route("year-classes.monthlyPlan.update", ":ID") }}';
            url = url.replace(':ID', id);
            $('#editMonthlyPlanModal form').attr('action', url);
            $('#editMonthlyPlanModal').modal('show');
        })


        $("#monthSelect").change(function () {
            $("#monthSelectForm").submit();
        });


    </script>

    @if ($errors->has('methods') || $errors->has('month') || $errors->has('objectives'))
        <script>
            $(document).ready(function () {
                $('#addMonthlyPlanModal').modal('show');
            });
        </script>
    @endif
@endpush
