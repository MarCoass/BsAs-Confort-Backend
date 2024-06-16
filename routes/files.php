<?php

use App\Http\Controllers\BarrioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Imagenes;

Route::get('/images/{carpeta}/{idPrefix}', [Imagenes::class, 'showImages']);
Route::delete('/propiedades/files/delete/{name}', [Imagenes::class, 'deletePropiedad']);
Route::delete('/barrios/files/delete/{name}', [Imagenes::class, 'deleteBarrio']);
Route::post('/propiedades/files/upload', [Imagenes::class, 'uploadPropiedad']);
Route::post('/barrios/files/upload', [Imagenes::class, 'uploadBarrio']);
