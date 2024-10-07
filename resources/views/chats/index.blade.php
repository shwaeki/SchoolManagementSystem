@extends('layouts.app')

@push('styles')
    <link href="{{ asset("assets/css/light/apps/chat.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/apps/chat.css")  }}" rel="stylesheet" type="text/css"/>
    <style>
        #loading-indicator {
            position: absolute;
            top: 0;
            left: 0;
            background-color: #ffffff96;
            padding: 10px;
            height: 100%;
            width: 100%;
            display: flex;
            z-index: 9999;
            justify-content: center;
            align-items: center;
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

    <script>
        document.addEventListener('livewire:init', function () {
            scrollChatToBottom();
        });

        document.addEventListener('livewire:update', function () {
            scrollChatToBottom();
        });

        function scrollChatToBottom() {
            var chatBox = document.getElementById('chat-conversation-box-scroll');
            if (chatBox) {
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        }


        $('#chat-form').on('submit', function (event) {
            event.preventDefault();
            console.log("test");
            $('#message-input').val('');
        });
    </script>


    <script src="{{ asset("assets/js/apps/chat.js")  }}"></script>
    <script>


        $("#startChat").click(function () {
            var student_id = $('#student').val()

            if (!student_id) {
                swal.fire({
                    icon: 'error',
                    title: 'خطأ',
                    text: 'الرجاء تحديد الطالب',
                })
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

        function scrollToBottom() {
            var getScrollContainer = $('.chat-conversation-box');
            if(getScrollContainer.length > 0){
                getScrollContainer.scrollTop(getScrollContainer.get(0).scrollHeight);
            }
        }


        document.addEventListener('livewire:init', () => {

            Livewire.on('chat-new-message', message => {
                let bubbleClass = message.sender === 'student' ? 'bubble you' : 'bubble me';
                let dateAlignmentClass = message.sender === 'student' ? 'text-start' : 'text-end';

                $('#main-chat').append(`
            <div class="d-flex flex-column">
                <div class="${bubbleClass} mb-0">${message.message}</div>
                <p class="mt-1 ms-2 small ${dateAlignmentClass}">${message.created_at_human}</p>
            </div>`);
                scrollToBottom();
            });

            Livewire.on('chat-select-student', () => {
                $("#loading-indicator").hide();
                scrollToBottom();
            });

            Livewire.on('chat-select-class', () => {
                $("#loading-indicator").hide();
                scrollToBottom();
            });

        });


    </script>
@endpush
