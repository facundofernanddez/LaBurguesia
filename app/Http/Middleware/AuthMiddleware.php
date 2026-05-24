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
        // middleware para verificar si el usuario esta autenticado, si no lo esta redirige al login
        // si el usuario es admin redirige al dashboard de admin, si es cliente redirige a la pagina de cliente
        if (Auth::check() === false) {
            return redirect('/login');
        }

        if (Auth::user()->rol === 'admin') {
            return redirect('/admin/dashboard');
        }

        if (Auth::user()->rol === 'cliente') {
            return redirect('/');
        }

        return $next($request);
    }
}
