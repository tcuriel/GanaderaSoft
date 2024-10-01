<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;

//agregar raza mixta
Route::post('/agregar-raza/{idFinca}',[AnimalController::class,'agregarRazaMixta']);

Route::get('/listar-raza/{tipo}/{idFinca}',[AnimalController::class,'listarRazas']);

Route::delete('/eliminar-raza/{idComposicon}',[AnimalController::class,'eliminarRazaMixta']);

Route::put('/modificar-raza/{idFinca}/{idComposicion}',[AnimalController::class,'modificarRazaMixta']);