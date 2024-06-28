<?php

namespace App\Http\Controllers\Api\Parents;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\StudentClassResource;
use App\Models\AcademicYear;
use App\Models\Otp;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


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

    public function classes(Request $request)
    {

        $student = $request->user();

        $adminActiveAcademicYear = AcademicYear::where('status', true)->get()->first();


        $currentClass = $student->studentClasses()->whereHas('yearClass', function ($query) use ($adminActiveAcademicYear) {
            $query->where('academic_year_id', $adminActiveAcademicYear->id);
        })->get()->first();

        $classes = $student->studentClasses;

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

        return $this->sendResponse(['current_class' => $currentClassData, 'classes' =>$classesData], 'Student Classes');
    }
}
