<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function getEvents(){
        try{
            $events = DB::table('events')->get();
            return response()->json(['status' => 1, 'events' => $events]);
        }
        catch (\Exception $e){
            return response()->json(['status' => 0, 'events' => []], 500);
        }
    }
}
