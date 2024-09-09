<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{

    protected $guarded = [];

    public function postable()
    {
        return $this->morphTo();
    }

    public function photos()
    {
        return $this->hasMany(PostPhotos::class);
    }

    public function yearClass(): belongsTo
    {
        return $this->belongsTo(YearClass::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Student::class, 'post_likes');
    }

}
