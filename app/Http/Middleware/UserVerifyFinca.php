<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Config\Repository;

class UserVerifyFinca
{
     /**
     * @var repositorio de clases
     */
    private $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Obtén el usuario autenticado
        $user = $request->user();

        // Si no hay usuario autenticado
        if (!$user) {
            return redirect()->route('login');
        }

        $typeUser = $user->type_user;// verificar tipo de usuaro
        $controllerClass = $this->config->get('app.acciones.' . $typeUser);
        if (!class_exists($controllerClass)) {
            abort(404);
        }
        
        $classUser = app()->make($controllerClass);
        if (!$classUser->verify($user)){
            return redirect()->route($classUser->verifyFailRoute($user));
        }

        return $next($request);
    }
}
