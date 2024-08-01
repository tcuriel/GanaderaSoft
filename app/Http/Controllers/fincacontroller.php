<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
use Illuminate\Database\QueryException;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\FincaRequests\fincaStoreRequest;
use App\Http\Requests\FincaRequests\fincaRequest;
use App\Http\Requests\FincaRequests\terrenoRequest;
use App\Http\Requests\FincaRequests\hierroRequest;
use App\Http\Requests\FincaRequests\rebanoRequest;
use App\Http\Requests\FincaRequests\personalFincaRequest;
use App\Http\Requests\FincaRequests\movimiento_rebanoRequest;
use App\Http\Requests\FincaRequests\movimiento;
use App\Http\Requests\csvRequests\csvRequest;
use App\Models\modelfinca\finca;
use App\Models\modelfinca\hierro;
use App\Models\modelfinca\terreno;
use App\Models\modelfinca\rebano;
use App\Models\modelfinca\afiliacion;
use App\Models\modelfinca\personal_finca;
use App\Models\modelfinca\inventario_general;
use App\Models\modelfinca\inventario_bufalo;
use App\Models\modelfinca\inventario_vacuno;
use App\Models\modelfinca\movimiento_rebano;
use App\Models\modelfinca\movimiento_rebano_animal;
use App\Models\modelusuario\propietario;
use App\Models\modelusuario\transcriptor;
use App\Models\modelanimal\animal;
use App\Models\modelsanidad\palpacion;
use App\Models\modelreproduccion\servicio_animal;
use App\Models\modelanimal\registro_pesocor;

use Illuminate\Support\Facades\Auth;


class fincacontroller extends Controller
{
    protected finca $finca;
    protected afiliacion $afiliacion;
    protected hierro $hierro;
    protected propietario $propietario;
    protected transcriptor $transcriptor;
    protected movimiento_rebano_animal $movRebanoAnimal;

    
    public function __construct()
    {
        $this->finca = new finca;
        $this->afiliacion = new afiliacion;
        $this->hierro = new hierro;
        $this->propietario = new propietario;
        $this->transcriptor = new transcriptor;
        $this->movRebanoAnimal = new movimiento_rebano_animal;
    }
   
    public function fincaStore(fincaStoreRequest $request, $idPropietario)
    {
        //metodo que verifica si la informacion esta definida y no es nula
        if(isset($request->validated()['finca'])){
            //se crea la instancia de finca y se le asigna el id que se envia por parametro
            $fincaData = $request->validated()['finca'];
            //try{
                DB::transaction(function() use ($request, $fincaData, $idPropietario, &$data) {
                    $fincaData["id_Propietario"] = $idPropietario;
                    $fincaData["Archivado"] = false;
                    
                    $finca = finca::create($fincaData);

                    //metodo que verifica si la informacion esta definida y no es nula
                    if(isset($request->validated()['hierro']) || isset($request->validated()['terreno'])){
                        
                        //crea la instancia y en caso de alguno no recibir datos se le da un valor predeterminado
                        $hierroData = $request->validated()['hierro'] ?? [];
                        $terrenoData = $request->validated()['terreno'] ?? [];

                        $finca_id = $finca->id_Finca;
                        $hierroData['id_Propietario'] = $idPropietario; //se asinga el parametro id para la relacion propietaario-
                        $hierroData['id_Finca'] = $finca_id;
                        $terrenoData['id_Finca'] = $finca_id;

                        $campos = ['Superficie', 'Precipitacion', 'Velocidad_Viento', 'Caudal_Disponible', 'Radiacion'];
                        foreach ($campos as $campo) {
                            if (isset($terrenoData[$campo])) {
                                $terrenoData[$campo] = floatval($terrenoData[$campo]);
                            }
                        }
                        
                        //obtenermos los campos donde se almacena la imagen y QR del hierro
                        $imagenHierro = $hierroData['hierro']['Hierro_Imagen'] ?? [];
                        $QRHierro = $hierroData['hierro']['Hierro_QR'] ?? [];
                        //creamos una instancia para usar el metodo del modelo hierro
                        $hierroImg = new hierro;
                        $obtenerImagen = $hierroImg->verificarImagen($request, $imagenHierro);
                        $obtenerQR = $hierroImg->verificarImagen($request, $QRHierro);

                        $hierroData['id'] = $idPropietario; //se asinga el parametro id para la relacion propietaario-
                        $hierroData['id_Finca'] = $finca_id;
                        $hierroData['Hierro_Imagen'] = $obtenerImagen;
                        $hierroData['Hierro_QR'] = $obtenerQR;
                        
                        $hierro = hierro::create($hierroData);
                        $terreno = terreno::create($terrenoData);

                    }else{
                        //se busca el id de la finca para asignarlo hierro y terreno para la relacion con finca
                        $finca_id = $finca->id_Finca;
                        $hierroData['id_Propietario'] = $idPropietario; //se asinga el parametro id para la relacion propietaario-
                        $hierroData['id_Finca'] = $finca_id;
                        $terrenoData['id_Finca'] = $finca_id;

                        $hierro = hierro::create($hierroData);
                        $terreno = terreno::create($terrenoData);
                    }
                
                    $data=[
                        'Finca'=>$finca,
                        'Hierro'=>$hierro,
                        'terreno'=>$terreno
                    ];
                });
            /*}catch(\Exception $e){
                return response()->json([
                        'message'=>'Ha habido una falla al crear la finca, intente de nuevo.',
                        'data'=>[],
                        'status'=>'Error'
                ],500);
            }*/

            return response()->json([
                    'message'=> 'La finca ha sido creada con exito,',
                    'data'=>$fincaData,
                    'status'=>'OK'
            ],201);
        } else {
            return response()->json([
                'message'=> 'Error en los campos',
                'data'=> [],
                'status'=>'Bad Request'
            ],400);
        }

    }

    public function rebanoStore(rebanoRequest $request, $idFinca)
    {
        //metodo que verifica si la informacion esta definida y no es nula
        if(isset($request->validated()['rebano'])){

            $rebanoData = $request->validated()['rebano'];
            $rebanoData['id_Finca'] = $idFinca;
            $rebanoData['Archivado'] = false;
        try{
            $rebano = rebano::create($rebanoData);

            $data=[
                'rebano'=>$rebano
            ];
         }catch(\Exception $e){
             return response()->json([
                    'message'=>'Ha habido un fallo al crear el rebaño, intente de nuevo',
                    'data'=>[],
                    'status'=>'Error'
             ],500);
         }
           return response()->json([
                'message'=> 'El rebaño ha sido creado con exito,',
                'data'=>$data,
                'status'=>'OK'
           ],201);
        }
    }

    public function personalFincaStore(personalFincaRequest $request, $idFinca)
    {
        //metodo que verifica si la informacion esta definida y no es nula
        if(isset($request->validated()['personal_finca'])){
            $personalData = $request->validated()['personal_finca'];
            $personalData['id_Finca'] = $idFinca;
            try{
                $personalData['Cedula'] = preg_replace('/^([VEJPG|vejpg])\-?(\d+)(?:-\d+)?$/', '$2', $personalData['Cedula']);//QUITAR CORREGIR CEDULA EN BASEDEDATOS
                $personal = personal_finca::create($personalData);

                $data=[
                    'personal'=>$personal
                ];

                return response()->json([
                        'message'=>'Se ha ingresado el registro de personal con exito',
                        'data'=>$data,
                        'status'=>'OK'
                ],201);

            }catch(\Exception $e){
                return response()->json([
                        'message'=>'Ha habido un fallo al registar el personal, intente de nuevo.',
                        'data'=>[],
                        'status'=>'Error'
                ],500);
            }
          
        }
    }

