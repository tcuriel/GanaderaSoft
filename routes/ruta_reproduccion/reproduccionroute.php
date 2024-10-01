<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReproduccionController;

Route::get('/reproduccion/{id_rebano}/{selectView}',[ReproduccionController::class,'getReproduccion']);

Route::get('/registros-celo/{id_Animal}',[ReproduccionController::class,'getDataFormServicio']);
Route::get('/registros-padrote/{id_Animal}',[ReproduccionController::class,'getDataPadrote']);
Route::get('/registros-semen/{id_Toro}',[ReproduccionController::class,'getdataSemen']);

Route::post('/registrar-servicio',[ReproduccionController::class,'postRegistrarServicio']);