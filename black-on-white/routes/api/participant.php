<?php

use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Route;

Route::controller(ParticipantController::class)->group(function () {
    Route::get('/participant', 'index');
    Route::get('/participant/count', 'participants_count');
    Route::get('/participant/{participant}', 'show');
    Route::post('/participant', 'create')->middleware('auth:api')->middleware('admin');
    Route::delete('/participant/{participant}', 'destroy')->middleware('auth:api')
        ->middleware('admin');
    Route::post('/participant/{participant}', 'update')->middleware('auth:api')->middleware('admin');
});
