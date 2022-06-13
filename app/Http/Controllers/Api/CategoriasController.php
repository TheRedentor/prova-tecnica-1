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
}
