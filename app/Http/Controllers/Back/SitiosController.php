<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sitio;
use App\Http\Controllers\Back\GoogleController;
use App\Http\Requests\SitiosRequest;


class SitiosController extends Controller
{
    public function create(){
        return view('crear-sitio');
    }

    public function store(SitiosRequest $request){
        try{
            $name = $request->input('name');
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
    
            $sitio = Sitio::create([
                'name' => $name,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'Uno o varios campos no son correctos']);
        }
        //dd($name, $description);
        return redirect()->route('mapa');
    }
    
    public function delete($id){
        try{
            $sitio = Sitio::findOrFail($id);
            $sitio->delete();
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'El sitio no existe']);
        }
        return redirect()->back();
    }
}
