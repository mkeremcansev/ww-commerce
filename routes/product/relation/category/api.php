<?php

use App\Http\Controllers\Product\Relation\Category\Controller\CategoryController;
use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::CATEGORY_GROUP)->prefix(RouteGroupPathEnumeration::CATEGORY_GROUP)->group(function (){
    Route::controller(CategoryController::class)->group(function (){
        Route::get('/', 'index')->name('index')->middleware('auth:sanctum', 'permission:category.index');
    });
});
