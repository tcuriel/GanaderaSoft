<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModelUsuario\User;

class TranscriptorController extends Controller
{
    /**
     * Verificar Afiliaciones del trascriptor.
     */
    public function verify(User $user)
    {
        return false;
    }
        
    /**
     * Verificar Falla. Nombre de la vista a la que redirige
     */
    public function verifyFailRoute(User $user)
    {
        return "afiliarPropietario";
    }
}
