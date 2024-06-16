<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
     /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): Response
    {
        // Verificar si el usuario ya está autenticado
        if (Auth::check()) {
            // El usuario ya está autenticado, mostrar un mensaje de error
            throw ValidationException::withMessages([
                'auth' => 'Ya has iniciado sesión. No puedes acceder a esta página.',
            ]);
        }

        // Si el usuario no está autenticado, proceder con el proceso de inicio de sesión
        Log::info('Login attempt for email: ' . $request->email);
        $request->authenticate();

        $request->session()->regenerate();

        return response()->noContent();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::logout(); // Cierra la sesión del usuario autenticado

        $request->session()->invalidate(); // Invalida la sesión actual
        $request->session()->regenerateToken(); // Genera un nuevo token de sesión

        return response()->noContent();
    }
}
