<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fincacontroller;

//ruta para crear finca
Route::post('/crear-finca/{idPropietario}',[fincacontroller::class, 'fincaStore']);
//ruta para modificar datos de finca
Route::put('/modificar-finca/{id_Finca}',[fincacontroller::class, 'fincaUpdate']);
//rutas listar fincas
Route::get('/fincas/{id_P}/{tipoListado}',[fincacontroller::class, 'fincasPropietario']);
Route::get('/Mostrar-Fincas',[fincacontroller::class, 'listarFincas']);
Route::delete('/Eliminar/{id}',[fincacontroller::class,'destroy']);
//obtener finca
Route::get('/finca/{idFinca}',[fincacontroller::class,'getFarm']);
Route::get('/fincafulldata/{idFinca}',[fincacontroller::class,'getFarmFullData']);
//filtrar finca por categoria
Route::get('/fincas/{categoria}/{filtrado}/{idPropietario}',[fincacontroller::class,'filtrarfincas']);

//Ruta de afiliacion
Route::post('/asignar-afiliacion/{tipo}/{id_Finca}/{id_Propietario}/{id_Transcriptor}',[fincacontroller::class,'crearAfiliacion']);
//actualizar
Route::put('/actualizar/{estado}/{idPropietario}/{idTranscriptor}/{idFinca}',[fincacontroller::class,'actualizarEstadoAfiliacion']);

Route::get('/lista-afiliaciones/{tipoUser}/{id}',[fincacontroller::class,'listarAfiliaciones']);

//csv
Route::post('/agregar-finca',[fincacontroller::class,'addFincaMasivo']);
