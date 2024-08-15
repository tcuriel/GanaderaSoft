<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\reproduccioncontroller;

Route::get('/reproduccion/{id_rebano}/{selectView}',[reproduccioncontroller::class,'getReproduccion']);

Route::get('/registros-celo/{id_Animal}',[reproduccioncontroller::class,'getDataFormServicio']);
Route::get('/registros-padrote/{id_Animal}',[reproduccioncontroller::class,'getDataPadrote']);
Route::get('/registros-semen/{id_Toro}',[reproduccioncontroller::class,'getdataSemen']);

Route::post('/registrar-servicio',[reproduccioncontroller::class,'postRegistrarServicio']);