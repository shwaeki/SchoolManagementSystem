@push('styles')
    <link href="{{ asset("assets/plugins/css/light/editors/quill/quill.snow.css")  }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset("assets/plugins/css/dark/editors/quill/quill.snow.css")  }}" rel="stylesheet" type="text/css"/>
    <style>
        .ql-container {
            min-height: 200px;
            height: 100%;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .ql-editor {
            height: 100%;
            flex: 1;
            overflow-y: auto;
            width: 100%;
        }
    </style>

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

                        <p class="fs-5">  <span>من تاريخ {{ $weekFirstDate  }}</span>   <span>الى  تاريخ {{ $weekLastDate  }}</span></p>

                        @php(
                            $dayNames = [
                                'Sunday' => 'الأحد',
                                'Monday' => 'الاثنين',
                                'Tuesday' => 'الثلاثاء',
                                'Wednesday' => 'الأربعاء',
                                'Thursday' => 'الخميس',
                                'Friday' => 'الجمعة',
                                'Saturday' => 'السبت',
                            ])


                        @if(count($weeklyPrograms) > 0)

                            <div class="row">
                                @foreach ( $dayNames as $key=>$day)

                                    @if ( !isset($weeklyPrograms[$key]))
                                        @continue
                                    @endif


                                    <div class="col-4">

                                        <div class="card">
                                            <div class="card-header py-2 bg-transparent">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="fs-5 mb-0">{{ $day }}</p>
                                                    <div>
                                                        {{--                                                        <button type="button"
                                                                                                                        class="btn btn-light-warning text-warning rounded-circle me-2 ">
                                                                                                                    <i class="far fa-edit"></i>
                                                                                                                </button>--}}

                                                        <button type="button"
                                                                class="btn btn-light-danger text-danger rounded-circle "
                                                                onclick="deleteItem(this)"
                                                                data-item="{{route('year-classes.weeklyProgram.destroy',$weeklyPrograms[$key]['id'])}}">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                {!! $weeklyPrograms[$key]['content'] !!}
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
        <div class="modal-dialog" role="document">
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


                        {{--                    <div class="mb-3">
                                                <label for="image">الصورة </label>
                                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                            </div>
                --}}
                        <div class="mb-3">
                            <label for="week"> الاسبوع</label>
                            <input type="week" id="week" name="week" class="form-control"
                                   value="{{ old('week') }}" required>
                            @error('start_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="day">اليوم</label>
                            <select id="day" name="day" class="form-control @error('day') is-invalid @enderror"
                                    required>
                                <option value="Sunday" {{ old('day') == 'Sunday' ? 'selected' : '' }}>الأحد</option>
                                <option value="Monday" {{ old('day') == 'Monday' ? 'selected' : '' }}>الإثنين
                                </option>
                                <option value="Tuesday" {{ old('day') == 'Tuesday' ? 'selected' : '' }}>الثلاثاء
                                </option>
                                <option value="Wednesday" {{ old('day') == 'Wednesday' ? 'selected' : '' }}>
                                    الأربعاء
                                </option>
                                <option value="Thursday" {{ old('day') == 'Thursday' ? 'selected' : '' }}>الخميس
                                </option>
                                <option value="Friday" {{ old('day') == 'Friday' ? 'selected' : '' }}>الجمعة
                                </option>
                                <option value="Saturday" {{ old('day') == 'Saturday' ? 'selected' : '' }}>السبت
                                </option>
                            </select>
                            @error('day')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="contentText">المحتوى </label>
                            <textarea id="contentText" name="content" class="form-control d-none" rows="20"
                                      required></textarea>
                            <div id="editor-container"></div>
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
        var quill = new Quill('#editor-container', {
            modules: {
                toolbar: [
                    [{header: [1, 2, 3, 4, 5, 6, false]}],
                    ['bold', 'italic', 'underline', 'strike', 'blockquote'],
                    [{align: []}],
                    [{'direction': 'rtl'}]
                ]
            },
            theme: 'snow'
        });
        quill.on('text-change', function (delta, oldDelta, source) {
            $('#contentText').val(quill.container.firstChild.innerHTML);
        });


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
