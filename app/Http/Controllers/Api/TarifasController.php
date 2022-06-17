<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tarifa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TarifasController extends Controller
{
    public function getTarifas(){
        try{
            $tarifas = DB::table('tarifas')->get();
            return response()->json(['status' => 1, 'tarifas' => $tarifas]);
        }
        catch (\Exception $e){
            return response()->json(['status' => 0, 'tarifas' => []], 500);
        }
    }
}
