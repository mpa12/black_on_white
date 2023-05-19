<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/login', 'login');
    Route::post('/auth/register', 'register');
    Route::post('/auth/refresh', 'refresh');
    Route::get('/auth/is-admin', 'isAdmin');
    Route::post('/auth/reset-password', 'resetPassword');
    Route::post('/auth/reset-password-response', 'resetPasswordResponse');
    Route::post('/auth/validate-token', 'validateToken');
});
