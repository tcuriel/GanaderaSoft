<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// Suponiendo que tu modelo de usuario es App\Models\User

use App\Models\modelusuario\User; // Importar el modelo de usuario

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) { // Verifica si hay un usuario autenticado
            return redirect()->back()->with('error', 'Debes iniciar sesión.');
        }

        if (!auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'No tienes permisos para realizar esta acción.');
        }

        return $next($request);
    }
}
