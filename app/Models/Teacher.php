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


    public function posts()
    {
        return $this->morphMany(Post::class, 'postable');
    }

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


    public function yearClassAssistants()
    {
        return $this->belongsToMany(YearClass::class,'year_class_assistants','assistant_id','year_class_id');
    }

    public function reports(): hasMany
    {
        return $this->hasMany(TeacherReport::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class, 'teacher_id');
    }


    public function monthlyPlans()
    {
        return $this->hasMany(TeacherMonthlyPlan::class, 'teacher_id');
    }

}
