<?php

use App\Http\Controllers\PropiedadServicioController;
use App\Http\Controllers\ServicioController;

use Illuminate\Support\Facades\Route;

Route::get('/servicios', [ServicioController::class, 'index']);
Route::post('/servicios/store', [ServicioController::class, 'store']);
Route::post('/servicios/update', [ServicioController::class, 'update']);
Route::delete('/servicios/delete/{id}', [ServicioController::class, 'delete']);
Route::get('/servicios/show/{id}', [ServicioController::class, 'show']);
Route::post('/propiedadServicio/store', [PropiedadServicioController::class, 'store']);
Route::post('/propiedadServicio/update', [PropiedadServicioController::class, 'update']);
