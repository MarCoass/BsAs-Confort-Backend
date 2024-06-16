<?php

namespace App\Http\Controllers;

use App\Models\parametro;
use Illuminate\Http\Request;

class ParametroController extends Controller
{
    //index
    public function index(){
        $data = parametro::all();
        return response()->json($data);
    }
    //store
    public function store(Request $request){
        $param = new parametro();
        $param->clave = $request->input('clave');
        $param->valor = $request->input('valor');
        if($param->save()){
            return response()->json(['message' => 'Parametro creado exitosamente'], 201);
        } else {
            return response()->json(['message' => 'No fue posible crear el parametro.'], 500);
        }
    }

    //update
    public function update(Request $request){
        $param = parametro::find($request->input('clave'));
        $param->valor = $request->input('valor');
        if($param->save()){
            return response()->json(['message' => 'Parametro editado exitosamente'], 201);
        } else {
            return response()->json(['message' => 'No fue posible editar el parametro.'], 500);
        }
    }

    //delete
    public function delete($id){
        $param = parametro::find($id);
        if($param->delete()){
            return response()->json(['message' => 'Parametro eliminado exitosamente'], 201);
        } else {
            return response()->json(['message' => 'No fue posible eliminar el parametro.'], 500);
        }
    }

    //show
    public function show($id){
        $param = parametro::find($id);
        return response()->json($param);
    }
}
