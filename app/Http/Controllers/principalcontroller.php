<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Request;
use App\ModelsModelUsuario\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\ModelUsuario\propietario;
use App\Models\ModelUsuario\transcriptor;
use App\Models\ModelFinca\finca;
use App\Models\ModelFinca\rebano;
use App\Models\ModelAnimal\animal;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Http\Requests\UserRequests\modificarUser;

class PrincipalController extends Controller
{
    public $auth;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      /*
      $this->auth = $auth;
      print_r($this->auth);
      exit;
      */
    }

    //Todos los usuarios del sistema para visualizar por el administrador
    protected function userOptionList($opcion='mixto', $archivado=0) {

        $user = Auth::user();
        /*
        print_r($this->user->name);
        echo "Her, sy yo, soy yo,...";echo "<pre>";
        if(isset($this->user->name))
        {
          print_r($this->user);
        }
        echo "</pre>";exit;
        */

        switch($opcion) {
          case 'mixto':
              //return $this->usersList($archivado);
              $jsonData = $this->usersList($archivado);
              return view('usuario.mostrar', ['user' => $user,
                                              'tipo' => 'Mixto',
                                              'userData' => json_decode($jsonData->getContent(), true)]);
            break;
          case 'propietario':
             //return $this->propietarioList($archivado);
             $jsonData = $this->propietarioList($archivado);
             return view('usuario.mostrar', ['user' => $user,
                                             'tipo' => 'Propietario',
                                             'userData' => json_decode($jsonData->getContent(), true)]);
             break;
          case 'transcriptor':
            //return 
            $jsonData = $this->transcriptorList($archivado);
            return view('usuario.mostrar', ['user' => $user,
                                            'tipo' => 'Transcriptor',
                                            'userData' => json_decode($jsonData->getContent(), true)]);

            break;
          default:
  
            break;
        }
      }
  
      protected function usersList($archivado) 
      {
          try{
          $users = DB::table('users as us')
                  ->leftJoin('Propietario as P', 'us.id', '=', 'P.id')
                  ->leftJoin('Transcriptor as T', 'us.id', '=', 'T.id')
                  ->select('us.id',
                            'us.email')
                              ->addSelect(
                                DB::raw('COALESCE(P.Nombre, T.Nombre) as Nombre'),
                                DB::raw('COALESCE(P.Apellido, T.Apellido) as Apellido'),
                                DB::raw('COALESCE(P.Telefono, T.Telefono) as Telefono'),
                                DB::raw('COALESCE(P.id_Personal, T.id_Personal) as id_Personal'),
                                DB::raw('COALESCE(T.Tipo_Transcriptor, "") as Tipo_Transcriptor'),
                                DB::raw('image as Imagen'),
                                DB::raw('type_user as Tipo'),  
                            )->whereRaw('COALESCE(P.Archivado, T.Archivado) = ?', [$archivado])
                            ->get();

            //elimino el campo Tipo_Transcriptor si viene como vacio (debido al proopietario)
            $users = $users->map(function ($item) {
            
              if (empty($item->Tipo_Transcriptor)) {
                  unset($item->Tipo_Transcriptor);
              }
              return $item;
          });
  
            if($users->isEmpty()){
              return response()->json([
                'message'=>'No hay usuarios en el sistema',
                'data'=>[],
                'status'=>'OK'
            ],204);
            }else{
              return response()->json([
                'message'=>'Usuarios en el sistema',
                'data'=>$users,
                'status'=>'OK'
            ],200);
            }
          }catch(QueryException $e){
              Log::error($e->getMessage());
                  return response()->json([
                      'message'=>'Ha habido un fallo al listar todos los usuarios. Intente de nuevo',
                      'data'=>[],
                      'status'=>'Error'
                  ],500);
          }
      }
  
      protected function propietarioList($archivado) {
        try{
          $usersP =  DB::table('users as U')
                      ->join('Propietario as P', 'U.id', '=', 'P.id')
                      ->select('U.id',
                               'U.email',
                               'P.Nombre',
                               'P.Apellido',
                               'P.Telefono',
                               'P.id_Personal')
                               ->addSelect(
                               DB::raw('image as Imagen'),
                               DB::raw('type_user as Tipo'),  
                               )->where('P.archivado',$archivado)
                               ->get();
  
                  if($usersP->isEmpty()){
                    return response()->json([
                      'message'=>'No hay propietarios en el sistema',
                      'data'=>[],
                      'status'=>'OK'
                  ],204);
                  }else{
                    return response()->json([
                      'message'=>'Propietarios en el sistema',
                      'data'=>$usersP,
                      'status'=>'OK'
                  ],200);
                  }
          }catch(QueryException $e){
              Log::error($e->getMessage());
                  return response()->json([
                      'message'=>'Ha habido un fallo al listar los propietarios. Intente de nuevo',
                      'data'=>[],
                      'status'=>'Error'
                  ],500);
          }
      }
  
      protected function transcriptorList($archivado) {
        try{
          $usersT =  DB::table('users as U')
                ->join('Transcriptor as T', 'U.id', '=', 'T.id')
                ->select('U.id',
                    'U.email',
                    'T.Nombre',
                    'T.Apellido',
                    'T.Telefono',
                    'T.id_Personal',
                    'T.Tipo_Transcriptor')
                    ->addSelect(
                      DB::raw('image as Imagen'),
                      DB::raw('type_user as Tipo'), 
                      )->where('T.archivado',$archivado)
                      ->get();
  
                  if($usersT->isEmpty()){
                    return response()->json([
                      'message'=>'No hay transcriptores en el sistema',
                      'data'=>[],
                      'status'=>'OK'
                  ],204);
                  }else{
                    return response()->json([
                      'message'=>'Transcriptores en el sistema',
                      'data'=>$usersT,
                      'status'=>'OK'
                  ],200);
                  }
          }catch(QueryException $e){
              Log::error($e->getMessage());
                  return response()->json([
                      'message'=>'Ha habido un fallo al listar los transcriptores. Intente de nuevo',
                      'data'=>[],
                      'status'=>'Error'
                  ],500);
          }
      }

      protected function unicoUser($id) {
        try{
       $user = DB::table('users as u')
        ->leftJoin('Propietario as p', 'u.id', '=', 'p.id')
        ->leftJoin('Transcriptor as t', 'u.id', '=', 't.id')
        ->select('u.id',
                  'u.email')
                    ->addSelect(
                      DB::raw('COALESCE(p.Nombre, t.Nombre) as Nombre'),
                      DB::raw('COALESCE(p.Apellido, t.Apellido) as Apellido'),
                      DB::raw('COALESCE(p.Telefono, t.Telefono) as Telefono'),
                      DB::raw('COALESCE(p.id_Personal, t.id_Personal) as id_Personal'),
                      DB::raw('COALESCE(t.Tipo_Transcriptor, "") as Tipo_Transcriptor')
                  )->where('u.id', $id) //ubico a partir de su id especifica
                  ->get();

                  //elimino el campo Tipo_Transcriptor si viene como vacio (debido al proopietario)
                  $user = $user->map(function ($item) {
            
                    if (empty($item->Tipo_Transcriptor)) {
                        unset($item->Tipo_Transcriptor); //elimino el campo solo para este momento
                    }
                    return $item;
                });

            if($user->isEmpty()){
              return response()->json([
                'message'=>'Usuario no encontrado',
                'data'=>[],
                'CODE' => 'NO_DATA',
                'status'=>'OK'
              ],204);
            }else{
              return response()->json([
                'message'=>'Usuario',
                'data'=>$user,
                'status'=>'OK'
              ],200);
              }
        }catch(QueryException $e){
            Log::error($e->getMessage());
            return response()->json([
                'message'=>'Ha habido un fallo al listar el usuario. Intente de nuevo',
                'data'=>[],
                'status'=>'Error'
            ],500);
        }
      }

      protected function modificarUsuario(modificarUser $data, $id) {
        try{
        $user = $this->obtenerUsuarioID($id);
        $pass = $data['password'];

            if(is_null($user)){
              return response()->json([
                'message'=>'No hay informacion del Usuario',
                'data'=>[],
                'status'=>'OK'
              ],200);
            }
            
            if($data['email'] == $user->email){
              $correo = $user->email;
            }elseif($this->encontrarCorreo($data['email'],$id)){ //verifica que el correo no exista
              return response()->json([                         // en otro registro
                'message'=>'Correo en uso',
                'data'=>[],
                'status'=>'OK'
              ],200);
            }else{
              $correo = $data['email'];
            }
            //verifica si se envio una nueva contraseña por el formulario
            if(is_null($pass)){
              $newPassword = $user->password;
            }elseif(!Hash::check($pass, $user->password)){ //verifica si la contraseña ingresada es la misma
              $newPassword = Hash::make($pass);
            }else{
              $newPassword = $user->password;
            }

            $dataUser = [
              'name' => $data['name'],
              'email' => $correo,
              'password' => $newPassword
            ];

            $dataAux = [
              'Nombre' => $data['name'],
              'Apellido' => $data['lastname'],
              'Telefono' => $data['cellphone'],
              'id_Personal' => $data['id_Personal']
            ];

            $usuario = User::findOrFail($id);
            $usuario->update($dataUser);

          if($user->type_user == 'Propietario'){

            $usuarioP = propietario::findOrFail($id);
            $usuarioP->update($dataAux);
          }else{
            
            $usuarioT = transcriptor::findOrFail($id);
            $usuarioT->update($dataAux);
          }

          $data = [
            'email' => $correo,
            'password' => $newPassword,
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'cellphone' => $data['cellphone'],
            'id_Personal' => $data['id_Personal']
          ];
          return response()->json([
            'message'=>'Se ha modificado el usuario con exito',
            'data usuario'=>$data,
            'status'=>'OK'
        ],200);
  
        }catch(\Exception $e){
          Log::error($e->getMessage());
            return response()->json([
                'message'=>'Ha habido un fallo al modificar el usuario. Intente de nuevo',
                'data'=>[],
                'status'=>'Error'
            ],500);
        }
      }

      protected function obtenerUsuarioID($id){
        try{
          return DB::table('users as u')
        ->leftJoin('Propietario as p', 'u.id', '=', 'p.id')
        ->leftJoin('Transcriptor as t', 'u.id', '=', 't.id')
        ->select('u.id',
                  'u.email',
                  'u.password',
                  'u.type_user')
                    ->addSelect(
                      DB::raw('COALESCE(p.Nombre, t.Nombre) as Nombre'),
                      DB::raw('COALESCE(p.Apellido, t.Apellido) as Apellido'),
                      DB::raw('COALESCE(p.Telefono, t.Telefono) as Telefono'),
                      DB::raw('COALESCE(p.id_Personal, t.id_Personal) as id_Personal'),
                  )->where('u.id', $id) //ubico a partir de su id especifica
                  ->first();
            
        }catch(QueryException $e){
          Log::error($e->getMessage());
            return response()->json([
                'message'=>'Ha habido un fallo al solicitar los datos',
                'data'=>[],
                'status'=>'Error'
            ],500);
        }
      }

      protected function encontrarCorreo($newEmail,$id){
        try{
          return DB::table('users')
            ->where('email', $newEmail)
            ->where('id', '<>', $id)
            ->exists();

        }catch(\Exception $e){
          Log::error($e->getMessage());
          return response()->json([
              'message'=>'Ha habido un fallo al solicitar los datos',
              'data'=>[],
              'status'=>'Error'
          ],500);
        }
      }

    protected function eliminarUsuario($id) {
      $response = null;
     try{
        DB::transaction(function () use ($id, &$response) {
          $user = User::find($id);

        if(is_null($user)){
            $response = response()->json([
              'message'=>'No existe registro alguno',
              'status'=>'OK'
            ],200);
           
            return;
        }

        if($user->type_user == "Propietario"){
            $response =  $this->eliminarPropietario($user);
        }else{
            $response = $this->eliminarTranscriptor($user);
        }
      
      });
     }catch(\Exception $e){
      DB::rollBack();
      Log::error($e->getMessage());
          return response()->json([
              'message'=>'Ha habido un fallo al eliminar la informacion',
              'data'=>[],
              'status'=>'Error'
          ],500);
     }
      return $response;
    }

    private function eliminarPropietario($user) {
      $propietario = propietario::findOrFail($user->id);
          
        DB::table('afiliacion')->where('id_Personal_P',$propietario->id)->delete();
      // Asegura de que todos los métodos deleting se ejecuten
        foreach ($propietario->finca as $finca) {

            foreach($finca->animales as $animal){
              $animal->delete();
            }
          $finca->delete();
       }
       DB::table('propietario')->where('id', $user->id)->delete();
       DB::table('users')->where('id',$user->id)->delete();

       return response()->json([
        'message' => 'Se elimino el registro del propietario',
        'status' => 'OK'
    ], 200);
    }

    private function eliminarTranscriptor($user) {
      $transcriptor = transcriptor::findOrFail($user->id);

      DB::table('afiliacion')->where('id_Personal_T',$transcriptor->id)->delete();

      DB::table('transcriptor')->where('id', $transcriptor->id)->delete();
      DB::table('users')->where('id',$user->id)->delete();

      return response()->json([
        'message' => 'Se elimino el registro del transcriptor',
        'status' => 'OK'
    ], 200);
    }

    protected function archivarUsuario($id,$tipo_usuario,$archivado) {
      $resultado = null;
      try{
        DB::transaction(function () use ($id, $archivado,$tipo_usuario, &$resultado) {

       if($tipo_usuario == 'propietario'){

          $propietario = propietario::where('id', $id)->update(['archivado' => $archivado]);
            if($propietario>0){
              $finca =Finca::where('id_Propietario', $id)->update(['archivado' => $archivado]);
              //obtiene el array de id posibles de finca del propietario
            $fincaIds = Finca::where('id_Propietario', $id)->pluck('id_Finca');
            //actualiza a partir del whereIn los rebaños enviados por los id
            $rebano=Rebano::whereIn('id_Finca', $fincaIds)->update(['archivado' => $archivado]);
              //obtiene el array de id posibles de rebaños de la finca
            $rebanoIds = Rebano::whereIn('id_Finca',$fincaIds)->pluck('id_Rebano');
            //actualiza a partir del whereIn los animales del array de id de rebaño
            $animal= Animal::whereIn('id_Rebano',$rebanoIds)->update(['archivado'=>$archivado]);
            }
          
            if($propietario>0 || $finca>0 || $rebano>0 || $animal>0){
              $resultado = response()->json([
                'message'=>'Se modifico el archivo con exito',
                'status'=>'OK'
              ],200);
            }
              }else{
                $transcriptor = transcriptor::where('id', $id)->update(['archivado' => $archivado]);
                if($transcriptor>0){
                  $resultado = response()->json([
                    'message'=>'Se modifico el archivo con exito',
                    'status'=>'OK'
                  ],200);
                }
              }
            });
          }catch(\Exception $e){
            Log::error($e->getMessage());
            return response()->json([
              'message'=>'Ha habido un fallo al cambiar el estado de archivado',
              'data'=>[],
              'status'=>'Error'
          ],500);
          }
          return $resultado;
       }

    //Todos los usuarios del sistema para visualizar por el administrador
    protected function crudUsuarios( $archivado=0) 
    {
      $user = Auth::user();
      $jsonData = $this->usersListAll($archivado);
      return view('usuario.welcome', ['user' => $user,
                                      'tipo' => '',
                                      'userData' => json_decode($jsonData->getContent(), true)]);
    }

    protected function usersListAll($archivado) 
    {
        try{
        $users = DB::table('users as us')
                ->select('us.id',
                          'us.email')
                            ->addSelect(
                              DB::raw('name as Nombre'),
                              DB::raw('image as Imagen'),
                              DB::raw('type_user as Tipo'),                             
                          )->get();

          //elimino el campo Tipo_Transcriptor si viene como vacio (debido al proopietario)
          $users = $users->map(function ($item) {
          
            if (empty($item->Tipo_Transcriptor)) {
                unset($item->Tipo_Transcriptor);
            }
            return $item;
        });

          if($users->isEmpty()){
            return response()->json([
              'message'=>'No hay usuarios en el sistema',
              'data'=>[],
              'status'=>'OK'
          ],204);
          }else{
            return response()->json([
              'message'=>'Usuarios en el sistema',
              'data'=>$users,
              'status'=>'OK'
          ],200);
          }
        }catch(QueryException $e){
            Log::error($e->getMessage());
                return response()->json([
                    'message'=>'Ha habido un fallo al listar todos los usuarios. Intente de nuevo',
                    'data'=>[],
                    'status'=>'Error'
                ],500);
        }
    }

}