    public function inventarioGeneralStore($idFinca){
        //obtiene el numero de trabajadores en la finca
        $count = DB::table('Personal_Finca')->where('id_Finca',$idFinca)->count();
        $fecha = Carbon::now();
        $fecha = $fecha->format('Y-m-d');

        $inventarioData['id_Finca'] = $idFinca;
        $inventarioData['Num_Personal'] = $count;
        $inventarioData['Fecha_Inventario'] = $fecha;
        try{
            $inventario = inventario_general::create($inventarioData);

            $data=[
                'invventario'=>$inventario
            ];

            return response()->json([
                'message'=>'Su inventario general ha sido contabilizado con exito',
                'data'=>$data,
                'status'=>'OK'
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Ha ocurrido un problema al contabilizar su inventario. Intente de nuevo',
                'data'=>[],
                'status'=>'Error'
            ],500);
        }
    }
  
    public function inventarioVacunoStore($idFinca)
    {

        $Estados = DB::table('Animal')->where('id_Finca',$idFinca)->where('Tipo','Vacuno')->pluck('Estado');
        $Estado = $Estados->countBy();
        $fecha = Carbon::now();
        $fecha = $fecha->format('Y-m-d');
      try{
        $inventarioVacuno = inventario_vacuno::create([
                                'id_Finca' => $idFinca,
                                'Num_Becerra' => isset($Estado['Becerra']) ? $Estado['Becerra'] : 0,
                                'Num_Mauta' => isset($Estado['Mauta']) ? $Estado['Mauta'] : 0,
                                'Num_Novilla' => isset($Estado['Novilla']) ? $Estado['Novilla'] : 0,
                                'Num_Vaca' => isset($Estado['Vaca']) ? $Estado['Vaca'] : 0,
                                'Num_Becerro' => isset($Estado['Becerro']) ? $Estado['Becerro'] : 0,
                                'Num_Maute' => isset($Estado['Maute']) ? $Estado['Maute'] : 0,
                                'Num_Torete' => isset($Estado['Torete']) ? $Estado['Torete'] : 0,
                                'Num_Toro' => isset($Estado['Toro']) ? $Estado['Toro'] : 0,
                                'Fecha_Inventario' => $fecha
                                ]);

        $data=[
            'invventario'=>$inventarioVacuno
            ];
       }catch(\Exception $e){
        return response()->json([
            'message'=>'Ha ocurrido un problema al contabilizar su inventario. Intente de nuevo.',
            'data'=>[],
            'status'=>'Error'
        ],500);
       }
        return response()->json([
            'message'=>'Su inventario vacuno ha sido contabilizado con exito.',
            'data'=>$data,
            'status'=>'OK'
        ],200);
    }

    public function inventarioBufaloStore($idFinca)
    {

        $Estados = DB::table('Animal')->where('id_Finca',$idFinca)->where('Tipo','Bufalo')->pluck('Estado');
        $Estado = $Estados->countBy();
        $fecha = Carbon::now();
        $fecha = $fecha->format('Y-m-d');
      try{
        $inventarioBufalo = inventario_bufalo::create([
                                'id_Finca' => $idFinca,
                                'Num_Becerro' => isset($Estado['Becerro']) ? $Estado['Becerro'] : 0,
                                'Num_Anojo' => isset($Estado['Anojo']) ? $Estado['Anojo'] : 0,
                                'Num_Bubilla' => isset($Estado['Bubilla']) ? $Estado['Bubilla'] : 0,
                                'Num_Bufalo' => isset($Estado['Bufalo']) ? $Estado['Bufalo'] : 0,
                                'Fecha_Inventario' => $fecha
                                ]);

        $data=[
            'invventario'=>$inventarioBufalo
            ];
       }catch(\Exception $e){
        return response()->json([
            'message'=>'Ha ocurrido un problema al contabilizar su inventario, intente de nuevo.',
            'data'=>[],
            'status'=>'Error'
        ],500);
       }
        return response()->json([
            'message'=>'Su inventario de bufalo ha sido contabilizado con exito.',
            'data'=>$data,
            'status'=>'OK'
        ],200);
      
    }


//   ------------------ AREA DE LISTADO --------------------------

    //metodo para buscar las fincas relacionadas a un propietario
    public function fincasPropietario($id_P,$tipoListado)
    {
      try{
        //tipo de listado es 0 para fincas activas y 1 para archivadas
            $fincas = DB::table('finca')->where('id_Propietario', $id_P)
                                        ->where('Archivado', $tipoListado)->get();
        
        if($fincas->isEmpty()){
            return response()->json([
                'message' => 'El usuario '.$id_P.' no tiene fincas creadas',
                'data' => [],
                'code' => 'NO_FINCAS_CREADAS',
                'status' => 'OK'
            ], 204);
        }else{
            return response()->json([
                'message' => 'Fincas del usuario '.$id_P,
                'data' => $fincas,
                'code' => 'NO_FINCAS_CREADAS',
                'status' => 'OK'
            ], 200);
        }
     }catch(\Exception $e){
        return $this->manejarExcepcion($e);
     }
    }

    //metodo para buscar el hierro relacionada a una finca
    public function hierroFinca($id)
    {
      try{
        $propietario = propietario::find($id);
        $hierroFinca = $propietario->hierroPropietario;

        if($hierroFinca->isEmpty()){
            return response()->json([
                'message'=>'No hay informacion de hierro de esta finca',
                'data'=>[],
                'status'=>'OK'
            ],204);
        }else{
            $hierroFinca['Hierro_Imagen'] = $this->hierro->convertirBlobAIMG($hierroFinca['Hierro_Imagen']);
            $hierroFinca['Hierro_QR'] = $this->hierro->convertirBlobAIMG($hierroFinca['Hierro_QR']);


            return response()->json([
                'message'=>'Informacion del hierro de la finca.',
                'data'=>$hierroFinca,
                'status'=>'OK'
            ],200);
        }
     }catch(\Exception $e){
        return $this->manejarExcepcion($e);
     }
    }

    //metodo para listar el personal de una finca
    public function fincaPersonal($idfinca)
    {
      try{
        $finca = finca::find($idfinca);
        $personal = $finca->personalfinca;

        if($personal->isEmpty()){
            return response()->json([
                'message'=>'Esta finca no posee personal registrado, ingrese uno.',
                'data'=>[],
                'code'=>'NO_PERSONAL_REGISTRADO',
                'status'=>'OK'
            ],204);
        }else{
         return response()->json([
            'message'=>'Este es el personal registrado en la finca',
            'data'=>$personal,
            'status'=>'OK'
         ],200);
        }
     }catch(\Exception $e){
        return $this->manejarExcepcion($e);
     }
    }

    //metodo para listar rebaños de una finca
    public function listarRebano($tipoListado,$idFinca)
    {

        $feilters = config('app.filter-renano');
        $filterType = [];
        foreach ($feilters as $filter) {
            $filterType[] = $filter;
        }

        if(!(in_array(strval($tipoListado), $filterType))){
            return response()->json([
                'message'=>'El tipo de listado enviado no existe.',
                'data'=>[],
                'code'=>'LISTADO_NO_EXISTE',
                'status'=>'OK'
            ],200);
        }else{

            $archivado = $tipoListado == "Activo" ? 0 : 1;
            $rebanos = DB::table('rebano')->where('id_Finca', $idFinca)->where('Archivado', $archivado)->get();
        
            if ($rebanos->isEmpty()) {
                return response()->json([
                    'message'=>'Esta finca no posee rebaño registrado, cree uno',
                    'data'=>[],
                    'code'=>'NO_REBAÑOS_CREADOS',
                    'status'=>'OK'
                ],204);
            } else {
                return response()->json([
                    'message'=>'Rebaños asociados a la finca',
                    'data'=>$rebanos,
                    'status'=>'OK'
                ],200);
            }
        }
    }
    
