<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function addedBy(): belongsTo
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function student(): belongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher(): belongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function yearClass(): belongsTo
    {
        return $this->belongsTo(YearClass::class);
    }

    public function marks()
    {
        return $this->hasMany(StudentMark::class);
    }

}
