<?php

use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use App\Http\Struct\Product\Relation\Category\Controller\CategoryController;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::CATEGORY_GROUP)->prefix(RouteGroupPathEnumeration::CATEGORY_GROUP)->group(function ($router) {
    $router->controller(CategoryController::class)->group(function ($router) {
        $router->post('/', 'index')->name('index')->middleware('auth:sanctum', 'permission:category.index');
        $router->get('/create', 'create')->name('create')->middleware('auth:sanctum', 'permission:category.create');
        $router->post('/store', 'store')->name('store')->middleware('auth:sanctum', 'permission:category.store');
        $router->get('/{id}/edit', 'edit')->name('edit')->middleware('auth:sanctum', 'permission:category.edit');
        $router->patch('/{id}', 'update')->name('update')->middleware('auth:sanctum', 'permission:category.update');
        $router->delete('/{id}/destroy', 'destroy')->name('destroy')->middleware('auth:sanctum', 'permission:category.destroy');
        $router->post('/restore', 'restore')->name('restore')->middleware(['auth:sanctum', 'permission:category.restore']);
        $router->post('/forceDelete', 'forceDelete')->name('forceDelete')->middleware(['auth:sanctum', 'permission:category.forceDelete']);
    });
});
