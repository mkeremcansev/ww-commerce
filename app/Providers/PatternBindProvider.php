<?php

namespace App\Providers;

use App\Http\Controllers\Product\Contract\ProductInterface;
use App\Http\Controllers\Product\Relation\Category\Contract\CategoryInterface;
use App\Http\Controllers\Product\Relation\Category\Repository\CategoryRepository;
use App\Http\Controllers\Product\Repository\ProductRepository;
use App\Http\Controllers\User\Relation\Permission\Contract\PermissionInterface;
use App\Http\Controllers\User\Relation\Permission\Repository\PermissionRepository;
use App\Http\Controllers\User\Relation\Role\Contract\RoleInterface;
use App\Http\Controllers\User\Relation\Role\Repository\RoleRepository;
use Illuminate\Support\ServiceProvider;

class PatternBindProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ProductInterface::class,
            ProductRepository::class
        );
        $this->app->bind(
            CategoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            PermissionInterface::class,
            PermissionRepository::class
        );

        $this->app->bind(
            RoleInterface::class,
            RoleRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
