<?php

use App\Http\Controllers\User\Controller\UserController;
use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::USER_GROUP)->prefix(RouteGroupPathEnumeration::USER_GROUP)->group(function ($router) {
    $router->controller(UserController::class)->group(function ($router) {
        $router->post('/authorization', 'authorization')->name('authorization');
        $router->get('/{id}/edit', 'edit')->name('edit')->middleware(['auth:sanctum', 'permission:user.edit']);
        $router->patch('/{id}/update', 'update')->name('update')->middleware(['auth:sanctum', 'permission:user.update']);
        $router->delete('/{id}/destroy', 'destroy')->name('destroy')->middleware(['auth:sanctum', 'permission:user.destroy']);
    });
});
