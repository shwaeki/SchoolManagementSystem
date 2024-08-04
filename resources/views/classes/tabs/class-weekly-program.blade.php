@push('styles')
    <link href="{{ asset("assets/plugins/css/light/editors/quill/quill.snow.css")  }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset("assets/plugins/css/dark/editors/quill/quill.snow.css")  }}" rel="stylesheet" type="text/css"/>
@endpush

@push("tab_button")
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="class-weekly-program-tab" data-bs-toggle="tab"
                href="#class-weekly-program"
                role="tab" aria-controls="class-weekly-program" aria-selected="false"
                tabindex="-1">
            <i class="fas fa-calendar-day"></i>
            الخطة الاسبوعية
        </button>
    </li>
@endpush

@php($weeklySubjects = ["التنوير اللغوي",  "المنطق الرياضي","علوم وتكنولوجيا", "الفنون والموسيقى", "القيم / التراث / الدين", "الزوايا الصفية", "التربية البدنية", "اللغة الانجليزية"])


@push("tab_content")
    <div class="tab-pane fade" id="class-weekly-program" role="tabpanel"
         aria-labelledby="class-students-tab">


        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">

                <div class="section general-info">
                    <div class="info">
                        <div class="text-center d-none d-print-block">
                            <img src="{{ asset('assets/img/logo.png') }}" height="150px" alt="logo">
                            <h6 class="mb-1">الخطة الاسبوعية</h6>
                            <h6 class="mb-1">{{ $class->name }}</h6>
                        </div>

                        <div class="row mb-4 d-print-none">
                            <div class="col-9">
                                <h6 class="mb-0 ">الخطة الاسبوعية</h6>
                            </div>
                            <div class="col-3 text-end">
                                <button type="button" class="btn btn-warning" onclick="window.print()">
                                    طباعة
                                </button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addWeeklyProgramModal">
                                    اضافة
                                </button>
                            </div>
                        </div>

                        <form method="GET" id="weekSelectForm" class="d-print-none">
                            <div class="mb-3">
                                <label for="weekSelect" class="form-label">التاريخ</label>
                                <input type="date" id="weekSelect" name="weekSelect"
                                       class="form-control custom-date"
                                       value="{{ request('weekSelect', $weekFirstDate) }}">
                            </div>
                        </form>

                        <p class="fs-5 text-center mb-3"><span>من تاريخ {{ $weekFirstDate  }}</span>
                            <span>الى  تاريخ {{ $weekLastDate  }}</span></p>
                        <hr>
                        @if(count($weeklyPrograms) > 0)

                            <div class="row">
                                @foreach ( $weeklySubjects as $key)

                                    @if ( !isset($weeklyPrograms[$key]))
                                        @continue
                                    @endif


                                    <div class="col-4 mb-3">
                                        <div class="card">
                                            <div class="card-header py-2 bg-transparent">
                                                <p class="fs-5 mb-0">{{ $key }}</p>
                                            </div>
                                            <div class="card-body">
                                                @foreach($weeklyPrograms[$key] as $contents)
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        {!! $contents['content'] !!}
                                                        <div class="d-print-none">
                                                            <button type="button"
                                                                    data-id="{{ $contents['id']  }}"
                                                                    data-title="{{ $key }}"
                                                                    data-content=" {!! $contents['content'] !!}"
                                                                    class="btn btn-light-warning text-warning rounded-circle editWeek">
                                                                <i class="far fa-edit"></i>
                                                            </button>

                                                            <button type="button"
                                                                    class="btn btn-light-danger text-danger rounded-circle "
                                                                    onclick="deleteItem(this)"
                                                                    data-item="{{route('year-classes.weeklyProgram.destroy',$contents['id'])}}">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                    </div>

                                                    @if(!$loop->last)
                                                        <hr>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        @else

                            <h4 class="text-center py-5">
                                لا يوجد خطة اسبوعية لهذا الاسبوع
                            </h4>
                        @endif

                    </div>
                </div>


            </div>
        </div>

    </div>
@endpush



@push("html")
    <div class="modal fade" id="addWeeklyProgramModal">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('year-classes.weeklyProgram.store',$current_year_class) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">اضافة الخطة الاسبوعية </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="start_date" class="form-label">التاريخ</label>
                            <input type="date" id="start_date" name="start_date"
                                   class="form-control custom-date"
                                   value="{{ request('start_date') }}">

                            @error('start_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>


                        <div class="row">
                            @foreach($weeklySubjects as $subject)
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="contentText">{{ $subject  }} </label>
                                        <textarea id="contentText" name="content[{{$subject}}]" class="form-control"
                                                  rows="2"></textarea>
                                    </div>
                                </div>
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

    <div class="modal fade" id="editWeeklyProgramModal">
        <div class="modal-dialog modal-lg" role="document">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تعديل الخطة الاسبوعية </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editWeekSubject">العنوان </label>
                            <input type="text" id="editWeekSubject" class="form-control" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="editWeekContent">المحتوى </label>
                            <textarea id="editWeekContent" name="content" class="form-control" rows="3"></textarea>
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
    <script src="{{ asset("assets/plugins/src/editors/quill/quill.js")  }}"></script>

    <script>

        $(document).on("click", ".editWeek", function () {
            var id = $(this).data("id");
            var title = $(this).data("title");
            var content = $(this).data("content");

            $("#editWeekSubject").val(title);
            $("#editWeekContent").val(content);

            var url = '{{ route("year-classes.weeklyProgram.update", ":ID") }}';
            url = url.replace(':ID', id);
            $('#editWeeklyProgramModal form').attr('action', url);
            $('#editWeeklyProgramModal').modal('show');
        })


        $("#weekSelect").change(function () {
            $("#weekSelectForm").submit();
        });

        $("#weekSelect").flatpickr({
            "disable": [
                function (date) {
                    return (date.getDay() != 0);
                }
            ],
            "locale": {
                "firstDayOfWeek": 0
            }
        });

        $("#start_date").flatpickr({
            "static": true,
            "disable": [
                function (date) {
                    return (date.getDay() != 0);
                }
            ],
            "locale": {
                "firstDayOfWeek": 0
            }
        });

    </script>

    @if ($errors->has('day') || $errors->has('start_date') || $errors->has('content'))
        <script>
            $(document).ready(function () {
                $('#addWeeklyProgramModal').modal('show');
            });
        </script>
    @endif
@endpush
