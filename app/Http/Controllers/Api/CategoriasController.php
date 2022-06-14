<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Validator;

class CategoriasController extends Controller
{
    public function getCategorias(){
        try{
            $categorias = Categoria::all();
            return response()->json(['status' => 1, 'categorias' => $categorias]);
        }
        catch (\Exception $e){
            return response()->json(['status' => 0, 'categorias' => []], 500);
        }
    }

    public function setCategoria(Request $request){
        $validation = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        if($validation->fails()){
            return response()->json([
                'status' => 2,
                'message' => 'Campos obligatorios',
            ]);
        }

        try{
            $categoria = Categoria::where('id', $request->input('id'))->first();
            $categoria->name = $request->name;
            $categoria->description = $request->description;
            $categoria->save();
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 3,
                'message' => 'Categoria no existente',
            ]);
        }
        
        return response()->json(['status' => 1]);
    }
}
