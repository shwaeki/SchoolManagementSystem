<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Student extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $guarded = [];

    public function addedBy(): belongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function studentClasses(): hasMany
    {
        return $this->hasMany(StudentClass::class);
    }


    public function YearClasses(): hasMany
    {
        return $this->hasMany(YearClass::class);
    }




    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logExcept(['updated_at'])
            ->logUnguarded()
            ->logOnlyDirty();

    }

    public function SchoolClasses(): hasManyThrough
    {
        return $this->hasManyThrough(StudentClass::class,SchoolClass::class, );
    }

}
