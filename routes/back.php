<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Back\LoginController;
use App\Http\Controllers\Back\CategoriasController;
use App\Http\Controllers\Back\ProductosController;
use App\Http\Controllers\Back\CallendarController;
use App\Http\Controllers\Back\EventController;
use App\Http\Controllers\Back\SubcategoriasController;
use App\Http\Controllers\Back\TarifasController;
use App\Http\Controllers\Back\GoogleController;
use App\Http\Controllers\Back\SitioController;
use App\Mail\EventCreated;
use Illuminate\Support\Facades\Mail;

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
    Route::get('/', [CategoriasController::class,'index'])->name('categorias');

    Route::get('categorias', [CategoriasController::class,'index'])->name('categorias');

    Route::get('productos', [ProductosController::class,'index'])->name('productos');

    Route::post('productos', [ProductosController::class,'index'])->name('productos-post');

    Route::get('productos/descargar', [ProductosController::class,'export'])->name('excel');

    Route::get('producto/{id}', [ProductosController::class,'show_product'])->name('producto');

    Route::get('producto/exportar/{id}', [ProductosController::class,'export1'])->name('pdf');

    Route::get('Calendar/event/{mes}', [CallendarController::class, 'index_month'])->name('calendario-mes');
    
    Route::get('Calendar/event', [CallendarController::class, 'index'])->name('calendario');

    Route::get('evento/nuevo', [EventController::class, 'create'])->name('evento-nuevo');

    Route::post('evento/creado', [EventController::class, 'store'])->name('evento-creado');

    Route::post('evento/calendario', [EventController::class, 'calendario'])->name('evento-calendario');

    Route::get('events/eliminar/{id}', [EventController::class,'delete'])->name('evento-eliminar');

    Route::get('evento/enviar/{id}', [EventController::class,'sendEmail'])->name('evento-enviar');

    Route::get('google-autocomplete/{id?}', [GoogleController::class, 'index'])->name('mapa');

    Route::get('sitio/nuevo', [SitioController::class, 'create'])->name('sitio-nuevo');

    Route::post('sitio/creado', [SitioController::class, 'store'])->name('sitio-creado');
    
    Route::get('sitio/eliminar/{id}', [SitiosController::class, 'delete'])->name('sitio-eliminar');
});

Route::group(['middleware' => 'can:admin'], function(){
    Route::get('categorias/nuevo', [CategoriasController::class,'create'])->name('categoria-nuevo');

    Route::post('categorias/creado', [CategoriasController::class,'store'])->name('categoria-creado');

    Route::get('categorias/editar/{id}', [CategoriasController::class,'edit'])->name('categoria-editar');
    
    Route::post('categorias/editado/{id}', [CategoriasController::class,'update'])->name('categoria-editado');
    
    Route::get('categorias/eliminar/{id}', [CategoriasController::class,'delete'])->name('categoria-eliminar');

    Route::get('subcategorias/nuevo/{id}', [SubcategoriasController::class,'create'])->name('subcategoria-nuevo');

    Route::post('subcategorias/creado/{id}', [SubcategoriasController::class,'store'])->name('subcategoria-creado');

    Route::get('subcategorias/eliminar/{id}', [SubcategoriasController::class,'delete'])->name('subcategoria-eliminar');

    Route::get('productos/nuevo', [ProductosController::class,'create'])->name('producto-nuevo');
    
    Route::post('productos/creado', [ProductosController::class,'store'])->name('producto-creado');
    
    Route::get('productos/editar/{id}', [ProductosController::class,'edit'])->name('producto-editar');
    
    Route::post('productos/editado/{id}', [ProductosController::class,'update'])->name('producto-editado');
    
    Route::get('productos/eliminar/{id}', [ProductosController::class,'delete'])->name('producto-eliminar');

    Route::get('tarifas/{id}', [TarifasController::class,'index'])->name('tarifas');

    Route::get('tarifas/nuevo/{id}', [TarifasController::class,'create'])->name('tarifa-nuevo');

    Route::post('tarifas/creado/{id}', [TarifasController::class,'store'])->name('tarifa-creado');

    Route::get('tarifas/editar/{id}', [TarifasController::class,'edit'])->name('tarifa-editar');
    
    Route::post('tarifas/editado/{id}', [TarifasController::class,'update'])->name('tarifa-editado');

    Route::get('tarifas/eliminar/{id}', [TarifasController::class,'delete'])->name('tarifa-eliminar');
});

Route::get('/', [LoginController::class,'index'])->name('login');

Route::get('login', [LoginController::class,'index'])->name('login');

Route::post('logged', [LoginController::class,'handleLogin'])->name('logged');

Route::get('logout', [LoginController::class,'logout'])->name('logout');