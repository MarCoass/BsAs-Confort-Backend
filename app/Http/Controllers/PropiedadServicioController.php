<?php

namespace App\Http\Controllers;

use App\Models\Propiedad;
use App\Models\propiedad_servicio;
use App\Models\Servicio;
use Illuminate\Http\Request;

class PropiedadServicioController extends Controller
{
    //
    public function index()
    {
    }

    public function store(Request $request)
    {
        try {
            $servicios = $request->input('servicios');
            foreach ($servicios as $servicio) {
                $serv = Servicio::find($servicio);
                if (!$serv) {
                    return response()->json(['message' => 'Servicio no encontrado: ' . $servicio], 404);
                }
                $propiedadServicio = new propiedad_servicio();
                $propiedadServicio->propiedad_id = $request->input('propiedad_id');
                $propiedadServicio->servicio()->associate($serv);
                $propiedadServicio->save();
            }
            return response()->json(['message' => 'Servicios guardados correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al guardar los servicios: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request)
{
    try {
        // Validar que el campo 'propiedad_id' exista en la solicitud
        $request->validate([
            'propiedad_id' => 'required|integer|exists:propiedades,id',
            'servicios' => 'sometimes|array',
            'servicios.*' => 'integer|exists:servicios,id'
        ]);

        // Obtener la propiedad por su ID
        $propiedad = Propiedad::find($request->input('propiedad_id'));
        if (!$propiedad) {
            return response()->json(['message' => 'Propiedad no encontrada'], 404);
        }

        // Obtener los servicios de la solicitud, puede ser un array vacío
        $servicios = $request->input('servicios', []);

        // Sincronizar los servicios de la propiedad, se eliminarán todas las relaciones si el array es vacío
        $propiedad->servicios()->sync($servicios);

        return response()->json(['message' => 'Servicios actualizados correctamente'], 200);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['message' => 'Datos de solicitud no válidos', 'errors' => $e->errors()], 400);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al actualizar los servicios: ' . $e->getMessage()], 500);
    }
}

    
}
