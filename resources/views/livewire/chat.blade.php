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

            <div class="simple-tab h-100">
                <ul class="nav nav-tabs" wire:ignore>
                    <li class="nav-item flex-grow-1 d-flex" role="presentation">
                        <button class="nav-link flex-grow-1 py-3 rounded-0 active" data-bs-toggle="tab"
                                data-bs-target="#students-tab-pane">
                            المحادثات
                        </button>
                    </li>
                    <li class="nav-item flex-grow-1 d-flex" role="presentation">
                        <button class="nav-link flex-grow-1 py-3 rounded-0" data-bs-toggle="tab"
                                data-bs-target="#group-tab-pane">
                            المجموعات
                        </button>
                    </li>
                </ul>

                <div class="tab-content h-100" id="myTabContent">
                    <div class="tab-pane fade h-100 show active" id="students-tab-pane" wire:ignore.self>
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
                                @if($chat->student->archived == false)
                                    <div
                                        class="person selectStudent {{ $chat->student_id == $selectedStudent?->id ? 'bg-light-primary' : '' }}"
                                        wire:click="selectStudent({{$chat->student_id}})">
                                        <div class="user-info">
                                            <div class="f-head">
                                                <img src="{{$chat->student->photo}}" alt="avatar">
                                            </div>
                                            <div class="f-body">
                                                <div class="meta-info">
                                                    <span class="user-name">{{$chat->student->name}}</span>
                                                    <span
                                                        class="user-meta-time">{{$chat->created_at?->diffForHumans()}}</span>
                                                </div>
                                                <span class="preview">
                                                    {{ Str::limit(str_replace(["\r", "\n"], '', $chat->message), 40) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade h-100" id="group-tab-pane" wire:ignore.self>
                        <div class="people classes">
                            @foreach($year_classes as $class)
                                <div
                                    class="person selectClass {{ $class->id == $selectedClass?->id ? 'bg-light-primary' : '' }}"
                                    wire:click="selectClass({{$class->id}})">
                                    <div class="user-info">
                                        <div class="f-body">
                                            <div class="meta-info">
                                                <span class="user-name">{{$class->schoolClass?->name}}</span>
                                                <span
                                                    class="user-meta-time">{{$class->chats()?->latest()->first()?->created_at?->diffForHumans()}}</span>
                                            </div>
                                            <span class="preview">
                                                {{ Str::limit(str_replace(["\r", "\n"], '', $class->chats()?->latest()->first()?->message), 40) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="chat-box" wire:poll.5s="refreshChats">
            @if($chatType == 'student')
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
                    <div class="chat-box-inner h-100">
                        <div class="chat-meta-user chat-active">
                            <div class="current-chat-user-name">
                                <span>
                                    <img src="{{$selectedStudent->photo}}" alt="dynamic-image">
                                    <span class="name">{{$selectedStudent->name}}</span>
                                </span>
                            </div>
                        </div>
                        <div class="chat-conversation-box" id="chat-conversation-box">
                            <div id="loading-indicator" style="display: none" wire:ignore.self>
                                <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                            <div id="chat-conversation-box-scroll" class="chat-conversation-box-scroll">
                                <div class="chat active-chat" id="main-chat">
                                    @if(count($messages) >= $messageLimit)
                                        <div class="text-center mb-3">
                                            <button class="btn btn-link" wire:click="loadMore">عرض المزيد</button>
                                        </div>
                                    @endif

                                    @foreach($messages as $message)
                                        <div class="d-flex flex-column">
                                            <div
                                                class="{{ $message->sender == "student" ? 'bubble you' : 'bubble me' }} mb-0">
                                                {{$message->message}}

                                                @if($message->file_path)
                                                    @if(strpos($message->file_type, 'image') !== false)
                                                        <!-- Image: Display in Lightbox -->
                                                        <div>
                                                            <a href="{{ asset(Storage::url($message->file_path)) }}"
                                                               data-lightbox="chat-images">
                                                                <img
                                                                    src="{{ asset(Storage::url($message->file_path)) }}"
                                                                    alt="Image" style="max-width: 200px;">
                                                            </a>
                                                        </div>

                                                    @elseif(strpos($message->file_type, 'video') !== false)
                                                        <!-- Video: Display in Video Player -->
                                                        <div>
                                                            <video controls style="max-width: 300px;">
                                                                <source
                                                                    src="{{ asset(Storage::url($message->file_path)) }}"
                                                                    type="{{ $message->file_type }}">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </div>

                                                    @elseif(strpos($message->file_type, 'pdf') !== false)
                                                        <div>
                                                            <a href="{{ Storage::url($message->file_path) }}"
                                                               class="text-white" download>
                                                                <i class="fas fa-file-pdf"></i> {{ $message->original_file_name ?? 'Show File' }}
                                                            </a>
                                                        </div>
                                                    @elseif(strpos($message->file_type, 'word') !== false || strpos($message->file_type, 'document') !== false)
                                                        <div>
                                                            <a href="{{ Storage::url($message->file_path) }}"
                                                               class="text-white" download>
                                                                <i class="fas fa-file-word"></i> {{ $message->original_file_name ?? 'Download File' }}
                                                            </a>
                                                        </div>
                                                    @elseif(strpos($message->file_type, 'excel') !== false || strpos($message->file_type, 'spreadsheet') !== false)
                                                        <div>
                                                            <a href="{{ Storage::url($message->file_path) }}"
                                                               class="text-white" download>
                                                                <i class="fas fa-file-excel"></i> {{ $message->original_file_name ?? 'Download File' }}
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <a href="{{ Storage::url($message->file_path) }}"
                                                               class="text-white" download>
                                                                <i class="fas fa-file-alt"></i> {{ $message->original_file_name ?? 'Download File' }}
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                            <p class="mt-1 ms-2 small {{ $message->sender == "student" ? 'text-start' : 'text-end' }}">
                                                {{$message->created_at_human}}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="chat-footer chat-active">
                            <div class="chat-input">
                                <form class="chat-form" wire:submit="sendStudentMessage">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-0 me-2">
                                            <div class="btn btn-light p-0" wire:target="file"
                                                 wire:loading.attr="disabled">
                                                <label for="file-input" class="file-upload-label p-2 mb-0">
                                                    <span wire:loading.remove wire:target="file">
                                                        <i class="fas fa-paperclip fa-lg"></i>
                                                    </span>
                                                    <span wire:loading wire:target="file">
                                                        <span class="spinner-border text-primary" role="status"></span>
                                                    </span>
                                                </label>
                                                <input type="file" id="file-input" wire:model="file"
                                                       class="file-upload-input" wire:target="file"
                                                       wire:loading.attr="disabled"/>
                                            </div>
                                        </div>

                                        <div class="flex-grow-1 me-2">
                                            <input type="text" class="mail-write-box form-control"
                                                   wire:model.defer="message"
                                                   placeholder="اكتب رسالة"/>
                                        </div>

                                        <div class="flex-grow-0">
                                            <button type="submit"
                                                    wire:loading.attr="disabled"
                                                    wire:target="file"
                                                    class="btn btn-primary btn-lg">ارسال
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            @if($file)
                                                <p class="mt-1 mb-0">
                                                    <button type="button"
                                                            class="btn btn-danger py-0 px-1 rounded-pill me-2"
                                                            wire:click="removeFile">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                    الملف المرفق : {{ $file->getClientOriginalName() }}
                                                </p>
                                            @endif

                                            @error('message')
                                            <p class="mt-1 mb-0 text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

            @else
                <div class="chat-box-inner h-100">
                    <div class="chat-meta-user chat-active">
                        <div class="current-chat-user-name">
                            <span>
                                <span class="name">{{$selectedClass->schoolClass?->name}}</span>
                            </span>
                        </div>
                    </div>
                    <div class="chat-conversation-box" id="chat-conversation-box-class">
                        <div id="loading-indicator" style="display: none" wire:ignore.self>
                            <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        <div id="chat-conversation-box-scroll-class" class="chat-conversation-box-scroll">
                            <div class="chat active-chat" id="main-chat">
                                @if(count($messages) >= $messageLimit)
                                    <div class="text-center mb-3">
                                        <button class="btn btn-link" wire:click="loadMore">عرض المزيد</button>
                                    </div>
                                @endif

                                @foreach($messages as $message)
                                    <div class="d-flex flex-column">
                                        <div
                                            class="{{ $message->sender == "student" ? 'bubble you' : 'bubble me' }} mb-0">
                                            {{$message->message}}
                                            @if($message->file_path)
                                                @if(strpos($message->file_type, 'image') !== false)
                                                    <!-- Image: Display in Lightbox -->
                                                    <div>
                                                        <a href="{{ asset(Storage::url($message->file_path)) }}"
                                                           data-lightbox="chat-images">
                                                            <img
                                                                src="{{ asset(Storage::url($message->file_path)) }}"
                                                                alt="Image" style="max-width: 200px;">
                                                        </a>
                                                    </div>

                                                @elseif(strpos($message->file_type, 'video') !== false)
                                                    <!-- Video: Display in Video Player -->
                                                    <div>
                                                        <video controls style="max-width: 300px;">
                                                            <source src="{{ asset(Storage::url($message->file_path)) }}"
                                                                    type="{{ $message->file_type }}">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    </div>

                                                @elseif(strpos($message->file_type, 'pdf') !== false)
                                                    <div>
                                                        <a href="{{ Storage::url($message->file_path) }}"
                                                           class="text-white" download>
                                                            <i class="fas fa-file-pdf"></i> {{ $message->original_file_name ?? 'Show File' }}
                                                        </a>
                                                    </div>
                                                @elseif(strpos($message->file_type, 'word') !== false || strpos($message->file_type, 'document') !== false)
                                                    <div>
                                                        <a href="{{ Storage::url($message->file_path) }}"
                                                           class="text-white" download>
                                                            <i class="fas fa-file-word"></i> {{ $message->original_file_name ?? 'Download File' }}
                                                        </a>
                                                    </div>
                                                @elseif(strpos($message->file_type, 'excel') !== false || strpos($message->file_type, 'spreadsheet') !== false)
                                                    <div>
                                                        <a href="{{ Storage::url($message->file_path) }}"
                                                           class="text-white" download>
                                                            <i class="fas fa-file-excel"></i> {{ $message->original_file_name ?? 'Download File' }}
                                                        </a>
                                                    </div>
                                                @else
                                                    <div>
                                                        <a href="{{ Storage::url($message->file_path) }}"
                                                           class="text-white" download>
                                                            <i class="fas fa-file-alt"></i> {{ $message->original_file_name ?? 'Download File' }}
                                                        </a>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                        <p class="mt-1 ms-2 small {{ $message->sender == "student" ? 'text-start' : 'text-end' }}">
                                            @if($message->sender == "student")
                                                {{ $message->student->name }} -
                                            @endif
                                            <span class="small fst-italic"> {{$message->created_at_human}}</span>
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="chat-footer chat-active">
                        <div class="chat-input">
                            <form class="chat-form" wire:submit="sendClassMessage">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-0 me-2">
                                        <div class="btn btn-light p-0" wire:target="file"
                                             wire:loading.attr="disabled">
                                            <label for="file-input" class="file-upload-label p-2 mb-0">
                                                <span wire:loading.remove wire:target="file">
                                                    <i class="fas fa-paperclip fa-lg"></i>
                                                </span>
                                                <span wire:loading wire:target="file">
                                                    <span class="spinner-border text-primary" role="status"></span>
                                                </span>
                                            </label>
                                            <input type="file" id="file-input" wire:model="file"
                                                   class="file-upload-input" wire:target="file"
                                                   wire:loading.attr="disabled"/>
                                        </div>
                                    </div>

                                    <div class="flex-grow-1 me-2">
                                        <input type="text" class="mail-write-box form-control"
                                               wire:model.defer="message"
                                               placeholder="اكتب رسالة"/>
                                    </div>

                                    <div class="flex-grow-0">
                                        <button type="submit"
                                                wire:loading.attr="disabled"
                                                wire:target="file"
                                                class="btn btn-primary btn-lg">ارسال
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        @if($file)
                                            <p class="mt-1 mb-0">
                                                <button type="button"
                                                        class="btn btn-danger py-0 px-1 rounded-pill me-2"
                                                        wire:click="removeFile">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                                الملف المرفق : {{ $file->getClientOriginalName() }}
                                            </p>
                                        @endif

                                        @error('message')
                                        <p class="mt-1 mb-0 text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@script
<script>

    Livewire.on('chat-new-message', message => {
        scrollToBottom();
    });

    Livewire.on('chat-select-student', () => {
        $("#loading-indicator").hide();
        console.log('chat-select-student');
        scrollToBottom();
    });

    Livewire.on('chat-select-class', () => {
        $("#loading-indicator").hide();
        console.log('chat-select-class');
        scrollToBottom();
    });


    function scrollToBottom(retryCount = 5, delay = 100) {
        var getScrollContainer = $('.chat-conversation-box');


        if (getScrollContainer.length > 0) {
            var scrollHeight = getScrollContainer.get(0).scrollHeight;
            getScrollContainer.scrollTop(scrollHeight);
        }
        if (retryCount > 0) {
            setTimeout(function () {
                scrollToBottom(retryCount - 1, delay);
            }, delay);
        }
    }

</script>
@endscript
