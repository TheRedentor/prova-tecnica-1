<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\Product;
use App\Models\Tarifa;
use App\Http\Requests\EventsRequest;

use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function create(){
        $productos = DB::table('products')->get();
        return view("crear-evento", compact('productos'));
    }

    public function store(EventsRequest $request){
        $fecha = $request->input('fecha');
        $producto = $request->input('producto');
        $numero = $request->input('numero');
        $productInfo = DB::table('products')->where('name', $producto)->first();
        if(!isset($productInfo)){
            return redirect()->back()->withErrors(['msg' => 'No existe ese producto']);
        }
        $tarifas = DB::table('tarifas')->where('product_id', $productInfo->id)->get();
        foreach($tarifas as $tarifa){
            if($tarifa->product_id == $productInfo->id){
                if($tarifa->start_date <= $fecha && $tarifa->end_date >= $fecha){
                    $precio = $tarifa->price;
                }
            }
        }
        if(!isset($precio)){
            return redirect()->back()->withErrors(['msg' => 'No hay precio para esa fecha']);
        }
        $precioTotal = $precio * $numero;
        $event = Event::create([
            'fecha' => $fecha,
            'producto' => $producto,
            'numero' => $numero,
            'precio' => $precioTotal,
        ]);

        return redirect()->action([CallendarController::class, 'index']);
    }

    public function delete($id){
        try{
            $event = Event::findOrFail($id);
            $event->delete();
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'El evento no existe']);
        }
        return redirect()->action([CallendarController::class, 'index']);
    }
}
