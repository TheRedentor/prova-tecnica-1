<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Http\Requests\CategoriasRequest;
use App\Models\Subcategoria;
use App\Models\CategoriaProduct;
use App\Models\Product;

class CategoriasController extends Controller
{
    public function index(){
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        return view('categorias', compact('categorias', 'subcategorias'));
    }

    public function create(){
        return view('crear-categoria');
    }

    public function store(CategoriasRequest $request){
        try{
            $name = $request->input('name');
            $description = $request->input('description');
    
            $categoria = Categoria::create([
                'name' => $name,
                'description' => $description,
            ]);
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'Uno o varios campos no son correctos']);
        }
        //dd($name, $description);
        return redirect()->action([CategoriasController::class, 'index']);
    }

    public function edit($id){
        try{
            $categoria = Categoria::findOrFail($id);
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'La categoria no existe']);
        }
        return view('editar-categoria', compact('categoria', 'id'));
    }

    public function update($id, CategoriasRequest $request){
        try{
            $categoria = Categoria::findOrFail($id);
            $categoria->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'Uno o varios campos no son correctos']);
        }
        return redirect()->action([CategoriasController::class, 'index']);
    }

    public function delete($id){
        try{
            $categoria = Categoria::findOrFail($id);
            $subcategorias = Subcategoria::where('categoria_id', $categoria->id)->get();
            $categoria_products = CategoriaProduct::where('categoria_id', $categoria->id)->get();
            $categoria_product = $categoria_products->first();
            try{
                $products = Product::where('id', $categoria_product->product_id)->get();
            }
            catch(\Exception $e){
                $products = null;
            }
            
            if($products != null){
                foreach($products as $product){
                    $product->subcategoria_id = null;
                    $product->save();
                }
            }
            if($categoria_products != null){
                foreach($categoria_products as $categoria_product){
                    $categoria_product->delete();
                }
            }
            if($subcategorias != null){
                foreach($subcategorias as $subcategoria){
                    $subcategoria->delete();
                }
            }
            $categoria->delete();
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'La categoria no existe']);
        }
        return redirect()->action([CategoriasController::class, 'index']);
    }
}
