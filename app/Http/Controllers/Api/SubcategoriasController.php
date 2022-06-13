<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategoria;
use Illuminate\Support\Facades\Validator;

class SubcategoriasController extends Controller
{
    public function getSubcategorias(){
        try{
            $subcategorias = Subcategoria::all();
            return response()->json(['status' => 1, 'subcategorias' => $subcategorias]);
        }
        catch (\Exception $e){
            return response()->json(['status' => 0, 'subcategorias' => []], 500);
        }
    }
}
