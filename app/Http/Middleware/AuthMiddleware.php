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
        $isRegisterRoute = $request->routeIs('register');

        if (Auth::check()) {
            if ($isRegisterRoute) {
                return redirect('/');
            }

            if (Auth::user()?->rol?->nombre === 'admin') {
                return redirect('/admin/dashboard');
            }

            return redirect('/');
        }

        if ($isRegisterRoute) {
            return $next($request);
        }

        return redirect('/login');
    }
}
