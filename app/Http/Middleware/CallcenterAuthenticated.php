<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CallcenterAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'callcenter')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect(Route('callcenter.login'));
        }

        return $next($request);
    }
}
