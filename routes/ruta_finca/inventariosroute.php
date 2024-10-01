<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FincaController;

//Rutas para crear el inventario
Route::post('/inventario-general/{idFinca}',[FincaController::class,'inventarioGeneralStore']);
Route::post('/inventario-vacuno/{idFinca}',[FincaController::class,'inventarioVacunoStore']);
Route::post('/inventario-bufalo/{idFinca}',[FincaController::class,'inventarioBufaloStore']);
//rutas para listar inventario
Route::get('/listar-inventario-general/{idFinca}',[FincaController::class,'listarInvGeneral']);
Route::get('/listar-inventario-vacuno/{idFinca}',[FincaController::class,'listarInvVacuno']);
Route::get('/listar-inventario-bufalo/{idFinca}',[FincaController::class,'listarInvBufalo']);
//Rutas para obtener el inventario
Route::get('/inventario-general/{idInventario}',[FincaController::class,'inventarioGeneralGet']);
Route::get('/inventario-vacuno/{idInventario}',[FincaController::class,'inventarioVacunoGet']);
Route::get('/inventario-bufalo/{idInventario}',[FincaController::class,'inventarioBufaloGet']);
