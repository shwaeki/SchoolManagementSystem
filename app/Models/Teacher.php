<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;


    public function addedBy(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function studentClasses(): hasMany
    {
        return $this->hasMany(StudentClass::class);
    }

    public function supervisorClasses(): hasMany
    {
        return $this->hasMany(SchoolClass::class, 'supervisor');
    }


    public function schoolClass(): belongsTo
    {
        return $this->belongsTo(SchoolClass::class,);
    }

}
