<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FincaController;

//agregar personal a finca
Route::post('/ingresar-personal/{id_Finca}',[FincaController::class, 'personalFincaStore']);
//listar personal de una finca
Route::get('/listar-personal/{id_Finca}',[FincaController::class, 'fincaPersonal']);
//filtrar personal
Route::get('/filtrar-personal/{categoria}/{filtrado}/{idFinca}',[FincaController::class,'filtrarPersonal']);
//actualizar informacion
Route::put('/actualizar-informacion/{cedula}/{idFinca}',[FincaController::class,'personalUpdate']);
//eliminar personal por identificacion
Route::delete('/eliminar-personal/{id}',[FincaController::class,'eliminarPersonal']);

Route::get('/actividades/{id}',[FincaController::class,'actividadesPersonal']);

Route::get('/get-personal/{idPersonal}',[FincaController::class,'getPersonal']);
