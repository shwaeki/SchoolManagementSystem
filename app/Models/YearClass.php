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


    public function schoolClass(): belongsTo
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

}
