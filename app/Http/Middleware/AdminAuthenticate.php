<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is not authenticated or does not have the admin role
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // Redirect to the login page or an error page
            return redirect()->route('login'); // Adjust the route as needed
        }

        return $next($request);
    }
}
