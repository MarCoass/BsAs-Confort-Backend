<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use App\Models\Propiedad;

class ComentarioController extends Controller
{
    public function index()
    {
        $data = Comentario::with('propiedad')->get();
        return response()->json($data);
    }
    public function comentariosActivos()
    {
        $data = Comentario::where('estado', '1')->with('propiedad')->get();
        return response()->json($data);
    }
    public function propiedad($id)
    {
        $data = Comentario::where('propiedad_id', $id)->where('estado', '1')->with('propiedad')->get();
        return response()->json($data);
    }

    public function contadorComentarios($id){
        $data = Comentario::where('propiedad_id', $id)->where('estado', '1')->with('propiedad')->count();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $comentario = new Comentario();
        $comentario->nombre = $request->input('nombre');
        $comentario->contenido = $request->input('contenido');
        $comentario->email = $request->input('email');
        $comentario->ig_user = $request->input('ig_user') != '' ? $request->input('ig_user') : null;
        $comentario->estado = 0; //por defecto los comentarios estan desactivados, los habilita un administrador
        $propiedad = Propiedad::find($request->input('id_propiedad'));

        $comentario->propiedad()->associate($propiedad);
        if ($comentario->save()) {
            return response()->json(['message' => 'Comentario creado exitosamente'], 201);
        } else {
            return response()->json(['message' => 'Error al crear el comentarioI'], 500);
        }
    }

    public function update(Request $request)
    {
        $comentario = Comentario::find($request->input('id'));
        $comentario->contenido = $request->input('contenido');
        $comentario->email = $request->input('email');
        $comentario->ig_user = $request->input('ig_user') != '' ? $request->input('ig_user') : null;
        $comentario->estado = 0; //por defecto los comentarios estan desactivados, los habilita un administrador
        $comentario->id_propiedad = 1; //TO-DO: modificar esto asi se guarda el id de la casa, o solo las calles
        if ($comentario->save()) {
            return response()->json(['message' => 'Comentario editado exitosamente'], 201);
        } else {
            return response()->json(['message' => 'Error al editar el comentarioI'], 500);
        }
    }

    public function delete($id)
    {
        $comentario = Comentario::find($id);

        if ($comentario->delete()) {
            return response()->json(['message' => 'Comentario eliminado exitosamente'], 201);
        } else {
            return response()->json(['message' => 'Error al eliminar el comentario'], 500);
        }
    }

    public function show($id)
    {
        $comentario = Comentario::with('propiedad')->find($id);
        return response()->json($comentario);
    }

    public function cambiarEstado($id)
    {
        $comentario = Comentario::find($id);
        $comentario->estado = $comentario->estado == 0 ? 1 : 0;
        if ($comentario->save()) {
            return response()->json(['message' => 'Comentario editado exitosamente'], 201);
        } else {
            return response()->json(['message' => 'Error al editar el comentario'], 500);
        }
    }
}
