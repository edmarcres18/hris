<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;

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

Route::post('/login', [LoginController::class, 'login']);
Route::post('/auth/forgot-password', [ForgotPasswordController::class, 'sendOtp']);
Route::post('/auth/send-reset-otp', [ForgotPasswordController::class, 'sendResetOtp']);
Route::post('/auth/verify-otp', [ForgotPasswordController::class, 'verifyOtp']);
Route::post('/auth/resend-otp', [ForgotPasswordController::class, 'resendOtp']);
Route::post('/auth/reset-password', [ResetPasswordController::class, 'resetPassword']);


Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::post('/forgot-password', [AuthController::class, 'sendOtp']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::middleware('auth:sanctum')->post('/attendance', [AttendanceController::class, 'store']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'getUserDetails']);
    Route::get('employee/{email}', [EmployeeController::class, 'getEmployeeByEmail']);
});
