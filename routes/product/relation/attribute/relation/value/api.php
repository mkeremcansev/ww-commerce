<?php

use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use App\Http\Struct\Product\Relation\Attribute\Relation\AttributeValue\Controller\AttributeValueController;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::ATTRIBUTE_VALUE_GROUP)->prefix(RouteGroupPathEnumeration::ATTRIBUTE_VALUE_GROUP)->group(function ($router) {
    $router->controller(AttributeValueController::class)->group(function ($router) {
        $router->post('/', 'index')->name('index')->middleware(['auth:sanctum', 'permission:attribute.index']);
        $router->get('/create', 'create')->name('create')->middleware(['auth:sanctum', 'permission:attribute.create']);
        $router->post('/store', 'store')->name('store')->middleware(['auth:sanctum', 'permission:attribute.store']);
        $router->get('/{id}/edit', 'edit')->name('edit')->middleware(['auth:sanctum', 'permission:attribute.edit']);
        $router->patch('/{id}', 'update')->name('update')->middleware(['auth:sanctum', 'permission:attribute.update']);
        $router->delete('/{id}/destroy', 'destroy')->name('destroy')->middleware(['auth:sanctum', 'permission:attribute.destroy']);
    });
});
