<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define the base controller namespace.
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Map routes.
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        $this->mapAdminRoutes();
        $this->mapCustomerRoutes();
    }

    protected function mapAdminRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace . '\Admin')
            ->group(base_path('routes/admin.php'));
    }

    protected function mapCustomerRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace . '\Customer')
            ->group(base_path('routes/customer.php'));
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