    public function listarInvGeneral($idFinca)
    {
        $finca = finca::find($idFinca);
        $invGeneral = $finca->inventarioGenerales;

        if(!is_null($invGeneral)){
            $invGeneral = $invGeneral->get();

            if($invGeneral->isEmpty()){
                return response()->json([
                    'message'=>'No hay inventarios generales contabilizados',
                    'data'=>[],
                    'code'=>'NO_INVENTARIO_CONTABILIZADO_GENERAL',
                    'status'=>'OK'
                ],204);
            }else{
                return response()->json([
                    'message'=>'Inventarios generales contabilizados para esta finca',
                    'data'=> json_decode($invGeneral),
                    'status'=>'OK'
                ],200);
            }
        } else {

            return response()->json([
                'message'=>'No hay inventarios vacunos contabilizados',
                'data'=>[],
                'code'=>'NO_INVENTARIO_CONTABILIZADO_VACUNO',
                'status'=>'OK'
            ],204);
        }
    }

    public function listarInvVacuno($idFinca)
    {
        $finca = finca::find($idFinca);
        $invVacuno = $finca->inventarioVacunos;

        if(!is_null($invVacuno)){
            $invVacuno = $invVacuno->get();

            if($invVacuno->isEmpty()){
                return response()->json([
                    'message'=>'No hay inventarios vacunos contabilizados',
                    'data'=>[],
                    'code'=>'NO_INVENTARIO_CONTABILIZADO_VACUNO',
                    'status'=>'OK'
                ],204);
            }else{
                return response()->json([
                    'message'=>'Inventarios vacunos contabilizados para esta finca',
                    'data'=> json_decode($invVacuno),
                    'status'=>'OK'
                ],200);
            }
        } else {

            return response()->json([
                'message'=>'No hay inventarios vacunos contabilizados',
                'data'=>[],
                'code'=>'NO_INVENTARIO_CONTABILIZADO_VACUNO',
                'status'=>'OK'
            ],204);
        }
    }

    public function listarInvBufalo($idFinca)
    {
        $finca = finca::find($idFinca);
        $invBufalo = $finca->inventarioBufalos;

        if(!is_null($invBufalo)){
            $invBufalo = $invBufalo->get();
            
            if($invBufalo->isEmpty()){
                return response()->json([
                    'message'=>'No hay inventarios bufala contabilizados',
                    'data'=>[],
                    'code'=>'NO_INVENTARIO_CONTABILIZADO_BUFALO',
                    'status'=>'OK'
                ],204);
            }else{
                return response()->json([
                    'message'=>'Inventarios bufala contabilizados para esta finca',
                    'data'=> json_decode($invBufalo),
                    'status'=>'OK'
                ],200);
            }
        } else {
            return response()->json([
                'message'=>'No hay inventarios vacunos contabilizados',
                'data'=>[],
                'code'=>'NO_INVENTARIO_CONTABILIZADO_VACUNO',
                'status'=>'OK'
            ],204);
        }
    }

    // ---------LISTADOS POR FILTRADO---------

    public function filtrarFincas($categoria,$filtrado,$idPropietario)
    {
      try{
        switch ($categoria){
            case "Nombre":
                $fincas = DB::table('finca')->where('id_Propietario',$idPropietario)->where('Nombre',$filtrado)->get();

                if ($fincas->isEmpty()) {
                    return response()->json([
                        'message'=>'No se encontro alguna finca por este nombre',
                        'data'=>[],
                        'code'=>'NO_FINCAS_ENCONTRADAS_NOMBRE',
                        'status'=>'OK'
                    ],204);
                } else {
                return response()->json([
                    'message'=>'Fincas filtradas por nombre',
                    'data'=>$fincas,
                    'status'=>'OK'
                ],200);
                }
            break;

            case "Identificacion":
                $fincas = DB::table('finca')->where('id_Propietario',$idPropietario)
                                            ->where('id_Finca',$filtrado)->get();
                    //---------------------------------
                if ($fincas->isEmpty()) {
                    return response()->json([
                        'message'=>'No se encontro alguna finca por esta identificacion',
                        'data'=>[],
                        'code'=>'NO_FINCAS_ENCONTRADAS_ID',
                        'status'=>'OK'
                    ],204);
                } else {
                return response()->json([
                    'message'=>'Fincas filtradas por identificacion',
                    'data'=>$fincas,
                    'status'=>'OK'
                ],200);
                }
            break;
            default:
                return response()->json([
                    'message'=>'No se encontro alguna finca por filtro',
                    'data'=>[],
                    'code'=>'NO_FINCAS_ENCONTRADAS_FILTRO',
                    'status'=>'OK'
                ],204);
            break;
        }
    }catch(\Exception $e){
        return $this->manejarExcepcion($e);
     }
    }

    public function filtrarPersonal($categoria,$filtrado,$idFinca){
     try{
        switch ($categoria){
            case "Nombre":
                $personal = DB::table('Personal_Finca')->where('id_Finca',$idFinca)->where('Nombre',$filtrado)->get();

                if ($personal->isEmpty()) {
                    return response()->json([
                        'message'=>'No se ha encontrado informacion del personal buscado por nombre',
                        'data'=>[],
                        'status'=>'OK'
                    ],204);
                } else {
                return response()->json([
                    'message'=>'Personal filtrado por nombre',
                    'data'=>$personal,
                    'status'=>'OK'
                ],200);
                }
            break;

            case "Correo":
                $personal = DB::table('Personal_Finca')->where('id_Finca',$idFinca)->where('Correo',$filtrado)->get();
                if ($personal->isEmpty()) {
                    return response()->json([
                        'message'=>'No se ha encontrado informacion del personal buscado por correo',
                        'data'=>[],
                        'status'=>'OK'
                    ],204);
                } else {
                return response()->json([
                    'message'=>'Personal filtrado por correo',
                    'data'=>$personal,
                    'status'=>'OK'
                ]);
                }
            break;

            case "Cedula":
                $personal = DB::table('Personal_Finca')->where('id_Finca',$idFinca)->where('Cedula',$filtrado)->get();
                if ($personal->isEmpty()) {
                    return response()->json([
                        'message'=>'No se ha encontrado informacion del personal buscado por identificacion',
                        'data'=>[],
                        'status'=>'OK'
                    ]);
                } else {
                return response()->json([
                    'message'=>'Personal filtrado por identificacion',
                    'data'=>$personal,
                    'status'=>'OK'
                ]);
                }
            break;
            default:
                return response()->json([
                    'message'=>'No se encontro personal',
                    'data'=>[],
                    'status'=>'OK'
                ],204);
            break;
        }
    }catch(\Exception $e){
        return $this->manejarExcepcion($e);
    }
    }

    public function filtrarRebano($filtrado,$idFinca)
    {
     try{
        $rebano = DB::table('rebano')->where('id_Finca',$idFinca)->where('Nombre',$filtrado);
         if($rebano->isEmpty()){
            return response()->json([
                'message'=>'No se encontro algun rebaño por este nombre',
                'data'=>[],
                'code'=>'NO_REBAÑO_FILTRADO_NOMBRE',
                'status'=>'OK'
            ],204);
        } else {
        return response()->json([
            'message'=>'Rebaños de la finca filtrados por nombre',
            'data'=>$rebano,
            'status'=>'OK'
        ],200);
        }
    }catch(\Exception $e){
        return $this->manejarExcepcion($e);
    }
    }

