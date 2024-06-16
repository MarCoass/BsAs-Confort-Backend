<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index()
    {
        $data = Servicio::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $servicio = new Servicio();
        $servicio->nombre = $request->input('nombre');
        if ($servicio->save()) {
            return response()->json(['message' => 'Servicio creado exitosamente'], 201);
        } else {
            return response()->json(['message' => 'Error al crear el servicio'], 500);
        }
    }

    public function update(Request $request)
    {
        $servicio = Servicio::find($request->input('id'));
        $servicio->nombre = $request->input('nombre');
        if ($servicio->save()) {
            return response()->json(['message' => 'Servicio editato exitosamente'], 201);
        } else {
            return response()->json(['message' => 'Error al editar el servicio'], 500);
        }
    }

    public function delete($id)
    {
        $servicio = Servicio::find($id);
        //revisar que no existan dptos usando el servicio
            if ($servicio->delete()) {
                return response()->json(['message' => 'Servicio eliminado exitosamente'], 201);
            } else {
                return response()->json(['message' => 'Error al eliminar el servicio'], 500);
            } 
    }
    public function show($id)
    {
        $servicio = Servicio::find($id);
        return response()->json($servicio);
    }
}
