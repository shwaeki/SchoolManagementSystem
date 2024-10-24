<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class YearClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    public function addedBy(): belongsTo
    {
        return $this->belongsTo(User::class,'added_by');
    }


    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function students(): hasMany
    {
        return $this->hasMany(StudentClass::class);
    }

    public function academicYear(): belongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function supervisorTeacher(): belongsTo
    {
        return $this->belongsTo(Teacher::class, 'supervisor');
    }


    public function certificate(): belongsTo
    {
        return $this->belongsTo(Certificate::class);
    }


    public function dailyPrograms(): hasMany
    {
        return $this->hasMany(DailyProgram::class);
    }

    public function posts(): hasMany
    {
        return $this->hasMany(Post::class);
    }

    public function weeklyPrograms(): hasMany
    {
        return $this->hasMany(WeeklyProgram::class);
    }


    public function studentMonthlyPlans(): hasMany
    {
        return $this->hasMany(StudentMonthlyPlan::class);
    }

    public function assistants()
    {
        return $this->belongsToMany(Teacher::class,'year_class_assistants','year_class_id','assistant_id');
    }

    public function chats(): hasMany
    {
        return $this->hasMany(GroupChat::class, 'year_class_id');
    }

}
