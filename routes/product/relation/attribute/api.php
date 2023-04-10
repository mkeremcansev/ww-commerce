<?php

use App\Http\Controllers\Product\Relation\Attribute\Controller\AttributeController;
use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::ATTRIBUTE_GROUP)->prefix(RouteGroupPathEnumeration::ATTRIBUTE_GROUP)->group(function ($router){
    Route::controller(AttributeController::class)->group(function ($router){
        $router->post('/', 'index')->name('index')->middleware(['auth:sanctum', 'permission:attribute.index']);
        $router->post('/store', 'store')->name('store')->middleware(['auth:sanctum', 'permission:attribute.store']);
        $router->get('/{id}/edit', 'edit')->name('edit')->middleware(['auth:sanctum', 'permission:attribute.edit']);
        $router->patch('/{id}', 'update')->name('update')->middleware(['auth:sanctum', 'permission:attribute.update']);
        $router->delete('/{id}/destroy', 'destroy')->name('destroy')->middleware(['auth:sanctum', 'permission:attribute.destroy']);
    });
});
