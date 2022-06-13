<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\LoginController;
use App\Http\Controllers\Back\CategoriasController;
use App\Http\Controllers\Back\ProductosController;
use App\Http\Controllers\Back\CallendarController;
use App\Http\Controllers\Back\EventController;
use App\Http\Controllers\Back\SubcategoriasController;
use App\Http\Controllers\Back\TarifasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth.back'])->group(function(){
    Route::get('categorias', [CategoriasController::class,'index']);

    Route::get('productos', [ProductosController::class,'index']);

    Route::get('productos/descargar', [ProductosController::class,'export']);

    Route::get('producto/{id}', [ProductosController::class,'show_product']);

    Route::get('producto/exportar/{id}', [ProductosController::class,'export1']);

    Route::get('Calendar/event/{mes}', [CallendarController::class, 'index_month']);
    
    Route::get('Calendar/event', [CallendarController::class, 'index']);

    Route::get('evento/nuevo', [EventController::class, 'create']);

    Route::post('evento/creado', [EventController::class, 'store']);

    Route::post('evento/calendario', [EventController::class, 'calendario']);
});

Route::group(['middleware' => 'can:admin'], function(){
    Route::get('categorias/nuevo', [CategoriasController::class,'create']);

    Route::post('categorias/creado', [CategoriasController::class,'store']);

    Route::get('categorias/editar/{id}', [CategoriasController::class,'edit']);
    
    Route::post('categorias/editado/{id}', [CategoriasController::class,'update']);
    
    Route::get('categorias/eliminar/{id}', [CategoriasController::class,'delete']);

    Route::get('subcategorias/nuevo/{id}', [SubcategoriasController::class,'create']);

    Route::post('subcategorias/creado/{id}', [SubcategoriasController::class,'store']);

    Route::get('subcategorias/eliminar/{id}', [SubcategoriasController::class,'delete']);

    Route::get('productos/nuevo', [ProductosController::class,'create']);
    
    Route::post('productos/creado', [ProductosController::class,'store']);
    
    Route::get('productos/editar/{id}', [ProductosController::class,'edit']);
    
    Route::post('productos/editado/{id}', [ProductosController::class,'update']);
    
    Route::get('productos/eliminar/{id}', [ProductosController::class,'delete']);

    Route::get('tarifas/nuevo/{id}', [TarifasController::class,'create']);

    Route::post('tarifas/creado/{id}', [TarifasController::class,'store']);

    Route::get('tarifas/editar/{id}', [TarifasController::class,'edit']);
    
    Route::post('tarifas/editado/{id}', [TarifasController::class,'update']);

    Route::get('events/eliminar/{id}', [EventController::class,'delete']);
});

Route::get('/', [LoginController::class,'index']);

Route::get('login', [LoginController::class,'index']);

Route::post('logged', [LoginController::class,'handleLogin']);

Route::get('logout', [LoginController::class,'logout']);