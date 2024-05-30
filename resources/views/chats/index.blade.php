@extends('layouts.app')

@push('styles')
    <link href="{{ asset("assets/css/light/apps/chat.css")  }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/css/dark/apps/chat.css")  }}" rel="stylesheet" type="text/css"/>

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
                                <div class="person" data-chat="person1">
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
                                    <button class="btn btn-primary btn-lg"> بدأ محادثة جديدة</button>
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
                                <div id="chat-conversation-box-scroll" class="chat-conversation-box-scroll">
                                    <div class="chat" data-chat="person1">
                                        <div class="conversation-start">
                                            <span>Today, 6:48 AM</span>
                                        </div>
                                        <div class="bubble you">
                                            Hello,
                                        </div>
                                        <div class="bubble you">
                                            It's me.
                                        </div>
                                        <div class="bubble you">
                                            I have a question regarding project.
                                        </div>
                                    </div>
                                    <div class="chat" data-chat="person2">
                                        <div class="conversation-start">
                                            <span>Today, 5:38 PM</span>
                                        </div>
                                        <div class="bubble you">
                                            Hello!
                                        </div>
                                        <div class="bubble me">
                                            Hey!
                                        </div>
                                        <div class="bubble me">
                                            How was your day so far.
                                        </div>
                                        <div class="bubble you">
                                            It was a bit dramatic.
                                        </div>
                                    </div>
                                    <div class="chat" data-chat="person3">
                                        <div class="conversation-start">
                                            <span>Today, 3:38 AM</span>
                                        </div>
                                        <div class="bubble me">
                                            Hey Buddy.
                                        </div>
                                        <div class="bubble me">
                                            What's up
                                        </div>
                                        <div class="bubble you">
                                            I am sick
                                        </div>
                                        <div class="bubble you">
                                            Not comming to office today.
                                        </div>
                                    </div>
                                    <div class="chat" data-chat="person4">
                                        <div class="conversation-start">
                                            <span>Yesterday, 4:20 PM</span>
                                        </div>
                                        <div class="bubble you">
                                            Hi, collect your check
                                        </div>
                                        <div class="bubble me">
                                            Ok, I will be there in 10 mins
                                        </div>
                                    </div>
                                    <div class="chat" data-chat="person5">
                                        <div class="conversation-start">
                                            <span>Today, 6:28 AM</span>
                                        </div>
                                        <div class="bubble you">
                                            Hi
                                        </div>
                                        <div class="bubble you">
                                            Uploaded files to server.
                                        </div>
                                    </div>
                                    <div class="chat" data-chat="person6">
                                        <div class="conversation-start">
                                            <span>Monday, 1:27 PM</span>
                                        </div>
                                        <div class="bubble you">
                                            Hi, I am back from vacation
                                        </div>
                                        <div class="bubble you">
                                            How are you?
                                        </div>
                                        <div class="bubble me">
                                            Welcom Back
                                        </div>
                                        <div class="bubble me">
                                            I am all well
                                        </div>
                                        <div class="bubble you">
                                            Coffee?
                                        </div>
                                    </div>
                                    <div class="chat" data-chat="person7">
                                    </div>
                                    <div class="chat" data-chat="person8">
                                    </div>
                                    <div class="chat" data-chat="person9">
                                    </div>
                                    <div class="chat" data-chat="person10">
                                    </div>
                                    <div class="chat" data-chat="person11">
                                    </div>
                                    <div class="chat" data-chat="person12">
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
                                        <input type="text" class="mail-write-box form-control" placeholder="الرسالة"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset("assets/js/apps/chat.js")  }}"></script>
    <script>

    </script>
@endpush
