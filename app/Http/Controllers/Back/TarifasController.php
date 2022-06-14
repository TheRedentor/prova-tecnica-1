<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tarifa;

use App\Http\Requests\TarifasRequest;

class TarifasController extends Controller
{
    public function index($id){
        try{
            $product = Product::findOrFail($id);
            $tarifas = Tarifa::where('product_id', $product->id)->get();
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'El producto no existe']);
        }
        return view('tarifas', compact('id', 'tarifas', 'product'));
    }

    public function create($id){
        try{
            $product = Product::findOrFail($id);
            $product_id = $product->id;
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'El producto no existe']);
        }
        return view('anadir-tarifa', compact('id'));
    }

    public function store($id, TarifasRequest $request){
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
        return redirect()->action([TarifasController::class, 'index'], compact('id'));
    }

    public function edit($id){
        try{
            $tarifa = Tarifa::findOrFail($id);
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'La tarifa no existe']);
        }
        return view('editar-tarifa', compact('tarifa'));
    }

    public function update($id, TarifasRequest $request){
        try{
            $tarifa = Tarifa::findOrFail($id);
            $product = Product::where('id', $tarifa->product_id)->first();
            $id = $product->id;
            $tarifa->update([
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'price' => $request->input('price'),
            ]);
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'Uno o varios campos no son correctos']);
        }
        return redirect()->action([TarifasController::class, 'index'], compact('id'));
    }

    public function delete($id){
        try{
            $tarifa = Tarifa::findOrFail($id);
            $tarifa->delete();
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'La tarifa no existe']);
        }
        return redirect()->back();
    }
}
