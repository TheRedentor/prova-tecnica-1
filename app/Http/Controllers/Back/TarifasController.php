<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\tarifa;

class TarifasController extends Controller
{
    public function create($id){
        try{
            $product = Product::findOrFail($id);
            $product_id = $product->id;
        }
        catch(\Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
        return view('anadir-tarifa', compact('id'));
    }

    public function store($id, Request $request){
        try{
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $price = $request->input('price');
            $tarifa = Tarifa::create([
                'start_date' => $start_date,
                'end_date' => $end_date,
                'price' => $price,
                'product_id' => $id,
            ]);
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'Uno o varios campos no son correctos']);
        }

        //dd($name, $description);
        return redirect()->action([ProductosController::class, 'index']);
    }

    public function edit($id){
        $i = 0;
        try{
            $product = Product::findOrFail($id);
            $tarifas = Tarifa::where('product_id', $product->id)->get();
        }
        catch(\Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
        return view('editar-tarifa', compact('tarifas' ,'id', 'i'));
    }

    public function update($id, Request $request){
        $i = 0;
        try{
            $product = Product::findOrFail($id);
            $tarifas = Tarifa::where('product_id', $product->id)->get();
            foreach($tarifas as $tarifa){
                $tarifa->update([
                    'start_date' => $request->input('start_date'.$i),
                    'end_date' => $request->input('end_date'.$i),
                    'price' => $request->input('price'.$i),
                ]);
                $i++;
            }
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'Uno o varios campos no son correctos']);
        }
        return redirect()->action([ProductosController::class, 'index']);
    }
}
