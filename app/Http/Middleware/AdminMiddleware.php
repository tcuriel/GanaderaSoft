<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

use Closure;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        if (!auth()->user() || strtolower(auth()->user()->type_user) !== 'administrar') {
            return redirect()->back()->with('error', 'No tienes permisos para realizar esta acción.');
        }

        return $next($request);
        
    }
}