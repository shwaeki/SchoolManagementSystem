<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(CertificateCategory::class, 'certificate_category_id');
    }


    public function studentCertificate()
    {
        return $this->belongsTo(StudentCertificate::class, 'student_certificate_id');
    }
}
