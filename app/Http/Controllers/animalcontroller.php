<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\LazyCollection;
use Illuminate\Support\Facades\Validator;
//MODELOS
use App\Models\modelanimal\animal;
use App\Models\modelanimal\arbol_genetica;
use App\Models\modelanimal\cambios_animal;
use App\Models\modelanimal\composicion_raza;
use App\Models\modelanimal\historico_cambio;
use App\Models\modelanimal\historico_indicescor;
use App\Models\modelanimal\historico_medidascor;
use App\Models\modelanimal\indices_corporales;
use App\Models\modelanimal\medidas_corporales;
use App\Models\modelanimal\peso_corporal;
use App\Models\modelanimal\raza_animal;
use App\Models\modelanimal\raza_toro;
use App\Models\modelanimal\registro_pesocor;
use App\Models\modelanimal\tipo_raza;
use App\Models\modelanimal\Toro;
use App\Models\modelanimal\semen_toro;
use App\Models\modelfinca\finca;
use App\Models\modelfinca\movimiento_rebano_animal;
//REQUESTS
use App\Http\Requests\AnimalRequests\animalRequest;
use App\Http\Requests\AnimalRequests\modificarAnimalRequest;
use App\Http\Requests\AnimalRequests\razaRequest;
use App\Http\Requests\AnimalRequests\cambioRequest;
use App\Http\Requests\AnimalRequests\MedidasRequest;
use App\Http\Requests\AnimalRequests\indiceRequest;
use App\Http\Requests\AnimalRequests\toroRequest;
use App\Http\Requests\AnimalRequests\semenRequest;
use App\Http\Requests\AnimalRequests\pesoRequest;
use App\Http\Requests\AnimalRequests\arbolRequest;
use App\Http\Requests\csvRequests\csvRequest;
use Illuminate\Support\Facades\Storage; 

class animalcontroller extends Controller
{
  protected animal $animal;
  protected composicion_raza $composicion;
  protected cambios_animal $cambioA;
  protected medidas_corporales $medidas;
  protected indices_corporales $indices;
  protected peso_corporal $pesos;
  protected registro_pesocor $registroPeso;


  public function __construct()
  {
    $this->animal = new animal;
    $this->composicion = new composicion_raza;
    $this->cambioA = new cambios_animal;
    $this->medidas = new medidas_corporales;
    $this->indices = new indices_corporales;
    $this->pesos = new peso_corporal;
 
  }
    //---------------AREA DE ANIMAL------------------
    public function getAnimals(int $id_Rebano){
      try{
        $animales = DB::table('animal')->join('etapa_animal','etapa_animal.etan_animal_id','=','animal.id_Animal')
                                       ->join('etapa','etapa_animal.etan_etapa_id','=','etapa.etapa_id')
                                        ->select('animal.Nombre','animal.codigo_animal',
                                          'animal.Sexo','animal.fecha_nacimiento','etapa_nombre',
                                          'etapa_animal.etan_animal_id','animal.id_Animal')
                                        ->where('animal.id_Rebano',$id_Rebano)
                                        ->where('etan_fecha_fin',null)
                                        ->where('animal.archivado',0)
                                        ->get();

          return response()->json([
              'message'=> 'animales del rebaño',
              'data'=>$animales,
              'status'=>'OK'
          ],200);
      }catch(\Excepcion $e){
        return $this->manejarExcepcion($e);
      }
    }

    public function getTipoAnimal(){
      try{
          $tipo = DB::table('tipo_animal')->get();

          return response()->json([
            'message'=> 'tipo',
            'data'=>$tipo,
            'status'=>'OK'
        ],200);
      }catch(\Excepcion $e){
        return $this->manejarExcepcion($e);
      }
    }

    public function getEtapaAnimal(int $etapa_id){
      try{
        $etapa = DB::table('etapa')->where('etapa_fk_tipo_animal_id',$etapa_id)->get();

        return response()->json([
          'message'=> 'tipo',
          'data'=>$etapa,
          'status'=>'OK'
      ],200);
    }catch(\Excepcion $e){
      return $this->manejarExcepcion($e);
    }
    }

    public function getSalud(){
      try{
        $salud = DB::table('estado_salud')->get();

        return response()->json([
          'message'=> 'tipo',
          'data'=>$salud,
          'status'=>'OK'
        ],200);
      }catch(\Excepcion $e){
      return $this->manejarExcepcion($e);
      }
    }

    public function getRebanos(int $id_finca){
      try{
        $rebano = DB::table('rebano')->where('id_Finca',$id_finca)->get();

        return response()->json([
          'message'=> 'rebanos',
          'data'=>$rebano,
          'status'=>'OK'
        ],200);
      }catch(\Excepcion $e){
      return $this->manejarExcepcion($e);
      }
    }

    public function getRazas(int $id_finca){
      try{
        $raza = DB::table('composicion_raza')->where('fk_id_Finca',$id_finca)
                                             ->orWhere('fk_id_Finca',null)
                                             ->select('id_Composicion','Nombre')
                                             ->get();

        return response()->json([
          'message'=> 'razas',
          'data'=>$raza,
          'status'=>'OK'
        ],200);
      }catch(\Excepcion $e){
      return $this->manejarExcepcion($e);
      }
    }

    public function detailAnimal(int $id_Animal){
      try{
          $detalle = DB::table('animal')->join('etapa_animal','etapa_animal.etan_animal_id','=','animal.id_Animal')
                                        ->join('etapa','etapa_animal.etan_etapa_id','=','etapa.etapa_id')
                                        ->join('tipo_animal','tipo_animal.tipo_animal_id','=','etapa.etapa_fk_tipo_animal_id')
                                        ->join('composicion_raza','animal.fk_composicion_raza','=','composicion_raza.id_Composicion')
                                        ->join('estado_animal','estado_animal.esan_fk_id_animal','=','animal.id_Animal')
                                        ->join('estado_salud','estado_salud.estado_id','=','estado_animal.esan_fk_estado_id')
                                        ->join('rebano','rebano.id_Rebano','=','animal.id_Rebano')
                                        ->select('animal.Nombre as animal_nombre','animal.codigo_animal',
                                            'animal.Sexo','animal.fecha_nacimiento','animal.Procedencia',
                                            'etapa_nombre','composicion_raza.Nombre','tipo_animal.tipo_animal_nombre',
                                            'estado_salud.estado_nombre','rebano.Nombre as rebano')
                                            ->where('etan_fecha_fin',null)
                                        ->where('id_Animal',$id_Animal)->get();

        
          return response()->json([
            'message'=> 'animal',
            'data'=>$detalle,
            'status'=>'OK'
          ],200);
      }catch(\Excepcion $e){
        return $this->manejarExcepcion($e);
        }
    }

