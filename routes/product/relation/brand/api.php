<?php

use App\Http\Controllers\Product\Relation\Brand\Controller\BrandController;
use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::BRAND_GROUP)->prefix(RouteGroupPathEnumeration::BRAND_GROUP)->group(function () {
    Route::controller(BrandController::class)->group(function () {
        Route::post('/store', 'store')->name('store')->middleware(['auth:sanctum', 'permission:brand.store']);
    });
});
