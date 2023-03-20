<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleTypeController;
use App\Http\Controllers\AuthController;
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
    Route::post('/article', 'store')->middleware('auth:api')->middleware('admin');
    Route::put('/article/{article}', 'update')->middleware('auth:api')->middleware('admin');
    Route::delete('/article/{article}', 'destroy')->middleware('auth:api')->middleware('admin');
});

Route::controller(ArticleTypeController::class)->group(function () {
    Route::get('/article-type', 'index');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/login', 'login');
    Route::post('/auth/register', 'register');
    Route::post('/auth/refresh', 'refresh');
});