    // AGREGAR ANIMAL
    public function agregarAnimal(animalRequest $request){
      $dataAnimal = $request->validated();
      try{
        DB::transaction(function() use ($dataAnimal,&$data){
          $id_animal = DB::table('animal')->insertGetId([
            'id_Rebano' => $dataAnimal['rebaño'],
            'Nombre' => $dataAnimal['Nombre'],
            'codigo_animal' => $dataAnimal['codigo_animal'],
            'Sexo' => $dataAnimal['Sexo'],
            'fecha_nacimiento' => $dataAnimal['fecha_nacimiento'],
            'Procedencia' => $dataAnimal['procedencia'],
            'archivado' => 0,
            'fk_composicion_raza' => $dataAnimal['raza'],
            'created_at' => now(),
            'updated_at' => now(),
          ]);

          DB::table('estado_animal')->insert([
            'esan_fk_id_animal' => $id_animal,
            'esan_fk_estado_id' => $dataAnimal['estado_salud'],
            'esan_fecha_ini' => now(),
            'esan_fecha_fin' => null,
          ]);

          DB::table('etapa_animal')->insert([
            'etan_animal_id' => $id_animal,
            'etan_etapa_id' => $dataAnimal['etapa_animal'],
            'etan_fecha_ini' => now(),
            'etan_fecha_fin' => null,
           ]);

           $data = [
             'id' => $id_animal
           ];
        });

        return response()->json([
          'message'=> 'creado animal',
          'data'=>$data,
          'status'=>'OK'
        ],201);
      }catch(\Excepcion $e){
      return $this->manejarExcepcion($e);
      }
    }

    public function identificarSeparador(csvRequest $request)
    {
      $archivo = fopen($request->file('archivo')->getPathname(), 'r');
      $fila = fgetcsv($archivo, 0, ';');

      if ($fila === false) {
        // Si no funciona, cambiamos al delimitador ','
        rewind($archivo); // Reiniciamos el puntero del archivo
        $fila = fgetcsv($archivo, 0, ',');
    }

    return $fila;
    }

    public function agregarMasivo(Request $request)
    {

      dd($request->all());
    // Access form data
    $idPropietario = $request->input('id_Propietario');
    $idFinca = $request->input('id_Finca');
    $idRebano = $request->input('id_Rebano');
    
    // Access and validate uploaded file
    $archivo = $request->file('archivo');
    if (!$archivo || !$archivo->isValid()) {
    return response()->json([
    'message' => 'Invalid file upload.'
    ], 422); // Unprocessable Entity
    }
    
    // Process and store the file
    $fileName = $archivo->getClientOriginalName();
    $filePath = Storage::disk('local')->put('uploads', $archivo); // Adjust storage disk if needed
    
    // Additional processing or storage logic for the CSV data (optional)
    // ...
    
    // Prepare response
    return response()->json([
    'message' => 'Animals successfully added from CSV',
    'data' => [
    'id_propietario' => $idPropietario,
    'id_finca' => $idFinca,
    'id_rebano' => $idRebano,
    'archivo' => $fileName, // Or the stored file path
    ]
    ]);
    }
    

    public function modificarAnimal(modificarAnimalRequest $request, $id_Animal)
    {

      if(isset($request->validated()['animal'])){
        try{
          $animal = animal::findOrFail($id_Animal);

      if($animal){
        $animalData = $request->validated()['animal'];
        $animal->fill($animalData);
        $animal->save();

        $data = [
          'Animal' => $animal
        ];

        return $this->enviarRespuesta('El registro se ha modificado con exito',$data,'OK',200);
       
      }else{
        return $this->enviarRespuesta('No se ha encontrado registro con este ID ',[],'OK',200);
      }
        }catch(\Exception $e){
          $this->manejarExcepcion($e);
        }
      }

    }

    public function eliminarAnimal($id_Animal)
    {
      $animalData = animal::find($id_Animal);
      if($animalData){
              $animalData->delete();

       $data =[
          'animal' => $animalData
       ];
        return response()->json([
          'message'=>'Se ha eliminado el registro de animal con exito',
          'data'=>$data,
          'status'=>'OK'
        ],200);
      }
    }

    public function archivarAnimal($id_Animal)
    {
      try{
      $animalArchivo = DB::table('animal')->where('id_Animal',$id_Animal)->first();
   
      if ($animalArchivo) {
        // Actualiza el campo 'Archivado' a true
        DB::table('animal')
            ->where('id_Animal', $id_Animal)
            ->update(['Archivado' => true]);

        // Recarga el registro actualizado
        $animalArchivoActualizado = DB::table('animal')->where('id_Animal', $id_Animal)->first();

        return $this->enviarRespuesta('El animal se ha archivado con éxito', $animalArchivoActualizado, 'OK', 200);
    }
      }catch(\Exception $e){
       $this->manejarExcepcion($e);
      }
    }

    // Listar animal de un rebaño, el tipo de listado es por si son animales archivados o activos
    public function listarAnimales(int $id_Rebano)
    {
      try{
        $animales =  DB::table('animal')->join('etapa_animal','etan_animal_id','=','id_Animal')
                                       ->join('etapa','etan_etapa_id','=','etapa_id')
                                        ->select('animal.Nombre','animal.Sexo',
                                        'animal.fecha_nacimiento','etapa_nombre')
                                        ->where('animal.id_Rebano',$id_Rebano)
                                        ->where('etan_fecha_fin',null)
                                        ->get();
        
        if($animales->isEmpty()){
            return response()->json([
                'message' => 'El rebano '.$id_Rebano.' no tiene animales ingresados',
                'data' => [],
                'code' => 'NO_FINCAS_CREADAS',
                'status' => 'OK'
            ], 200);
        }else{
            return response()->json([
                'message' => 'Animales del rebano '.$id_Rebano,
                'data' => $animales,
                'status' => 'OK'
            ], 200);
        }
     }catch(\Exception $e){
        return $this->manejarExcepcion($e);
     }
    
    }

