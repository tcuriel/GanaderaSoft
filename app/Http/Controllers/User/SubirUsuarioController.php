<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Config\Repository;
use App\Models\modelusuario\User;
use App\Http\Controllers\fincacontroller;

class SubirUsuarioController extends Controller
{
    private $config;

    /**
     * @var FincaController
     */
    private $fincaController;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        fincacontroller $fincaController,
        Repository $config
    ){
        $this->middleware('auth');
        $this->middleware('verified.user.finca', ['except' => ['splashFinca','createmyfarm']]);
        $this->fincaController = $fincaController;
        $this->config = $config;
    }

    function seleccionarArchivo()
    {   
        
        $user = Auth::user();

        $statusFarms = config('app.statusfarm');
        $fincas = $this->fincaController->fincasPropietario($user->id,0)->getData();
        
        //print_r($fincas->data[0]->id_Finca);

        //dd($fincas->data[0]->id_Finca);

        $animalSexo = config('app.animal-sexo');
        $animalState = config('app.animal-state');
        $animalType = config('app.animal-type');
        $animalStage = config('app.animal-stage');
        $listRebano = $this->fincaController->listarRebano("Activo",$fincas->data[0]->id_Finca)->getData()->data;

        /*
        echo "Her, sy yo, soy yo,...";
        echo "<pre>[";
        print_r($user);
        echo "][";
        //print_r($response);
        echo "]</pre>";
        exit;
        */
        /*return view('usuario.seleccionar_archivo', ['user' => $user,]);*/
        return view('animal.formcreateanimal2', [
            'user' => $user,
            'statusFarms' => $statusFarms,
            'data' => $fincas->data,
            'animalSexo' => $animalSexo,
            'animalType' => $animalType,
            'animalState' => $animalState,
            'animalStage' => $animalStage,
            'listRebano' => $listRebano,
        ]);

    }

    public function seleccionarSubirUsuarios()
    {

        return view('usuario.seleccionarSubirUsuarios', [
        	'mostrar_lateral' => true,
            'mostrar_instituciones' => true,
            'mostrar_estrella_solitaria' => true,
        ]);

    }
}
