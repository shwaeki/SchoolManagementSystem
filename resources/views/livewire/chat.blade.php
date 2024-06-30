<div>
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

            <div class="mx-3">
                <button class="btn btn-primary w-100" data-bs-toggle="modal"
                        data-bs-target="#newChatModal">
                    بدء محادثة جديدة
                </button>
            </div>
            <hr>
            <div class="people">
                @if($newChat && $selectedStudent)
                    <div class="person bg-light-primary">
                        <div class="user-info">
                            <div class="f-head">
                                <img src="{{$selectedStudent?->photo}}" alt="avatar">
                            </div>
                            <div class="f-body">
                                <div class="meta-info">
                                    <span class="user-name">{{$selectedStudent?->name}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @foreach($chats as $chat)
                    <div class="person selectStudent {{ $chat->student_id == $selectedStudent?->id ? 'bg-light-primary' : '' }}"
                         wire:click="selectStudent({{$chat->student_id}})">
                        <div class="user-info">
                            <div class="f-head">
                                <img src="{{$chat->student->photo}}" alt="avatar">
                            </div>
                            <div class="f-body">
                                <div class="meta-info">
                                <span class="user-name">
                                    {{$chat->student->name}}
                                </span>
                                    <span class="user-meta-time">
                                    {{$chat->created_at?->diffForHumans()}}
                                </span>
                                </div>
                                <span class="preview">{{$chat->message}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

        <div class="chat-box" wire:poll.5s="refreshChats" >

            @if(empty($selectedStudent))
                <div class="chat-not-selected">
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round" class="feather feather-message-square">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                        اختر طالب لعرض المحادثة
                    </p>
                </div>

            @else
                <div class="chat-box-inner h-100" >
                    <div class="chat-meta-user chat-active">
                        <div class="current-chat-user-name">
                        <span>
                            <img src="{{$selectedStudent->photo}}" alt="dynamic-image">
                            <span class="name">{{$selectedStudent->name}}</span>
                        </span>
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
                            <div class="chat active-chat" id="main-chat">
                                @foreach($selectedStudent?->chats as $message)
                                    <div class="d-flex flex-column">
                                        <div
                                            class="{{ $message->sender == "student" ? 'bubble you' : 'bubble me' }} mb-0">
                                            {{$message->message}}
                                        </div>
                                        <p class="mt-1 ms-2 small {{ $message->sender == "student" ? 'text-start' : 'text-end' }}">
                                            {{$message->created_at_human}}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="chat-footer chat-active"  >
                        <div class="chat-input">
                            <form class="chat-form" wire:submit.prevent="sendMessage">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-message-square">
                                    <path
                                        d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg>
                                <input type="text" class="mail-write-box form-control"
                                       wire:model.defer="message"
                                       data-student="" placeholder="الرسالة"/>
                            </form>
                        </div>
                    </div>
                </div>
            @endif


        </div>
    </div>
</div>
