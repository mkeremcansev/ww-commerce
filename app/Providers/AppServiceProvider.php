<?php

namespace App\Providers;

use App\Http\Struct\Product\Model\Product;
use App\Http\Struct\Product\Relation\Brand\Model\Brand;
use App\Observers\BrandObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Brand::observe(BrandObserver::class);
        Product::observe(ProductObserver::class);
    }
}
