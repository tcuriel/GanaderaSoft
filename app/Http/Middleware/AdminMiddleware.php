<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;

use Closure;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        /*if (!auth()->check()) { // Verifica si hay un usuario autenticado
            return redirect()->back()->with('error', 'Debes iniciar sesión.');
        }*/

        /*if (!auth()->user() || auth()->user()->type_user !== 'Administrar') {
            return redirect()->back()->with('error', 'No tienes permisos para realizar esta acción.');
        }*/

        if (!auth()->user() || strtolower(auth()->user()->type_user) !== 'administrar') {
            return redirect()->back()->with('error', 'No tienes permisos para realizar esta acción.');
            
            // En un controlador:
            //return redirect()->route('login'); // Redirige a la ruta 'home'

            // En un middleware:
            //return redirect()->back(); // Redirige a la página anterior
        }

        return $next($request);
    }
}