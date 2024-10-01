<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;

//cear cambio
Route::post('/cambio/{id_Animal}',[AnimalController::class,'realizarCambio']);

Route::put('/modificar-cambio/{idCambio}',[AnimalController::class,'modificarCambio']);

Route::get('/listar-cambio/{idCambio}',[AnimalController::class,'listarCambios']);

Route::delete('/eliminar-historicos/{idCambio}',[AnimalController::class,'eliminarHistoricosCambios']);