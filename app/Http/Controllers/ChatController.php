<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use App\Models\Message;
use App\Models\Student;
use App\Models\User;
use http\Client\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'students' => Student::all(),
            'chats' => Chat::select('chats.*')
                ->join(DB::raw('(SELECT MAX(id) as id FROM chats GROUP BY student_id) as latest_messages'), 'chats.id', '=', 'latest_messages.id')
                ->latest('chats.created_at')
                ->with('student', 'teacher')
                ->limit(15)
                ->get(),
        ];

        return view('chats.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChatRequest $request)
    {
        $data = [
            'message' => 'required|string',
            'student_id' => 'required|exists:students,id',
            'teacher_id' => auth()->id(),
        ];

        Chat::create($data);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChatRequest $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        //
    }


    public function getMessages()
    {
        $student_id = request('student_id');
        $student = Student::findOrfail($student_id);

        $data = [
            'chats' => $student->chats()->get(),
        ];

        return response()->json($data);
    }

    public function sendMessage(Request $request)
    {
        $student_id = request('student_id');
        $message = request('message');

        $data = new Chat();
        $data->teacher_id = Auth::id();
        $data->student_id = $student_id;
        $data->message = $message;
        $data->sender = "teacher";
        $data->save();
    }
}
