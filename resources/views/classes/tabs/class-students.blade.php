@push("tab_button")
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="class-students-tab" data-bs-toggle="tab"
                href="#class-students"
                role="tab" aria-controls="class-students" aria-selected="false"
                tabindex="-1">
            <i class="fas fa-user-graduate"></i>
            قائمة الطلاب
        </button>
    </li>
@endpush

@push("styles")
    <style>
        @media print {
            table.dataTable {
                border-collapse: collapse;
                width: 100%;
            }

            table.dataTable thead th,
            table.dataTable tbody td {
                padding: 2px;
                font-size: 10px;
            }

            body, table {
                background: white;
            }

            body:before {
                display: none;
            }
        }
    </style>
@endpush

@push("tab_content")

    <div class="tab-pane fade" id="class-students" role="tabpanel"
         aria-labelledby="class-students-tab">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                <form class="section general-info">
                    <div class="info">
                        <div class="row">
                            <div class="col-9">
                                <h6 class="mb-0"> قائمة الطلاب</h6>
                            </div>
                            <div class="col-3 text-end">
                                @auth("web")
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#classStudentModal">
                                        اضافة
                                    </button>
                                @endauth
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table
                                class="table table-hover table-striped table-bordered dataTableCustomTitleConfig">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">الاسم</th>
                                    <th scope="col">رقم الهوية</th>
                                    <th scope="col">عنوان السكن</th>
                                    <th scope="col">الجنس</th>
                                    <th scope="col">اسم ألام</th>
                                    <th scope="col">رقم هاتف ألام</th>
                                    <th scope="col">اسم ألاب</th>
                                    <th scope="col">رقم هاتف ألاب</th>
                                    <th scope="col">تاريخ الميلاد</th>
                                    <th scope="col">تاريخ ألإضافة</th>
                                    <th scope="col" class="dontExport"> اضيف بواسطة</th>
                                    <th scope="col" class="dontExport">خيارات</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($class_year_students as $data)
                                    <tr>
                                        <td>{{$data->id}} </td>
                                        <td>
                                            <img src="{{$data->student?->photo}}"
                                                 class="me-2 rounded-circle border border-primary object-fit edit-personal-image"
                                                 width="50px" height="50px"
                                                 data-id="{{$data->student_id}}"
                                                 data-name="{{$data->student?->name}}"
                                                 data-image="{{$data->student?->photo}}">
                                            {{$data->student?->name}}
                                        </td>
                                        <td>{{$data->student?->identification}}</td>
                                        <td>{{$data->student?->address}}</td>

                                        <td>
                                            {{ trans('options.'. $data->student?->gender) }}
                                        </td>
                                        <td>{{$data->student?->mother_name}}</td>
                                        <td>{{$data->student?->mother_phone}}</td>
                                        <td>{{$data->student?->father_name}}</td>
                                        <td>{{$data->student?->father_phone}}</td>

                                        <td>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-calendar">
                                                <rect x="3" y="4" width="18" height="18" rx="2"
                                                      ry="2"></rect>
                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                            </svg>
                                            <span
                                                class="table-inner-text">{{$data->student?->birth_date}}</span>
                                        </td>
                                        <td>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                 height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-calendar">
                                                <rect x="3" y="4" width="18" height="18" rx="2"
                                                      ry="2"></rect>
                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                            </svg>
                                            <span
                                                class="table-inner-text">{{$data->created_at->format('Y-m-d')}}</span>
                                        </td>
                                        <td>{{$data->addedBy?->name}}</td>
                                        <td>
                                            @auth("web")
                                                <button type="button"
                                                        class="btn btn-light-danger text-danger"
                                                        onclick="deleteItem(this)"
                                                        data-item="{{route('student-classes.destroy', $data)}}">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            @endauth
                                            @if($current_year_class->certificate)
                                                <button type="button"
                                                        data-student_class_year-id="{{$data->id}}"
                                                        class="btn btn-light-warning text-warning  editStudentCertification">
                                                    <i class="fas fa-certificate"></i>
                                                </button>
                                                <a href="{{route('students.marks',$data->id)}}"
                                                   target="_blank"
                                                   class="btn btn-light-primary text-primary">
                                                    <i class="fas fa-certificate"></i>
                                                </a>

                                            @endif
                                            <a href="{{route('students.yearlyFile',$data->id)}}"
                                               target="_blank"
                                               class="btn btn-light-success text-success">
                                                <i class="fas fa-file-alt"></i>
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
@endpush



