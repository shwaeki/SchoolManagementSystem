<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    public function addedBy(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function studentClasses(): hasMany
    {
        return $this->hasMany(StudentClass::class);
    }

    public function supervisorTeacher(): belongsTo
    {
        return $this->belongsTo(Teacher::class, 'supervisor');
    }

    public function teachers(): hasMany
    {
        return $this->hasMany(Teacher::class);
    }


}
