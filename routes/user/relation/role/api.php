<?php

use App\Http\Controllers\User\Relation\Role\Controller\RoleController;
use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::ROLE_GROUP)->prefix(RouteGroupPathEnumeration::ROLE_GROUP)->group(function ($router) {
    $router->controller(RoleController::class)->group(function ($router) {
        $router->post('/', 'index')->name('index')->middleware(['auth:sanctum', 'permission:role.index', 'permission:permission.index']);
        $router->get('/create', 'create')->name('create')->middleware(['auth:sanctum', 'permission:role.create', 'permission:permission.create']);
        $router->post('/store', 'store')->name('store')->middleware(['auth:sanctum', 'permission:role.store', 'permission:permission.store']);
        $router->get('/{id}/edit', 'edit')->name('edit')->middleware(['auth:sanctum', 'permission:role.edit', 'permission:permission.edit']);
        $router->patch('/{id}', 'update')->name('update')->middleware(['auth:sanctum', 'permission:role.update', 'permission:permission.update']);
        $router->delete('/{id}/destroy', 'destroy')->name('destroy')->middleware(['auth:sanctum', 'permission:role.destroy', 'permission:permission.destroy']);
    });
});