@push("html")
    @auth("web")
        <div class="modal fade" id="classStudentModal">
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                <form action="{{route('student-classes.store')}}" method="POST" id="addStudentsForm">
                    @csrf

                    <input type="hidden" name="school_class_id" value="{{$class->id}}">
                    <input type="hidden" name="year_class_id" value="{{$current_year_class->id}}">
                    <input type="hidden" name="academic_year_id" value="{{$activeAcademicYear->id}}">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">تسجل الطلاب في السنة الحالية</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>قائمة الطلاب .</p>


                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dataTableConfigNoData">
                                    <thead>
                                    <tr>
                                        <th class="checkbox-area" scope="col">
                                        </th>
                                        <th scope="col">الاسم</th>
                                        <th scope="col">رقم الهوية</th>
                                        <th scope="col">عنوان السكن</th>
                                        <th scope="col">تاريخ الميلاد</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>
                                                @if($student->approx_age >= $class->student_start_age && $student->approx_age <= $class->student_end_age)
                                                <div class="form-check form-check-primary">
                                                    <input class="form-check-input checkbox_child striped_child"
                                                           type="checkbox" name="students[]"
                                                           value="{{$student->id}}">
                                                </div>
                                                @endif
                                            </td>
                                            <td class="d-flex align-items-center">
                                                <img src=" {{$student->photo}}"
                                                     class="me-2 rounded-circle border border-primary object-fit"
                                                     width="35px" height="35px">
                                                <div>
                                                    {{$student->name}}

                                                    @if($student->approx_age > $class->student_end_age || $student->approx_age < $class->student_start_age)
                                                        <p class="text-danger mb-0 small">
                                                            عمر الطالب ({{$student->approx_age}}) غير مناسب للفصل. يجب أن يكون
                                                            بين {{ $class->student_start_age }}
                                                            و {{ $class->student_end_age }} سنوات.
                                                        </p>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{$student->identification}}</td>
                                            <td>{{$student->address}}</td>
                                            <td>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2"
                                                     stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-calendar">
                                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                                </svg>
                                                <span class="table-inner-text">{{$student->birth_date}}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
    @endauth

    @if($current_year_class->certificate)
        <div class="modal fade" id="studentCertificateModal" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-xl">
                <form action="{{route('student-marks.store')}}" method="POST">
                    @csrf

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">اضافة مجال جديد</h5>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">


                                <input type="hidden" name="student_class_year" id="student_class_year" value="">
                                <input type="hidden" name="year_class" value="{{$current_year_class->id}}">

                                <table class="table table-sm table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">المجال</th>
                                        <th scope="col">علامة الفصل الاول</th>
                                        <th scope="col">علامة الفصل الثاني</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($current_year_class->certificate?->fields as $field)
                                        <tr class="table-primary">
                                            <td><strong>{{ $field->field_name }}</strong></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @if(count($field->categories) > 0)
                                            @foreach($field->mainCategories as $category)
                                                <tr class="{{count($category->subcategories) > 0 ? 'table-warning' : ''}}">
                                                    <td>{{ $category->name }}</td>
                                                    <td>
                                                        <select class="form-select form-select-sm"
                                                                name="marks[first_semester][{{ $category->id }}]">
                                                            <option value="" selected>اختر العلامة</option>
                                                            <option value="Always">دائماً</option>
                                                            <option value="Sometimes">أحياناً</option>
                                                            <option value="Rarely">نادراً</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-select form-select-sm"
                                                                name="marks[second_semester][{{ $category->id }}]">
                                                            <option value="" selected>اختر العلامة</option>
                                                            <option value="Always">دائماً</option>
                                                            <option value="Sometimes">أحياناً</option>
                                                            <option value="Rarely">نادراً</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                @if($category->subcategories->isNotEmpty())
                                                    @foreach($category->subcategories as $subcategory)
                                                        <tr>
                                                            <td>{{ $subcategory->name }}</td>
                                                            <td>
                                                                <select class="form-select form-select-sm"
                                                                        name="marks[first_semester][{{ $subcategory->id }}]">
                                                                    <option value="" selected>اختر العلامة</option>
                                                                    <option value="Always">دائماً</option>
                                                                    <option value="Sometimes">أحياناً</option>
                                                                    <option value="Rarely">نادراً</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-select form-select-sm"
                                                                        name="marks[second_semester][{{ $subcategory->id }}]">
                                                                    <option value="" selected>اختر العلامة</option>
                                                                    <option value="Always">دائماً</option>
                                                                    <option value="Sometimes">أحياناً</option>
                                                                    <option value="Rarely">نادراً</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>


                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="first_notes" class="form-label">ملاحظات مربية الفصل الدراسي
                                            الاول</label>
                                        <textarea class="form-control" id="first_notes" name="first_notes"
                                                  rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="second_notes" class="form-label">ملاحظات مربية الفصل الدراسي
                                            الثاني</label>
                                        <textarea class="form-control" id="second_notes" name="second_notes"
                                                  rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-delete" data-bs-dismiss="modal">اغلاق</button>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
    <div class="modal fade" id="editStudentImage">
        <div class="modal-dialog" role="document">
            <form action="" id="editStudentImageForm"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="edit_image_student_id" value="">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تعديل الصورة الشخصية </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            X
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="text-center">
                            <p>الصورة الحالية</p>
                            <img src="" id="edit_image_student_image" width="200px" height="200px"
                                 class="mb-3 rounded-circle border border-primary object-fit">
                            <p class="fs-5" id="edit_image_student_name">N/A</p>
                        </div>
                        <hr>

                        <div class="mb-3">
                            <label for="personal_photo">الصورة </label>
                            <input type="file" id="personal_photo" name="personal_photo"
                                   class="form-control" accept="image/*" required>
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



