<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fincacontroller;

//Rutas para crear el inventario
Route::post('/inventario-general/{idFinca}',[fincacontroller::class,'inventarioGeneralStore']);
Route::post('/inventario-vacuno/{idFinca}',[fincacontroller::class,'inventarioVacunoStore']);
Route::post('/inventario-bufalo/{idFinca}',[fincacontroller::class,'inventarioBufaloStore']);
//rutas para listar inventario
Route::get('/listar-inventario-general/{idFinca}',[fincacontroller::class,'listarInvGeneral']);
Route::get('/listar-inventario-vacuno/{idFinca}',[fincacontroller::class,'listarInvVacuno']);
Route::get('/listar-inventario-bufalo/{idFinca}',[fincacontroller::class,'listarInvBufalo']);
//Rutas para obtener el inventario
Route::get('/inventario-general/{idInventario}',[fincacontroller::class,'inventarioGeneralGet']);
Route::get('/inventario-vacuno/{idInventario}',[fincacontroller::class,'inventarioVacunoGet']);
Route::get('/inventario-bufalo/{idInventario}',[fincacontroller::class,'inventarioBufaloGet']);
