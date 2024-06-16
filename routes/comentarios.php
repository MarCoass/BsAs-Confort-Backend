<?php

use App\Http\Controllers\ComentarioController;
use Illuminate\Support\Facades\Route;

Route::get('/comentarios', [ComentarioController::class, 'index']);
Route::get('/comentarios/activos', [ComentarioController::class, 'comentariosActivos']);
Route::post('/comentarios/store', [ComentarioController::class, 'store']);
Route::post('/comentarios/cambiarEstado/{id}', [ComentarioController::class, 'cambiarEstado']);
Route::delete('/comentarios/delete/{id}', [ComentarioController::class, 'delete']);
Route::get('/comentarios/show/{id}', [ComentarioController::class, 'show']);
Route::get('/comentarios/propiedad/{id}', [ComentarioController::class, 'propiedad']);


Route::post('/comentarios/nuevo', [ComentarioController::class, 'store']);
Route::get('/comentarios/contador/{id}', [ComentarioController::class, 'contadorComentarios']);
