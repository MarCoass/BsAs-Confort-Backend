<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Propiedad;
use Illuminate\Http\Request;

class BarrioController extends Controller
{
    public function index()
    {
        $data = Barrio::all();
        return response()->json($data);
    }
    public function propiedades($id)
    {
        if ($id == 0) {
            // Obtener los barrio_id de barrios con estado = 1
            $barriosExcluidos = Barrio::where('estado', 1)->pluck('id')->toArray();

            // Obtener propiedades cuyo barrio_id no esté en la lista de barrios excluidos
            $data = Propiedad::whereNotIn('barrio_id', $barriosExcluidos)
                ->where('estado', '<>', 0)
                ->with('barrio')
                ->get();
        } else {
            // Obtener propiedades con el barrio_id especificado
            $data = Propiedad::where('barrio_id', $id)
                ->where('estado', '<>', 0)
                ->with('barrio')
                ->get();
        }

        return response()->json($data);
    }


    public function store(Request $request)
    {
        $barrio = new Barrio();
        $barrio->nombre = $request->input('nombre');
        $barrio->estado = $request->input('estado');
        if ($request->input('prioridad') != null) {
            $barrio->prioridad = $request->input('prioridad');
        }
        $barrio->save();

        if ($request->hasFile('imagen_0')) {
            foreach ($request->file() as $key => $file) {
                if ($key === 'video') {
                    continue; // Saltar el archivo de video en este bucle
                }
                $extension = $file->getClientOriginalExtension(); // Obtener la extensión del archivo
                $nombreSinEspacios = str_replace(' ', '', $request->input('nombre')); // Eliminar espacios para evitar problemas
                $nombreBarrio = $barrio->id . $nombreSinEspacios . '_' . mt_rand(100, 2000) . '.' . $extension; // Generar un nombre único para la imagen
                $barrio->nombre_archivos = $barrio->id . $nombreSinEspacios; //guardo el nombre de la imagenes
                $file->storeAs('/barrios', $nombreBarrio, 'public'); // Subir la imagen al directorio 'public/propiedades'

            }
        }

        // Guardar video
        if ($request->hasFile('video')) {
            $video = $request->file('video'); // Obtener el archivo de video
            $nombreSinEspacios = str_replace(' ', '', $request->input('nombre'));
            $nombreVideo = $barrio->id . $nombreSinEspacios . '_video.' . $video->getClientOriginalExtension(); // Generar un nombre único para el video
            $barrio->nombre_archivos = $barrio->id . $nombreSinEspacios;
            $video->storeAs('/barrios', $nombreVideo, 'public'); // Subir el video al directorio 'public/propiedades'
        }

        if ($barrio->save()) {
            return response()->json(['message' => 'Barrio creado exitosamente'], 201);
        } else {
            $barrio->delete();
            return response()->json(['message' => 'Error al crear el barrio'], 500);
        }
    }


    public function update(Request $request)
    {
        $barrio = Barrio::find($request->input('id'));
        $barrio->nombre = $request->input('nombre');
        $barrio->estado = $request->input('estado');
        if ($request->input('prioridad') != null) {
            $barrio->prioridad = $request->input('prioridad');
        }
        if ($barrio->save()) {
            return response()->json(['message' => 'Barrio editato exitosamente'], 201);
        } else {
            return response()->json(['message' => 'Error al editar el barrio'], 500);
        }
    }
    public function delete($id)
    {
        $barrio = Barrio::find($id);
        //revisar que no existan dptos en el barrio
        $cantPropiedades = Propiedad::where('barrio_id', $id)->count();
        if ($cantPropiedades > 0) {
            return response()->json(['message' => 'No es posible eliminar el barrio, existen propiedades'], 500);
        } else {
            if ($barrio->delete()) {
                return response()->json(['message' => 'Barrio eliminado exitosamente'], 201);
            } else {
                return response()->json(['message' => 'Error al eliminar el barrio'], 500);
            }
        }
    }
    public function show($id)
    {
        $barrio = Barrio::find($id);
        return response()->json($barrio);
    }
}
