@extends('layouts.app')

@push('styles')
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

    @php($monthlySubjects = ["غايات في مجال التنوير اللغوي", "غايات في مجال التفكير الرياضي", "غايات في مجال العلوم", "غايات في مجال الفنون", "غايات في مجال المهارات الحياتية", "غايات في مجال التراث والحضارة", "غايات في مجال ادب الاطفال", "غايات في المجال الحركي", "غايات في مجال اللغة الانجليزية" ])


    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


    <div class="statbox widget box box-shadow">
        <div class="widget-header px-3 pt-3">
            <div class="row mb-4 d-print-none">
                <div class="col-9">
                    <h4 class="mb-0 ">الخطة الشهرية</h4>
                </div>
                <div class="col-3 text-end">
                    @if(count($monthly_plans) == 0)
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addMonthlyPlanModal">
                            اضافة
                        </button>
                    @endif
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area  px-3">


            <form method="GET" id="monthSelectForm" class="d-print-none">
                <div class="mb-3">
                    <label for="monthSelect" class="form-label">التاريخ</label>
                    <input type="month" id="monthSelect" name="monthSelect"
                           class="form-control custom-date"
                           value="{{ request('monthSelect', Carbon\Carbon::now()->format('Y-m')) }}">
                </div>
            </form>

            <hr>

            @if( count($monthly_plans) > 0)

                <div class="row">
                    @foreach ( $monthlySubjects as $key)

                        @if ( !isset($monthly_plans[$key]))
                            @continue
                        @endif


                        <div class="col-12 col-md-6 mb-3">
                            <div class="card">
                                    <div class="card-header py-2 bg-transparent d-flex justify-content-between">
                                        <p class="fs-5 mb-0">{{ $key }}</p>
                                        <div class="d-print-none">
                                            <button type="button"
                                                    data-id="{{ $monthly_plans[$key][0]['id']  }}"
                                                    data-title="{{ $key }}"
                                                    data-objectives=" {!! $monthly_plans[$key][0]['objectives'] !!}"
                                                    data-methods=" {!! $monthly_plans[$key][0]['methods'] !!}"
                                                    class="btn btn-light-warning text-warning rounded-circle editMonthlyPlan">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </div>
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

    <div class="modal fade" id="addMonthlyPlanModal">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('teacher-plan.store') }}"
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
                                                    <label for="methods">الفعاليات </label>
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
                            <textarea id="editMonthPlanMethods" name="methods" class="form-control preserveLines" rows="3"></textarea>
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

@endsection


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

            var url = '{{ route("teacher-plan.update", ['teacher_plan' => ":ID"]) }}';
            url = url.replace(':ID', id);
            $('#editMonthlyPlanModal form').attr('action', url);
            $('#editMonthlyPlanModal').modal('show');
        })


        $("#monthSelect").change(function () {
            $("#monthSelectForm").submit();
        });


    </script>
@endpush
