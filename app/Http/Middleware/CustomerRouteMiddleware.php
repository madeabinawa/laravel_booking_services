<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerRouteMiddleware
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
        if (Auth::user()) {
            if (Auth::user()->profile_type == 'App\Models\Admin' || Auth::user()->profile_type == 'App\Models\Assistant') {
                return $next($request);
            }
        }
        return redirect()->route('unauthorized');
    }
}
