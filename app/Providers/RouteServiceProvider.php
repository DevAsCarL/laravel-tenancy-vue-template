<?php

namespace App\Providers;

use Hyn\Tenancy\Environment;
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
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->configureRateLimiting();
        $this->routes(function () {
            $this->loadRoutesBasedOnTenancy();
        });
    }

    protected function loadRoutesBasedOnTenancy()
    {
        $hostname = app(Environment::class)->hostname();
        if ($hostname && $hostname->website) {
            $this->loadTenantRoutes();
        } else {
            $this->loadCentralRoutes();
        }
    }

    protected function loadTenantRoutes(): void
    {
        Route::middleware('web')
            ->namespace('App\Http\Controllers\Tenant')
            ->group(base_path('routes/tenant.php'));
    }

    protected function loadCentralRoutes(): void
    {
        Route::middleware('web')
            ->namespace('App\Http\Controllers\System')
            ->group(base_path('routes/system.php'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
