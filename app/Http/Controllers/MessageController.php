<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{

    public function index()
    {

        $messages = Message::query();
        if (request('date')) {
            $messages->whereDate('created_at', request('date'));
        } else {
            $messages->whereDate('created_at', now());
        }

        $data = [
            "schoolClasses" => SchoolClass::all(),
            "students" => Student::all(),
            "teachers" => Teacher::all(),
            "messages" => $messages->get()
        ];

        return view('messages.index', $data);
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
    public function store(StoreMessageRequest $request)
    {

        $message_to = request('message_to');
        $message = request('message');
        $phones = [];

        if ($message_to == "all_students") {
            $students = Student::all();

            foreach ($students as $student) {
                if ($student->mother_phone != null) {
                    $phones[] = $student->mother_phone;
                }
                if ($student->father_phone != null) {
                    $phones[] = $student->father_phone;
                }
            }
        } elseif ($message_to == "all_teachers") {
            $teachers = Teacher::all();
            foreach ($teachers as $teacher) {
                if ($teacher->phone != null) {
                    $phones[] = $teacher->phone;
                }
            }
        } elseif ($message_to == "specific_student") {
            $student_id = request('student');
            $student = Student::findOrFail($student_id);

            if ($student->mother_phone != null) {
                $phones[] = $student->mother_phone;
            }
            if ($student->father_phone != null) {
                $phones[] = $student->father_phone;
            }

        } elseif ($message_to == "specific_teacher") {
            $teacher_id = request('teacher');
            $teacher = Teacher::findOrFail($teacher_id);
            $phones[] = $teacher->phone;
        } elseif ($message_to == "specific_class") {
            $schoolclass_id = request('schoolclass');
            $schoolClass = SchoolClass::findOrFail($schoolclass_id);


            $activeAcademicYear = Session::get('activeAcademicYear');
            $current_year_class = $schoolClass->yearClasses()->where('academic_year_id', $activeAcademicYear->id)->get()->first();
            $year_class_students = $current_year_class->students()->whereHas('student', function ($query) {
                $query->whereNull('deleted_at');
            })->with('student')->get();


            foreach ($year_class_students as $student) {
                if ($student?->student?->mother_phone != null) {
                    $phones[] = $student?->student?->mother_phone;
                }
                if ($student?->student?->father_phone != null) {
                    $phones[] = $student?->student?->father_phone;
                }
            }
        }

        sendSmsBulk($message, $phones);

        Session::flash('message', 'تم ارسال الرسالة بنجاح.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}