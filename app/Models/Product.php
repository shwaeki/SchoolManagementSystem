<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function addedBy(): belongsTo
    {
        return $this->belongsTo(User::class,'added_by');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->barcode = static::generateUniqueBarcode();
        });
    }

    // Generate a unique numeric barcode
    protected static function generateUniqueBarcode()
    {
        $barcode = mt_rand(10000000, 99999999);
        while (static::where('barcode', $barcode)->exists()) {
            $barcode = mt_rand(10000000, 99999999);
        }

        return $barcode;
    }
}
