<?php

use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use App\Http\Struct\User\Controller\UserController;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::USER_GROUP)->prefix(RouteGroupPathEnumeration::USER_GROUP)->group(function ($router) {
    $router->controller(UserController::class)->group(function ($router) {
        $router->post('/', 'index')->name('index')->middleware(['auth:sanctum', 'permission:user.index']);
        $router->post('/authorization', 'authorization')->name('authorization');
        $router->get('/profile', 'profile')->name('profile')->middleware(['auth:sanctum', 'permission:user.profile.edit']);
        $router->patch('/profile', 'profileUpdate')->name('profileUpdate')->middleware(['auth:sanctum', 'permission:user.profile.update']);
        $router->get('/logout', 'logout')->name('logout');
        $router->get('/{id}/edit', 'edit')->name('edit')->middleware(['auth:sanctum', 'permission:user.edit']);
        $router->patch('/{id}', 'update')->name('update')->middleware(['auth:sanctum', 'permission:user.update']);
        $router->delete('/{id}/destroy', 'destroy')->name('destroy')->middleware(['auth:sanctum', 'permission:user.destroy']);
    });
});
