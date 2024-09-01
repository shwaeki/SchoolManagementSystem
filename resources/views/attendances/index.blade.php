@extends('layouts.app')

@section('content')

    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-8">
                    <h4> تقارير الحضور</h4>
                </div>

                <div class="col-4 text-end align-self-center">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#attendanceModal">
                        اضافة
                    </button>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            {{ $dataTable->table() }}
        </div>
    </div>

    <div class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="attendanceModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('attendances.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="attendanceModalLabel">اضافة حضور</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="teacher_id" class="form-label">الموظف</label>
                            <select class="form-select select2" id="teacher_id" name="teacher_id" required>
                                <option value="" disabled selected>اختر الموظف ...</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">التاريخ</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>

                        <div class="mb-3">
                            <label for="check_in" class="form-label">وقت الوصول</label>
                            <input type="time" class="form-control" id="check_in" name="check_in">
                        </div>

                        <div class="mb-3">
                            <label for="check_out" class="form-label">وقت المغادرة</label>
                            <input type="time" class="form-control" id="check_out" name="check_out">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAttendanceModal" tabindex="-1" aria-labelledby="editAttendanceModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editAttendanceForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editAttendanceModalLabel">تعديل الحضور</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_date" class="form-label">التاريخ</label>
                            <input type="date" class="form-control" id="edit_date" name="date" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit_check_in" class="form-label">وقت الوصول</label>
                            <input type="time" class="form-control" id="edit_check_in" name="check_in">
                        </div>

                        <div class="mb-3">
                            <label for="edit_check_out" class="form-label">وقت المغادرة</label>
                            <input type="time" class="form-control" id="edit_check_out" name="check_out">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    {{ $dataTable->scripts() }}

    <script>
        $(document).on('click', '.edit-attendance', function () {
            var id = $(this).data('id');
            var url = '{{ route("attendances.update", ":id") }}';
            url = url.replace(':id', id);


            $('#edit_date').val($(this).data('date'));
            $('#edit_check_in').val($(this).data('check_in'));
            $('#edit_check_out').val($(this).data('check_out'));

            $('#editAttendanceForm').attr('action', url);
        });
    </script>
@endpush
