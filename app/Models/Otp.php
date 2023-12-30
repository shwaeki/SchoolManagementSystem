<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'phone',
        'student_id',
    ];


    protected $hidden = [
        'code',
    ];

    public function student(): belongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
