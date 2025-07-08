<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckSuperAdmin
{
    public function handle($request, Closure $next)
    {
        \Log::info('CheckSuperAdmin middleware executed.');

        if (Auth::check() && Auth::user()->role === 'super_admin') {
            return $next($request);
        }

        return redirect('/login')->withErrors(['access' => 'You do not have access to this section.']);
    }
}