@php(  $assistants_data = $current_year_class->assistants->implode('name', '- ') )

@push("scripts")
    <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.colVis.min.js"></script>

    <script>
        $("#addStudentsForm").on('submit', function (e) {
            var table = $('.dataTableConfigNoData').DataTable();

            var $form = $(this);
            console.log("true");
            table.$('input[type="checkbox"]').each(function () {
                if (!$.contains(document, this)) {
                    if (this.checked) {
                        $form.append(
                            $('<input>')
                                .attr('type', 'hidden')
                                .attr('name', this.name)
                                .val(this.value)
                        );
                    }
                }
            });
        });

        $('.edit-personal-image').on('click', function () {
            var studentId = $(this).data('id');
            var studentName = $(this).data('name');
            var studentImage = $(this).data('image');
            $('#edit_image_student_id').val(studentId);
            $('#edit_image_student_name').text(studentName);
            $('#edit_image_student_image').attr('src', studentImage);


            var url = '{{ route("students.image.update", ":studentId") }}';
            url = url.replace(':studentId', studentId);
            console.log(url)
            $('#editStudentImageForm').attr('action', url);
            $("#editStudentImage").modal('show');
        });

        $('.editStudentCertification').on('click', function () {
            var studentId = $(this).data('student_class_year-id');
            $('#student_class_year').val(studentId);

            var url = '{{ route("students.ajax.marks", ":studentId") }}';
            url = url.replace(':studentId', studentId);

            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'json',
                success: function (response) {
                    $('select[name="marks"]').val("");
                    $('#first_notes').val("");
                    $('#second_notes').val("");

                    if (response.marks && response.marks && response.marks.first) {
                        $.each(response.marks.first, function (key, value) {
                            $('select[name="marks[first_semester][' + key + ']"]').val(value.mark);
                        });
                    }

                    if (response.marks && response.marks && response.marks.second) {
                        $.each(response.marks.second, function (key, value) {
                            $('select[name="marks[second_semester][' + key + ']"]').val(value.mark);
                        });
                    }

                    if (response.studentCertificate) {
                        if (response.studentCertificate.first_notes) {
                            $('#first_notes').val(response.studentCertificate.first_notes);
                        }
                        if (response.studentCertificate.second_notes) {
                            $('#second_notes').val(response.studentCertificate.second_notes);
                        }


                    }
                    $("#studentCertificateModal").modal('show');
                },

            });
        });

        var studentsTable = $('.dataTableCustomTitleConfig').DataTable({
            order: [[1, 'asc']],
            dom: "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'B><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",

            language: {"url": "{{asset('assets/datatable_arabic.json')}}"},
            columnDefs: [
                {
                    targets: [4, 5, 6, 7, 8], // Indexes of columns to hide by default (0-based index)
                    visible: false
                }
            ],
            buttons: [
                {
                    extend: 'excel',
                    messageTop: function () {
                        return 'المعلمة : {{$current_year_class?->supervisorTeacher?->name}} : رقم الروضة : {{$current_year_class?->code}} المساعدات: {{$assistants_data ?? ''}}';
                    },
                    exportOptions: {
                        columns: function (idx, data, node) {
                            return studentsTable.column(idx).visible() && !$(node).hasClass('dontExport');
                        }
                    },
                },

                {
                    extend: 'print',
                    messageTop: function () {
                        return '<div style="text-align: center;">' +
                            'المعلمة : {{$current_year_class?->supervisorTeacher?->name}}<br>' +
                            'رقم الروضة : {{$current_year_class?->code}}<br>' +
                            'المساعدات: {{$assistants_data ?? ''}}' +
                            '</div>';
                    },
                    messageBottom: null,
                    exportOptions: {
                        columns: function (idx, data, node) {
                            return studentsTable.column(idx).visible() && !$(node).hasClass('dontExport');
                        }
                    },
                    customize: function (win) {
                        $(win.document.body).find('h1').css('text-align', 'center').css('font-size', '30px');
                    },

                },
                {
                    extend: 'colvis',
                    columns: ':not(.noVis)',

                }
            ],

            pageLength: 25
        });
    </script>
@endpush
