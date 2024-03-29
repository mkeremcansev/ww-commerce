<?php

use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use App\Http\Struct\Product\Relation\Attribute\Controller\AttributeController;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::ATTRIBUTE_GROUP)->prefix(RouteGroupPathEnumeration::ATTRIBUTE_GROUP)->group(function ($router) {
    Route::controller(AttributeController::class)->group(function ($router) {
        $router->post('/', 'index')->name('index')->middleware(['auth:sanctum', 'permission:attribute.index']);
        $router->post('/store', 'store')->name('store')->middleware(['auth:sanctum', 'permission:attribute.store']);
        $router->get('/{id}/edit', 'edit')->name('edit')->middleware(['auth:sanctum', 'permission:attribute.edit']);
        $router->patch('/{id}', 'update')->name('update')->middleware(['auth:sanctum', 'permission:attribute.update']);
        $router->delete('/{id}/destroy', 'destroy')->name('destroy')->middleware(['auth:sanctum', 'permission:attribute.destroy']);
        $router->post('/restore', 'restore')->name('restore')->middleware(['auth:sanctum', 'permission:attribute.restore']);
        $router->post('/forceDelete', 'forceDelete')->name('forceDelete')->middleware(['auth:sanctum', 'permission:attribute.forceDelete']);
    });
});