    public function filtrarAnimal($tipo,$idAnimal,$idRebano,$texto){
 
      switch($tipo)
      {
        case 'Nombre':
          try{
            $animal = DB::table('animal')->where('Nombre',$texto)
                                      ->where('id_Rebano',$idRebano)
                                      ->where('id_Animal',$idAnimal)->get();
    
            if($animal->isEmpty()){
              return $this->enviarRespuesta('No hay animales por este nombre',[],'OK',200);
            }else{
              return $this->enviarRespuesta('Animales encontrados por el nombre ingresado',$animal,'OK',200);
            }
          }catch(QueryException $e){
            return $this->manejarExcepcion($e);
          }
          break;
    
        case 'Raza':
          try{
            $idRaza = composicion_raza::where('Nombre',$texto)->first();
    
            if($idRaza === null){
              return $this->enviarRespuesta('No se encontro algun registro',[],'OK',200);
            }
            $animalRaza = DB::table('animal')->join('raza_animal','animal.id_Animal','=','raza_animal.id_Animal')
                                        ->where('animal.id_Rebano',$idRebano)
                                        ->where('raza_animal.id_Composicion',$idRaza->id_Composicion)
                                        ->get();
    
            return $this->enviarRespuesta('Animales encontrados por la raza',$animalRaza,'OK',200);
           
          }catch(QueryException $e){
            return $this->manejarExcepcion($e);
          }
          break;

        case 'Etapa':
          try{
            $etapa = DB::table('animal')->where('Etapa',$texto)
                                        ->where('id_Rebano',$idRebano)
                                        ->where('id_Animal',$idAnimal)->get();
    
            if($etapa->isEmpty()){
              return $this->enviarRespuesta('No hay animales por esta etapa',$texto,'OK',200);
            }else{
              return $this->enviarRespuesta('Animales encontrados por la etapa ingresada',$etapa,'OK',200);
            }
    
          }catch(QueryException $e){
            return $this->manejarExcepcion($e);
          }
          break;
  
      }
    
     
    }

    public function escogerAnimales($idFinca,$idRebano,...$ids)
    {
        $animales = DB::table('animal')->where('id_Finca',$idFinca)->where('id_Rebano',$idRebano)
                                        ->whereIn('id_Animal',$ids)->get();

         if($animales->isEmpty()){
          return null;
         }else{
            return $animales;
         }
    }
    //------------------------------------

public function eventosGeneral($id_Rebano)
{
  try{
    $fechaInicio = Carbon::now()->subDays(2)->toDateString();
    $fechaFin = Carbon::now()->endOfDay()->toDateString();

    $eventos = DB::table('animal')
                  ->join('cambios_animal','animal.id_Animal','=','cambios_animal.id_Animal')
                  ->selectRaw('cambios_animal.*')
                  ->where('animal.id_Rebano',$id_Rebano)
                  ->whereBetween('cambios_animal.updated_at', [$fechaInicio, $fechaFin])
                  ->get();
    if($eventos->isEmpty()){
      return $this->enviarRespuesta('No hay eventos realizados estos dias',[],'OK',200);
    }else{
      return $this->enviarRespuesta('Ultimos eventos de animales en el rebano',$eventos,'OK',200);
    }
  }catch(QueryException $e){
    return $this->manejarExcepcion($e);
  }
}

public function eventosAnimal($id_Animal)
{
  try{
    $fechaInicio = Carbon::now()->subDays(2)->toDateString();
    $fechaFin = Carbon::now()->endOfDay()->toDateString();

    $eventos = DB::table('animal')
                  ->join('cambios_animal','animal.id_Animal','=','cambios_animal.id_Animal')
                  ->selectRaw('cambios_animal.*')
                  ->where('animal.id_Animal',$id_Animal)
                  ->whereBetween('cambios_animal.updated_at', [$fechaInicio, $fechaFin])
                  ->get();
    if($eventos->isEmpty()){
      return $this->enviarRespuesta('No hay eventos realizados estos dias',[],'OK',200);
    }else{
      return $this->enviarRespuesta('Ultimos eventos del animal',$eventos,'OK',200);
    }
  }catch(QueryException $e){
    return $this->manejarExcepcion($e);
  }
}

//---------------AREA DE TORO------------------
public function agregarToro(toroRequest $request,$idRaza,$idFinca)
{
  if(isset($request->validated()['toro'])){

    if($this->composicion->verificarRaza($idRaza))
    {
      $idRaza = intval($idRaza);
    $toroData = $request->validated()['toro'];
    $toroData['id_Finca'] = $idFinca;

      DB::transaction(function() use($toroData,$idRaza,&$data){
         $toro = Toro::create($toroData);
        
         $relacionRaza= [
          'id_Toro' => $toro->id_Toro,
          'id_Composicion' => $idRaza
      ];
      $relacion = DB::table('raza_toro')->insert([
        'id_Toro' => $toro->id_Toro,
        'id_Composicion' => $idRaza
    ]);
    

         $data = [
            'toro' => $toro,
            'relacion' => $relacion
         ];
      });
      return $this->enviarRespuesta('Se ha creado el registro de toro con exito',
      $data,'OK',201);
    }
  }
}

public function listarToros($idFinca){
  try{
    $toros = DB::table('toro')->where('id_Finca',$idFinca)->get();

    if($toros->isEmpty()){
      return $this->enviarRespuesta('No hay toros en esta finca',[],'OK',200);
    }else{
      return $this->enviarRespuesta('Listado de toros',$toros,'OK',200);
    }
  }catch(QueryException $e){
    $this->manejarExcepcion($e);
  }
}

public function consultarToro($idToro){
  try{
    $toro = DB::table('toro')->where('id_Toro',$idToro)->get();

    if($toro->isEmpty()){
      return $this->enviarRespuesta('No se encontro el toro solicitado',[],'OK',200);
    }else{
      return $this->enviarRespuesta('Toro solicitado',$toro,'OK',200);
    }
  }catch(QueryException $e){
    $this->manejarExcepcion($e);
  }
}

public function filtrarToro($tipo,$idFinca,$texto){
 
  switch($tipo)
  {
    case 'Nombre':
      try{
        $toro = DB::table('toro')->where('nombre',$texto)->where('id_Finca',$idFinca)->get();

        if($toro->isEmpty()){
          return $this->enviarRespuesta('No hay toros por este nombre',[],'OK',200);
        }else{
          return $this->enviarRespuesta('Toros encontrados por el nombre ingresado',$toro,'OK',200);
        }
      }catch(QueryException $e){
        return $this->manejarExcepcion($e);
      }
      break;

    case 'Raza':
      try{
        $idRaza = composicion_raza::where('Nombre',$texto)->first();

        if($idRaza === null){
          return $this->enviarRespuesta('No se encontro algun registro',[],'OK',200);
        }
        $toroRaza = DB::table('toro')->join('raza_toro','toro.id_Toro','=','raza_toro.id_Toro')
                                    ->where('toro.id_Finca',$idFinca)
                                    ->where('raza_toro.id_Composicion',$idRaza->id_Composicion)
                                    ->get();

        return $this->enviarRespuesta('Toros encontrados por la raza',$toroRaza,'OK',200);
       
      }catch(QueryException $e){
        return $this->manejarExcepcion($e);
      }
      break;
  }

 
}

public function modificarToro(toroRequest $request,$idToro){
  if(isset($request->validated()['toro']))
  {
    $toroData = $request->validated()['toro'];
    try{
      $toro = toro::findOrFail($idToro);

      if($toro){
        $toro->fill($toroData);
        $toro->save();

        $data = [
          'Toro' => $toro
        ];

        return $this->enviarRespuesta('El registro se ha modificado con exito',$data,'OK',200);
       
      }else{
        return $this->enviarRespuesta('No se ha encontrado registro con este ID ',[],'OK',200);
      }
    }catch(QueryException $e){
      $this->manejarExcepcion($e);
    }
  }
}

public function eliminarToro($idToro){
  $toro = toro::find($idToro);
   
   if($toro){
     $toro->delete();

     $data = [
      'Toro' => $toro
     ];

     return $this->enviarRespuesta('Se ha eliminado el registro de toro con exito',$data,'OK',200);
   }else{
    return $this->enviarRespuesta('No se encontro ningun registro con esta identificacion',[],'ERROR',404);
   }
}

public function agregarSemen(semenRequest $request,$idToro)
{
  if(isset($request->validated()['semen']))
  {
   try{
    $semenData = $request->validated()['semen'];
    $semenData['id_Toro'] = $idToro;

    $semen = semen_toro::create($semenData);

    $data = [
      'semen' => $semen
    ];

    return $this->enviarRespuesta('Se ha agregado el registro del semen del toro',$data,'OK',200);
   }catch(\Exception $e){
    return manejarExcepcion($e);
   }
  }
}

public function listarSemenToro($idToro)
{
  try{
    $semenListas = DB::table('seme_toro')->where('id_Toro',$idToro)->get();

    if($semenListas->isEmpty()){
      return $this->enviarRespuesta('Este toro no posee registros de semen',[],'OK',200);
    }else{
      return $this->enviarRespuesta('Listado de semen del toro',$semenListas,'OK',200);
    }
  }catch(QueryException $e){
    return $this->manejarExcepcion($e);
  }
}

public function consultarRegistroSemen($idSemen)
{
  try{
    $semen = DB::table('semen_toro')->where('id_Semen',$idSemen)->get();

    if($semen->isEmpty()){
      return $this->enviarRespuesta('No se encontro el registro de semen solicitado',[],'OK',200);
    }else{
      return $this->enviarRespuesta('Semen solicitado',$semen,'OK',200);
    }
  }catch(QueryException $e){
    $this->manejarExcepcion($e);
  }
}

public function modificarEstadoSemen($idSemen)
{
  try{
    $estado = semen_toro::findOrFail($idSemen);

    if($estado){
      $estado->update([
        'Estado'=>1
      ]);

      $data =[
        'semen' => $estado
      ];
      return $this->enviarRespuesta('Estado cambiado',$data,'OK',200);
    }
  }catch(\Exception $e){
    return $this->manejarExcepcion($e);
  }
}

public function eliminarSemen($idSemen)
{
  try{
    $registro = semen_toro::findOrFail($idSemen);

    if($registro){
      $registro->delete();

      $data = [
        'Semen' => $registro
       ];
  
       return $this->enviarRespuesta('Se ha eliminado el registro de semen con exito',$data,'OK',200);
    }else{
      return $this->enviarRespuesta('No se encontró ningún registro de semen', [], 'ERROR', 404);
    }
  }catch(\Exception $e){
    return $this->manejarExcepcion($e);
  }
}

