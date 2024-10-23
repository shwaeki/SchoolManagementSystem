@push("tab_button")
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="class-info-tab" data-bs-toggle="tab"
                href="#class-info" role="tab" aria-controls="class-info" aria-selected="true">
            <i class="fas fa-info-circle"></i>
            بيانات الفصل الدراسي
        </button>
    </li>
@endpush

@push("tab_content")
    <div class="tab-pane fade show active" id="class-info" role="tabpanel"
         aria-labelledby="class-info-tab">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                <div class="section general-info">
                    <div class="info">
                        <div class="row">
                            <div class="col-9">
                                <h6> بيانات الفصل الدراسي </h6>
                            </div>
                            @can('update-school-class')
                                @auth("web")
                                    <div class="col-3 text-end">
                                        <a href="{{route('school-classes.edit',$class)}}"
                                           class="btn btn-primary"> تعديل </a>
                                    </div>
                                @endauth
                            @endcan
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">الاسم</label>
                                    <input type="text" id="name" class="form-control"
                                           value="{{$class->name}}" disabled>
                                </div>
                            </div>

                            {{--                                        <div class="col-12 col-md-3">
                                                                        <div class="mb-3">
                                                                            <label for="code" class="form-label"> الكود</label>
                                                                            <input type="text" id="code" class="form-control"
                                                                                   value="{{$class->code}}" disabled>
                                                                        </div>
                                                                    </div>--}}

                            <div class="col-12 col-md-3">
                                <div class="mb-3">
                                    <label for="alphabetical_name" class="form-label"> الكود الابجدي</label>
                                    <input type="text" id="alphabetical_name" class="form-control"
                                           value="{{$class->alphabetical_name}}" disabled>
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="mb-3">
                                    <label for="address" class="form-label">العنوان </label>
                                    <input type="text" id="address" class="form-control"
                                           value="{{$class->address}}" disabled>
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="mb-3">
                                    <label for="phone" class="form-label"> رقم الهاتف </label>
                                    <input type="text" id="code" class="form-control"
                                           value="{{$class->phone}}" disabled>
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="mb-3">
                                    <label for="capacity" class="form-label"> الطاقة الاستيعابة </label>
                                    <input type="text" id="capacity" class="form-control"
                                           value="{{$class->capacity}}" disabled>
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="mb-3">
                                    <label for="student_start_age" class="form-label"> الحد الادنى لعمر
                                        الطلاب </label>
                                    <input type="text" id="student_start_age" class="form-control"
                                           value="{{$class->student_start_age}}" disabled>
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="mb-3">
                                    <label for="student_end_age" class="form-label"> الحد الاعلى لعمر
                                        الطلاب </label>
                                    <input type="text" id="student_end_age" class="form-control"
                                           value="{{$class->student_end_age}}" disabled>
                                </div>
                            </div>


                        </div>


                    </div>
                </div>
            </div>
            @if($current_year_class != null)
                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                    <div class="section general-info">
                        <div class="info">
                            <div class="row">
                                <div class="col-9">
                                    <h6> بيانات الفصل الدراسي لسنة
                                        - {{$current_year_class->academicYear->name}} </h6>
                                </div>
                                @can('update-school-class')
                                    @auth("web")
                                        <div class="col-3 text-end">
                                            <a href="#editCertificateModal" data-bs-toggle="modal"
                                               class="btn btn-primary">تعديل </a>.
                                        </div>
                                    @endauth
                                @endcan
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">السنة الدراسية</label>
                                        <input type="text" id="name" class="form-control"
                                               value="{{$current_year_class->academicYear->name}}" disabled>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">المدرس المشرف</label>
                                        <input type="text" id="name" class="form-control"
                                               value="{{$current_year_class->supervisorTeacher->name}}"
                                               disabled>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">عدد الطلاب</label>
                                        <input type="text" id="name" class="form-control"
                                               value="{{count($current_year_class->students)}}" disabled>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">اضيف بواسطة</label>
                                        <input type="text" id="name" class="form-control"
                                               value="{{$current_year_class->addedBy->name}}" disabled>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">نوع الشهادة</label>
                                        <input type="text" id="name" class="form-control"
                                               value="{{$current_year_class->certificate?->name}}" disabled>
                                    </div>
                                </div>

                                <div class="col-12 col-md-4">
                                    <div class="mb-3">
                                        <label for="code" class="form-label">الكود </label>
                                        <input type="text" id="code" class="form-control"
                                               value="{{$current_year_class->code}}" disabled>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                    <div class="section general-info">
                        <div class="info">
                            <div class="row">
                                <div class="col-9">
                                    <h6>قائمة المساعدات </h6>
                                </div>
                                @can('update-school-class')
                                    @auth("web")
                                        <div class="col-3 text-end">
                                            <a href="#addAssistantModal" data-bs-toggle="modal"
                                               class="btn btn-primary">اضافة </a>.
                                        </div>
                                    @endauth
                                @endcan
                            </div>

                            <div class="row">

                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th scope="col"> اسم المساعدة</th>
                                            <th scope="col"> رقم الهاتف</th>
                                            @auth("web")
                                                <th scope="col"> خيارات</th>
                                            @endauth
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($current_year_class->assistants as $assistant)
                                            <tr>
                                                <td>{{$assistant->name}}</td>
                                                <td>{{$assistant->phone}}</td>
                                                @auth("web")
                                                    @can('update-school-class')
                                                        <td>
                                                            <button type="button"
                                                                    class="btn btn-light-danger text-danger"
                                                                    onclick="deleteItem(this)"
                                                                    data-item="{{route('year-classes.destroyAssistant',[$current_year_class,$assistant])}}">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                        </td>
                                                    @endcan
                                                @endauth
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endpush

