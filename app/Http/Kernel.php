<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\FraudDetection;


class Kernel extends HttpKernel
{

    protected $routeMiddleware = [
        // ... existing middleware

        'admin_auth' => \App\Http\Middleware\AdminAuthenticate::class, // Renamed key
        'admin' => \App\Http\Middleware\AdminMiddleware::class, // Keep this key for AdminMiddleware
        'auth.customer' => \App\Http\Middleware\CustomerAuthenticate::class,
        'auth.admin' => \App\Http\Middleware\AdminAuthenticate::class,
        'auth' => \App\Http\Middleware\Authenticate::class,
        'super_admin' => \App\Http\Middleware\CheckSuperAdmin::class,
        'admin_data_separation' => \App\Http\Middleware\AdminDataSeparation::class,
        'admin.data' => \App\Http\Middleware\AdminDataSeparation::class,
        'localization' => \App\Http\Middleware\Localization::class,
    ];
}
