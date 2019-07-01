<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfLeadAssistantAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = 'lead_assistant')
    {
        if (Auth::guard($guard)->check()) {
            return redirect(Route('lead_assistant.index'));
        }

        return $next($request);
    }
}
