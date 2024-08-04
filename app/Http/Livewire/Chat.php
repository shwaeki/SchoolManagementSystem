<?php

namespace App\Http\Livewire;

use App\Models\GroupChat;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Chat as ChatModel;
use App\Models\YearClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chat extends Component
{
    public $chatType = 'student';
    public $newChat = false;
    public $selectedStudent;
    public $selectedClass;
    public $message = '';
    public $userType = 'admin';
    public $chats;
    public $year_classes;

    protected $listeners = ['start-chat' => 'startNewChat'];

    public function mount()
    {
        $this->userType = Auth::guard('teacher')->check() ? 'teacher' : 'admin';
        $this->refreshChats();
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
    }

    public function selectStudent($id)
    {
        $this->selectedStudent = Student::findOrFail($id);
        $this->selectedClass = null;
        $this->message = '';
        $this->chatType = 'student';
        $this->emit('chat-select-student');
    }

    public function selectClass($id)
    {
        $this->selectedStudent = null;
        $this->selectedClass = YearClass::findOrFail($id);
        $this->message = '';
        $this->chatType = 'class';
        $this->emit('chat-select-class');
    }

    public function sendStudentMessage()
    {
        $this->validate(['message' => 'required|min:2']);

        $message = ChatModel::create([
            'teacher_id' => Auth::id(),
            'student_id' => $this->selectedStudent->id,
            'message' => $this->message,
            'sender' => 'teacher',
        ]);

        $this->resetChat();
        $this->emit('chat-new-message', $message);
        $token = $this->selectedStudent->device_token;
        if ($token) {
            sendNotification($token, 'رسالة جديدة', 'تم ارسال رسالة جديدة');
        }

    }

    public function sendClassMessage()
    {
        $this->validate(['message' => 'required|min:2']);

        $message = GroupChat::create([
            'teacher_id' => Auth::id(),
            'year_class_id' => $this->selectedClass->id,
            'message' => $this->message,
            'sender' => 'teacher',
        ]);

        $this->resetChat();
        $this->emit('chat-new-message', $message);
    }

    private function resetChat()
    {
        $this->message = '';
        $this->newChat = false;
        $this->refreshChats();
    }

}
