<?php

namespace Modules\Authentication\app\Providers;

use Hyn\Tenancy\Environment;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     */
    protected string $moduleNamespace = 'Modules\Authentication\app\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     */
    public function boot(): void
    {
    }

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        $hostname = app(Environment::class)->hostname();
        if ($hostname && $hostname->website) {
            $this->mapApiRoutes();

            $this->mapWebRoutes();
        }
    }

    protected function loadTenantRoutes(): void
    {
        Route::middleware('web')
            ->namespace('App\Http\Controllers\Tenant')
            ->group(base_path('routes/authentication.php'));
    }
    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Authentication', '/routes/authentication.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Authentication', '/routes/api.php'));
    }
}
