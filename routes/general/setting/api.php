<?php

use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use App\Http\Struct\Main\Setting\Controller\SettingController;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::SETTING_GROUP)->prefix(RouteGroupPathEnumeration::SETTING_GROUP)->group(function ($router) {
    $router->controller(SettingController::class)->group(function ($router) {
        $router->get('/', 'index')->name('index');
        $router->patch('/', 'update')->name('update');
    });
});