    public function filtraInventario($fecha,$idFinca,$tipo)
    {
     try{
        $fecha = Carbon::parse($fecha);
        $inventario = DB::table('$tipo')->where('id_Finca',$idFinca)->where('Fecha_Inventario',$fecha);
        
        if($inventario->isEmpty()){
            return response()->json([
                'message'=>'No se encontro inventario en esta fecha',
                'data'=>[],
                'code'=>'NO_INVENTARIO_FILTRADO_FECHA',
                'status'=>'OK'
            ],204);
        } else {
            return response()->json([
                'message'=>'Inventarios filtrados por la fecha',
                'data'=>$inventario,
                'status'=>'OK'
            ],200);
        }
     }catch(\Exception $e){
        return $this->manejarExcepcion($e);
     }
    }

//-----------AREA DE ACTUALIZAR/MODIFICAR INFORMACION
 
    public function fincaUpdate(fincaRequest $request, $id)
    {
      //metodo que verifica si la informacion esta definida y no es nula
     if(isset($request->validated()['finca'])){
        $fincaData = $request->validated()['finca'];
       try{
        $finca = finca::findOrFail($id);
        $finca->update($fincaData);

        $data =[
            'finca' => $finca
        ];
    }catch(\Exception $e){
        return response()->json([
            'message'=>'Ha habido una fallo al modificar registo de la finca, vuelve a intentarlo',
            'data'=>[],
            'status'=>'Error'
        ],500);
    }
        return response()->json([
            'message'=>'Se ha modificado el registro de finca con exito',
            'data'=>$data,
            'status'=>'OK'
        ],200);
     }
    }

    public function rebanoUpdate(rebanoRequest $request, $id_Finca)
    {
        if(isset($request->validated()['rebano'])){
            $rebanoData = $request->validated()['rebano'];
          try{
            $rebano = rebano::firstOrNew(['id_Finca'=>$id_Finca],['id_Finca'=>$id_Finca]);
            $rebano->fill($rebanoData);
            $rebano->save();

            $data = [
                  'rebano' => $rebano
            ];
           }catch(\Exception $e){
            return response()->json([
                'message'=>'Ha habido un fallo al modificar el registro de rebaño, intente de nuevo',
                'data'=>[],
                'status'=>'Error'
            ],500);
           }
               /*return resposne()->json([
                'message'=>'Se ha modifica el registro de rebaño con exito',
                'data'=>$data,
                'status'=>'OK'
               ],200);*/
        }
    }

    public function terrenoUpdate(terrenoRequest $request, $id)
    {
        if(isset($request->validated()['terreno'])){
            $terrenoData = $request->validated()['terreno'];
          try{
            $terreno = terreno::firstOrNew(['id_Finca'=>$id] , ['id_Finca'=>$id]);
            $terreno->fill($terrenoData);
            $terreno->save();

            $data =[
                'terreno' => $terreno
            ];
          }catch(\Exception $e){
            return response()->json([
                'message'=>'Ha habido un fallo al modificar el registro de terreno, vuelve a intentarlo',
                'data'=>[],
                'status'=>'OK'
            ],500);
          }
            return response()->json([
                'message'=>'Se ha modificado el registro de terreno con exito',
                'data'=>$data,
                'status'=>'OK'
            ],200);
        }
    }

    public function hierroUpdate(hierroRequest $request, $id,$id_P)
    {
        if(isset($request->validated()['hierro'])){
            $hierroData = $request->validated()['hierro'];
          try{
            $hierro = hierro::firstOrNew(['id_Finca'=>$id, 'id_Propietario'=>$id_P]  //Si el registro no existe
                                        , ['id_Finca'=>$id, 'id_Propietario'=>$id_P]); //asigna los campos en el nuevo registro
            //---------------------------------------------------
            $hierro->fill($hierroData);
            $hierro->save();

            $data =[
                'hierro' => $hierro
            ];
        }catch(\Exception $e){
            return response()->json([
                'message'=>'Ha habido un fallo al modificar el regitro de hierro, vuelve a intentarlo',
                'data'=>[],
                'status'=>'OK'
            ],500);
          }
            return response()->json([
                'message'=>'Se ha modificado el registro de hierro con exito',
                'data'=>$data,
                'status'=>'Ok'
            ],200);

        }
    }

    public function personalUpdate(personalFincaRequest $request, $cedula,$idFinca)
    {
        if(isset($request->validated()['personal_finca'])){
          $personalData = $request->validated()['personal_finca'];
          $personalData['Cedula'] = preg_replace('/^([VEJPG|vejpg])\-?(\d+)(?:-\d+)?$/', '$2', $personalData['Cedula']);//QUITAR CORREGIR CEDULA EN BASEDEDATOS
        try{
          $personal = personal_finca::firstOrNew(['Cedula'=>$cedula, 'id_Finca'=>$idFinca]
                                                ,['Cedula'=>$cedula, 'id_Finca'=>$idFinca]);
          $personal->fill($personalData);
          $personal->save();

          $data =[
            'personal' => $personal
        ];
    }catch(\Exception $e){
        return response()->json([
            'message'=>'Ha habido un fallo al modifica el registro del personal, vuelve a intentarlo',
            'data'=>[],
            'status'=>'OK'
        ],500);
      }
        return response()->json([
            'message'=>'Se ha modificado el registro del personal con exito',
            'data'=>$data,
            'status'=>'OK'
        ],200);

        }
    }

    // ------- METODOS DE ELIMINACION DE REGISTROS --------
    public function eliminarFinca(movimiento $request,$id_Finca,$eliminacion){
     try{
        $fincaData = finca::find($id_Finca);
        if($fincaData){
            if($eliminacion=='Completo'){
                $fincaData->delete();

         $data =[
            'finca' => $fincaData
         ];
          return response()->json([
            'message'=>'Se ha eliminado el registro de finca con exito',
            'data'=>$data,
            'status'=>'OK'
          ],200);
        }elseif($eliminacion=='Parcial'){
           $datos = $request->validated()['movimiento'];
            //Este movimiento sera exclusivamente dentro de la misma finca
            if($datos['id_Finca']==$datos['id_Finca_Destino']){
                $this->moverRebano($datos,$datos['id_Finca'],$datos['id_Finca'],$datos['id_Rebano_Destino'],
                                    $datos['id_Rebano'],'Local',$datos['cantidad']);
                                    
                 
                    DB::table('animal')->whereIn('id_Rebano',$idRebano)->delete();
                    $fincaData->delete();
            }
        }else{
          return response()->json([
            'message'=>'No se ha encontrado finca con esta identificacion',
            'data'=>[],
            'status'=>'OK'
          ],204);
      }
    }
  }catch(\Exception $e){
    return $this->manejarExcepcion($e);
  }
}

  public function eliminarHierro($idHierro){
    try{
        $hierroData = hierro::find($idHierro);
        if($hierroData){
         $hierroData->delete();

         $data =[
            'hierro' => $hierroData
         ];
        return response()->json([
            'message'=>'Se ha eliminado el registro del hierro con exito',
            'data'=>$data,
            'status'=>'OK'
        ],200);
     }else{
        return response()->json([
            'message'=>'No se ha encontrado hierro con esta identificacion',
            'data'=>[],
            'status'=>'OK'
        ],204);
     }
    }catch(\Exception $e){
      return $this->manejarExcepcion($e);
    }
  }

  public function eliminarTerreno($idTerreno){
    try{
        $terrenoData = terreno::find($idTerreno);
         if($terrenoData){
            $terrenoData->delete();
          
            $data =[
             'terreno' => $terrenoData
              ];
        return response()->json([
            'message'=>'Se ha eliminado el registro del terreno con exito',
            'data'=>$data,
            'status'=>'OK'
        ],200);
      
      }else{
        return response()->json([
            'message'=>'No se ha encontrado informacion del terreno',
            'data'=>[],
            'status'=>'OK'
        ],204);
      }
    }catch(\Exception $e){
      return $this->manejarExcepcion($e);
    }
  }

