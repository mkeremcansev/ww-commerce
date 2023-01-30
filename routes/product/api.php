<?php

use App\Http\Controllers\Product\Controller\ProductController;
use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::PRODUCT_GROUP)->prefix(RouteGroupPathEnumeration::PRODUCT_GROUP)->group(function (){
    Route::controller(ProductController::class)->group(function (){
        Route::post('/', 'index')->name('index')->middleware(['auth:sanctum', 'permission:product.index']);
        Route::get('/create', 'create')->name('create')->middleware(['auth:sanctum', 'permission:product.create']);
        Route::post('/store', 'store')->name('store')->middleware(['auth:sanctum', 'permission:product.store']);
        Route::patch('/{id}', 'update')->name('update')->middleware(['auth:sanctum', 'permission:product.update']);
        Route::get('/{id}/edit', 'edit')->name('edit')->middleware(['auth:sanctum', 'permission:product.edit']);
        Route::delete('/{id}/destroy', 'destroy')->name('destroy')->middleware(['auth:sanctum', 'permission:product.destroy']);
        Route::get('/{slug}', 'show')->name('show');
    });
});
