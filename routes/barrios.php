<?php

use App\Http\Controllers\BarrioController;
use Illuminate\Support\Facades\Route;

Route::get('/barrios', [BarrioController::class, 'index']);
Route::post('/barrios/store', [BarrioController::class, 'store']);
Route::post('/barrios/update', [BarrioController::class, 'update']);
Route::delete('/barrios/delete/{id}', [BarrioController::class, 'delete']);
Route::get('/barrios/show/{id}', [BarrioController::class, 'show']);
Route::get('/barrios/{id}/propiedades', [BarrioController::class, 'propiedades']);
