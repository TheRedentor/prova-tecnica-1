<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function getUsers(){
        try{
            $users = DB::table('users')->get();
            return response()->json(['status' => 1, 'users' => $users]);
        }
        catch (\Exception $e){
            return response()->json(['status' => 0, 'users' => []], 500);
        }
    }

    public function setUser(Request $request){
        $user = $request->user();

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'is_admin' => 'required',
        ]);

        if($validation->fails()){
            return response()->json([
                'status' => 2,
                'message' => 'Campos obligatorios',
            ]);
        }

        $user->name = $request->name;
        $user->is_admin = $request->is_admin;
        $user->save();
        return response()->json(['status' => 1]);
    }
}
