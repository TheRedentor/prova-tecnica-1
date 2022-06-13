<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\ProductosController;
use App\Http\Controllers\Api\CategoriasController;
use App\Http\Controllers\Api\SubcategoriasController;
use App\Http\Controllers\Api\TarifasController;
use App\Http\Controllers\Api\EventController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', function(){
    return response()->json(['status' => 1, 'value' => 'Test']);
});

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('get-users', [UsersController::class, 'getUsers']);
    Route::post('set-user', [UsersController::class, 'setUser']);
    Route::get('get-productos', [ProductosController::class, 'getProductos']);
    Route::get('get-categorias', [CategoriasController::class, 'getCategorias']);
    Route::get('get-subcategorias', [SubcategoriasController::class, 'getSubcategorias']);
    Route::get('get-tarifas', [TarifasController::class, 'getTarifas']);
    Route::get('get-events', [EventController::class, 'getEvents']);
});
