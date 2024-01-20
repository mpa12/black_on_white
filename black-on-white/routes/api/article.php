<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::controller(ArticleController::class)->group(function () {
    // Получение списка новостей.
    Route::get('/article', 'index');

    // Получение двух последних новостей.
    Route::get('/article/two-last', 'two_last');

    // Просмотр новости.
    Route::get('/article/{article}', 'show');

    // Добавление новости.
    Route::post('/article', 'create')
        ->middleware('auth:api')
        ->middleware('admin');

    // Редактирование новости.
    Route::post('/article/{article}', 'update')
        ->middleware('auth:api')
        ->middleware('admin');

    // Удаление новости.
    Route::delete('/article/{article}', 'destroy')
        ->middleware('auth:api')
        ->middleware('admin');

    // Загрузка изображения.
    Route::post('/article/upload/image', 'uploadImage')
        ->middleware('auth:api')
        ->middleware('admin');
});

