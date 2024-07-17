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

        Route::post('/logout', [StudentController::class, 'logout']);
        Route::post('/sendMassage', [ChatController::class, 'sendMassage']);
        Route::get('/getMessages', [ChatController::class, 'getMessages']);
        Route::get('/getAdvertises', [GeneralController::class, 'getAdvertises']);
    });

});

