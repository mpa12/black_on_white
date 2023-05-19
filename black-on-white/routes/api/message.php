<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

Route::controller(MessageController::class)->group(function () {
    Route::get('/message', 'index');
    Route::get('/message/{message}', 'show');
    Route::get('/message/read/{message}', 'read');
    Route::post('/message', 'create');
    Route::delete('/message/{message}', 'destroy')->middleware('auth:api')->middleware('admin');
});
