<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

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

