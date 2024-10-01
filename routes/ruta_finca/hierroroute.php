<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FincaController;

//ruta para modificar hierro de la finca
Route::put('/modificar-hierro/{id_finca}/{id_Propietario}',[FincaController::class, 'hierroUpdate']);