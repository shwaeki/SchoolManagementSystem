<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpdf\Tag\Mark;

class StudentCertificate extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class, 'student_class_id');
    }

    public function marks()
    {
        return $this->hasMany(StudentMark::class, 'student_certificate_id');
    }
}
