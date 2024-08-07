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
            'massage' => 'required|min:2',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $student = $request->user();

        $adminActiveAcademicYear = AcademicYear::where('status', true)->get()->first();

        $currentClass = $student->studentClasses()->whereHas('yearClass', function ($query) {
            $query->where('academic_year_id', getAdminActiveAcademicYearID())
                ->whereHas('schoolClass', function ($query) {
                    $query->where('archived', false);
                });
        })->get()->first();

        $message = Chat::create([
            'teacher_id' => $currentClass?->teacher_id,
            'student_id' => $student->id,
            'message' => $request->input('massage'),
            'sender' => 'student',
        ]);

        return $this->sendResponse([], 'Message send successfully');

    }

    public function getMessages(Request $request)
    {
        $student = $request->user();

        $messages = ChatResource::collection($student->chats);
        return $this->sendResponse([$messages], 'Messages Data');
    }


    public function sendGroupMassage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'massage' => 'required|min:2',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $student = $request->user();

        $currentClass = $student->studentClasses()->whereHas('yearClass', function ($query) {
            $query->where('academic_year_id', getAdminActiveAcademicYearID())
                ->whereHas('schoolClass', function ($query) {
                    $query->where('archived', false);
                });
        })->get()->first();

        if (!$currentClass) {
            return $this->sendError('The Student Not Register To Any Class This Year.');
        }

        $message = GroupChat::create([
            'student_id' => $student->id,
            'year_class_id' => $currentClass->year_class_id,
            'message' => $request->input('massage'),
            'sender' => 'student',
        ]);


        return $this->sendResponse([], 'Message send successfully');

    }

    public function getGroupMessages(Request $request)
    {
        $student = $request->user();

        $currentClass = $student->studentClasses()->whereHas('yearClass', function ($query) {
            $query->where('academic_year_id', getAdminActiveAcademicYearID());
        })->get()->first();

        $chats = $currentClass->YearClass->chats;

        $messages = ChatResource::collection($chats);
        return $this->sendResponse([$messages], 'Messages Data');
    }


}