@push("html")
    @auth("web")
        @if($current_year_class != null)
            @can('update-school-class')
                <div class="modal fade" id="editCertificateModal">
                    <div class="modal-dialog" role="document">
                        <form action="{{route('year-classes.update',$current_year_class)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">تعديل بيانات الفصل الدراسي السنوية </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        X
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">الفصل الدراسي</label>
                                        <input type="text" id="name" class="form-control"
                                               value="{{$class->name}}" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label for="supervisor" class="form-label"> المعلم المشرف </label>
                                        <select class="form-select"
                                                id="supervisor" name="supervisor" required>
                                            <option selected disabled value="">اختر ...</option>
                                            @foreach($teachers as $teacher)
                                                <option
                                                    {{old('supervisor', $current_year_class->supervisor) == $teacher->id ? 'selected' : '' }}
                                                    value="{{$teacher->id}}">
                                                    {{$teacher->name}}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="mb-3">
                                        <label for="certificate_id" class="form-label"> الشهادة </label>
                                        <select class="form-select"
                                                id="certificate_id" name="certificate_id">
                                            <option selected disabled value="">اختر ...</option>
                                            @foreach($certificates as $certificate)
                                                <option
                                                    {{old('certificate_id', $current_year_class->certificate_id) == $certificate->id ? 'selected' : '' }} value="{{$certificate->id}}">
                                                    {{$certificate->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="code" class="form-label"> الكود </label>
                                        <input type="text" id="code" name="code" class="form-control"
                                               value="{{$current_year_class->code}}">
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="chat_active"
                                                   name="chat_active" {{old('chat_active', $current_year_class->chat_active) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="chat_active">
                                                تفعيل الشات
                                            </label>
                                        </div>
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

                <div class="modal fade" id="addAssistantModal">
                    <div class="modal-dialog" role="document">
                        <form action="{{route('year-classes.storeAssistant',$current_year_class)}}" method="POST">
                            @csrf

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">اضافة مساعدة جديدة</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label for="assistant_id" class="form-label"> المساعدة </label>
                                        <select class="form-select"
                                                id="assistant_id" name="assistant_id" required>
                                            <option selected disabled value="">اختر ...</option>
                                            @foreach($assistants as $assistant)
                                                <option
                                                    {{old('assistant_id') == $assistant->name ? 'selected' : '' }} value="{{$assistant->id}}">
                                                    {{$assistant->name}}
                                                </option>
                                            @endforeach
                                        </select>
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
            @endcan
        @endif
    @endauth
@endpush


@push("scripts")

@endpush
