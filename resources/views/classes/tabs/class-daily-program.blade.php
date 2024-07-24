@push("tab_button")

    <li class="nav-item" role="presentation">
        <button class="nav-link" id="class-daily-program-tab" data-bs-toggle="tab"
                href="#class-daily-program"
                role="tab" aria-controls="class-daily-program" aria-selected="false"
                tabindex="-1">
            <i class="fas fa-calendar-day"></i>
            البرنامج اليومي
        </button>
    </li>
@endpush

@push("tab_content")
    <div class="tab-pane fade" id="class-daily-program" role="tabpanel"
         aria-labelledby="class-students-tab">

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">

                <form class="section general-info">
                    <div class="info">
                        <div class="row mb-4">
                            <div class="col-9">
                                <h6 class="mb-0"> البرنامج اليومي</h6>
                            </div>
                            <div class="col-3 text-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addDailyProgramModal">
                                    اضافة
                                </button>
                            </div>
                        </div>

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

                        <div class="row">
                            @foreach ( $dayNames as $key=>$day)
                                @php( $programs = $current_year_class->dailyPrograms->where('day', $key)->sortBy('start_time'))

                                @if ($programs->isEmpty())
                                    @continue
                                @endif

                                {{--      Style 1      --}}
                                {{--                                                    <div class="col-12 d-none">
                                  <p class="fs-5">{{ $day }}</p>
                                                                                        <table class="table table-bordered table-sm">
                                                                                            <tr>
                                                                                                <td>الساعة</td>
                                                                                                @foreach ($programs as $program)
                                                                                                    <td>
                                                                                                        {{ Carbon\Carbon::createFromFormat('H:i:s', $program->start_time)->format('h:i') }}
                                                                                                        -
                                                                                                        {{ Carbon\Carbon::createFromFormat('H:i:s', $program->end_time)->format('h:i') }}
                                                                                                    </td>
                                                                                                @endforeach
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>المادة</td>
                                                                                                @foreach ($programs as $program)
                                                                                                    <td>{{ $program->subject_name }}</td>
                                                                                                @endforeach
                                                                                            </tr>
                                                                                        </table>
                                                                                    </div>--}}

                                {{--      Style 2     --}}
                                <div class="mb-4 col-12 col-md-6">
                                    <p class="fs-5">{{ $day }}</p>
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                        <tr>
                                            <th scope="col">الساعة</th>
                                            <th scope="col">المادة</th>
                                            <th scope="col">الصورة</th>
                                            <th scope="col">خيارات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($programs as $program)
                                            <tr>
                                                <td>{{ $program->time }}</td>
                                                <td>{{ $program->subject_name }}</td>
                                                <td>
                                                    <img src="{{ $program->image_path }}"
                                                         class="rounded object-fit" height="50px"
                                                         width="50px">
                                                </td>
                                                <td>
                                                    <button type="button"
                                                            class="btn btn-light-danger text-danger"
                                                            onclick="deleteItem(this)"
                                                            data-item="{{route('year-classes.dailyProgram.destroy',$program)}}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{--      Style 3     --}}
                                {{--                                                    <div class="col-12">
                                  <p class="fs-5">{{ $day }}</p>
                                                                                        <div class="row">
                                                                                            @foreach ($programs as $program)
                                                                                                <div class="col-2">
                                                                                                    <div class="card text-center">
                                                                                                        <div class="card-body p-2">
                                                                                                            <h5 class="card-title mb-1">{{ $program->subject_name }}</h5>
                                                                                                            <p>{{ $program->time }}</p>
                                                                                                            <img src="{{  Storage::url($program->image) }}"
                                                                                                               class="img-fluid"  >
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>--}}
                            @endforeach


                        </div>
                    </div>
                </form>


            </div>
        </div>

    </div>
@endpush



@push("html")
    <div class="modal fade" id="addDailyProgramModal">
            <div class="modal-dialog" role="document">
                <form action="{{ route('year-classes.dailyProgram.store',$current_year_class) }}"
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
                                <label for="subject_name">اسم المادة</label>
                                <input type="text" id="subject_name" name="subject_name" class="form-control"
                                       value="{{ old('subject_name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="image">الصورة </label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label for="start_time">وقت البدء</label>
                                <select id="start_time" name="start_time"
                                        class="form-control @error('start_time') is-invalid @enderror" required>
                                    @for ($i = 7; $i < 15; $i++)
                                        @for ($j = 0; $j < 60; $j+=5)
                                            <option
                                                value="{{ sprintf('%02d:%02d', $i, $j) }}" {{ old('start_time') == sprintf('%02d:%02d', $i, $j) ? 'selected' : '' }}>
                                                {{ sprintf('%02d:%02d', $i, $j) }}
                                            </option>
                                        @endfor
                                    @endfor
                                </select>
                                @error('start_time')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="end_time">وقت الانتهاء</label>
                                <select id="end_time" name="end_time"
                                        class="form-control @error('end_time') is-invalid @enderror" required>
                                    @for ($i = 7; $i < 15; $i++)
                                        @for ($j = 0; $j < 60; $j+=5)
                                            <option
                                                value="{{ sprintf('%02d:%02d', $i, $j) }}" {{ old('end_time') == sprintf('%02d:%02d', $i, $j) ? 'selected' : '' }}>
                                                {{ sprintf('%02d:%02d', $i, $j) }}
                                            </option>
                                        @endfor
                                    @endfor
                                </select>
                                @error('end_time')
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
    @if ($errors->has('day') || $errors->has('start_time') || $errors->has('end_time') || $errors->has('subject_name'))
        <script>
            $(document).ready(function () {
                $('#addDailyProgramModal').modal('show');
            });
        </script>
    @endif
@endpush
