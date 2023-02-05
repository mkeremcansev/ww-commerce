<?php

use App\Http\Controllers\Media\Image\Controller\ImageController;
use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::IMAGE_GROUP)->prefix(RouteGroupPathEnumeration::IMAGE_GROUP)->group(function () {
    Route::controller(ImageController::class)->group(function () {
        Route::post('/upload', 'upload')->name('upload')->middleware(['auth:sanctum', 'permission:image.upload']);
    });
});
