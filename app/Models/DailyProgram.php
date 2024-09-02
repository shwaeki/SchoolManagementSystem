<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

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

    public function getImagePathAttribute()
    {
        if (!empty($this->image) && Storage::disk()->exists($this->image)) {
            return url(Storage::url($this->image));
        }
        return 'https://placehold.co/100x100/f9f9f9/4361ee.png?text=?';
    }
}
