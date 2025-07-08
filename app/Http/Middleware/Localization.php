<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Determine the locale: from request, session, user, or fallback to default
        $locale = $request->get('lang')
            ?? session('locale')
            ?? (Auth::check() ? Auth::user()->locale : null)
            ?? Config::get('app.locale');

        // Set the application locale
        App::setLocale($locale);

        // Optionally, store the locale in session
        session(['locale' => $locale]);

        return $next($request);
    }
}
