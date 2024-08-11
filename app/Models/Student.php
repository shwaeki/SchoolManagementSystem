<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory, SoftDeletes, LogsActivity, HasApiTokens;

    protected $guarded = [];
    protected $appends = ['photo', 'age'];

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

    public function chats()
    {
        return $this->hasMany(Chat::class, 'student_id');
    }

    public function purchases()
    {
        return $this->hasMany(Purchases::class, 'student_id');
    }

    public function payments()
    {
        return $this->hasMany(Payments::class, 'student_id');
    }


    public function purchasesCurrentYear()
    {
        return $this->hasMany(Purchases::class, 'student_id')->where( 'academic_year_id', getUserActiveAcademicYearID());
    }

    public function paymentsCurrentYear()
    {
        return $this->hasMany(Payments::class, 'student_id')->where( 'academic_year_id', getUserActiveAcademicYearID());
    }

    public function attendances()
    {
        return $this->hasMany(StudentAttendance::class);
    }


    public function generateCode($phone = null)
    {
        $code = rand(1000, 9999);

        if ($phone == null) {
            $phone = session('otpVerifyPhone');
        }
        Otp::updateOrCreate(
            ['student_id' => $this->id],
            ['phone' => $phone, 'code' => $code],
        );

        $message = "رمز التحقق الخاص بك هو " . $code;
        return sendSms($message, $phone);

    }


    public function getAgeAttribute()
    {
        if (!$this->birth_date || $this->birth_date == '1970-01-01') {
            return 0;
        }

        return Carbon::parse($this->birth_date)->age ?? 0;
    }

    public function getPhotoAttribute()
    {

        if (!empty($this->personal_photo) && Storage::disk('public')->exists($this->personal_photo)) {
            return Storage::url($this->personal_photo);
        }
        //    return asset("assets/img/90x90.jpg");
        return 'https://placehold.co/100x100/f9f9f9/4361ee.png?text=?';
    }
}
