<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FincaController;

//ruta para crear rebano de una finca
Route::post('/crear-rebano/{id_Finca}',[FincaController::class,'rebanoStore']);
//ruta para listar rebano de una finca
Route::get('/listar-rebano/{tipoListado}/{id_Finca}',[FincaController::class, 'listarRebano']);

Route::get('/filtrar-rebano/{filtrado}/{idFinca}',[FincaController::class,'filtrarRebano']);
Route::get('/get-rebano/{idRebano}',[FincaController::class,'getRebano']);
