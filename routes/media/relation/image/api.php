<?php

use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use App\Http\Struct\Media\Controller\MediaController;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::MEDIA_GROUP)->prefix(RouteGroupPathEnumeration::MEDIA_GROUP)->group(function ($router) {
    $router->controller(MediaController::class)->group(function ($router) {
        $router->post('/destroy', 'destroy')->name('destroy')->middleware(['auth:sanctum', 'permission:image.destroy']);
        $router->get('/', 'index')->name('index')->middleware(['auth:sanctum', 'permission:image.index']);
        $router->post('/store', 'store')->name('upload')->middleware(['auth:sanctum', 'permission:image.upload']);
    });
});
