<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('academic-years', AcademicYearController::class);
    Route::resource('school-classes', SchoolClassController::class);
    Route::resource('students', StudentController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('student-classes', StudentClassController::class);

});