  public function eliminarRebano(movimiento $request,$idRebano,$eliminacion){
    try{
        $rebanoData = rebano::find($idRebano);
        if($rebanoData){
            if($eliminacion=='Completo'){
                $rebanoData->delete();
                DB::table('animal')->whereIn('id_Rebano',$idRebano)->delete();
      
        $data =[
            'rebaño' => $rebanoData
        ];
        return response()->json([
            'message'=>'Se elimino el registro de rebaño del sistema',
            'data'=>$data,
            'status'=>'OK'
        ],200);
    }elseif($eliminacion=='Parcial'){
        $datos = $request->validated()['movimiento'];
        //Este movimiento sera exclusivamente dentro de la misma finca
        if($datos['id_Finca']==$datos['id_Finca_Destino']){
            $this->moverRebano($datos,$datos['id_Finca'],$datos['id_Finca'],$datos['id_Rebano_Destino'],
                                $datos['id_Rebano'],'Local',$datos['cantidad']);

                $rebanoData->delete();
                DB::table('animal')->whereIn('id_Rebano',$idRebano)->delete();
      
                $data =[
                    'rebaño' => $rebanoData
                       ];
              return response()->json([
                     'message'=>'Se elimino el registro de rebaño del sistema',
                    'data'=>$data,
                   'status'=>'OK'
                   ],200);
        }else{
            return response()->json([
                'message' => 'El id de la finca debe ser el mismo',
                'data'=> $datos['id_Finca'],
                'status' => 'OK'
            ],200);
        }
    }
      }else{
        return response()->json([
            'message' => 'No se encontro el rebano',
            'data'=> [],
            'status' => 'OK'
        ],204);
      }
    }catch(\Exception $e){
      return $this->manejarExcepcion($e);
    }
  } //---------------------------------------------

    public function eliminarPersonal($cedula){
       try{
        $personalTemporal = DB::table('personal_finca')->where('Cedula',$cedula)->first();

        if($personalTemporal===null){

            return response()->json([
                'message'=>'No se encontro registro del personal',
                'data'=>[],
                'status'=>'OK'
            ],200);
        }else{
            $personalData = DB::table('personal_finca')->where('Cedula',$cedula)->delete();
            $data =[
              'personal' => $personalData
            ];
            return response()->json([
              'message'=>'Se ha eliminado el registro del personal',
              'data'=>$data,
              'status'=>'OK'
            ],200);
        }
     }catch(\Exception $e){
        return response->json([
            'message'=>'Ha habido un fallo al eliminar el registro, intente de nuevo',
            'data'=>[],
            'status'=>'Error'
        ],500);
     }
    }

