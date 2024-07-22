<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyProgram extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function yearClass(): belongsTo
    {
        return $this->belongsTo(YearClass::class);
    }

    public function getTimeAttribute()
    {
        return Carbon::createFromFormat('H:i:s', $this->start_time)->format('h:i') . ' - ' . Carbon::createFromFormat('H:i:s', $this->end_time)->format('h:i');
    }
}
