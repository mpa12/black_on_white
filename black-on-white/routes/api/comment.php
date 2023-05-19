<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::controller(CommentController::class)->group(function () {
    Route::get('/comment/{article_id}', 'index');
    Route::post('/comment', 'create')->middleware('auth:api');
    Route::delete('/comment/{comment}', 'destroy')->middleware('auth:api');
});

