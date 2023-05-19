<?php

use App\Http\Controllers\PhotoGalleryController;
use Illuminate\Support\Facades\Route;

Route::controller(PhotoGalleryController::class)->group(function () {
    Route::get('/photo-gallery', 'index');
    Route::delete('/photo-gallery/{photo}', 'destroy')->middleware('auth:api')
        ->middleware('admin');
    Route::post('/photo-gallery', 'create')->middleware('auth:api')->middleware('admin');
});
