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
                        <div class="row mb-4">
                            <div class="col-9">
                                <h6 class="mb-0">الخطة الاسبوعية</h6>
                            </div>
                            <div class="col-3 text-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addweeklyProgramModal">
                                    اضافة
                                </button>
                            </div>
                        </div>

                        @php( $seletedWeek = request('weekSelect', Carbon\Carbon::now()->format('o-\WW')))
                        <form method="GET" id="weekSelectForm">
                            <div class="mb-3">
                                <label for="weekSelect" class="form-label">الاسبوع</label>
                                <input type="week" id="weekSelect" name="weekSelect"
                                       class="form-control"
                                       value="{{ $seletedWeek }}">
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
                                                        <div>
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
    <div class="modal fade" id="addweeklyProgramModal">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('year-classes.weeklyProgram.store',$current_year_class) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">اضافة برنامج يومي </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="week"> الاسبوع</label>
                            <input type="week" id="week" name="week" class="form-control"
                                   value="{{ old('week') }}" required>
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
@endpush


@push("scripts")
    <script src="{{ asset("assets/plugins/src/editors/quill/quill.js")  }}"></script>

    <script>
        $("#weekSelect").change(function () {
            $("#weekSelectForm").submit();
        });
    </script>

    @if ($errors->has('day') || $errors->has('week') || $errors->has('content'))
        <script>
            $(document).ready(function () {
                $('#addweeklyProgramModal').modal('show');
            });
        </script>
    @endif
@endpush
