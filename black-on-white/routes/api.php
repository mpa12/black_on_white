<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleTypeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PhotoGalleryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(ArticleController::class)->group(function () {
    Route::get('/article', 'index');
    Route::get('/article/two-last', 'two_last');
    Route::get('/article/{article}', 'show');
    Route::post('/article', 'create')->middleware('auth:api')->middleware('admin');
    Route::post('/article/{article}', 'update')->middleware('auth:api')->middleware('admin');
    Route::delete('/article/{article}', 'destroy')->middleware('auth:api')->middleware('admin');
    Route::post('/article/upload/image', 'uploadImage')->middleware('auth:api')
        ->middleware('admin');
});

Route::controller(ArticleTypeController::class)->group(function () {
    Route::get('/article-type', 'index');
});

Route::controller(MessageController::class)->group(function () {
    Route::get('/message', 'index');
    Route::get('/message/{message}', 'show');
    Route::get('/message/read/{message}', 'read');
    Route::post('/message', 'create');
    Route::delete('/message/{message}', 'destroy')->middleware('auth:api')->middleware('admin');
});

Route::controller(ParticipantController::class)->group(function () {
    Route::get('/participant', 'index');
    Route::get('/participant/count', 'participants_count');
    Route::get('/participant/{participant}', 'show');
    Route::post('/participant', 'create')->middleware('auth:api')->middleware('admin');
    Route::delete('/participant/{participant}', 'destroy')->middleware('auth:api')
        ->middleware('admin');
    Route::post('/participant/{participant}', 'update')->middleware('auth:api')->middleware('admin');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/login', 'login');
    Route::post('/auth/register', 'register');
    Route::post('/auth/refresh', 'refresh');
    Route::get('/auth/is-admin', 'isAdmin');
    Route::post('/auth/reset-password', 'resetPassword');
    Route::post('/auth/reset-password-response', 'resetPasswordResponse');
    Route::post('/auth/validate-token', 'validateToken');
});

Route::controller(PhotoGalleryController::class)->group(function () {
    Route::get('/photo-gallery', 'index');
    Route::delete('/photo-gallery/{photo}', 'destroy')->middleware('auth:api')
        ->middleware('admin');
});
