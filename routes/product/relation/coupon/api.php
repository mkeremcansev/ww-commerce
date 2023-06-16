<?php

use App\Http\Enumeration\RouteGroupNameEnumeration;
use App\Http\Enumeration\RouteGroupPathEnumeration;
use App\Http\Struct\Product\Relation\Coupon\Controller\CouponController;
use Illuminate\Support\Facades\Route;

Route::name(RouteGroupNameEnumeration::COUPON_GROUP)->prefix(RouteGroupPathEnumeration::COUPON_GROUP)->group(function ($router) {
    Route::controller(CouponController::class)->group(function ($router) {
        $router->post('/', 'index')->name('index')->middleware(['auth:sanctum', 'permission:coupon.index']);
        $router->get('/create', 'create')->name('create')->middleware(['auth:sanctum', 'permission:coupon.create']);
        $router->post('/store', 'store')->name('store')->middleware(['auth:sanctum', 'permission:coupon.store']);
        $router->patch('/{id}', 'update')->name('update')->middleware(['auth:sanctum', 'permission:coupon.update']);
        $router->get('/{id}/edit', 'edit')->name('edit')->middleware(['auth:sanctum', 'permission:coupon.edit']);
        $router->delete('/{id}/destroy', 'destroy')->name('destroy')->middleware(['auth:sanctum', 'permission:coupon.destroy']);
    });
});
