<?php

use App\Http\Controllers\Product\Controller\ProductController;
use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::PRODUCT_GROUP)->prefix(RouteGroupPathEnumeration::PRODUCT_GROUP)->group(function (){
    Route::controller(ProductController::class)->group(function (){
        Route::get('/{slug}', 'show')->name('show');
    });
});
