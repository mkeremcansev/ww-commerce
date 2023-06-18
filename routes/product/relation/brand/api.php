<?php

use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use App\Http\Struct\Product\Relation\Brand\Controller\BrandController;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::BRAND_GROUP)->prefix(RouteGroupPathEnumeration::BRAND_GROUP)->group(function ($router) {
    $router->controller(BrandController::class)->group(function ($router) {
        $router->post('/', 'index')->name('index')->middleware(['auth:sanctum', 'permission:brand.index']);
        $router->post('/store', 'store')->name('store')->middleware(['auth:sanctum', 'permission:brand.store']);
        $router->get('/{id}/edit', 'edit')->name('edit')->middleware(['auth:sanctum', 'permission:brand.edit']);
        $router->patch('/{id}', 'update')->name('update')->middleware(['auth:sanctum', 'permission:brand.update']);
        $router->delete('/{id}/destroy', 'destroy')->name('destroy')->middleware(['auth:sanctum', 'permission:brand.destroy']);
        $router->post('/restore', 'restore')->name('restore')->middleware(['auth:sanctum', 'permission:brand.restore']);
        $router->post('/forceDelete', 'forceDelete')->name('forceDelete')->middleware(['auth:sanctum', 'permission:brand.forceDelete']);
    });
});
