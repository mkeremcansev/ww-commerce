<?php

use App\Http\Controllers\User\Controller\UserController;
use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::USER_GROUP)->prefix(RouteGroupPathEnumeration::USER_GROUP)->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::post('/authorization', 'authorization')->name('authorization');
        Route::get('/{id}/edit', 'edit')->name('edit')->middleware(['auth:sanctum', 'permission:user.edit']);
        Route::patch('/{id}/update', 'update')->name('update')->middleware(['auth:sanctum', 'permission:user.update']);
        Route::delete('/{id}/destroy', 'destroy')->name('destroy')->middleware(['auth:sanctum', 'permission:user.destroy']);
    });
});
