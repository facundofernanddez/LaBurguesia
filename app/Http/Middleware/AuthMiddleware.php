<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isAuthRoute = $request->routeIs(['login', 'register']);

        if (! $isAuthRoute) {
            return $next($request);
        }

        if (Auth::check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
