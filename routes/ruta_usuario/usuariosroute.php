<?php
//aqui estaran presente las rutas de los tipos de usuarios (propietario,admin,transcriptor)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\User\SubirUsuarioController;

/* Route::post('/login',[logincontroller::class,'login']);
Route::post('/register',[logincontroller::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function(){

   Route::get('/logout',[logincontroller::class,'logout']);
}); */

//csv

Route::post('/csv-users',[RegisterController::class,'addUserMasivo'])->name('import.users.csv');

// Assuming you have a route defined for the API endpoint
Route::get('/api/user', [App\Http\Controllers\Api\UserController::class,'getUser'])->name('getUser');

//listar usuario por admin
Route::get('/listado/{opcion}/{archivado}',[PrincipalController::class,'userOptionList'])->name('users.option.list');

Route::get('/consultar/{id}',[PrincipalController::class,'unicoUser'])->name('user.consult');

Route::put('/modificar/{id}',[PrincipalController::class,'modificarUsuario']);

Route::delete('/eliminar/{id}',[PrincipalController::class,'eliminarUsuario']);

Route::put('/archivo/{id}/{tipoUsuario}/{archivado}',[PrincipalController::class,'archivarUsuario']);