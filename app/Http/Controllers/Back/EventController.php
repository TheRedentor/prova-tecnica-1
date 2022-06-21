<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\Product;
use App\Models\Tarifa;
use App\Http\Requests\EventsRequest;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\EventCreated;

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
        $productInfo = Product::where('name', $producto)->first();
        if(!isset($productInfo)){
            return redirect()->back()->withErrors(['msg' => 'No existe ese producto']);
        }
        $productInfo->stock -= $numero;
        $productInfo->save();
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
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('evento-enviar', [$event->id]);
    }

    public function delete($id){
        try{
            $event = Event::findOrFail($id);
            $event->delete();
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'El evento no existe']);
        }
        return redirect()->route('calendario');
    }

    public function sendEmail($id){
        Mail::to(auth()->user()->email)->send(new EventCreated($id));
        return new EventCreated($id);
    }
}