 //---------------AREA DE RAZA------------------

  public function agregarRazaMixta(razaRequest $request,$idFinca)
  {
  
    if(isset($request->validated()['raza'])){
      $razaData = $request->validated()['raza'];

      if($this->composicion->verificarNombre('Agregar',$razaData['Nombre'],$idFinca)){
        return $this->enviarRespuesta('Ya existe una raza con ese nombre, ingrese otro',
                                      $razaData['Nombre'],'OK',200);
      }
      $razaData['Mixta'] = true;
      DB::transaction(function() use ($razaData,$idFinca,&$data){
        try{
        
          $composicionRaza = composicion_raza::create($razaData);
          
          $tipoRazaData = [
                      'id_Composicion' => $composicionRaza->id_Composicion,
                      'id_Finca' => $idFinca,
          ];
         
          $tipoRaza = tipo_raza::create($tipoRazaData);
        
        
          $data = [
            'composicion raza' => $composicionRaza,
            'tipo raza' => $tipoRaza
          ];

          

        }catch(\Exception $e){
          return $this->manejarExcepcion($e);
        }
      });
      return $this->enviarRespuesta('Se ha creado el registro de raza con exito',
      $data,'OK',201);
    }
    
  }

  public function modificarRazaMixta(razaRequest $request,$idFinca,$id_Composicion)
  {
    if($this->composicion->verificarRegistro($id_Composicion)){
      return $this->enviarRespuesta('Esta raza no se puede modificar',[],'ERROR',500);
    }

    try{
      if($request->validated()['raza']){
        $razaData = $request->validated()['raza'];
      
        if($this->composicion->verificarNombre('Modificar',$razaData['Nombre'],$idFinca,$id_Composicion)){
          return $this->enviarRespuesta('Ya hay una raza con este nombre en la finca',$razaData['Nombre'],'OK',200);
        }
       
      
       $raza = composicion_raza::findOrFail($id_Composicion);
       $raza->update($razaData);
         
        $data = [
            'composicion nueva' => $raza
        ];
        $this->enviarRespuesta('Se actualizo el registro',$data,'OK',200);
      }
    }catch(\Exception $e){
      $this->manejarExcepcion($e);
    }
  }

  public function eliminarRazaMixta($id_Composicion)
  {
   try{
    $tipoRaza = tipo_raza::find($id_Composicion);

     if($tipoRaza->Mixta === 0){
      return $this->enviarRespuesta('No es posible eliminar esta raza del sistema',
                [],'OK',200);
     }else{
        $tipoRaza->delete();
        $composicionRaza = composicion_raza::find($id_Composicion);
        $composicionRaza->delete();

        $data = [
          'Tipo Raza' => $tipoRaza,
          'Composicion' => $composicionRaza
        ];

        return $this->enviarRespuesta('Se eliminaron los registros con exito',
                $data,'OK',200);
     }
   }catch(\Exception $e){
    $this->manejarExcepcion($e);
   }
  }

