<?php

use App\Http\Controllers\ArticleTypeController;
use Illuminate\Support\Facades\Route;

Route::controller(ArticleTypeController::class)->group(function () {
    Route::get('/article-type', 'index');
});
