<?php

namespace App\Jobs;

use App\Models\NotifcationMessage;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\StudentClass;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckTeacherAttendance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $teachers = Teacher::where('teacher_type','teacher')->where('archived',false)->get();

        foreach ($teachers as $teacher) {


            $studentIds = StudentClass::join('year_classes', 'student_classes.year_class_id', '=', 'year_classes.id')
                ->join('school_classes', 'school_classes.id', '=', 'year_classes.school_class_id')
                ->where('school_classes.archived', false)
                ->where('year_classes.supervisor', $teacher->id)
                ->where('year_classes.academic_year_id', getAdminActiveAcademicYearID())
                ->pluck('student_classes.student_id');

            if (count($studentIds) > 0) {

                $attendanceDate = Carbon::now()->format('Y-m-d');
                $studentsAttendance = StudentAttendance::whereIn('student_id', $studentIds)
                    ->whereDate('date', $attendanceDate)
                    ->pluck('status', 'student_id')
                    ->toArray();

                if (count($studentsAttendance) == 0) {
                    NotifcationMessage::create([
                        'message' => "لم يقم المعلم {$teacher->name} بتسجيل الحضور اليوم.",
                        'teacher_id' => $teacher->id,
                    ]);
                }
            }
        }


    }
}
