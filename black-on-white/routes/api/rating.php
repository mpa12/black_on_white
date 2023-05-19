<?php

use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::controller(RatingController::class)->group(function () {
    Route::get('/rating/{article_id}', 'index');
    Route::post('/rating', 'setRating')->middleware('auth:api');
});