    public function listarRazas($tipo,$idFinca)
    {
      switch ($tipo)
      {
        case 'Todo':
          $raza = DB::table('composicion_raza')
            ->join('Tipo_Raza', 'Tipo_Raza.id_Composicion', '=', 'composicion_raza.id_Composicion')
            ->where('Tipo_Raza.Mixta', 0)
            ->orWhere('Tipo_Raza.id_Finca', $idFinca)
            ->get();

        if($raza->isEmpty()){
          return $this->enviarRespuesta('No hay razas disponibles',
                              [],'OK',200);
         }else{
         return $this->enviarRespuesta('Listado de todas las razas para su finca',
                           $raza,'OK',200);
         }
         break;
        
        case 'Predeterminada':
          $raza = DB::table('composicion_raza')
                      ->join('tipo_raza', 'tipo_raza.id_Composicion','=','composicion_raza.id_Composicion')
                      ->where('tipo_raza.Mixta',0)->get();
          
         if($raza->isEmpty()){
          return $this->enviarRespuesta('No hay razas predeterminadas disponibles',
                              [],'OK',200);
         }else{
         return $this->enviarRespuesta('Listado de todas las razas del sistema para su finca',
                           $raza,'OK',200);
         }
          break;

        case 'Mixta':
          $raza = DB::table('composicion_raza')
          ->join('tipo_raza', 'tipo_raza.id_Composicion','=','composicion_raza.id_Composicion')
          ->where('tipo_raza.Mixta',1)
          ->where('id_Finca',$idFinca)->get();

            if($raza->isEmpty()){
              return $this->enviarRespuesta('No hay razas mixtas disponibles',
                  [],'OK',200);
            }else{
              return $this->enviarRespuesta('Listado de todas las razas mixtas para su finca',
               $raza,'OK',200);
            }
          break;

        default:
         break;
      
          }
    }

  public function consultarRaza($id_Composicion)
  {
    try{
      $raza = DB::table('composicion_raza')->where('id_Composicon',$id_Composicion)->get();
        if($raza->isEmpty()){
          return $this->enviarRespuesta('No selecciono ninguna raza',[],'OK',200);
        }else{
         return $this->enviarRespuesta('Raza seleccionada',$raza,'OK',200);
        }
    }catch(\Exception $e){
      $this->manejarExcepcion($e);
    }
  }

  public function fitrarRaza($tipoFiltro,$nombre,$idFinca)
  {
    switch($tipoFiltro)
    {
      case 'Todo':
        $raza = DB::table('composicion_raza')
          ->join('Tipo_Raza', 'Tipo_Raza.id_Composicion', '=', 'composicion_raza.id_Composicion')
          ->where('composicion_raza.Nombre',$nombre)
          ->orWhere('Tipo_Raza.id_Finca', $idFinca)
          ->orWhere('Tipo_Raza.Mixta',0)
          ->get();

      if($raza->isEmpty()){
        return $this->enviarRespuesta('No hay raza con este nombre',
                            [],'OK',200);
       }else{
       return $this->enviarRespuesta('raza encontrada con el nombre',
                         $raza,'OK',200);
       }
       break;
      
      case 'Predeterminada':
        $raza = DB::table('composicion_raza')
                    ->join('tipo_raza', 'tipo_raza.id_Composicion','=','composicion_raza.id_Composicion')
                    ->where('composicion_raza.Nombre',$nombre)
                    ->where('tipo_raza.Mixta',0)->get();
        
       if($raza->isEmpty()){
        return $this->enviarRespuesta('No hay razas predeterminadas con este nombre',
                            [],'OK',200);
       }else{
       return $this->enviarRespuesta('raza predeterminada encontrada con el nombre',
                         $raza,'OK',200);
       }
        break;

      case 'Mixta':
        $raza = DB::table('composicion_raza')
        ->join('tipo_raza', 'tipo_raza.id_Composicion','=','composicion_raza.id_Composicion')
        ->where('composicion_raza.Nombre',$nombre)
        ->where('tipo_raza.id_Finca',$idFinca)->get();

          if($raza->isEmpty()){
            return $this->enviarRespuesta('No hay razas mixtas con este nombre',
                [],'OK',200);
          }else{
            return $this->enviarRespuesta('Raza mixta de su finca encontrada con el nombre',
             $raza,'OK',200);
          }
        break;

      default:
       break;
    
    }
  }

