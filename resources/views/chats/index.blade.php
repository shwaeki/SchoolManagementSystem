@extends('layouts.app')

@push('styles')
    <link href="{{ asset("assets/css/light/apps/chat.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/apps/chat.css")  }}" rel="stylesheet" type="text/css"/>
    <style>
        .chat-conversation-box {
            position: relative;
        }

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

                <div class="chat-system">
                    <div class="hamburger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-menu mail-menu d-lg-none">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </div>

                    <div class="user-list-box">
                        <div class="search">
                            <input type="text" class="form-control" placeholder="بحث في المحادثات ..."/>
                        </div>
                        <div class="people">

                            @foreach($chats as $chat)
                                <div class="person" data-chat="" data-student="{{$chat->student_id}}">
                                    <div class="user-info">
                                        <div class="f-head">
                                            <img src="{{$chat->student->photo}}" alt="avatar">
                                        </div>
                                        <div class="f-body">
                                            <div class="meta-info">
                                                    <span class="user-name" data-name="{{$chat->student->name}}">
                                                        {{$chat->student->name}}
                                                    </span>
                                                <span
                                                    class="user-meta-time">{{$chat->created_at?->diffForHumans()}}</span>
                                            </div>
                                            <span class="preview">{{$chat->message}}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="chat-box">

                        <div class="chat-not-selected">
                            <p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-message-square">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg>
                                اختر طالب لعرض المحادثة
                            </p>

                            <div class="row justify-content-center mt-3">
                                <div class="col-6 text-center">
                                    <button class="btn btn-primary btn-lg" data-bs-toggle="modal"
                                            data-bs-target="#newChatModal">
                                        بدء محادثة جديدة
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="chat-box-inner">
                            <div class="chat-meta-user">
                                <div class="current-chat-user-name">
                                    <span><img src="{{ asset("assets/img/90x90.jpg")  }}" alt="dynamic-image"><span
                                            class="name"></span></span>
                                </div>

                                <div class="chat-action-btn align-self-center">
                                    <div class="dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-2"
                                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="feather feather-more-vertical">
                                                <circle cx="12" cy="12" r="1"></circle>
                                                <circle cx="12" cy="5" r="1"></circle>
                                                <circle cx="12" cy="19" r="1"></circle>
                                            </svg>
                                        </a>

                                        <div class="dropdown-menu left" aria-labelledby="dropdownMenuLink-2">
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-copy">
                                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                                    <path
                                                        d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                                </svg>
                                                Copy</a>
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-trash-2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                                </svg>
                                                Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-conversation-box">
                                <div id="loading-indicator" style="display: none">
                                    <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>

                                <div id="chat-conversation-box-scroll" class="chat-conversation-box-scroll">

                                    <div class="chat" id="main-chat">
                                        {{--          <div class="conversation-start">
                                                      <span>Today, 6:48 AM</span>
                                                  </div>--}}
                                    </div>


                                </div>
                            </div>
                            <div class="chat-footer">
                                <div class="chat-input">
                                    <form class="chat-form" action="javascript:void(0);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-message-square">
                                            <path
                                                d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                        <input type="text" class="mail-write-box form-control" data-student=""
                                               placeholder="الرسالة"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                        <select class="form-select"
                                id="student" name="student" required>
                            <option selected disabled value="">اختر ...</option>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    <button type="button" class="btn btn-primary">بدء</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset("assets/js/apps/chat.js")  }}"></script>
    <script>
        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('.user').click(function () {
                $('.user').removeClass('active');
                $(this).addClass('active');
                $(this).find('.pending').remove();
                receiver_id = $(this).attr('id');

            });

            function getMessages(Salon) {
                var salonli = $('li[data-salon="salon' + Salon + '"]');
                salonli.addClass('active');
                salonli.find('.pending').remove();
                receiver_id = salonli.attr('id');
                $.ajax({
                    type: "get",
                    url: "message/" + receiver_id, // need to create this route
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#messages').html(data);
                        scrollToBottomFunc();
                    },

                });
            }

            @if(request()->has('salon'))
            getMessages({{request()->get('salon')}});
            @endif

            $(document).on('keyup', 'input[name="sendMassage"]', function (e) {
                var message = $(this).val();
                if (e.keyCode == 13 && message != '' && receiver_id != '') {
                    sendMassage(message);
                    $(this).val('');
                }
            });


            function sendMassage(message) {
                $(this).val(''); // while pressed enter text box will be empty
                var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                $.ajax({
                    type: "post",
                    url: "message", // need to create this post route
                    data: datastr,
                    cache: false,
                    success: function (data) {
                    },
                    error: function (jqXHR, status, err) {
                    },
                    complete: function () {
                        scrollToBottomFunc();
                    }
                })
            }
        });


        // make a function to scroll down auto
        function scrollToBottomFunc() {
            $('.message-wrapper').animate({
                scrollTop: $('.message-wrapper').get(0).scrollHeight
            }, 50);
        }
    </script>
@endpush
