<?php

namespace App\Http\Controllers\Api\Parents;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\StudentClassResource;
use App\Models\AcademicYear;
use App\Models\DailyProgram;
use App\Models\Otp;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Exception\Messaging\NotFound;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class StudentController extends BaseController
{
    public function info(Request $request)
    {
        return $this->sendResponse([$request->user()], 'User Data');
    }


    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identification' => 'required|exists:students,identification',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $identification = $request->input('identification');
        $phone = $request->input('phone');

        $student = Student::where('identification', $identification)->where(function ($query) use ($phone) {
            $query->where('father_phone', $phone)->orWhere('mother_phone', $phone);
        })->first();


        if ($student) {
            if ($student->archived) {
                return $this->sendError([], 'Student is archived', 401);
            }

            // $student->generateCode($phone);
            $code = 123456;

            Otp::updateOrCreate(
                ['student_id' => $student->id],
                ['phone' => $phone, 'code' => $code],
            );
            return $this->sendResponse([], 'Otp code send successfully');
        }
        return $this->sendError([], 'Unauthorized', 401);

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identification' => 'required|exists:students,identification',
            'phone' => 'required',
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $identification = $request->input('identification');
        $phone = $request->input('phone');
        $code = $request->input('code');

        $student = Student::where('identification', $identification)->where(function ($query) use ($phone) {
            $query->where('father_phone', $phone)->orWhere('mother_phone', $phone);
        })->first();

        if ($student) {

            $studentOTP = Otp::where('student_id', $student->id)
                ->where('code', $code)
                ->where('phone', $phone)
                /*  ->where('updated_at', '>=', now()->subMinutes(5))*/
                ->first();

            if (!is_null($studentOTP)) {
                auth('parent')->login($student);

                //   $student->tokens()->delete();

                $token = $student->createToken('Parent')->plainTextToken;

                return $this->sendResponse(['student' => $student, 'token' => $token], 'Login successfully ');
            }
        }

        return $this->sendError([], 'Unauthorized', 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->sendResponse([], 'Successfully logged out');
    }

    public function updateDeviceToken(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'device_token' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $student = $request->user();
        $student->device_token = request('device_token');
        $student->save();

        return $this->sendResponse([], 'Token stored successfully');
    }

    public function sendTestNotification(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $student = $request->user();
        $title = request('title');
        $body = request('body');

        $deviceToken = $student->device_token;

        if ($deviceToken) {
            try {
                $factory = (new Factory)->withServiceAccount(public_path('firebase-configuration.json'));
                $messaging = $factory->createMessaging();
                $message = CloudMessage::withTarget('token', $deviceToken)->withNotification(['title' => $title, 'body' => $body])->withDefaultSounds();

                $messaging->send($message);
                return $this->sendResponse(['message' => $message], 'Notification send successfully');
            } catch (NotFound $exception) {
                return $this->sendError('Device Token Not Found .', []);
            }
        } else {
            return $this->sendError('Device Token is empty .', []);
        }
    }

    public function classes(Request $request)
    {

        $student = $request->user();

        $currentClass = $student->studentClasses()->whereHas('yearClass', function ($query) {
            $query->where('academic_year_id', getAdminActiveAcademicYearID())
                ->whereHas('schoolClass', function ($query) {
                    $query->where('archived', false);
                });
        })->get()->first();

        $classes = $student->studentClasses()->whereHas('yearClass', function ($query) {
            $query->whereHas('schoolClass', function ($query) {
                $query->where('archived', false);
            });
        })->get();

        if ($currentClass == null) {
            $currentClassData = null;
        } else {
            $currentClassData = new StudentClassResource($currentClass);
        }

        if ($classes == null) {
            $classesData = null;
        } else {
            $classesData = StudentClassResource::collection($classes);
        }

        return $this->sendResponse(['current_class' => $currentClassData, 'classes' => $classesData], 'Student Classes');
    }


    public function getDailyProgram(Request $request)
    {

        $student = $request->user();


        $currentClass = $student->studentClasses()->whereHas('yearClass', function ($query) {
            $query->where('academic_year_id', getAdminActiveAcademicYearID());
        })->get()->first();


        $data = $currentClass?->yearClass?->dailyPrograms;

        return $this->sendResponse([$data], 'Daily Program Data');
    }
}
