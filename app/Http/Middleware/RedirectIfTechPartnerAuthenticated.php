<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfTechPartnerAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = 'tech_partner')
    {
        if (Auth::guard($guard)->check()) {
            return redirect(Route('tech_partner.index'));
        }

        return $next($request);
    }
}
