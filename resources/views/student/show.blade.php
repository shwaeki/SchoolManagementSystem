@extends('layouts.app')

@push('styles')
    <link href="{{ asset("assets/css/light/users/account-setting.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/users/account-setting.css")  }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset("assets/css/light/components/tabs.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/components/tabs.css")  }}" rel="stylesheet" type="text/css"/>

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

    <div class="account-settings-container layout-top-spacing">

        <div class="account-content">
            <div class="row mb-3">
                <div class="col-md-12">
                    <h2> معلومات الطالب - {{$student->name}}</h2>


                    @if($current_student_class == null)
                        <div class="alert alert-dismissible alert-icon-left alert-light-warning fade mb-4 show"
                             role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" data-bs-dismiss="alert" width="24"
                                     height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-x close">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-alert-triangle">
                                <path
                                    d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                                <line x1="12" y1="9" x2="12" y2="13"></line>
                                <line x1="12" y1="17" x2="12" y2="17"></line>
                            </svg>
                            الطالب غير مسجل لهذه السنة {{$adminActiveAcademicYear->name}} .

                        </div>
                    @endif


                    <ul class="nav nav-pills" id="animateLine" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="student-info-tab" data-bs-toggle="tab"
                                    href="#student-info" role="tab" aria-controls="student-info" aria-selected="true">
                                <i class="fas fa-info-circle"></i>
                                البيانات الشخصية
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="student-files-tab" data-bs-toggle="tab" href="#student-files"
                                    role="tab" aria-controls="student-files" aria-selected="false" tabindex="-1">
                                <i class="fas fa-folder-open"></i>
                                ملفات الطالب
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="student-classes-tab" data-bs-toggle="tab"
                                    href="#student-classes" role="tab" aria-controls="student-classes"
                                    aria-selected="false" tabindex="-1">
                                <i class="fas fa-graduation-cap"></i>
                                السنوات الدراسية
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="student-log-tab" data-bs-toggle="tab" href="#student-log"
                                    role="tab" aria-controls="student-log" aria-selected="false" tabindex="-1">
                                <i class="fas fa-history"></i>
                                سجل الطالب
                            </button>
                        </li>


                    </ul>
                </div>
            </div>

            <div class="tab-content" id="animateLineContent-4">
                <div class="tab-pane fade show active" id="student-info" role="tabpanel"
                     aria-labelledby="student-info-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <div class="section general-info">
                                <div class="info">
                                    <div class="row">
                                        <div class="col-9">
                                            <h6> البيانات الشخصية </h6>
                                        </div>
                                        <div class="col-3 text-end">
                                            <a href="{{route('students.edit',['student'=>$student])}}"
                                               class="btn btn-primary"> تعديل </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">الاسم</label>
                                                <input type="text" id="name" class="form-control"
                                                       value="{{$student->name}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="mb-3">
                                                <label for="identification" class="form-label">رقم الهوية</label>
                                                <input type="text" id="identification" class="form-control"
                                                       value="{{$student->identification}}" disabled>

                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="mb-3">
                                                <label for="birth_date" class="form-label">تاريخ الميلاد </label>
                                                <input type="text" id="birth_date" class="form-control"
                                                       value="{{$student->birth_date}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="mb-3">
                                                <label for="birth_place" class="form-label">مكان الولادة </label>
                                                <input type="text" id="birth_place" class="form-control"
                                                       value="{{$student->birth_place}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="mb-3">
                                                <label for="address" class="form-label"> العنوان </label>
                                                <input type="text" id="address" class="form-control"
                                                       value="{{$student->address}}" disabled>
                                            </div>
                                        </div>


                                        <div class="col-12 col-md-3">
                                            <div class="mb-3">
                                                <label for="address_street" class="form-label"> الشارع </label>
                                                <input type="text" id="address" class="form-control"
                                                       value="{{$student->address_street}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="mb-3">
                                                <label for="address_house_no" class="form-label"> رقم البيت </label>
                                                <input type="text" id="address" class="form-control"
                                                       value="{{$student->address_house_no}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <div class="mb-3">
                                                <label for="zipcode" class="form-label"> الرمز البريدي (Zip)  </label>
                                                <input type="text" id="zipcode" class="form-control"
                                                       value="{{$student->zipcode}}" disabled>
                                            </div>
                                        </div>


                                        <div class="col-6 col-md-3">
                                            <div class="mb-3">
                                                <label for="gender" class="form-label"> الجنس </label>
                                                <input type="text" id="gender" class="form-control"
                                                       value="{{trans('options.'.$student->gender)  }}" disabled>
                                            </div>
                                        </div>


                                        <div class="col-12 col-md-3">
                                            <div class="mb-3">
                                                <label for="postal_code" class="form-label">رقم صندوق البريد </label>
                                                <input type="text" id="postal_code" class="form-control"
                                                       value="{{$student->postal_code}}" disabled>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="notes" class="form-label"> ملاحظات اضافية </label>
                                                <textarea id="notes" class="form-control" rows="3"
                                                          disabled>{{ $student->notes }}</textarea>
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
                                            <h6> معلومات العائلة</h6>
                                        </div>
                                    </div>

                                    <div class="row">


                                        <div class="col-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="mother_name" class="form-label"> اسم الام </label>
                                                <input type="text" id="mother_name" class="form-control"
                                                       value="{{$student->mother_name}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="mother_phone" class="form-label"> رقم هاتف الام </label>
                                                <input type="text" id="mother_phone" class="form-control"
                                                       value="{{$student->mother_phone}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="mother_id" class="form-label"> رقم هوية الام </label>
                                                <input type="text" id="mother_id" class="form-control"
                                                       value="{{$student->mother_id}}" disabled>
                                            </div>
                                        </div>


                                        <div class="col-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="father_name" class="form-label"> اسم الاب </label>
                                                <input type="text" id="father_name" class="form-control"
                                                       value="{{$student->father_name}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="father_phone" class="form-label"> رقم هاتف الاب </label>
                                                <input type="text" id="father_phone" class="form-control"
                                                       value="{{$student->father_phone}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="father_id" class="form-label"> رقم هوية الاب </label>
                                                <input type="text" id="father_id" class="form-control"
                                                       value="{{$student->father_id}}" disabled>
                                            </div>
                                        </div>


                                        <div class="col-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="family_status" class="form-label"> الحالة الاجتماعية
                                                    للعائلة </label>
                                                <input type="text" id="family_status" class="form-control"
                                                       value="{{trans('options.'.$student->family_status)}}" disabled>
                                            </div>
                                        </div>


                                        <div class="col-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="custody" class="form-label"> حضانة الطالب </label>
                                                <input type="text" id="gender" class="form-control"
                                                       value="{{trans('options.'.$student->custody)}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-4">
                                            <div class="mb-3">
                                                <label for="family_members" class="form-label"> عدد افراد
                                                    العائلة </label>
                                                <input type="text" id="family_members" class="form-control"
                                                       value="{{$student->family_members}}" disabled>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>

                        @if($current_student_class != null)
                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <div class="section general-info">
                                    <div class="info">
                                        <div class="row">
                                            <div class="col-9">
                                                <h6> بيانات الفصل الدراسي لسنة
                                                    - {{$current_student_class->yearClass->academicYear->name}} </h6>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-3">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">الفصل الدراسي </label>
                                                    <input type="text" id="name" class="form-control"
                                                           value="{{$current_student_class->yearClass->schoolClass->name}}"
                                                           disabled>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">السنة الدراسية</label>
                                                    <input type="text" id="name" class="form-control"
                                                           value="{{$current_student_class->yearClass->academicYear->name}}"
                                                           disabled>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">المدرس المشرف</label>
                                                    <input type="text" id="name" class="form-control"
                                                           value="{{$current_student_class->teacher->name}}"
                                                           disabled>
                                                </div>
                                            </div>


                                            <div class="col-12 col-md-3">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">اضيف بواسطة</label>
                                                    <input type="text" id="name" class="form-control"
                                                           value="{{$current_student_class->addedBy->name}}" disabled>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="tab-pane fade " id="student-files" role="tabpanel" aria-labelledby="student-files-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section general-info">
                                <div class="info">
                                    <h6> ملفات خاصبة بالطالب </h6>
                                    <div class="row">
                                        <div class="col-12">
                                            <iframe src="/filemanager"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="tab-pane fade " id="student-classes" role="tabpanel" aria-labelledby="student-classes-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section general-info">
                                <div class="info">
                                    <h6> السنوات الدراسية </h6>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الفصل</th>
                                                <th scope="col">السنة الدراسية</th>
                                                <th scope="col">المدرس</th>
                                                <th scope="col">اضيف بواسطة</th>
                                                <th scope="col">تاريخ الاضافة</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($i = 0)
                                            @foreach($student_classes as $class)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{$class->yearClass->schoolClass->name}}</td>
                                                    <td>{{$class->yearClass->academicYear->name}}</td>
                                                    <td>{{$class->teacher->name}}</td>
                                                    <td>{{$class->addedBy->name}}</td>
                                                    <td>{{$class->created_at->format('d/m/Y')}}</td>
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
                <div class="tab-pane fade " id="student-log" role="tabpanel" aria-labelledby="student-log-tab">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form class="section general-info">
                                <div class="info">
                                    <h6> سجل الطالب </h6>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الحقل</th>
                                                <th scope="col">القيمة القديمة</th>
                                                <th scope="col">القيمة الجديدة</th>
                                                <th scope="col">المستخدم</th>
                                                <th scope="col">تاريخ التعديل</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($i = 0)
                                            @foreach($student_logs as $logs)
                                                @if($logs->event == 'updated')
                                                    @foreach($logs->properties['attributes'] as $key=>$log)
                                                        @php($i++)
                                                        <tr>
                                                            <td>{{ $i }}</td>
                                                            <td>{{ trans('validation.attributes.'.$key) }}</td>

                                                            @if (trans()->has('options.'.$logs->properties['old'][$key]))
                                                                <td>{{ trans('options.'.$logs->properties['old'][$key])  }}</td>
                                                            @else
                                                                <td>{{ $logs->properties['old'][$key]  }}</td>
                                                            @endif

                                                            @if (trans()->has('options.'.$log))
                                                                <td>{{ trans('options.'.$log)  }}</td>
                                                            @else
                                                                <td>{{ $log  }}</td>
                                                            @endif

                                                            <td>{{$logs->causer->name}}</td>
                                                            <td>{{$logs->created_at->format('d/m/Y')}}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
