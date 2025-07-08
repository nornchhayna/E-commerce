<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customer.login'); // Adjust login route as needed
        }

        return $next($request);
    }
}
