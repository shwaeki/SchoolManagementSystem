<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chat extends Component
{

    public $newChat;
    public $selectedStudent;
    public $chats;
    public $message;
    public $userType = "admin";

    protected $listeners = ['start-chat' => 'startNewChat'];

    public function startNewChat($student_id)
    {
        $studentId5NotInList = $this->chats->where('student_id', $student_id)->isEmpty();

        if ($studentId5NotInList) {
            $this->newChat = true;
        }

        $this->selectedStudent = Student::findOrFail($student_id);
        $this->message = '';
        $this->emit('chat-select-student');
    }

    public function refreshChats()
    {
        if ($this->userType == 'admin') {
            $this->chats = \App\Models\Chat::select('chats.*')
                ->join(DB::raw('(SELECT MAX(id) as id FROM chats GROUP BY student_id) as latest_messages'), 'chats.id', '=', 'latest_messages.id')
                ->latest('chats.created_at')
                ->with('student', 'teacher')
                ->limit(30)
                ->get();
        } else {
            $latestMessagesSubquery = DB::table('chats')->select(DB::raw('MAX(id) as id'))->groupBy('student_id');


            $this->chats = \App\Models\Chat::select('chats.*')
                ->joinSub($latestMessagesSubquery, 'latest_messages', function ($join) {
                    $join->on('chats.id', '=', 'latest_messages.id');
                })
                ->join('student_classes', 'student_classes.student_id', '=', 'chats.student_id')
                ->join('year_classes', 'year_classes.id', '=', 'student_classes.year_class_id')
                ->where('year_classes.academic_year_id', getAdminActiveAcademicYearID())
                ->where('year_classes.supervisor', auth()->id())
                ->latest('chats.created_at')
                ->with('student', 'teacher')
                ->distinct('chats.id')
                ->limit(30)
                ->get();

        }


    }

    public function selectStudent($id)
    {
        $this->selectedStudent = Student::findOrFail($id);
        $this->message = '';
        $this->emit('chat-select-student');
    }


    public function sendMessage()
    {

        $this->validate([
            'message' => 'required|min:2',
        ]);


        $message = \App\Models\Chat::create([
            'teacher_id' => Auth::id(),
            'student_id' => $this->selectedStudent->id,
            'message' => $this->message,
            'sender' => 'teacher',
        ]);
        $this->message = '';
        $this->newChat = false;
        $this->refreshChats();
        $this->emit('chat-new-message', $message);



        $deviceToken = $this->selectedStudent->device_token;

        if ($deviceToken) {
            sendNotification(
                $deviceToken,
                'New Message',
                'You have a new message from Riad Majd.'
            );
        }
    }

    public function mount()
    {

        if (Auth::guard('teacher')->check()) {
            $this->userType = 'teacher';
        } else {
            $this->userType = 'admin';
        }


        $this->refreshChats();
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
