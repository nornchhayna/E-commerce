<?php

// namespace App\Http\Middleware;

// use Illuminate\Auth\Middleware\Authenticate as Middleware;
// use Illuminate\Support\Facades\Auth;
// use Closure;

// class RedirectIfAuthenticated extends Middleware
// {
//     public function handle($request, Closure $next, ...$guards)
//     {
//         $user = Auth::user();
//         if ($user->role === 'super_admin') {
//             return redirect()->route('super-admin.admins.index'); // Redirect to super admin dashboard
//         }
//         foreach ($guards as $guard) {
//             if (Auth::guard($guard)->check()) {
//                 return redirect('/home'); // or some other route del jg oy vea tv
//             }
//         }

//         return $next($request);
//     }
// }
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class RedirectIfAuthenticated extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                if ($user->role === 'super_admin') {
                    return redirect()->route('super-admin.admins.index'); // Redirect to super admin dashboard
                }

                return redirect('/home'); // Redirect to a different page for regular users
            }
        }

        return $next($request);
    }
}
