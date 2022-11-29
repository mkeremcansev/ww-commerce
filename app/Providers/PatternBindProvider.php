<?php

namespace App\Providers;

use App\Http\Controllers\Product\Contract\ProductInterface;
use App\Http\Controllers\Product\Repository\ProductRepository;
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
