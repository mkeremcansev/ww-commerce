<?php

use App\Http\Controllers\Media\Image\Controller\ImageController;
use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::IMAGE_GROUP)->prefix(RouteGroupPathEnumeration::IMAGE_GROUP)->group(function ($router) {
    $router->controller(ImageController::class)->group(function ($router) {
        $router->get('/', 'index')->name('index')->middleware(['auth:sanctum', 'permission:image.index']);
        $router->post('/upload', 'upload')->name('upload')->middleware(['auth:sanctum', 'permission:image.upload']);
        $router->post('/destroy', 'destroy')->name('destroy')->middleware(['auth:sanctum', 'permission:image.destroy']);
    });
});