    public function eliminarInventario($tipoInventario, $idInventario){
      try{
        switch ($tipoInventario){
        
         case "General":
         $inventarioData = inventario_general::find($idInventario);
         if($inventarioData){
             $inventarioData->delete();

                $data =[
                  'inventario' => $inventarioData
                ];
                return response()->json([
                    'message'=>'Se elimino el regitro del inventario',
                    'data'=>$data,
                    'status'=>'OK'
                ],200);
           
            }else{
             return response()->json([
                'message'=>'No se ha encontrado informacion del inventario general',
                'data'=>[],
                'status'=>'OK'
             ],204);
            }
        break;

        case "bufalo":
            $inventarioData = inventario_bufalo::find($idInventario);
            if($inventarioData){
                $inventarioData->delete();
            
                   $data =[
                     'inventario' => $inventarioData
                   ];
                   return response()->json([
                    'message'=>'Se ha eliminado el registro del inventario de bufalo',
                    'data'=>$data,
                    'status'=>'OK'
                   ],200);
               
               }else{
                return response()->json([
                    'message'=>'No se ha encontrado informacion del inventario de bufalo',
                    'data'=>[],
                    'status'=>'OK'
                ],204);
               }
        break;

        case "vacuno":
            $inventarioData = inventario_vacuno::find($idInventario);
            if($inventarioData){
                $inventarioData->delete();
                
                   $data =[
                     'inventario' => $inventarioData
                   ];
                   return response()->json([
                    'message'=>'Se ha eliminado el registro del inventario vacuno',
                    'data'=>$data,
                    'status'=>'OK'
                   ],200);
              
               }else{
                return response()->json([
                    'message'=>'No se ha encontrado informacion del inventario vacuno',
                    'data'=>[],
                    'status'=>'OK'
                ],204);
               }
        break;

        default:
        break;
        
    }
  }catch(\Exception $e){
    return $this->manejarExcepcion($e);
  }
}

//-----------------AREA DE ARCHIVAR-----------------

public function archivarFinca(movimiento_rebanoRequest $request,$idFinca,$tipoArchivado)
{
  try{
   $fincaArchivo = DB::table('finca')->where('id_Finca',$idFinca)->first();
   

    if($tipoArchivado=='Completo'){
        $fincaArchivo['Archivado'] = true;

        $fincaArchivo->save();

        $rebanos = DB::table('rebano')->where('id_Finca',$idFinca)->get();
        foreach($rebanos as $rebano){
            $this->archivarRebano($rebano->id_Rebano,'Completo');
        }

    }elseif($tipoArchivado=='Parcial'){
        $fincaArchivo['Archivado'] = true;

        $fincaArchivo->save();
        $datos = $request->validated()['movimiento'];
        $rebanos = DB::table('rebano')->whereIn('id_Rebano',$datos['ids'])->get();

        foreach($rebanos as $rebano){
            $this->archivarRebano($rebano->id_Rebano,'Parcial');
        }
    }

   $data=[
    'Finca' => $fincaArchivo
   ];
  }catch(\Exception $e){
    return response()->json([
        'message'=>'Ha habido un fallo al archivar la finca, vuelve a intentarlo',
        'data'=>[],
        'status'=>'Error'
    ],500);
  }
   return response()->json([
    'message'=>'Se ha archivado la finca con exito',
    'data'=>$data,
    'status'=>'OK'
   ],200);
}

public function archivarRebano(movimiento $request,$idRebano,$tipArchivado)
{
  try{
    $rebanoArchivo = DB::table('rebano')->where('id_Rebano',$idRebano)->first();

    switch($tipArchivado){

        case "Completo":
            $rebanoArchivo['Archivado'] = true;

            if($rebanoArchivo->save()){

            $data=[
                'Rebano' => $rebanoArchivo
            ];

            return response()->json([
                'message'=>'Se ha archivado el registro del rebaño con su informacion',
                'data'=>$data,
                'status'=>'OK'
            ],200);
        }else{
            return response()->json([
                'message'=>'Ha habido un problema al archivar el rebaño, intentelo de nuevo',
                'data'=>[],
                'status'=>'Error'
            ],500);
        }
        break;

        case "Parcial": //En esta area se llamara al metodo mover rebaño
            $datos = $request->validated()['movimiento'];

            $this->moverRebano($datos,$datos['id_Finca'],$datos['id_Finca_Destino'],$datos['id_Rebano_Destino'],
                                $datos['id_Rebano'],$datos['Tipo'],$datos['cantidad']);

                $rebanoArchivo['Archivado'] = true;

                if($rebanoArchivo->save()){
                    
                 $data=[
                    'Rebano' => $rebanoArchivo
                    ];
                    
                return response()->json([
                     'message'=>'Se ha archivado el registro del rebaño con su informacion',
                     'data'=>$data,
                     'status'=>'OK'
                     ],200);
                 }else{
                     return response()->json([
                      'message'=>'Ha habido un problema al archivar el rebaño, intentelo de nuevo',
                      'data'=>[],
                     'status'=>'Error'
                 ],500);
            }
        break;

        default:
        break;
    }
  }catch(\Exception $e){
    return $this->manejarExcepcion($e);
  }
  
}

// -------------- METODO DE MOVER REBAÑO -----------

public function moverRebano(movimiento_rebanoRequest $request,$idFincaBase,$idFincaD,$rebanoDestino,$rebanoBase,$tipoMovimiento,$cantidadAnimales)
{
try{
  if($tipoMovimiento=="Local")
  {
    $data = $this->movivimientoLocal($request,$idFincaBase,$rebanoDestino,$rebanoBase,$cantidadAnimales);

    return $this->enviarRespuesta('Se ha realizado el movimiento con exito'
                                     ,$data,'OK',200);
  }elseif($tipoMovimiento=="Foraneo")
  {
    $data = $this->movimientoForaneo($request,$idFincaBase,$idFincaD,$rebanoDestino,$rebanoBase,$cantidadAnimales);

    return $this->enviarRespuesta('Se ha creado la solicitud de movimiento'
                                     ,$data,'OK',200);
  }
}catch(\Exception $e){
  return $this->manejarExcepcion($e);
}
}

//Se realiza cuando el movimiento es dentro de la misma finca
public function movivimientoLocal(movimiento_rebanoRequest $request,$idFinca,$rebanoDestino,$rebanoBase,$tipoMovimiento)
{
  try{
        $idsAnimal = $request->validated()['movimiento'];

        if($this->movRebanoAnimal->movimientoPendiente($idsAnimal['ids'])){
            return $this->enviarRespuesta('Hay animales en estado de Pendiente en sus movimientos'
                                      ,[],'OK',200);
        }
        DB::transaction(function() use ($idsAnimal,$idFinca,$rebanoDestino,$rebanoBase,$tipoMovimiento,
                                     &$movimiento)
        {

        $registroRebano = DB::table('Rebano')->where('id_Rebano',$rebanoDestino)->first();
        $nombreRebano = $registroRebano->Nombre;
        


        $movimientoData['Comentario'] = $idsAnimal['Comentario'];
        $movimientoData['id_Finca'] = $idFinca;
        $movimientoData['id_Rebano'] = $rebanoBase;
        $movimientoData['id_Finca_Destino'] = $idFinca;
        $movimientoData['id_Rebano_Destino'] = $rebanoDestino;
        $movimientoData['Rebano_Destino'] = $nombreRebano;

        $movimiento = movimiento_rebano::create($movimientoData);
//---
     //Se mueve todo el listado de animales del rebaño
     if($tipoMovimiento=="Completo"){
       $animales = $this->movimientoCompleto($idFinca,$rebanoBase,$rebanoDestino);

       foreach($animales as $animal){
        $rebanoAnimalData['id_Movimiento'] = $movimiento->id_Movimiento;
        $rebanoAnimalData['id_Animal'] = $animal->id_Animal;
        $rebanoAnimalData['Estado'] = "Aceptado";
        $rebanoAnimalData['solicitud_recepetor'] = 1; //Lo recibe el mismo propietario
        $rebanoAnimalData['Motivo'] = $idsAnimal['Motivo'];

        $movimientoAnimal[] = movimiento_rebano_animal::create($rebanoAnimalData);
        }

    }elseif($tipoMovimiento=="Parcial"){
        $animalesParciales = $this->movimientoParcial($idFinca,$rebanoBase,$idsAnimal['ids']);

        foreach($animalesParciales as $animal){
            $rebanoAnimalData['id_Movimiento'] = $movimiento->id_Movimiento;
            $rebanoAnimalData['id_Animal'] = $animal->id_Animal;
            $rebanoAnimalData['Estado'] = "Aceptado";
            $rebanoAnimalData['solicitud_recepetor'] = 1; //lo recibe el mismo propietario
            $rebanoAnimalData['Motivo'] = $idsAnimal['Motivo'];
    
            $movimientoAnimal[] = movimiento_rebano_animal::create($rebanoAnimalData);
            DB::table('animal')->where('id_Finca',$idFinca)->where('id_Rebano',$rebanoBase)
                                ->where('id_Animal',$animal->id_Animal)->update(['id_Rebano' => $rebanoDestino]);
        }
    }
        });
       return   [
                 'movimiento' => $movimiento,
                ];
    }catch(\Exception $e){
        return $this->manejarExcepcion($e);
    }

}

//Se realiza cuando el movimiento es a un rebaño de una finca exterior
public function movimientoForaneo(movimiento_rebanoRequest $request,$idFincaBase,$idFincaD,$rebanoDestino,$rebanoBase,$tipoMovimiento)
{
  try{
    $idsAnimal = $request->validated()['movimiento'];

    if($this->movRebanoAnimal->movimientoPendiente($idsAnimal['ids'])){
        return $this->enviarRespuesta('Hay animales en estado de Pendiente en sus movimientos'
                                  ,[],'OK',200);
    }
    DB::transaction(function() use ($idsAnimal,$idFincaBase,$rebanoDestino,$rebanoBase,$tipoMovimiento,
                                 $idFincaD,&$movimiento)
    {

    $registroRebano = DB::table('Rebano')->where('id_Rebano',$rebanoDestino)->first();
    $nombreRebano = $registroRebano->Nombre;
 
    $movimientoData['Comentario'] = $idsAnimal['comentario'];
    $movimientoData['id_Finca'] = $idFincaBase;
    $movimientoData['id_Rebano'] = $rebanoBase;
    $movimientoData['id_Finca_Destino'] = $idFincaD;
    $movimientoData['id_Rebano_Destino'] = $rebanoDestino;
    $movimientoData['Rebano_Destino'] = $nombreRebano;

    $movimiento = movimiento_rebano::create($movimientoData);
//---
 //Se mueve todo el listado de animales del rebaño
 if($tipoMovimiento=="Completo"){
   $animales = DB::table('animal')->where('id_Finca',$idFincaBase)->where('id_Rebano',$rebanoBase);

   foreach($animales as $animal){
    $rebanoAnimalData['id_Movimiento'] = $movimiento->id_Movimiento;
    $rebanoAnimalData['id_Animal'] = $animal->id_Animal;
    $rebanoAnimalData['Estado'] = "Pendiente";
    $rebanoAnimalData['solicitud_recepetor'] = 0; //Lo recibe el propietario que se le envia la peticion
    $rebanoAnimalData['Motivo'] = $idsAnimal['motivo'];

    $movimientoAnimal[] = movimiento_rebano_animal::create($rebanoAnimalData);
    }

}elseif($tipoMovimiento=="Parcial"){
    $animalesParciales = $this->escogerAnimales($idFincaBase,$rebanoBase,$idsAnimal['ids']);

    foreach($animalesParciales as $animal){
        $rebanoAnimalData['id_Movimiento'] = $movimiento->id_Movimiento;
        $rebanoAnimalData['id_Animal'] = $animal->id_Animal;
        $rebanoAnimalData['Estado'] = "Pendiente";
        $rebanoAnimalData['solicitud_recepetor'] = 0; //lo recibe el mismo propietario
        $rebanoAnimalData['Motivo'] = $idsAnimal['motivo'];

        $movimientoAnimal[] = movimiento_rebano_animal::create($rebanoAnimalData);
    }
}
    });
   return   [
             'movimiento' => $movimiento,
            ];
    }catch(\Exception $e){
      return $this->manejarExcepcion($e);
    }
}

//Genera el movimiento de todos los animales del rebaño escogido
public function movimientoCompleto($idFinca,$rebanoBase,$rebanoDestino)
{
  try{
  return DB::table('animal')->where('id_Finca',$idFinca)->where('id_Rebano',$rebanoBase)
                            ->update(['id_Rebano' => $rebanoDestino]);
  }catch(QuertException $e){
    return $this->manejarExcepcion($e);
  }
}

public function movimientoParcial($idFinca,$idRebano,...$ids)
{
    return $this->escogerAnimales($idFinca,$idRebano,...$ids);
}

public function escogerAnimales($idFinca,$idRebano,...$ids)
    {
      try{
        $ids = Arr::flatten($ids);
        $animales = DB::table('animal')->where('id_Finca',$idFinca)->where('id_Rebano',$idRebano)
                                        ->whereIn('id_Animal',$ids)->get();

         if($animales->isEmpty()){

         }else{
            return $animales;
         }
      }catch(\Exception $e){
        return $this->manejarExcepcion($e);
      }
    }

