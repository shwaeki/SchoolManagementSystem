<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function field()
    {
        return $this->belongsTo(CertificateField::class, 'certificate_field_id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(CertificateCategory::class, 'parent_id');
    }

    public function subcategories()
    {
        return $this->hasMany(CertificateCategory::class, 'parent_id');
    }

    public function marks()
    {
        return $this->hasMany(StudentMark::class);
    }

}