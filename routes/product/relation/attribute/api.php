<?php

use App\Http\Controllers\Product\Relation\Attribute\Controller\AttributeController;
use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::ATTRIBUTE_GROUP)->prefix(RouteGroupPathEnumeration::ATTRIBUTE_GROUP)->group(function (){
    Route::controller(AttributeController::class)->group(function (){
        Route::post('/', 'index')->name('index')->middleware(['auth:sanctum', 'permission:attribute.index']);
        Route::post('/store', 'store')->name('store')->middleware(['auth:sanctum', 'permission:attribute.store']);
        Route::get('/{id}/edit', 'edit')->name('edit')->middleware(['auth:sanctum', 'permission:attribute.edit']);
        Route::patch('/{id}/update', 'update')->name('update')->middleware(['auth:sanctum', 'permission:attribute.update']);
        Route::delete('/{id}/destroy', 'destroy')->name('destroy')->middleware(['auth:sanctum', 'permission:attribute.destroy']);
    });
});
