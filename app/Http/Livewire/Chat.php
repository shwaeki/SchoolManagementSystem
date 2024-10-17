<?php

namespace App\Http\Livewire;

use App\Jobs\SendNotificationJob;
use App\Models\GroupChat;
use App\Models\Student;
use App\Models\Chat as ChatModel;
use App\Models\YearClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Chat extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $messages = [];
    public $messageLimit = 30; // Start by loading 30 messages


    public $chatType = 'student';
    public $newChat = false;
    public $selectedStudent;
    public $selectedClass;
    public $message = '';
    public $userType = 'admin';
    public $chats;
    public $year_classes;
    public $file;

    protected $listeners = ['start-chat' => 'startNewChat'];

    public function mount()
    {
        $this->userType = Auth::guard('teacher')->check() ? 'teacher' : 'admin';
        $this->refreshChats();
    }


    public function loadMessages()
    {
        if ($this->chatType === 'student') {
            $this->messages = ChatModel::where('student_id', $this->selectedStudent->id)
                ->latest()
                ->take($this->messageLimit)
                ->get()
                ->reverse();
        } elseif ($this->chatType === 'class') {
            $this->messages = GroupChat::where('year_class_id', $this->selectedClass->id)
                ->latest()
                ->take($this->messageLimit)
                ->get()
                ->reverse();
        }
    }

    public function loadMore()
    {
        $this->messageLimit += 30;
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.chat');
    }

    public function startNewChat($student_id)
    {
        if ($this->chats->where('student_id', $student_id)->isEmpty()) {
            $this->newChat = true;
        }

        $this->selectedStudent = Student::findOrFail($student_id);
        $this->message = '';
        $this->resetChat();
        $this->emit('chat-select-student');
    }

    public function refreshChats()
    {
        if ($this->userType == 'admin') {
            $this->loadAdminChats();
        } else {
            $this->loadTeacherChats();
        }
    }

    private function loadAdminChats()
    {
        $this->chats = ChatModel::select('chats.*')
            ->join(DB::raw('(SELECT MAX(id) as id FROM chats GROUP BY student_id) as latest_messages'), 'chats.id', '=', 'latest_messages.id')
            ->latest('chats.created_at')
            ->with(['student', 'teacher'])
            ->limit(30)
            ->get();

        $this->year_classes = YearClass::whereHas('students', function ($query) {
            $query->where('academic_year_id', getAdminActiveAcademicYearID());
        })->whereHas('schoolClass', function ($query) {
            $query->whereNull('deleted_at');
        })->with([
            'schoolClass',
            'students',
            'chats' => function ($query) {
                $query->latest('created_at');
            }
        ])->get()
            ->sortByDesc(function ($class) {
                return $class->chats?->max('created_at');
            });


    }

    private function loadTeacherChats()
    {
        $latestMessagesSubquery = DB::table('chats')->select(DB::raw('MAX(id) as id'))->groupBy('student_id');

        $this->chats = ChatModel::select('chats.*')
            ->joinSub($latestMessagesSubquery, 'latest_messages', function ($join) {
                $join->on('chats.id', '=', 'latest_messages.id');
            })
            ->join('student_classes', 'student_classes.student_id', '=', 'chats.student_id')
            ->join('year_classes', 'year_classes.id', '=', 'student_classes.year_class_id')
            ->where('year_classes.academic_year_id', getAdminActiveAcademicYearID())
            ->where('year_classes.supervisor', auth()->id())
            ->latest('chats.created_at')
            ->with(['student', 'teacher'])
            ->distinct('chats.id')
            ->limit(30)
            ->get();


        $this->year_classes = YearClass::whereHas('students', function ($query) {
            $query->where('supervisor', auth()->id());
            $query->where('academic_year_id', getUserActiveAcademicYearID());
        })->whereHas('schoolClass', function ($query) {
            $query->where('archived', false);
            $query->whereNull('deleted_at');
        })->with([
            'schoolClass',
            'students',
            'chats' => function ($query) {
                $query->latest('created_at');
            }
        ])->get()
            ->sortByDesc(function ($class) {
                return $class->chats?->max('created_at');
            });
    }

    public function selectStudent($id)
    {
        $this->resetChat();
        $this->selectedStudent = Student::findOrFail($id);
        $this->selectedClass = null;
        $this->message = '';
        $this->chatType = 'student';
        $this->emit('chat-select-student');
        $this->loadMessages();
    }

    public function selectClass($id)
    {
        $this->resetChat();
        $this->selectedStudent = null;
        $this->selectedClass = YearClass::findOrFail($id);
        $this->message = '';
        $this->chatType = 'class';
        $this->emit('chat-select-class');
        $this->loadMessages();
    }

    public function sendStudentMessage()
    {
        $this->validate([
            'message' => 'nullable|min:2',
            'file' => 'nullable|file|max:10240'
        ], [
            'message.min' => 'يجب أن تكون الرسالة على الأقل من حرفين.',
            'file.max' => 'يجب ألا يزيد حجم الملف عن 10 ميجابايت.',
        ]);

        if (empty($this->message) && !$this->file) {
            $this->addError('message', 'يرجى إدخال رسالة أو تحميل ملف.');
            return;
        }


        $filePath = null;
        $originalFileName = null;
        $fileType = null;

        if ($this->file) {
            $filePath = $this->file->store('chat_files', 'public');
            $fileType = $this->file->getMimeType();
            $originalFileName = $this->file->getClientOriginalName();
        }

        $message = ChatModel::create([
            'teacher_id' => Auth::id(),
            'student_id' => $this->selectedStudent->id,
            'message' => $this->message,
            'file_path' => $filePath,
            'file_type' => $fileType,
            'original_file_name' => $originalFileName,
            'sender' => 'teacher',
        ]);

        $this->resetChat();
        $this->loadMessages();
        $this->emit('chat-new-message', $message);

        $token = $this->selectedStudent->device_token;
        if ($token) {
            SendNotificationJob::dispatch('token', $token, 'رسالة جديدة', 'تم ارسال رسالة جديدة');
        }
    }

    public function sendClassMessage()
    {
        $this->validate([
            'message' => 'nullable|min:2',
            'file' => 'nullable|file|max:10240'
        ], [
            'message.min' => 'يجب أن تكون الرسالة على الأقل من حرفين.',
            'file.max' => 'يجب ألا يزيد حجم الملف عن 10 ميجابايت.',
        ]);

        if (empty($this->message) && !$this->file) {
            $this->addError('message', 'يرجى إدخال رسالة أو تحميل ملف.');
            return;
        }


        $filePath = null;
        $originalFileName = null;
        $fileType = null;

        if ($this->file) {
            $filePath = $this->file->store('chat_files', 'public');
            $fileType = $this->file->getMimeType();
            $originalFileName = $this->file->getClientOriginalName();
        }

        $message = GroupChat::create([
            'teacher_id' => Auth::id(),
            'year_class_id' => $this->selectedClass->id,
            'message' => $this->message,
            'file_path' => $filePath,
            'file_type' => $fileType,
            'original_file_name' => $originalFileName,
            'sender' => 'teacher',
        ]);

        $this->resetChat();
        $this->loadMessages();
        $this->emit('chat-new-message', $message);

        $topic = 'year_class_' . $this->selectedClass->id;
        SendNotificationJob::dispatch('topic', $topic, 'رسالة جديدة', 'تم ارسال رسالة جديدة');
    }

    public function removeFile()
    {
        $this->file = null;
        $this->reset('file');
    }


    private function resetChat()
    {
        $this->messages = [];
        $this->message = '';
        $this->messageLimit = 30;
        $this->file = null;
        $this->newChat = false;
        $this->reset('file');
        $this->refreshChats();
    }

}
