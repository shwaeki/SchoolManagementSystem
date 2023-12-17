<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $hidden = [
        'password',
    ];

    protected $guarded = [];
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
    public function supervisorYearClasses(): hasMany
    {
        return $this->hasMany(YearClass::class, 'supervisor');
    }


    public function schoolClass(): belongsTo
    {
        return $this->belongsTo(SchoolClass::class,);
    }

}
