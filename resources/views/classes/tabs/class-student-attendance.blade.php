@push("tab_button")
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="class-student-attendance-tab" data-bs-toggle="tab"
                href="#class-student-attendance"
                role="tab" aria-controls="class-student-attendance" aria-selected="false"
                tabindex="-1">
            <i class="fas fa-calendar-alt"></i>
            الحضور و الغياب
        </button>
    </li>
@endpush

@push("tab_content")
    <div class="tab-pane fade" id="class-student-attendance" role="tabpanel"
         aria-labelledby="class-student-attendance-tab">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                <div class="section general-info">
                    <div class="info">
                        <div class="row mb-4">
                            <div class="col-9">
                                <h6 class="mb-0">الحضور و الغياب</h6>
                            </div>
                        </div>

                        <form method="GET" id="attendanceDateForm">
                            <div class="mb-3">
                                <label for="attendanceDate" class="form-label">التاريخ</label>
                                <input type="date" id="attendanceDate" name="date"
                                       class="form-control" value="{{request('date',date('Y-m-d'))}}">
                            </div>
                        </form>

                        <form action="{{route('year-classes.attendance.update',$current_year_class)}}" method="POST">
                            @csrf

                            @if(request('date'))
                                <input type="hidden" name="date" value="{{request('date')}}">
                            @endif

                            <div class="table-responsive">
                                <table
                                    class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="checkbox-area" scope="col">
                                            <div class="form-check form-check-primary">
                                                <input class="form-check-input" id="checkbox_parent_all"
                                                       type="checkbox">
                                            </div>
                                        </th>
                                        <th scope="col">الاسم</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($class_year_students as $data)
                                        @php
                                            $status = $studentsAttendance[$data->student_id] ?? null;

                                            if (!isset($studentsAttendance[$data->student_id])){
                                                 $rowClass = '';
                                            }elseif ($status == true){
                                                   $rowClass = 'table-success';
                                            }else if ($status == false){
                                                   $rowClass = 'table-danger';
                                            }
                                        @endphp
                                        <tr class="{{ $rowClass }}">
                                            <td>
                                                <div class="form-check form-check-primary">
                                                    <input type="hidden" name="students[{{ $data->student_id }}]"
                                                           value="0">
                                                    <input class="form-check-input checkbox_child striped_child"
                                                           type="checkbox" name="students[{{ $data->student_id }}]"
                                                           value="1" @checked($status)>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $data->student?->name }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100">
                                    حفظ
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush



@push("html")

@endpush


@push("scripts")
    <script>
        $("#attendanceDate").change(function () {
            $("#attendanceDateForm").submit();
        });
    </script>
@endpush
