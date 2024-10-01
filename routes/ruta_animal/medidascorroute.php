<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;


Route::post('/agregar-medida/{idAnimal}',[AnimalController::class,'agregarMedidas']);

Route::put('/modificar-medida/{idMedida}',[AnimalController::class,'modificarMedidas']);

Route::get('/listar-medidas/{idMedida}',[AnimalController::class,'listarMedidas']);

Route::delete('/eliminar-historicos/{idMedida}',[AnimalController::class,'modificarHistoricosMedidas']);