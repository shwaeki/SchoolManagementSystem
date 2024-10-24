<?php

use App\Http\Controllers\Api\Parents\ChatController;
use App\Http\Controllers\Api\Parents\GeneralController;
use App\Http\Controllers\Api\Parents\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::prefix('parents')->group(function () {
    Route::post('/send-otp', [StudentController::class, 'sendOtp']);
    Route::post('/login', [StudentController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/info', [StudentController::class, 'info']);
        Route::get('/classes', [StudentController::class, 'classes']);
        Route::post('/update-device-token', [StudentController::class, 'updateDeviceToken']);
        Route::post('/send-test-notification', [StudentController::class, 'sendTestNotification']);
        Route::get('/daily-program', [StudentController::class, 'getDailyProgram']);
        Route::get('/monthly-plan', [StudentController::class, 'getStudentMonthlyPlan']);

        Route::post('/logout', [StudentController::class, 'logout']);
        Route::get('/getAdvertises', [GeneralController::class, 'getAdvertises']);
        Route::post('/sendMassage', [ChatController::class, 'sendMassage']);
        Route::get('/getMessages', [ChatController::class, 'getMessages']);
        Route::post('/sendGroupMassage', [ChatController::class, 'sendGroupMassage']);
        Route::get('/getGroupMessages', [ChatController::class, 'getGroupMessages']);
        Route::get('/isChatActive', [ChatController::class, 'isChatActive']);

        Route::get('/financialStatistics', [StudentController::class, 'financialStatistics']);

        Route::get('/getPosts', [StudentController::class, 'getClassPosts']);
        Route::post('/posts/like', [StudentController::class, 'likePost'])->name('posts.like');
        Route::post('/posts/unlike', [StudentController::class, 'unlikePost'])->name('posts.unlike');
    });

});

