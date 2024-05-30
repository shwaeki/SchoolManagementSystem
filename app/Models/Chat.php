<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function student(): belongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function teacher(): belongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
