<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AdvertiseController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CertificateCategoryController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CertificateFieldController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalarySlipController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentMarkController;
use App\Http\Controllers\StudentReportController;
use App\Http\Controllers\StudentRequestController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherMonthlyPlanController;
use App\Http\Controllers\TeacherReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\YearClassController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;


Auth::routes(['reset' => false]);

Route::get('application/message', [ApplicationController::class, 'message'])->name('application.message');

Route::resource('application', ApplicationController::class);


Route::middleware(['auth:web,teacher', 'check.year'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/mysalries', [HomeController::class, 'mysalries'])->name('mysalries');
    Route::get('/myfiles', [HomeController::class, 'myFiles'])->name('myfiles');
    Route::get('/myreports', [HomeController::class, 'myReports'])->name('myreports');
    Route::get('show-salary/{salarySlip}', [HomeController::class, 'showSalary'])->name('show.salary');


    Route::get('school-classes/archives', [SchoolClassController::class, 'archives'])->name('school-classes.archives');
    Route::put('school-classes/archive/{school_class}', [SchoolClassController::class, 'archive'])->name('school-classes.archive');
    Route::put('school-classes/restore/{school_class}', [SchoolClassController::class, 'restore'])->name('school-classes.restore');

    Route::resource('school-classes', SchoolClassController::class);
    Route::resource('student-classes', StudentClassController::class);
    Route::resource('student-marks', StudentMarkController::class);


    Route::get('students/ajax/marks/{studentClass}', [StudentController::class, 'getStudentMarks'])->name('students.ajax.marks');
    Route::get('students/yearlyFile/{studentClass}', [StudentController::class, 'yearlyFile'])->name('students.yearlyFile');
    Route::get('students/marks/{studentClass}', [StudentController::class, 'showMarks'])->name('students.marks');
    Route::get('students/marks/pdf/{studentClass}', [StudentController::class, 'showMarksPdf'])->name('students.marks.pdf');
    Route::get('students/report', [StudentController::class, 'report'])->name('students.report');


    Route::get('profile', [UserController::class, 'profile'])->name('profile.edit');
    Route::put('profile', [UserController::class, 'profileUpdate'])->name('profile.update');
    Route::put('profile/change-password', [UserController::class, 'passwordUpdate'])->name('profile.password');

    Route::get('academic-year/select', [AcademicYearController::class, 'selectAcademicYear'])->name('academic-year.select');


    Route::post('chats/getMessages', [ChatController::class, 'getMessages'])->name('chats.messages.get');
    Route::post('chats/sendMessage', [ChatController::class, 'sendMessage'])->name('chats.message.send');

    Route::resource('chats', ChatController::class);
    Route::resource('teacher-plan', TeacherMonthlyPlanController::class)->only(['index','store','update']);


    Route::post('year-classes/update-attendance/{yearClass}', [YearClassController::class, 'updateStudentAttendance'])->name('year-classes.attendance.update');

    Route::post('year-classes/store-weekly-program/{yearClass}', [YearClassController::class, 'storeWeeklyProgram'])->name('year-classes.weeklyProgram.store');
    Route::put('year-classes/update-weekly-program/{weeklyProgram}', [YearClassController::class, 'updateWeeklyProgram'])->name('year-classes.weeklyProgram.update');
    Route::delete('year-classes/destroy-weekly-program/{week}', [YearClassController::class, 'destroyWeeklyProgram'])->name('year-classes.weeklyProgram.destroy');

    Route::post('year-classes/store-monthly-plan/{yearClass}', [YearClassController::class, 'storeMonthlyPlan'])->name('year-classes.monthlyPlan.store');
    Route::put('year-classes/update-monthly-plan/{studentMonthlyPlan}', [YearClassController::class, 'updateMonthlyPlan'])->name('year-classes.monthlyPlan.update');


    Route::post('year-classes/store-daily-program/{yearClass}', [YearClassController::class, 'storeDailyProgram'])->name('year-classes.dailyProgram.store');
    Route::delete('year-classes/destroy-daily-program/{day}', [YearClassController::class, 'destroyDailyProgram'])->name('year-classes.dailyProgram.destroy');

    Route::put('students/updataImage/{student}', [StudentController::class, 'updatePersonalPhoto'])->name('students.image.update');

    Route::group(['prefix' => 'filemanager'], function () {
        Lfm::routes();
    });


    Route::get('teacher-reports/show/{teacher_report}', [TeacherReportController::class, 'show'])->name('teacher-reports.show');

    Route::middleware(['auth:web', 'check.year'])->group(function () {
        Route::resource('roles', RoleController::class);

        Route::get('students/archives', [StudentController::class, 'archives'])->name('students.archives');
        Route::put('students/archive/{student}', [StudentController::class, 'archive'])->name('students.archive');
        Route::put('students/restore/{student}', [StudentController::class, 'restore'])->name('students.restore');
        Route::resource('students', StudentController::class);

        Route::put('students-request/accept/{students_request}', [StudentRequestController::class, 'accept'])->name('students-request.accept');
        Route::resource('students-request', StudentRequestController::class);


        Route::get('teachers/archives', [TeacherController::class, 'archives'])->name('teachers.archives');
        Route::put('teachers/archive/{teacher}', [TeacherController::class, 'archive'])->name('teachers.archive');
        Route::put('teachers/restore/{teacher}', [TeacherController::class, 'restore'])->name('teachers.restore');
        Route::get('teachers/downloadSlip/{salarySlip}', [TeacherController::class, 'downloadSlip'])->name('teachers.downloadSlip');
        Route::delete('teachers/deleteSlip/{salarySlip}', [TeacherController::class, 'deleteSlip'])->name('teachers.deleteSlip');
        Route::post('teachers/storeSlip', [TeacherController::class, 'storeSlip'])->name('teachers.storeSlip');
        Route::put('teachers/change-password/{teacher}', [TeacherController::class, 'passwordUpdate'])->name('teachers.password');
        Route::resource('teachers', TeacherController::class);


        Route::delete('year-classes/destroy-assistant/{yearClass}/{assistant}', [YearClassController::class, 'destroyAssistant'])->name('year-classes.destroyAssistant');
        Route::post('year-classes/store-assistant/{yearClass}', [YearClassController::class, 'storeAssistant'])->name('year-classes.storeAssistant');


        Route::resource('year-classes', YearClassController::class);

        Route::post('student-reports/generate', [StudentReportController::class, 'generate'])->name('student-reports.generate');
        Route::resource('student-reports', StudentReportController::class);

        Route::post('teacher-reports/generate', [TeacherReportController::class, 'generate'])->name('teacher-reports.generate');
        Route::resource('reports', ReportController::class);


        Route::resource('messages', MessageController::class);

        Route::resource('certificates', CertificateController::class);
        Route::get('certificate-fields/categories', [CertificateFieldController::class, 'getCategories'])->name('certificate-fields.categories');
        Route::resource('certificate-fields', CertificateFieldController::class);
        Route::resource('certificate-categories', CertificateCategoryController::class);


        Route::resource('users', UserController::class);

        Route::resource('academic-years', AcademicYearController::class);
        Route::resource('salaries', SalarySlipController::class);

        Route::get('products/ajax', [ProductController::class, 'ajax'])->name('products.ajax');
        Route::resource('products', ProductController::class);
        Route::resource('purchases', PurchasesController::class);
        Route::resource('payments', PaymentsController::class);
        Route::resource('advertises', AdvertiseController::class);

    });
});


Route::prefix('parents')->group(function () {
    Route::get('/login', [ParentController::class, 'login'])->name('parents.login');
    Route::post('/login', [ParentController::class, 'loginCheck'])->name('parents.loginCheck');
    Route::middleware(['otp.student'])->group(function () {

        Route::get('otp', [ParentController::class, 'otp'])->name('parents.otp');
        Route::post('otp/verification', [ParentController::class, 'verification'])->name('otp.verification');
        Route::get('otp/reset', [ParentController::class, 'resend'])->name('otp.resend');
        Route::get('otp/cancel', [ParentController::class, 'cancel'])->name('otp.cancel');

        Route::middleware(['auth:parent', 'otp.verify'])->group(function () {
            Route::get('/', [ParentController::class, 'index'])->name('parents.index1');
            Route::get('', [ParentController::class, 'index'])->name('parents.index');
        });
    });
});

