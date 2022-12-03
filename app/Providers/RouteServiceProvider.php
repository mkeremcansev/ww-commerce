<?php

namespace App\Providers;

use App\Exceptions\ResponseHandler;
use App\Http\Enumeration\RouteGroupThrottleEnumeration;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php')) // General router API's
                ->group(base_path('routes/product/api.php')) // Product router API's
                ->group(base_path('routes/product/relation/category/api.php')) // Category router API's
                ->group(base_path('routes/product/relation/attribute/api.php')) // Attribute router API's
                ->group(base_path('routes/brand/api.php')) // Brand router API's
                ->group(base_path('routes/user/api.php')) // uSER router API's
            ;

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(RouteGroupThrottleEnumeration::RATE_LIMIT)->by($request->user()?->id ?: $request->ip())->response(function (){
                return ResponseHandler::tooManyRequests();
            });
        });
    }
}
