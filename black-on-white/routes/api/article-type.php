<?php

use App\Http\Controllers\ArticleTypeController;
use Illuminate\Support\Facades\Route;

Route::controller(ArticleTypeController::class)->group(function () {
    // Получение списка типов новостей.
    Route::get('/article-type', 'index');

    // Создание типа новости.
    Route::post('/article-type', 'create')
        ->middleware('auth:api')
        ->middleware('admin');

    // Редактирование типа новости.
    Route::post('/article-type/{articleType}', 'update')
        ->middleware('auth:api')
        ->middleware('admin');

    // Удаление типа новости.
    Route::delete('/article-type/{articleType}', 'destroy')
        ->middleware('auth:api')
        ->middleware('admin');
});
