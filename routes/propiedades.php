<?php

use App\Http\Controllers\PropiedadController;
use Illuminate\Support\Facades\Route;

Route::get('/propiedades', [PropiedadController::class, 'index']);
Route::get('/alquileres/activos', [PropiedadController::class, 'alquileresActivos']);
Route::get('/ventas', [PropiedadController::class, 'ventas']);
Route::post('/propiedades/store', [PropiedadController::class, 'store']);
Route::post('/propiedades/update/{id}', [PropiedadController::class, 'update']);
Route::delete('/propiedades/delete/{id}', [PropiedadController::class, 'delete']);
Route::get('/propiedades/show/{id}', [PropiedadController::class, 'show']);
