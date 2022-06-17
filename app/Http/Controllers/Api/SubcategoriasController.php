<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SubcategoriasController extends Controller
{
    public function getSubcategorias(){
        try{
            $subcategorias = DB::table('subcategorias')->get();
            return response()->json(['status' => 1, 'subcategorias' => $subcategorias]);
        }
        catch (\Exception $e){
            return response()->json(['status' => 0, 'subcategorias' => []], 500);
        }
    }
}
