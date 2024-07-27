<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\modelusuario\User;
use App\Http\Controllers\fincacontroller;

class PropietarioController extends TranscriptorController
{
    /**
     * @var FincaController
     */
    private $fincaController;

    public function __construct(fincacontroller $fincaController)
    {
        $this->fincaController = $fincaController;
    }

    /**
     * Verificar Existencia de fincas del propietario.
     */
    public function verify(User $user)
    {

        $fincas = $this->fincaController->fincasPropietario($user->id,0);
        if ($fincas->getStatusCode() != 200) {
            return false;
        }
        return true;
        
    }
    
    /**
     * Verificar Falla. Redirigue a crear tu primera finca
     */
    public function verifyFailRoute(User $user)
    {
        return 'frontpagefinca';
    }
}
