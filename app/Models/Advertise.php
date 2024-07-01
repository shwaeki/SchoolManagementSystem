<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Advertise extends Model
{
    protected $guarded = [];

    public function addedBy(): belongsTo
    {
        return $this->belongsTo(User::class,'added_by');
    }
}
