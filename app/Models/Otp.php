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
        'user_id',
    ];


    protected $hidden = [
        'code',
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
