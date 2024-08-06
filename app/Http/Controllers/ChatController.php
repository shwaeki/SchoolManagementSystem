<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use App\Models\Message;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\StudentClass;
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

        if (Auth::guard('teacher')->check()) {

            $studentIds = StudentClass::join('year_classes', 'student_classes.year_class_id', '=', 'year_classes.id')
                ->join('school_classes', 'school_classes.id', '=', 'year_classes.school_class_id')
                ->where('school_classes.archived', false)
                ->where('year_classes.supervisor', auth()->id())
                ->where('year_classes.academic_year_id', getAdminActiveAcademicYearID())
                ->pluck('student_classes.student_id');

            $students = Student::whereIn('id', $studentIds)->where('archived',false)->get();

        } else {
            $students = Student::where('archived',false)->get();
        }

        $data = [
            'students' => $students,
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
        return response()->json(['chat' => $data]);
    }
}
