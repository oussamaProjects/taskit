<?php

namespace App\Http\Middleware;

use Closure;
use Inertia\Inertia;

class ShareFlashes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Inertia::share('success', session('success', false));
        Inertia::share('errors', session('errors', false));
        return $next($request);
    }
}
