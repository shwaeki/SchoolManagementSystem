<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CertificateCategoryController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CertificateFieldController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentMarkController;
use App\Http\Controllers\StudentReportController;
use App\Http\Controllers\StudentRequestController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\YearClassController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['reset' => false]);

Route::get('application/message', [ApplicationController::class, 'message'])->name('application.message');

Route::resource('application', ApplicationController::class);


Route::middleware(['auth:web,teacher', 'check.year'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('school-classes', SchoolClassController::class);
    Route::resource('student-classes', StudentClassController::class);
    Route::resource('student-marks', StudentMarkController::class);


    Route::get('students/ajax/marks/{studentClass}', [StudentController::class, 'getStudentMarks'])->name('students.ajax.marks');
    Route::get('students/marks/{studentClass}', [StudentController::class, 'showMarks'])->name('students.marks');
    Route::get('students/report', [StudentController::class, 'report'])->name('students.report');


    Route::get('profile', [UserController::class, 'profile'])->name('profile.edit');
    Route::put('profile', [UserController::class, 'profileUpdate'])->name('profile.update');
    Route::put('profile/change-password', [UserController::class, 'passwordUpdate'])->name('profile.password');

    Route::get('academic-year/select', [AcademicYearController::class, 'selectAcademicYear'])->name('academic-year.select');

    Route::middleware(['auth:web', 'check.year'])->group(function () {
        Route::resource('roles', RoleController::class);

        Route::resource('students', StudentController::class);

        Route::put('students-request/accept/{students_request}', [StudentRequestController::class, 'accept'])->name('students-request.accept');
        Route::resource('students-request', StudentRequestController::class);

        Route::put('teachers/change-password/{teacher}', [TeacherController::class, 'passwordUpdate'])->name('teachers.password');
        Route::resource('teachers', TeacherController::class);

        Route::resource('year-classes', YearClassController::class);
        Route::resource('student-reports', StudentReportController::class);


        Route::resource('certificates', CertificateController::class);
        Route::get('certificate-fields/categories', [CertificateFieldController::class, 'getCategories'])->name('certificate-fields.categories');
        Route::resource('certificate-fields', CertificateFieldController::class);
        Route::resource('certificate-categories', CertificateCategoryController::class);


        Route::resource('users', UserController::class);

        Route::resource('academic-years', AcademicYearController::class);
    });
});


Route::middleware(['auth'])->group(function () {
    Route::get('otp', [OtpController::class, 'index'])->name('otp.index');
    Route::post('otp/verification', [OtpController::class, 'verification'])->name('otp.verification');
    Route::get('otp/reset', [OtpController::class, 'resend'])->name('otp.resend');
});
