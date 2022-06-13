<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductosController extends Controller
{
    public function getProductos(){
        try{
            $products = Product::all();
            return response()->json(['status' => 1, 'products' => $products]);
        }
        catch (\Exception $e){
            return response()->json(['status' => 0, 'products' => []], 500);
        }
    }
}
