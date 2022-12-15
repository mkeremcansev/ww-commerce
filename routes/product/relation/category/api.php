<?php

use App\Http\Controllers\Product\Relation\Category\Controller\CategoryController;
use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::CATEGORY_GROUP)->prefix(RouteGroupPathEnumeration::CATEGORY_GROUP)->group(function (){
    Route::controller(CategoryController::class)->group(function (){
        Route::post('/', 'index')->name('index')->middleware('auth:sanctum', 'permission:category.index');
        Route::get('/create', 'create')->name('create')->middleware('auth:sanctum', 'permission:category.create');
        Route::post('/store', 'store')->name('store')->middleware('auth:sanctum', 'permission:category.store');
        Route::get('/{id}/edit', 'edit')->name('edit')->middleware('auth:sanctum', 'permission:category.edit');
        Route::patch('/{id}/update', 'update')->name('update')->middleware('auth:sanctum', 'permission:category.update');
    });
});
