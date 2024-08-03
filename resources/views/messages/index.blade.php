@extends('layouts.app')

@section('content')
    <div class="statbox widget box box-shadow mb-4">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>ارسال رسالة</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">
            <form action="{{ route('messages.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label" for="message_to">ارسال رسالة الى :</label>
                            <select class="form-select" id="message_to" name="message_to" required>
                                <option value="all_students">جميع الطلاب</option>
                                <option value="all_teachers">جميع المعلمات و المساعدات</option>
                                <option value="specific_class">لفصل دراسي محدد</option>
                                <option value="specific_student"> طالب محدد</option>
                                <option value="specific_teacher"> معلم محدد</option>
                            </select>
                        </div>


                        <div class="mb-3 message_container d-none" id="specific_student">
                            <label class="form-label" for="student">الطالب</label>
                            <select class="form-select select2" id="student" name="student" required disabled>
                                <option disabled selected value=""> اختر ...</option>
                                @foreach($students as $student)
                                    <option value="{{$student->id}}">{{$student->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 message_container d-none" id="specific_teacher">
                            <label class="form-label" for="teacher">المعلم</label>
                            <select class="form-select select2" id="teacher" name="teacher" required disabled>
                                <option disabled selected value=""> اختر ...</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 message_container d-none" id="specific_class">
                            <label class="form-label" for="schoolclass">الفصل الدراسي</label>
                            <select class="form-select select2" id="schoolclass" name="schoolclass" required disabled>
                                <option disabled selected value=""> اختر ...</option>
                                @foreach($schoolClasses as $schoolClass)
                                    <option value="{{$schoolClass->id}}">{{$schoolClass->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label class="form-label" for="message">نص الرسالة</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" rows="5" id="message" name="message"
                                      required>{{old("message")}}</textarea>
                            @error('message')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary ml-3">ارسال</button>
            </form>
        </div>
    </div>
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4> سجل الرسائل</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area-normal">

            <div class="row">
                <div class="col-12">
                    <form method="get" class="d-flex">
                        <div class="mb-3 flex-grow-1 me-3">
                            <label for="date" class="form-label">تاريخ الارسال</label>
                            <input type="date" class="form-control" name="date" id="date"
                                   value="{{request("date",now()->format('Y-m-d'))}}">
                        </div>
                        <div class="mb-3 align-self-end">
                            <button type="submit" class="btn btn-primary btn-lg mb-1">
                                فلترة
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                            <tr>
                                <th scope="col"> رقم الهاتف</th>
                                <th scope="col">  الاسم</th>
                                <th scope="col"> تم الارسال بواسطة</th>
                                <th scope="col"> تاريخ الارسال</th>
                                <th scope="col"> نص الرسالة</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($messages as $message)
                                <tr>
                                    <td>{{$message->phone}}</td>
                                    <td>{{$message->name }}</td>
                                    <td>{{$message->addedBy?->name }}</td>
                                    <td>{{$message->created_at->format('Y-m-d')}}</td>
                                    <td>{{$message->message}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $('#message_to').on('change', function () {
            var selectedValue = $(this).val();
            $('.message_container').addClass('d-none').find('select').prop('disabled', true);
            $('#' + selectedValue).removeClass('d-none').find('select').prop('disabled', false);
        });
    </script>
@endpush
