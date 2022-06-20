<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Models\Sitio;
use Illuminate\Support\Facades\DB;

class GoogleController extends Controller
{
    public function index($id = null)
    {
        $sitios = DB::table('sitios')->get();
        if(!is_null($id)){
            $place = DB::table('sitios')->where('id', $id)->first();
        }
        else{
            $place = null;
        }
        return view('googleAutocomplete', compact('sitios', 'place'));
    }
}
