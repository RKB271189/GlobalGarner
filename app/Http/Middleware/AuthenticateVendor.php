<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateVendor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'vendor')
    {
        if (!auth()->guard($guard)->check())
            return redirect()->route('login')->with('message', 'You are not authorized to view this page');
        return $next($request);
    }
}
