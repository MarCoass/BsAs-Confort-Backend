<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Propiedad;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class Imagenes extends Controller
{
    //
    public function showImages($carpeta, $idPrefix)
    {
        $imageUrls = $this->getImagesWithPrefix($carpeta, $idPrefix);
        return response()->json($imageUrls);
    }

    public function getImagesWithPrefix($carpeta, $idPrefix)
    {
        // Obtener todos los archivos en el directorio de imágenes
        $files = Storage::files('public/' . $carpeta);
        // Filtrar solo los archivos que comiencen con el prefijo especificado
        $filteredFiles = array_filter($files, function ($file) use ($idPrefix, $carpeta) {
            $pathToCheck = "public/" . $carpeta . "/" . $idPrefix;
            return strpos($file, $pathToCheck) === 0;
        });

        // Construir las URLs de las imágenes
        $imageUrls = array_map(function ($file) {
            return Storage::url($file);
        }, $filteredFiles);

        // Devolver las URLs de las imágenes
        return $imageUrls;
    }


    public function deletePropiedad($name)
    {
        try {
            // Extraer el nombre de la imagen de la ruta completa
            $nombreImagen = basename($name);
            /*     dd("Nombre de la imagen: " . $nombreImagen); */

            // Eliminar la imagen del almacenamiento
            Storage::disk('public')->delete('propiedades/' . $nombreImagen);

            return response()->json(['message' => 'Imagen eliminada correctamente'], 200);
        } catch (\Exception $e) {
            // Manejar el error si la imagen no se pudo eliminar
            return response()->json(['message' => 'Error al eliminar la imagen'], 500);
        }
    }
    public function deleteBarrio($name)
    {
        try {
            // Extraer el nombre de la imagen de la ruta completa
            $nombreImagen = basename($name);
            // Eliminar la imagen del almacenamiento
            Storage::disk('public')->delete('barrios/' . $nombreImagen);

            return response()->json(['message' => 'Imagen eliminada correctamente'], 200);
        } catch (\Exception $e) {
            // Manejar el error si la imagen no se pudo eliminar
            return response()->json(['message' => 'Error al eliminar la imagen'], 500);
        }
    }

    public function uploadPropiedad(Request $request)
    {
        $propiedad = Propiedad::find($request->input('id'));
        if ($propiedad->nombre_imagen === null) {
            $nombreSinEspacios = str_replace(' ', '', $propiedad->calles); // Eliminar espacios para evitar problemas
            $propiedad->nombre_imagen = $propiedad->id . $nombreSinEspacios; //guardo el nombre de la imagenes
        }
        // Guardar imágenes
        if ($request->hasFile('imagen_0')) {
            foreach ($request->file() as $key => $file) {
                $extension = $file->getClientOriginalExtension(); // Obtener la extensión del archivo
                $nombreImagen = $propiedad->nombre_imagen . '_' . mt_rand(100, 2000) . '.' . $extension; // Generar un nombre único para la imagen
                $file->storeAs('/propiedades', $nombreImagen, 'public'); // Subir la imagen al directorio 'public/propiedades'

            }
        }

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $nombreVideo =  $propiedad->nombre_imagen . '_video.' . $video->getClientOriginalExtension();
            $video->storeAs('/propiedades', $nombreVideo, 'public'); // Subir el video al directorio 'public/propiedades'
        }


        if ($propiedad->save()) {
            return response()->json(['message' => 'Imagenes cargadas exitosamente'], 201);
        } else {
            return response()->json(['message' => 'Error al cargar imagenes.'], 500);
        }
    }
    public function uploadBarrio(Request $request)
    {
        $barrio = Barrio::find($request->input('id'));
        if ($barrio->nombre_archivos === null) {
            $nombreSinEspacios = str_replace(' ', '', $barrio->calles); // Eliminar espacios para evitar problemas
            $barrio->nombre_archivos = $barrio->id . $nombreSinEspacios; //guardo el nombre de la imagenes
        }
        // Guardar imágenes
        if ($request->hasFile('imagen_0')) {
            foreach ($request->file() as $key => $file) {
                $extension = $file->getClientOriginalExtension(); // Obtener la extensión del archivo
                $nombreImagen = $barrio->nombre_archivos . '_' . mt_rand(100, 2000) . '.' . $extension; // Generar un nombre único para la imagen
                $file->storeAs('/barrios', $nombreImagen, 'public'); // Subir la imagen al directorio 'public/propiedades'

            }
        }

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $nombreVideo =  $barrio->nombre_archivos . '_video.' . $video->getClientOriginalExtension();
            $video->storeAs('/barrios', $nombreVideo, 'public'); // Subir el video al directorio 'public/propiedades'
        }


        if ($barrio->save()) {
            return response()->json(['message' => 'Imagenes cargadas exitosamente'], 201);
        } else {
            return response()->json(['message' => 'Error al cargar imagenes.'], 500);
        }
    }
}
