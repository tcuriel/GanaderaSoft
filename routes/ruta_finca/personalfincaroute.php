<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fincacontroller;

//agregar personal a finca
Route::post('/ingresar-personal/{id_Finca}',[fincacontroller::class, 'personalFincaStore']);
//listar personal de una finca
Route::get('/listar-personal/{id_Finca}',[fincacontroller::class, 'fincaPersonal']);
//filtrar personal
Route::get('/filtrar-personal/{categoria}/{filtrado}/{idFinca}',[fincacontroller::class,'filtrarPersonal']);
//actualizar informacion
Route::put('/actualizar-informacion/{cedula}/{idFinca}',[fincacontroller::class,'personalUpdate']);
//eliminar personal por identificacion
Route::delete('/eliminar-personal/{id}',[fincacontroller::class,'eliminarPersonal']);

Route::get('/actividades/{id}',[fincacontroller::class,'actividadesPersonal']);

Route::get('/get-personal/{idPersonal}',[fincacontroller::class,'getPersonal']);
