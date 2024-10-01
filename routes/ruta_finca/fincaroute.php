<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FincaController;

//ruta para crear finca
Route::post('/crear-finca/{idPropietario}',[FincaController::class, 'fincaStore']);
//ruta para modificar datos de finca
Route::put('/modificar-finca/{id_Finca}',[FincaController::class, 'fincaUpdate']);
//rutas listar fincas
Route::get('/fincas/{id_P}/{tipoListado}',[FincaController::class, 'fincasPropietario']);
Route::get('/Mostrar-Fincas',[FincaController::class, 'listarFincas']);
Route::delete('/Eliminar/{id}',[FincaController::class,'destroy']);
//obtener finca
Route::get('/finca/{idFinca}',[FincaController::class,'getFarm']);
Route::get('/fincafulldata/{idFinca}',[FincaController::class,'getFarmFullData']);
//filtrar finca por categoria
Route::get('/fincas/{categoria}/{filtrado}/{idPropietario}',[FincaController::class,'filtrarfincas']);

//Ruta de afiliacion
Route::post('/asignar-afiliacion/{tipo}/{id_Finca}/{id_Propietario}/{id_Transcriptor}',[FincaController::class,'crearAfiliacion']);
//actualizar
Route::put('/actualizar/{estado}/{idPropietario}/{idTranscriptor}/{idFinca}',[FincaController::class,'actualizarEstadoAfiliacion']);

Route::get('/lista-afiliaciones/{tipoUser}/{id}',[FincaController::class,'listarAfiliaciones']);

//csv
Route::post('/agregar-finca',[FincaController::class,'addFincaMasivo']);
