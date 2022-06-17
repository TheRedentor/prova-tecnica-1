<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{
    public function getProductos(){
        try{
            $products = DB::table('products')->get();
            return response()->json(['status' => 1, 'products' => $products]);
        }
        catch (\Exception $e){
            return response()->json(['status' => 0, 'products' => []], 500);
        }
    }
}
