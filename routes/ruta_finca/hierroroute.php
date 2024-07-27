<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fincacontroller;

//ruta para modificar hierro de la finca
Route::put('/modificar-hierro/{id_finca}/{id_Propietario}',[fincacontroller::class, 'hierroUpdate']);