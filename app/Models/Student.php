<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $guarded = [];
    protected $appends = ['photo'];

    public function addedBy(): belongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function studentClasses(): hasMany
    {
        return $this->hasMany(StudentClass::class)
            ->whereHas('yearClass', function ($query) {
                $query->whereHas('schoolClass', function ($query) {
                    $query->whereNull('deleted_at');
                });
            });
    }


    public function reports(): hasMany
    {
        return $this->hasMany(StudentReport::class);
    }


    public function YearClasses(): hasMany
    {
        return $this->hasMany(YearClass::class);
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logExcept(['updated_at'])
            ->logUnguarded()
            ->logOnlyDirty();

    }

    public function SchoolClasses(): hasManyThrough
    {
        return $this->hasManyThrough(StudentClass::class, SchoolClass::class,);
    }


    public function generateCode()
    {
        $code = rand(1000, 9999);

        Otp::updateOrCreate(
            ['student_id' => $this->id],
            ['phone' => session('otpVerifyPhone'), 'code' => $code],
        );

        $receiverNumber = session('otpVerifyPhone');

        $message = "رمز التحقق الخاص بك هو " . $code;
        return sendSms($message, $receiverNumber);

    }

    public function getPhotoAttribute()
    {

        if ( !empty($this->personal_photo) && Storage::disk('public')->exists($this->personal_photo)) {
            return Storage::url($this->personal_photo);
        }
    //    return asset("assets/img/90x90.jpg");
        return 'https://placehold.co/100x100/f9f9f9/4361ee.png?text=?';
    }
}
