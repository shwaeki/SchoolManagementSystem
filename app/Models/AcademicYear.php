<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicYear extends Model
{
    use HasFactory, SoftDeletes;


    protected $casts = [
        'status' => 'boolean',
    ];

    protected $guarded = [];
    public function addedBy(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function studentClasses(): HasMany
    {
        return $this->hasMany(StudentClass::class);
    }
}
