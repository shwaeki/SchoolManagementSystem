<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupChat extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $appends = ['created_at_human'];

    public function student(): belongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function teacher(): belongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function YearClass(): belongsTo
    {
        return $this->belongsTo(YearClass::class, 'year_class_id');
    }


    public function getCreatedAtHumanAttribute()
    {
        return Carbon::parse($this->created_at)->locale('ar')->diffForHumans();
    }
}