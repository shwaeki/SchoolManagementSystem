<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateField extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function certificate()
    {
        return $this->belongsTo(Certificate::class);
    }

    public function categories()
    {
        return $this->hasMany(CertificateCategory::class);
    }

    public function mainCategories()
    {
        return $this->hasMany(CertificateCategory::class)->where('parent_id', null);
    }
}
