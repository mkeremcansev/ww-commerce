<?php

use App\Http\Controllers\User\Controller\UserController;
use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::USER_GROUP)->prefix(RouteGroupPathEnumeration::USER_GROUP)->group(function (){
    Route::controller(UserController::class)->group(function (){
        Route::post('/authorization', 'authorization')->name('authorization');
    });
});
