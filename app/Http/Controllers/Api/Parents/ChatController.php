<?php

namespace App\Http\Controllers\Api\Parents;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\ChatResource;
use App\Http\Resources\StudentClassResource;
use App\Models\AcademicYear;
use App\Models\Chat;
use App\Models\GroupChat;
use App\Models\Message;
use App\Models\Otp;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ChatController extends BaseController
{


    public function sendMassage(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'massage' => 'nullable|min:2',
            'file' => 'nullable|file|max:10240',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if (!$request->has('massage') && !$request->hasFile('file')) {
            return $this->sendError('Validation Error.', ['massage' => 'Please provide a message or upload a file.']);
        }

        $student = $request->user();

        $adminActiveAcademicYear = AcademicYear::where('status', true)->first();

        $currentClass = $student->studentClasses()->whereHas('YearClass', function ($query) {
            $query->where('academic_year_id', getAdminActiveAcademicYearID())
                ->whereHas('schoolClass', function ($query) {
                    $query->where('archived', false);
                });
        })->first();


        $filePath = null;
        $fileType = null;
        $originalFileName = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('chat_files', 'public');
            $fileType = $file->getMimeType();
            $originalFileName = $file->getClientOriginalName();
        }


        $message = Chat::create([
            'teacher_id' => $currentClass?->teacher_id,
            'student_id' => $student->id,
            'message' => $request->input('massage'),
            'file_path' => $filePath,
            'file_type' => $fileType,
            'original_file_name' => $originalFileName,
            'sender' => 'student',
        ]);

        return $this->sendResponse([], 'Message sent successfully');
    }


    public function sendGroupMassage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'massage' => 'nullable|min:2',
            'file' => 'nullable|file|max:10240',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if (!$request->has('massage') && !$request->hasFile('file')) {
            return $this->sendError('Validation Error.', ['massage' => 'Please provide a message or upload a file.']);
        }

        $student = $request->user();

        $currentClass = $student->studentClasses()->whereHas('YearClass', function ($query) {
            $query->where('academic_year_id', getAdminActiveAcademicYearID())
                ->whereHas('schoolClass', function ($query) {
                    $query->where('archived', false);
                });
        })->first();

        if (!$currentClass) {
            return $this->sendError('The student is not registered in any class this year.');
        }


        $filePath = null;
        $fileType = null;
        $originalFileName = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('chat_files', 'public');
            $fileType = $file->getMimeType();
            $originalFileName = $file->getClientOriginalName();
        }

        $message = GroupChat::create([
            'student_id' => $student->id,
            'year_class_id' => $currentClass->year_class_id,
            'message' => $request->input('massage'),
            'file_path' => $filePath,
            'file_type' => $fileType,
            'original_file_name' => $originalFileName,
            'sender' => 'student',
        ]);

        return $this->sendResponse([], 'Message sent successfully');
    }


    public function getMessages(Request $request)
    {
        $student = $request->user();
        $skip = $request->input('skip', 0);
        $messages = $student->chats()->latest()->skip($skip)->take(20)->get();
        return $this->sendResponse([ChatResource::collection($messages)], 'Messages Data');
    }

    public function getGroupMessages(Request $request)
    {
        $student = $request->user();

        $currentClass = $student->studentClasses()->whereHas('YearClass', function ($query) {
            $query->where('academic_year_id', getAdminActiveAcademicYearID());
        })->get()->first();


        $skip = $request->input('skip', 0);
        $chats = $currentClass->YearClass->chats()->latest()->skip($skip)->take(20)->get();

        $messages = ChatResource::collection($chats);
        return $this->sendResponse([$messages], 'Messages Data');
    }

    public function isChatActive(Request $request)
    {
        $student = $request->user();

        $currentClass = $student->studentClasses()->whereHas('YearClass', function ($query) {
            $query->where('academic_year_id', getAdminActiveAcademicYearID());
        })->get()->first();

        //   $data = $currentClass?->YearClass?->posts;
        $data = [
            'chat_active' => $currentClass?->YearClass?->chat_active
        ];
        return $this->sendResponse([$data], 'Class Posts Data');
    }


}
