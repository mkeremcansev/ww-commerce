<?php

use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Controller\AttributeValueController;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::ATTRIBUTE_VALUE_GROUP)->prefix(RouteGroupPathEnumeration::ATTRIBUTE_VALUE_GROUP)->group(function ($router) {
    $router->controller(AttributeValueController::class)->group(function ($router) {
        $router->post('/', 'index')->name('index')->middleware(['auth:sanctum', 'permission:attribute_value.index']);
        $router->get('/create', 'create')->name('create')->middleware(['auth:sanctum', 'permission:attribute_value.create']);
        $router->post('/store', 'store')->name('store')->middleware(['auth:sanctum', 'permission:attribute_value.store']);
        $router->get('/{id}/edit', 'edit')->name('edit')->middleware(['auth:sanctum', 'permission:attribute_value.edit']);
        $router->patch('/{id}', 'update')->name('update')->middleware(['auth:sanctum', 'permission:attribute_value.update']);
        $router->delete('/{id}/destroy', 'destroy')->name('destroy')->middleware(['auth:sanctum', 'permission:attribute_value.destroy']);
        $router->post('/restore', 'restore')->name('restore')->middleware(['auth:sanctum', 'permission:attribute_value.restore']);
        $router->post('/forceDelete', 'forceDelete')->name('forceDelete')->middleware(['auth:sanctum', 'permission:attribute_value.forceDelete']);
    });
});
