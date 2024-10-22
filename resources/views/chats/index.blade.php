@extends('layouts.app')

@push('styles')
    <link href="{{ asset("assets/css/light/apps/chat.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/apps/chat.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

    <style>
        #loading-indicator {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #ffffff;
            padding: 10px;
            height: 100%;
            width: 100%;
            display: flex;
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .file-upload-input {
            display: none;
        }

        .file-upload-label {
            cursor: pointer;
            font-size: 1.2rem;
            color: #4361ee;
        }
    </style>
@endpush

@section('content')
    <div class="chat-section layout-top-spacing">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                @livewire('chat')
            </div>
        </div>
    </div>

    <div class="modal fade" id="newChatModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">بدء محادثة جديدة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="student" class="form-label"> الطالب </label>
                        <select class="form-select select2" data-placeholder="اختر ..."
                                id="student" name="student" required>
                            <option></option>
                            @foreach($students as $student)
                                <option
                                    {{old('student') == $student->name ? 'selected' : '' }} value="{{$student->id}}">
                                    {{$student->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">اغلاق</button>
                    <button type="button" class="btn btn-primary" id="startChat">بدء</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script src="{{ asset("assets/js/apps/chat.js") }}"></script>

    <script>


        $("#startChat").click(function () {
            var student_id = $('#student').val();

            if (!student_id) {
                swal.fire({
                    icon: 'error',
                    title: 'خطأ',
                    text: 'الرجاء تحديد الطالب',
                });
                return;
            }

            Livewire.dispatch('start-chat', {student_id: student_id});
            $("#newChatModal").modal("hide");
        });

        $(document).on('click', '.selectStudent', function (event) {
            $('#loading-indicator').show();
            $('#main-chat').empty();
        });

        $(document).on('click', '.selectClass', function (event) {
            $('#loading-indicator').show();
            $('#main-chat').empty();
        });


    </script>
@endpush