  public function listarMovimientosPendientes($idFinca)
  {
    try{
    $movimientos = DB::table('movimiento_rebano')
            ->join('movimiento_rebano_animal', 'movimiento_rebano_animal.id_Movimiento', '=', 'movimiento_rebano.id_Movimiento')
            ->where('movimiento_rebano.id_Finca_Destino', $idFinca)->where('movimiento_rebano_animal.Estado','Pendiente')
            ->get();

            if($movimientos->isEmpty()){
                return $this->enviarRespuesta('No hay movimientos',[],'OK',200);
            }else{
            return $this->enviarRespuesta('Movimientos Pendientes para su finca',$movimientos,'OK',200);
            }
    }catch(QueryException $e){
      return $this->manejarExcepcion($e);
    }
  }

  public function actualizarEstadoMovimiento($estado,$idMovimiento)
  {
  try{
    switch($estado){

       case 'Aceptar':
        DB::transaction(function() use ($idMovimiento){

        $idRebano = DB::table('movimiento_rebano')->where('id_Movimiento',$idMovimiento)->first()->id_Rebano_Destino;
        $idFinca = DB::table('movimiento_rebano')->where('id_Movimiento',$idMovimiento)->first()->id_Finca_Destino;

        DB::table('movimiento_rebano_animal')->where('id_Movimiento',$idMovimiento)->update(['Estado'=>'Aceptado']);
        $animales = DB::table('movimiento_rebano_animal')->where('id_Movimiento',$idMovimiento)->pluck('id_Animal');

        DB::table('animal')->whereIn('id_Animal',$animales)->update(['id_Rebano'=>$idRebano , 'id_Finca'=>$idFinca]);
        });
        return $this->enviarRespuesta('Se actualizo el estado del movimiento',[],'OK',200);
           
        break;
    
       case 'Denegar':
        DB::table('movimiento_rebano_animal')->where('id_Movimiento',$idMovimiento)->update(['Estado'=>'Denegado']);
        
        return $this->enviarRespuesta('Se actualizo el estado del movimiento',[],'OK',200);
        break;

        default:
        break;
    }
  }catch(\Exception $e){
    return $this->manejarExcepcion($e);
  }
  }

    
// -------------- METODOS DE AFILIACION -------------
    public function crearAfiliacion($tipo,$idFinca,$idPropietario,$idTranscriptor)
    {
        if(!$this->transcriptor->existeTranscriptor($idTranscriptor)){
            return $this->enviarRespuesta('El usuario transcriptor no ha sido seleccionado o encontrado.
                                        Intente de nuevo',[],'OK',200);
        }
        if(!$this->propietario->existePropietario($idPropietario)){
            return $this->enviarRespuesta('El usuario propietario no ha sido seleccionado o encontrado.
            Intente de nuevo',[],'OK',200);
        }
        if(!$this->finca->existeFinca($idFinca)){
            return $this->enviarRespuesta('La finca no ha sido seleccionada o encontrada. Intente de nuevo'
            ,[],'OK',200);
        }
        if($this->afiliacion->existeAfiliacion($idPropietario,$idTranscriptor)){
            return $this->enviarRespuesta('Ya existe una solicitud de afiliacion enviada, espere su respuesta'
                                                ,[],'Accepted',202);
        }

        try{
            //El propietario genera la solicitud de afiliacion al transcriptor
            if($tipo=="Transcriptor"){
             $afiliacionData =[
             'id_Personal_P' => $idPropietario,
             'id_Personal_T' => $idTranscriptor,
             'id_Finca' => $idFinca,
             'Estado' => "Pendiente",
             'receptor_solicitud' => 0 //El 0= Transcriptor recibe la solicitud
            ];
            //el transcriptor realiza la peticion a la finca
            }elseif($tipo=="Finca"){
             $afiliacionData =[
             'id_Personal_P' => $idPropietario,
             'id_Personal_T' => $idTranscriptor,
             'id_Finca' => $idFinca,
             'Estado' => "Pendiente",
             'receptor_solicitud' => 1 //El 1= Propietario recibe la solicitud
             ];
            }
            $afiliacion = afiliacion::create($afiliacionData);
            $data=[
            'afiliacion'=>$afiliacion
            ];

             return $this->enviarRespuesta('Se ha creado la solicitud con exito,espere la respuesta del Usuario'
                                            ,$data,'OK',201);
            //------------------------------------------------
        }catch(\Exception $e){
          return $this->manejarExcepcion($e,'uno');
        }

    }

    public function actualizarEstadoAfiliacion($estado,$idPropietario,$idTranscriptor,$idFinca)
    {
             try{
                $afiliacionTemporal = $this->afiliacion->buscarAfiliacion($idPropietario,$idTranscriptor,$idFinca);
 
                if($afiliacionTemporal){

                    if($afiliacionTemporal->Estado=='Pendiente'){
                      
                          if($estado=="Aceptar"){
                            $estadoNuevo = $this->afiliacion->cambiarEstadoAfiliacion('Aceptado',$idPropietario,$idTranscriptor,$idFinca);
                          }elseif($estado=="Denegar"){
                            $estadoNuevo = $this->afiliacion->cambiarEstadoAfiliacion('Denegado',$idPropietario,$idTranscriptor,$idFinca);
                          }
                            $data =[
                            'afiliacion' => $estadoNuevo
                            ];
                            return $this->enviarRespuesta('Se ha cambiado el estado de la afiliacion',$data,'OK',200);
                           
                    }else{
                        $this->enviarRespuesta('La peticion ya ha sido modificada anteriormente',[],'OK',200);
                    }
                }else{
                    $this->enviarRespuesta('No se ha encontrado informacion de la afiliacion buscada',[],'OK',200);
                }
            }catch(\Exception $e){
                return $this->manejarExcepcion($e);
                }
        }

    public function listarAfiliaciones($tipoUser, $id)
    {
      try{
    //Las afiliaciones se listaran segun sea el tipo de usuario que haga la peticion
        if($tipoUser=="Propietario"){
            $afiliaciones = DB::table('afiliacion')->where('id_Personal_P',$id)->where('receptor_solicitud',1)->get();

            return response()->json([
                'message'=>'Solicitudes de afiliaciones',
                'data'=>$afiliaciones,
                'status'=>'OK'
            ],200);
         }else{
            $afiliaciones = DB::table('afiliacion')->where('id_Personal_T',$id)->where('receptor_solicitud',0)->get();

            return response()->json([
                'message'=>'Solicitudes de afiliaciones',
                'data'=>$afiliaciones,
                'status'=>'OK'
            ]);
        }
      }catch(\Exception $e){
        return $this->manejarExcepcion($e);
      }
    }

    //Listara todas las actividades que ha hecho un personal
    public function actividadesPersonal($idPersonal)
    {
      try{
        $actividades = DB::table('servicio_animal')
                    ->select('servicio_animal.*')
                    ->where('servicio_animal.id_Tecnico',$idPersonal)
                    ->union(DB::table('registro_pesocor'))
                    ->select('registro_pesocor.*')
                    ->where('registro_pesocor.id_Tecnico',$idPersonal)
                    ->union(DB::table('palpacion'))
                    ->select('palpacion.*')
                    ->where('palpacion.id_Tecnico',$idPersonal)
                    ->get();

            if($actividades.isEmpty()){
                return $this->enviarRespuesta('Este personal no tiene actividades hechas'
                                        ,[],'OK',200);
            }else{
            return $this->enviarRespuesta('Actividades hechas por el personal'
                                        ,$actividades,'OK',200);
            }
      }catch(QueryException $e){
        return $this->manejarExcepcion($e);
      }
    }


    private function manejarExcepcion($excepcion)
    {
        // Registra el error en el log
        Log::error($excepcion->getMessage());
    
        // Devuelve la respuesta JSON con el mensaje de error
        return response()->json([
            'message' => 'Ha habido un fallo al ejecutar la accion en. Intente de nuevo',
            'data' => [],
            'status' => 'Error'
        ], 500);
    }

    private function enviarRespuesta($mensaje,$datos,$estado,$codigoRetorno)
    {
    return response()->json([
        'message' => $mensaje,
        'data' => $datos,
        'status' => $estado
    ], $codigoRetorno);
    }
    
    public function getFarm($idfinca) {

        $finca = Finca::find($idfinca);
        
        if (is_null($finca)) {
            return response()->json([
                'message' => 'Esta finca no existe.',
                'data' => [],
                'code' => 'NO_FINCA',
            ], 404);
        }
    
        $finca = json_decode($finca);
        $rebano = json_decode($this->listarRebano($idfinca, 'Activo'));
        $personal = json_decode($this->fincaPersonal($idfinca));

        return response()->json([
            'message' => 'Datos finca',
            'data' => [$finca, $rebano, $personal],
        ], 200);

    }

    public function getFarmFullData($idfinca) {

        $finca = Finca::find($idfinca);
        
        if (is_null($finca)) {
            return response()->json([
                'message' => 'Esta finca no existe.',
                'data' => [],
                'code' => 'NO_FINCA',
            ], 404);
        }
    
        $finca = json_decode($finca);
        $hierro = Hierro::where('id_finca', $idfinca)->first();
        $hierro = is_null($hierro)?$hierro:json_decode($hierro);
        $terreno = Terreno::where('id_finca', $idfinca)->first();
        $terreno = is_null($terreno)?$terreno:json_decode($terreno);

        return response()->json([
            'message' => 'Datos finca',
            'data' => [$finca, $hierro, $terreno],
        ], 200);

    }

    public function getRebano($idRebano) {

        $rebanoArchivo = DB::table('Rebano')->where('id_Rebano',$idRebano)->first();
        if (is_null($rebanoArchivo)) {
            return response()->json([
                'message' => 'Este rebano no existe.',
                'data' => [],
                'code' => 'NO_REBANO',
            ], 404);
        }

        return response()->json([
            'message' => 'Datos rebano',
            'data' => $rebanoArchivo,
        ], 200);

    }

    public function getPersonal($idPersonal) {

        $personalArchivo = DB::table('Personal_Finca')->where('id_Tecnico',$idPersonal)->first();
        if (is_null($personalArchivo)) {
            return response()->json([
                'message' => 'Este personal no existe.',
                'data' => [],
                'code' => 'NO_REBANO',
            ], 404);
        }

        return response()->json([
            'message' => 'Datos personal',
            'data' => $personalArchivo,
        ], 200);

    }

    public function inventarioGeneralGet($idInventario) {

        $personalArchivo = DB::table('Inventario_General')->where('id_Inv',$idInventario)->first();
        if (is_null($personalArchivo)) {
            return response()->json([
                'message' => 'Este inventario no existe.',
                'data' => [],
                'code' => 'NO_REBANO',
            ], 404);
        }

        return response()->json([
            'message' => 'Datos inventario',
            'data' => $personalArchivo,
        ], 200);

    }

    public function inventarioVacunoGet($idInventario) {

        $personalArchivo = DB::table('Inventario_Vacuno')->where('id_Inv_V',$idInventario)->first();
        if (is_null($personalArchivo)) {
            return response()->json([
                'message' => 'Este inventario no existe.',
                'data' => [],
                'code' => 'NO_REBANO',
            ], 404);
        }

        return response()->json([
            'message' => 'Datos inventario',
            'data' => $personalArchivo,
        ], 200);

    }

    public function inventarioBufaloGet($idInventario) {

        $personalArchivo = DB::table('Inventario_Bufalo')->where('id_Inv_B',$idInventario)->first();
        if (is_null($personalArchivo)) {
            return response()->json([
                'message' => 'Este inventario no existe.',
                'data' => [],
                'code' => 'NO_REBANO',
            ], 404);
        }

        return response()->json([
            'message' => 'Datos inventario',
            'data' => $personalArchivo,
        ], 200);

    }

    public function addFincaMasivo(csvRequest $request) {
        try{
            $archivo = fopen($request->file('archivo')->getPathname(), 'r');
      
            if ($archivo === false) { //verifico si se abrio el archivo o no
              return response()->json([
                  'message' => 'No se pudo abrir el archivo CSV.',
                  'status' => 'ERROR'
              ], 500);
          }
          $archivoAbierto = true;

            LazyCollection::make(function () use ($archivo) { //lee el archivo en tiempo real
              while ($fila = fgetcsv($archivo, 0, ';')) {
                  yield $fila;
              }
             })->chunk(100)->each(function ($chunk) use ($request, &$erroresValidacion) {
                foreach ($chunk as $fila) {
      
                if ($fila[0] === 'Nombre') {
                    continue; // Omitir la primera fila
                }
                    // Lógica para procesar cada fila
                    $nombre = $fila[0];
                    $explotacion = $fila[1];
                    $identificador_Hierro = $fila[2];
                    $datetime = now();
                  
                    $lote_Finca = [
                      'id_Propietario'=> $request->validated()['id_Propietario'],
                      'Nombre' => $nombre,
                      'Explotacion_Tipo'=> $explotacion,
                      'Archivado'=> false,
                      'created_at'=> $datetime,
                      'updated_at'=> $datetime
                    ];

                    $validator = $this->validatorFinca($lote_Finca); //realizo la validacion

                    if ($validator->fails()) {
                      $erroresValidacion[] = $validator->errors();
                      return false; // Detener el procesamiento de más filas
                  }

                   $ids_Finca = DB::table('finca')->insertGetId($lote_Finca);

                    $lote_Hierro = [
                      [
                        'id_Finca'=> $ids_Finca,
                        'identificador' => $identificador_Hierro,
                        'id_Propietario'=> $request->validated()['id_Propietario'],
                        'created_at'=> $datetime,
                        'updated_at'=> $datetime
                      ]
                    ];

                    $this->addHierroMasivo($lote_Hierro);
              }
            
            });
              
            if ($archivoAbierto) {
              fclose($archivo);
          }
  
          if (!empty($erroresValidacion)) { //Avisa si hay un dato no valido
              return response()->json([
                  'message' => 'Se encontraron errores de validación.',
                  'status' => 'ERROR',
                  'errors' => $erroresValidacion
              ], 422);
          }
              return response()->json(['message'  => 'Datos procesados correctamente',
                                      'status'=>'OK'
      ],201);
      
            }catch(\Exception $e){
              $this->manejarExcepcion($e);
            }
    }

    public function addHierroMasivo(array $dataHierro) {
      try{
        
        $chunks = array_chunk($dataHierro, 100);

       foreach($chunks as $chunk){
        DB::table('Hierro')->insert($chunk);
       }

       unset($dataHierro);
    
      }catch(\Exception $e){
        $this->manejarExcepcion($e);
      }
    }

    protected function validatorFinca(array $data) {

      return Validator::make($data, [ //validaciones internas
        'Nombre' => 'required|max:25',
        'Explotacion_Tipo' => 'required|in:Intensiva,Extensiva,Mixta',
        'identificador' => 'nullable|string|size:10'
      ]);
    }
}