 //---------------AREA DE GENETICA------------------
public function establecerArbolGenealogico(arbolRequest $request,$id_Animal)
{
  try{
    if(isset($request->validated()['arbol'])){
     $arbolData = $request->validated()['arbol'];
      $arbolData['id_Animal'] = $id_Animal;

      $arbol = arbol_genetica::create($arbolData);

      return $this->enviarRespuesta('Arbol genetico creado',
                              $arbol,'OK',201);
  }
}catch(\Exception $e){
  return $this->manejarExcepcion($e);
}
}

//Este metodo viene para mostrar los animales a escoger para el arbol genetico
public function opcionesArbol($etapa, $id_Finca, $generaciones) {
  $resultados = $this->buscarAscendente($etapa, $generaciones, $id_Finca);
  return response()->json([
      'data' => $resultados,
      'status' => 'OK'
  ], 200);
}

private function buscarAscendente($tipo,$generacion,$id_Finca)
{
  try{
  $generacion = min($generacion, 3); //maximo tres generaciones por arriba
                                    //Padres, abuelos, bisabuelos
  $etapa = $tipo == 'Padre' ? 'Toro' : 'Vaca';
                  //Siempre se envia Padre o Madre

  $ascendentes = DB::table('animal')
                    ->select('id_Animal', 'Nombre')
                    ->where('id_Finca', $id_Finca)
                    ->where('Etapa', $etapa);
                    
//Si la generacion es 2 o 3 buscara adicionalmente por la edad en meses
  if($generacion = 2){ 
        $ascendentes->where('Edad', '>', 36);        
  }

  if($generacion = 3){ 
    $ascendentes->where('Edad', '>', 48);        
}

    return $ascendentes->get();
  }catch(\Exception $e){
    $this->manejarExcepcion($e);
  }
}

public function modificarArbolGenealogico(arbolRequest $request,$id_Gen)
{
  try{
    if(isset($request->validated()['arbol'])){
      $arbolData = $request->validated()['arbol'];
      $arbol = arbol_genetica::findOrFail($id_Gen);

      if($arbol){

      $arbol->update($arbolData);

      return $this->enviarRespuesta('Arbol genetico modificado',
                              $arbol,'OK',200);
      }else{
        return $this->enviarRespuesta('No se ha encontrado informacion del arbol a modificar',
                              [],'OK',200);
      }
  }
}catch(\Exception $e){
  return $this->manejarExcepcion($e);
}
}

public function eliminarArbolGenealogico($id_Gen)
{
 try{
  $arbol = arbol_genetica::where('id_Gen',$id_Gen)->first();
  if(!($arbol)){
    return $this->enviarRespuesta('No se encontro ningun registro',
    [],'OK',200);
  }else{
   $arbol->delete();

    return $this->enviarRespuesta('Se elimino el arbol genetico del animal',
                                  [],'OK',200);
  }
 }catch(\Excpetion $e){
  return $this->manejarExcepcion($e);
 }
}

public function consultarArbolGenealogico($id_Animal)
{
  try{
    $arbol = DB::table('arbol_genetica')->where('id_Animal',$id_Animal)->first();
    
    if($arbol->isEmpty()){
      return $this->enviarRespuesta('No se encontro informacion del arbol de este animal',
                                    [],'OK',200);
    }else{
    return $this->enviarRespuesta('Arbol genetico del animal',
                                    $arbol,'OK',200);
    }
  }catch(\Exception $e){
    return $this->manejarExcepcion($e);
  }
}

//cuando se desee consultar informacion de algun ascendente del arbol genealogico
//de algun animal
public function informacionAscendente($id_Animal)
{
  try{
    $informacion = DB::table('animal')->where('id_Animal',$id_Animal)->first();

    if(empty($informacion)){
      return $this->enviarRespuesta('No se encontro informacion del ascendente',
      [],'OK',200);
    }else{
      return $this->enviarRespuesta('Informacion del ascendente',
      $informacion,'OK',200);
    }
  }catch(\Exception $e){
    return $this->manejarExcepcion($e);
  }
}

//---------------AREA DE CAMBIOS------------------
public function realizarCambio(cambioRequest $request, $id_Animal)
{
  if(isset($request->validated()['cambio']) && isset($request->validated()['animal']))
  {
    $cambioData = $request->validated()['cambio'];
    $cambioAnimal = $request->validated()['animal'];

    if($this->cambioA->verificarCambio($id_Animal,$cambioAnimal)){
      if(!($this->cambioA->verificarRegistro($id_Animal))){

      DB::transaction(function() use ($cambioData,$cambioAnimal,$id_Animal,&$data){
        $cambioData['id_Animal'] = $id_Animal;
        $cambio = cambios_animal::create($cambioData);

        $animal = animal::findOrFail($id_Animal);
        $cambioAnimal['Etapa'] = $cambioData['Etapa_Cambio'];
        $animal->update($cambioAnimal);

    
      $historicoData = $cambioData;
      $historicoData['id_Cambio'] = $cambio->id_Cambio;
      $fecha = Carbon::now();
      $fecha->timestamp;
      $fecha->toDateTimeString();
      $historicoData['Fecha_Actualizacion'] = $fecha;

        $cambioHistorico = historico_cambio::create($historicoData);

        $data = [
          'cambio' => $cambio,
          'historico' => $cambioHistorico
        ];

      });

     return $this->enviarRespuesta('Se ha creado el registro del cambio con exito',
                            $data,'OK',201);

      }else{
       $data = DB::table('cambios_animal')->where('id_Animal',$id_Animal)->first();
        return $this->enviarRespuesta('Ya existe un registro de este animal, vaya al listado',
        $data,'OK',200);
      }
    }else{
     return $this->enviarRespuesta('Locurita',
      [],'OK',200);
    }
    
  }else{
    return $this->enviarRespuesta('Locura',
                            [],'OK',200);
  }
}

//Aqui siempre se envia el registro de la tabla cambios_animal ya que es el ultimo
//de esa forma se evita comparar en la tabla historico
public function modificarCambio(cambioRequest $request,$idCambio)
{
  if(isset($request->validated()['cambio']) && isset($request->validated()['animal']))
  {
    
    if($this->cambioA->verificarModificacion($request,$idCambio))
    {
      $cambioData = $request->validated()['cambio'];
      $cambioEdad = $request->validated()['animal'];
      $id = DB::table('cambios_animal')->select('id_Animal')->where('id_Cambio',$idCambio)
                                ->first();
      if($this->cambioA->verificarCambio($id->id_Animal,$cambioEdad['Edad'])){

      DB::transaction(function() use ($cambioData,$idCambio,$cambioEdad,&$data){
        $cambio = cambios_animal::findOrFail($idCambio);
        $cambio->update($cambioData);

        $id = DB::table('cambios_animal')->select('id_Animal')->where('id_Cambio',$idCambio)->first();
        $animal = animal::findOrFail($id->id_Animal);
        $animal->update($cambioEdad);

        $historicoData = $cambioData;
        $historicoData['id_Cambio'] = $cambio->id_Cambio;
        $historicoData['id_Animal'] = $id->id_Animal;
        $fecha = Carbon::now();
        $fecha->timestamp;
        $fecha->toDateTimeString();
        $historicoData['Fecha_Actualizacion'] = $fecha;
  
          $cambioHistorico = historico_cambio::create($historicoData);

          $data = [
            'cambio' => $cambio,
            'historico' => $cambioHistorico
          ];
        });

        return $this->enviarRespuesta('Se ha modificado el registro del cambio con exito',
        $data,'OK',200);
      }
    }else{
      return $this->enviarRespuesta('El registro es identico, no es posible moodificarlo',
      [],'OK',200);
    } 
  }
}

public function listarCambios($idCambio)
{
  try{
    $historicos = DB::table('historico_cambio')->where('id_Cambio',$idCambio)->get();
    $cambio = DB::table('cambios_animal')->where('id_Cambio',$idCambio)->get();
   

    if($cambio->isEmpty()){
      return $this->enviarRespuesta('No existen cambios hechos para este animal',
                                    [],'OK',200);
    }else{
      $data = [
        'cambio' => $cambio,
        'historicos' => $historicos
      ];
      return $this->enviarRespuesta('Cambios hechos',$data,'OK',200);
    }
  }catch(QueryException $e){

    Log::error($e->getMessage());
    return response()->json([
      'message'=>'Ha habido un fallo en el sistema. Intente de nuevo',
      'data'=>[],
      'code'=>'ERROR_QUERYEXCEPTION',
      'status'=>'ERROR'
],500);
  }
}

public function eliminarHistoricosCambios($idCambio)
{
  try{
    $historicos = DB::table('historico_cambio')->where('id_Cambio',$idCambio)->exists();

    if(!($historicos)){
      return $this->enviarRespuesta('No se encontro ningun registro',
      [],'OK',200);
    }else{
      DB::table('historico_cambio')->where('id_Cambio', $idCambio)->delete();

      return $this->enviarRespuesta('Se eliminaron los historicos con exito',
                                    [],'OK',200);
    }
  }catch(\Exception $e){
    $this->manejarExcepcion($e);
  }
}

//---------------AREA DE MEDIDAS CORPORALES------------------
public function agregarMedidas(MedidasRequest $request, $id_Animal)
{
  try{
    if(!($this->medidas->verificarRegistro($id_Animal))){
    $medidasData = $request->validated()['medida'];
    $historicoData = $medidasData;
    $medidasData['id_Animal'] = $id_Animal;
   
    DB::transaction(function() use ($medidasData,$historicoData,$id_Animal,&$data){
    $medidas = medidas_corporales::create($medidasData);

    $historicoData['id_Medida'] = $medidas->id_Medida;
    $historicoData['id_Animal'] = $id_Animal;
    //agrega la fecha tipo date al registro
    $fecha = Carbon::now();
    $fecha->timestamp;
    $fecha->toDateTimeString();
    $historicoData['Fecha_Actualizacion'] = $fecha;

    $historico = historico_medidascor::create($historicoData);

      $data = [
        'medidas' => $medidas,
        'historico' => $historico
      ];
    });

      return $this->enviarRespuesta('Se ha creado el registro de medidas con exito',
                                    $data,'OK',201);

    }else{
      $data = DB::table('medidas_corporales')->where('id_Animal',$id_Animal)->first();
      return $this->enviarRespuesta('Ya existe un registro de este animal, vaya al listado',
      $data,'OK',200);
    }


  }catch(\Exception $e){
    $this->manejarExcepcion($e);
  }
}

public function modificarMedidas(MedidasRequest $request, $idMedida)
{
  if($this->medidas->verificarModificacion($request,$idMedida))
    {
      $medidaData = $request->validated()['medida'];

      DB::transaction(function() use ($medidaData,$idMedida,&$data){
        $medida = medidas_corporales::findOrFail($idMedida);
        $medida->update($medidaData);

        $historicoData = $medidaData;
        $historicoData['id_Medida'] = $medida->id_Medida;
        $historicoData['id_Animal'] = $medida->id_Animal;
        $fecha = Carbon::now();
        $fecha->timestamp;
        $fecha->toDateTimeString();
        $historicoData['Fecha_Actualizacion'] = $fecha;
  
          $medidaHistorico = historico_medidascor::create($historicoData);

          $data = [
            'medida' => $medida,
            'historico' => $medidaHistorico
          ];
        });

        return $this->enviarRespuesta('Se ha modificado el registro de medida con exito',
        $data,'OK',200);
      
    }else{
      return $this->enviarRespuesta('El registro es identico, no es posible modificarlo',
      [],'OK',200);
    }
}

public function listarMedidas($idMedida)
{
  try{
    $historicos = DB::table('historico_medidascor')->where('id_Medida',$idMedida)->get();
    $medida = DB::table('medidas_corporales')->where('id_Medida',$idMedida)->get();
   

    if($medida->isEmpty()){
      return $this->enviarRespuesta('No existen registro de medidas para este animal',
                                    [],'OK',200);
    }else{
      $data = [
        'medida' => $medida,
        'historicos' => $historicos
      ];
      return $this->enviarRespuesta('Registros',$data,'OK',200);
    }
  }catch(QueryException $e){

    Log::error($e->getMessage());
    return response()->json([
      'message'=>'Ha habido un fallo en el sistema. Intente de nuevo',
      'data'=>[],
      'code'=>'ERROR_QUERYEXCEPTION',
      'status'=>'ERROR'
],500);
  }
}

public function eliminarHistoricosMedidas($idMedida)
{
  try{
    $historicos = DB::table('historico_medidascor')->where('id_Medida',$idMedida)->exists();

    if(!($historicos)){
      return $this->enviarRespuesta('No se encontro ningun registro',
      [],'OK',200);
    }else{
      DB::table('historico_medidascor')->where('id_Medida', $idMedida)->delete();

      return $this->enviarRespuesta('Se eliminaron los historicos con exito',
                                    [],'OK',200);
    }
  }catch(\Exception $e){
    $this->manejarExcepcion($e);
  }
}

//---------------AREA DE INDICES CORPORALES------------------
public function agregarIndiceCorporal(indiceRequest $request,$id_Animal)
{
  try{
    if(!($this->indices->verificarRegistro($id_Animal))){
    $indiceData = $request->validated()['indice'];
    $historicoData = $indiceData;
    $indiceData['id_Animal'] = $id_Animal;
   
    DB::transaction(function() use ($indiceData,$historicoData,$id_Animal,&$data){
    $indice = indices_corporales::create($indiceData);

    $historicoData['id_Indice'] = $indice->id_Indice;
    $historicoData['id_Animal'] = $id_Animal;
    //agrega la fecha tipo date al registro
    $fecha = Carbon::now();
    $fecha->timestamp;
    $fecha->toDateTimeString();
    $historicoData['Fecha_Actualizacion'] = $fecha;

    $historico = historico_indicescor::create($historicoData);

      $data = [
        'medidas' => $indice,
        'historico' => $historico
      ];
    });

      return $this->enviarRespuesta('Se ha creado el registro de indices con exito',
                                    $data,'OK',201);

    }else{
      $data = DB::table('indices_corporales')->where('id_Animal',$id_Animal)->first();
      return $this->enviarRespuesta('Ya existe un registro de este animal, vaya al listado',
      $data,'OK',200);
    }


  }catch(\Exception $e){
    $this->manejarExcepcion($e);
  }
}

public function modificarIndiceCorporal(indiceRequest $request,$idIndice)
{
  if($this->indices->verificarModificacion($request,$idIndice))
    {
      $indiceData = $request->validated()['indice'];

      DB::transaction(function() use ($indiceData,$idIndice,&$data){
        $indice = indices_corporales::findOrFail($idIndice);
        $indice->update($indiceData);

        $historicoData = $indiceData;
        $historicoData['id_Indice'] = $indice->id_Indice;
        $historicoData['id_Animal'] = $indice->id_Animal;
        $fecha = Carbon::now();
        $fecha->timestamp;
        $fecha->toDateTimeString();
        $historicoData['Fecha_Actualizacion'] = $fecha;
  
          $indiceHistorico = historico_indicescor::create($historicoData);

          $data = [
            'medida' => $indice,
            'historico' => $indiceHistorico
          ];
        });

        return $this->enviarRespuesta('Se ha modificado el registro de indice con exito',
        $data,'OK',200);
      
    }else{
      return $this->enviarRespuesta('El registro es identico, no es posible modificarlo',
      [],'OK',200);
    }
}

public function listarIndices($idIndice)
{
  try{
    $historicos = DB::table('historico_indicescor')->where('id_Indice',$idIndice)->get();
    $indice = DB::table('indices_corporales')->where('id_Indice',$idIndice)->get();
   

    if($indice->isEmpty()){
      return $this->enviarRespuesta('No existen registro de medidas para este animal',
                                    [],'OK',200);
    }else{
      $data = [
        'medida' => $indice,
        'historicos' => $historicos
      ];
      return $this->enviarRespuesta('Registros',$data,'OK',200);
    }
  }catch(QueryException $e){

    Log::error($e->getMessage());
    return response()->json([
      'message'=>'Ha habido un fallo en el sistema. Intente de nuevo',
      'data'=>[],
      'code'=>'ERROR_QUERYEXCEPTION',
      'status'=>'ERROR'
],500);
  }
}

public function eliminarHistoricosIndices($idIndice)
{
  try{
    $historicos = DB::table('historico_indicescor')->where('id_Indice',$idIndice)->exists();

    if(!($historicos)){
      return $this->enviarRespuesta('No se encontro ningun registro',
      [],'OK',200);
    }else{
      DB::table('historico_indicescor')->where('id_Indice', $idIndice)->delete();

      return $this->enviarRespuesta('Se eliminaron los historicos con exito',
                                    [],'OK',200);
    }
  }catch(\Exception $e){
    $this->manejarExcepcion($e);
  }
}


//---------------AREA DE PESO CORPORAL------------------
public function establecerPeso(pesoRequest $request,$tipo,$id_Animal,$id_Tecnico=null)
{ 
  try{
    if($this->pesos->verificarRegistro($id_Animal)){
      $pesoData = $request->validated()['peso'];
      $pesoData['id_Animal'] = $id_Animal;
      $pesoData['id_Tecnico'] = $id_Tecnico;

    DB::transaction(function() use ($pesoData,$tipo,$id_Animal,$id_Tecnico,&$data){
      $peso = peso_corporal::create($pesoData);

      $columna_fecha = 'Fecha_' . $tipo;
      $columna_peso = 'Peso_' . $tipo;
      
       $datosHistorico = [
          'id_Peso' => $peso->id_Peso,
          'id_Animal' => $id_Animal,
          'id_Tecnico' => $id_Tecnico,
          $columna_fecha => $pesoData['Fecha_Peso'],
          $columna_peso => $pesoData['Peso'],
          'Comentario' => $pesoData['Comentario'],
      ];
      $historico = DB::table('registro_pesocor')->insert($datosHistorico);
      
      $data = [
        'peso' => $peso,
        'historico'=>$historico
      ];
    });


    return $this->enviarRespuesta('Se ha creado el registro de peso con exito',
                                   $data,'OK',201);

    }else{
      $data = DB::table('peso_corporal')->where('id_Animal',$id_Animal)->first();
      return $this->enviarRespuesta('Ya existe un registro de este animal, vaya al listado',
      $data,'OK',200);
    }
  }catch(\Exception $e){
    return $this->manejarExcepcion($e);
  }
}

public function actualizarPesoCorporal(pesoRequest $request,$idPeso,$tipo,$id_Tecnico=null)
{
  if($this->registroPeso->verificarModificacion($request,$idPeso,$tipo))
    {
      $pesoData = $request->validated()['peso'];
      $pesoData['id_Tecnico'] = $id_Tecnico;

    DB::transaction(function() use ($pesoData,$idPeso,$tipo,&$data){
      $peso = peso_corporal::findOrFail($idPeso);
      $peso->update($pesoData);

      $columna_fecha = 'Fecha_' . $tipo;
      $columna_peso = 'Peso_' . $tipo;

       $data = [ 
          $columna_fecha => $pesoData['Fecha_Peso'],
          $columna_peso => $pesoData['Peso'],
          'Comentario' => $pesoData['Comentario'],
      ];

      $historicoNuevo = $this->registroPeso->comprobarHistorico($data,$idPeso,$tipo);
      $historicoNuevo['created_at'] = now();
    $historicoNuevo['updated_at'] = now();

      $historico = DB::table('registro_pesocor')->insert($historicoNuevo);
      
      $data = [
        'peso' => $peso,
        'historico'=>$historico
      ];
    });


    return $this->enviarRespuesta('Se ha creado el registro de peso con exito',
                                   $data,'OK',201);

    }else{
      return $this->enviarRespuesta('El registro es identico, no es posible modificarlo',
      [],'OK',200);
    }
}



public function listarPesos($idPeso)
{
  try{
    $historicos = DB::table('registro_pesocor')->where('id_Peso',$idPeso)->get();
    $peso = DB::table('peso_corporal')->where('id_Peso',$idPeso)->get();
   

    if($peso->isEmpty()){
      return $this->enviarRespuesta('No existen registro de pesos para este animal',
                                    [],'OK',200);
    }else{
      $data = [
        'peso' => $peso,
        'historicos' => $historicos
      ];
      return $this->enviarRespuesta('Registros',$data,'OK',200);
    }
  }catch(QueryException $e){

    Log::error($e->getMessage());
    return response()->json([
      'message'=>'Ha habido un fallo en el sistema. Intente de nuevo',
      'data'=>[],
      'code'=>'ERROR_QUERYEXCEPTION',
      'status'=>'ERROR'
],500);
  }
}

public function eliminarHistoricosPesos($idPeso)
{
  try{
    $historicos = DB::table('registro_pesocor')->where('id_Peso',$idPeso)->exists();

    if(!($historicos)){
      return $this->enviarRespuesta('No se encontro ningun registro',
      [],'OK',200);
    }else{
      DB::table('registro_pesocor')->where('id_Peso', $idPeso)->delete();

      return $this->enviarRespuesta('Se eliminaron los historicos con exito',
                                    [],'OK',200);
    }
  }catch(\Exception $e){
    $this->manejarExcepcion($e);
  }
}
// ---------- METODOS ADICIONALES------------------------

private function manejarExcepcion($excepcion)
{
    // Registra el error en el log
    Log::error($excepcion->getMessage());

    // Devuelve la respuesta JSON con el mensaje de error
    return response()->json([
        'message' => 'Ha habido un fallo al ejecutar la accion. Intente de nuevo',
        'data' => [],
        'status' => 'Error'
    ], 500);
}

private function enviarRespuesta($mensaje,$datos,$estado,$codigoRetorno)
{

  Log::info('Enviando respuesta', ['mensaje' => $mensaje, 'status' => $estado, 
                                'codigoRetorno' => $codigoRetorno]);

return response()->json([
    'message' => $mensaje,
    'data' => $datos,
    'status' => $estado
], $codigoRetorno);
}

protected function validatorAnimal(array $data) {

  return Validator::make($data, [ //validaciones internas
    'Nombre' => 'required|max:25|regex:/^[A-Za-z\s\d]+$/',
    'Sexo' => 'required|in:M,F',
    'Edad' => 'required|integer',
    'Etapa' => 'required',
    'Tipo' =>  'required|in:Vacuno,Bufala',
    'Estado' => 'required|in:Sano,Enfermo,Muerto,Servicio,Preñez',
    'Procedencia' => 'required|max:50',
  ]);
}

}
