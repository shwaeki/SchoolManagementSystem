<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchases extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function addedBy(): belongsTo
    {
        return $this->belongsTo(User::class,'added_by');
    }

    public function student(): belongsTo
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function product(): belongsTo
    {
        return $this->belongsTo(Product::class,'product_id');
    }

}
