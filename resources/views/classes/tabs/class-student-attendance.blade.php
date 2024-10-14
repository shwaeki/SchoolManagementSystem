@push("tab_button")
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="class-student-attendance-tab" data-bs-toggle="tab"
                href="#class-student-attendance"
                role="tab" aria-controls="class-student-attendance" aria-selected="false"
                tabindex="-1">
            <i class="fas fa-calendar-alt"></i>
            الحضور والغياب
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
                                <h6 class="mb-0">الحضور والغياب</h6>
                            </div>
                            <div class="col-3 text-end">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#addNoteModal">
                                    إضافة ملاحظة للجميع
                                </button>
                            </div>
                        </div>

                        <form method="GET" id="attendanceDateForm">
                            <div class="mb-3">
                                <label for="attendanceDate" class="form-label">التاريخ</label>
                                <input type="date" id="attendanceDate" name="date"
                                       class="form-control custom-date" value="{{request('date',date('Y-m-d'))}}">
                            </div>
                        </form>

                        <form action="{{route('year-classes.attendance.update',$current_year_class)}}" method="POST">
                            @csrf

                            @if(request('date'))
                                <input type="hidden" name="date" value="{{request('date')}}">
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="checkbox-area" scope="col">
                                            <div class="form-check form-check-primary">
                                                <input class="form-check-input" id="checkbox_parent_all"
                                                       type="checkbox">
                                            </div>
                                        </th>
                                        <th scope="col">الاسم</th>
                                        <th scope="col">الملاحظة</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($class_year_students as $data)


                                        @php
                                            $status = $studentsAttendance[$data->student_id]['status'] ?? null;
                                            $note = $studentsAttendance[$data->student_id]['notes'] ?? '';

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
                                            <td>
                                                <input type="text" class="form-control form-control-sm" name="notes[{{ $data->student_id }}]"
                                                       value="{{ $note }}">
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
    <!-- Add Note Modal -->
    <div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNoteModalLabel">إضافة ملاحظة للجميع</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addNoteForm">
                        <div class="mb-3">
                            <label for="noteText" class="form-label">الملاحظة</label>
                            <textarea class="form-control" id="noteText" name="note" rows="3"></textarea>
                        </div>
       {{--                 <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="updateAttendanceCheckbox">
                            <label class="form-check-label" for="updateAttendanceCheckbox">
                                تحديث الحضور لجميع الطلاب
                            </label>
                        </div>--}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">إغلاق</button>
                    <button type="button" class="btn btn-primary" id="saveNoteButton">حفظ الملاحظة للجميع</button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push("scripts")
    <script>
        flatpickr(document.getElementById('attendanceDate'),{
            static: true,
            maxDate: "today",
        })

        $("#attendanceDate").change(function () {
            $("#attendanceDateForm").submit();
        });

        $('#saveNoteButton').click(function () {
            var noteText = $('#noteText').val();
            var updateAttendance = $('#updateAttendanceCheckbox').is(':checked');

            $('input[name^="notes"]').each(function() {
                $(this).val(noteText);
            });

            if (updateAttendance) {
                $('.checkbox_child').prop('checked', true);
            }

            $('#addNoteModal').modal('hide');
        });
    </script>
@endpush
