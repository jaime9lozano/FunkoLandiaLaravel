<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Si el usuario no es administrador, puedes redirigirlo a donde prefieras
        return redirect('home')->with('error', 'No tienes acceso a esta sección');
    }
}
