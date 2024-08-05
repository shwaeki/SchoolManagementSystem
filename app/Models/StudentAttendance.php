<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentAttendance extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function addedBy(): belongsTo
    {
        return $this->belongsTo(User::class,'added_by');
    }

    public function student(): belongsTo
    {
        return $this->belongsTo(Student::class);
    }

}
