<?php

use App\Http\Controllers\Imagenes;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Barrio;
use App\Models\Comentario;
use App\Models\Propiedad;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});
/* Route::get('/user', function (Request $request) {
    if (!$request->session()->has('user')) {
        return response()->json(['error' => 'No session data'], 401);
    }

    Log::info($request->session()->all());

    return response()->json($request->session()->all());
}); */
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Log::info($request->session()->all());
    return response()->json($request->user());
});
Route::get('/existeSesion', function (Request $request) {
    Log::info($request->session()->all());
    return response()->json($request->user() ? true : false);
});

Route::get('/informacion', function () {
    $cantPropiedades = Propiedad::all()->count();
    $cantBarrios = Barrio::all()->count();
    $cantComentarios = Comentario::all()->count();
    return response()->json(['propiedades' => $cantPropiedades, 'barrios' => $cantBarrios, 'comentarios' => $cantComentarios]);
});

require __DIR__ . '/auth.php';
require __DIR__ . '/barrios.php';
require __DIR__ . '/servicios.php';
require __DIR__ . '/propiedades.php';
require __DIR__ . '/comentarios.php';
require __DIR__ . '/files.php';

Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);
