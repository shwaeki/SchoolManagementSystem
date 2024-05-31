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
        $this->chats = \App\Models\Chat::select('chats.*')
            ->join(DB::raw('(SELECT MAX(id) as id FROM chats GROUP BY student_id) as latest_messages'), 'chats.id', '=', 'latest_messages.id')
            ->latest('chats.created_at')
            ->with('student', 'teacher')
            ->limit(30)
            ->get();
        $this->message = '';
        $this->newChat = false;

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

        $this->refreshChats();
        $this->emit('chat-new-message', $message);
    }

    public function mount()
    {
        $this->refreshChats();
    }

    public function render()
    {
        return view('livewire.chat');
    }
}
