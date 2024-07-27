<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\modelusuario\User;

class AdministrarController extends Controller
{
    /**
     * Verificar Afiliaciones del trascriptor.
     */
    public function verify(User $user)
    {
        return true;
    }

    /**
     * Verificar Falla. Nombre de la vista a la que redirige
     */
    public function verifyFailRoute(User $user)
    {
        return "homeImage";
    }
}
