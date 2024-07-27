<?php
//aqui estaran presente las rutas de los tipos de usuarios (propietario,admin,transcriptor)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\principalcontroller;
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
Route::get('/listado/{opcion}/{archivado}',[principalcontroller::class,'userOptionList'])->name('users.option.list');

Route::get('/consultar/{id}',[principalcontroller::class,'unicoUser'])->name('user.consult');

Route::put('/modificar/{id}',[principalcontroller::class,'modificarUsuario']);

Route::delete('/eliminar/{id}',[principalcontroller::class,'eliminarUsuario']);

Route::put('/archivo/{id}/{tipoUsuario}/{archivado}',[principalcontroller::class,'archivarUsuario']);