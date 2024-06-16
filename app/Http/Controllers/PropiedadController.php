<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Propiedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PropiedadController extends Controller
{
    public function index()
    {
        $data = Propiedad::with('barrio')->with('servicios')->get();
        return response()->json($data);
    }
    public function alquileresActivos()
    {
        $data = Propiedad::with('barrio')->with('servicios')->where('estado', '<>', 0)->where('tipo_alquiler', '<>', 0)->get();
        return response()->json($data);
    }
    public function ventas()
    {
        $data = Propiedad::with('barrio')->with('servicios')->where('estado', '<>', 0)->where('venta', 1)->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {

        $propiedad = new Propiedad();
        $propiedad->calles = $request->input('calles');
        $propiedad->cant_habitaciones = $request->input('cant_habitaciones') ? $request->input('cant_habitaciones') : null;
        $propiedad->cant_banios = $request->input('cant_banios') ? $request->input('cant_banios') : null;
        $propiedad->cant_personas = $request->input('cant_personas') ? $request->input('cant_personas') : null;
        $propiedad->tamanio = $request->input('tamanio') ? $request->input('tamanio') : null;
        $propiedad->estado = $request->input('estado');
        $propiedad->latitud = $request->input('latitud');
        $propiedad->longitud = $request->input('longitud');
        $propiedad->tipo_alquiler = $request->input('tipo_alquiler');
        $propiedad->venta = $request->input('venta')=='true';


        //asociar el barrio
        $barrio = Barrio::find($request->input('barrio'));
        $propiedad->barrio()->associate($barrio);

        $propiedad->save();

        // Guardar imágenes
        if ($request->hasFile('imagen_0')) {
            foreach ($request->file() as $key => $file) {
                if ($key === 'video') {
                    continue; // Saltar el archivo de video en este bucle
                }
                $extension = $file->getClientOriginalExtension(); // Obtener la extensión del archivo
                $nombreSinEspacios = str_replace(' ', '', $request->input('calles')); // Eliminar espacios para evitar problemas
                $nombreImagen = $propiedad->id . $nombreSinEspacios . '_' . mt_rand(100, 2000) . '.' . $extension; // Generar un nombre único para la imagen
                $propiedad->nombre_imagen = $propiedad->id . $nombreSinEspacios; //guardo el nombre de la imagenes
                $file->storeAs('/propiedades', $nombreImagen, 'public'); // Subir la imagen al directorio 'public/propiedades'

            }
        }

        // Guardar video
        if ($request->hasFile('video')) {
            $video = $request->file('video'); // Obtener el archivo de video
            $nombreSinEspacios = str_replace(' ', '', $request->input('calles'));
            $nombreVideo = $propiedad->id . $nombreSinEspacios . '_video.' . $video->getClientOriginalExtension(); // Generar un nombre único para el video
            $propiedad->nombre_imagen = $propiedad->id . $nombreSinEspacios;
            $video->storeAs('/propiedades', $nombreVideo, 'public'); // Subir el video al directorio 'public/propiedades'
        }


        if ($propiedad->save()) {
            return response()->json(['message' => 'Propiedad creada exitosamente'], 201);
        } else {
            return response()->json(['message' => 'Error al crear la propiedad'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $propiedad = Propiedad::find($id);
        $propiedad->calles = $request->input('calles');
        $propiedad->cant_habitaciones = $request->input('cant_habitaciones') ? $request->input('cant_habitaciones') : null;
        $propiedad->cant_banios = $request->input('cant_banios') ? $request->input('cant_banios') : null;
        $propiedad->cant_personas = $request->input('cant_personas') ? $request->input('cant_personas') : null;
        $propiedad->tamanio = $request->input('tamanio') ? $request->input('tamanio') : null;
        $propiedad->estado = $request->input('estado');
        $propiedad->latitud = $request->input('latitud');
        $propiedad->longitud = $request->input('longitud');
        $propiedad->tipo_alquiler = $request->input('tipo_alquiler');
        $propiedad->venta = $request->input('venta')=='true';

        //asociar el barrio
        $barrio = Barrio::find($request->input('barrio'));
        $propiedad->barrio()->associate($barrio);

        $propiedad->save();

        if ($propiedad->save()) {
            return response()->json(['message' => 'Propiedad editada exitosamente'], 201);
        } else {
            $propiedad->delete();
            return response()->json(['message' => 'Error al editar la propiedad'], 500);
        }
    }

    public function delete($id)
    {
        $propiedad = Propiedad::find($id);
        if ($propiedad->delete()) {
            return response()->json(['message' => 'Propiedad eliminada exitosamente'], 201);
        } else {
            return response()->json(['message' => 'Error al eliminar la propiedad'], 500);
        }
    }

    public function show($id)
    {
        $propiedad = Propiedad::with('barrio')->with('servicios')->find($id);
        return response()->json($propiedad);
    }
}
