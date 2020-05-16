<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthBasic
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
        try {
            if (Auth::onceBasic('login')) {
                return response()->json([], 401);
            } else {
                return $next($request);
            }
        } catch (\Exception $e) {
            return response()->json([], 401);
        }

    }
}
