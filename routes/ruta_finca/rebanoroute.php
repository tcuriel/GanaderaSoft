<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fincacontroller;

//ruta para crear rebano de una finca
Route::post('/crear-rebano/{id_Finca}',[fincacontroller::class,'rebanoStore']);
//ruta para listar rebano de una finca
Route::get('/listar-rebano/{tipoListado}/{id_Finca}',[fincacontroller::class, 'listarRebano']);

Route::get('/filtrar-rebano/{filtrado}/{idFinca}',[fincacontroller::class,'filtrarRebano']);
Route::get('/get-rebano/{idRebano}',[fincacontroller::class,'getRebano']);
