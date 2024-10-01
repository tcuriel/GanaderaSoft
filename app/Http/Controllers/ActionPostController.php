<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Validators\ValidatorFactory;
use App\Validators\CreateFarmValidator;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ActionPostController extends Controller
{

    protected ValidatorFactory $validatorFactory;
    protected string $apiUrl;
    private $fincaController;

    public function __construct(
        ValidatorFactory $validatorFactory,
        FincaController $fincaController
    ) {
        $this->middleware('auth');
        $this->validatorFactory = $validatorFactory;
        $this->apiUrl = env('API_URL', 'http://localhost');
        $this->fincaController = $fincaController;
    }

    public function  create_farm(Request $request)
    {

        $dataFarm = $request->all();
        $validator = $this->validatorFactory->make(CreateFarmValidator::class, $dataFarm);
        $response = response()->json();
        
        if (!$validator->validate($dataFarm)) {
            $response = response()->json(['errors' => $validator->errors($dataFarm)], 422);
        } else {
            try {
                $url = '/Finca/crear-finca/'.Auth::user()->id;
                $data = [
                    'finca' => [
                        'Nombre' => $dataFarm['name'],
                        'Explotacion_Tipo' => $dataFarm['exploitation'],
                    ],
                    'hierro' => [
                        'Hierro_Imagen' => $dataFarm['img-iron-show'],
                        'Hierro_QR' => $dataFarm['qr-iron-show'],
                        'identificador' => null,
                    ],
                    'terreno' => [
                        'Superficie' => $dataFarm['surface'],
                        'Relieve' => $dataFarm['relief'],
                        'Suelo_Textura' => $dataFarm['soil-texture'],
                        'ph_Suelo' => $dataFarm['soil-ph'],
                        'Precipitacion' => $dataFarm['precipitation'],
                        'Velocidad_Viento' => $dataFarm['wind-speed'],
                        'Temp_Anual' => $dataFarm['annual-temperature'],
                        'Temp_Min' => $dataFarm['minimum-temperature'],
                        'Temp_Max' => $dataFarm['maximum-temperature'],
                        'Radiacion' => $dataFarm['radiation'],
                        'Fuente_Agua' => $dataFarm['water-fontain'],
                        'Caudal_Disponible' => $dataFarm['vailable-flow'],
                        'Riego_Metodo' => $dataFarm['irrigation-method'],
                    ],
                ];
                $response = response()->json([
                    'message'=> 'OK',
                    'data'=> [$data, $url],
                    'status'=>'OK'
               ],200);
            } catch (Throwable $error) {

                return response()->json(['error' => $error->getMessage()], 500);
            }
        }
        return $response;

    }
}
