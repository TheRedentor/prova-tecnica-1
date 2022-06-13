<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategoria;
use App\Models\Categoria;
use App\Models\Product;

class SubcategoriasController extends Controller
{
    public function create($id){
        try{
            $categoria = Categoria::findOrFail($id);
            $categoria_id = $categoria->id;
        }
        catch(\Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
        return view('crear-subcategoria', compact('id'));
    }

    public function store($id, Request $request){
        try{
            $name = $request->input('name');
            $description = $request->input('description');
            $subcategoria = Subcategoria::create([
                'name' => $name,
                'description' => $description,
                'categoria_id' => $id,
            ]);
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'Uno o varios campos no son correctos']);
        }

        //dd($name, $description);
        return redirect()->action([CategoriasController::class, 'index']);
    }

    public function delete($id){
        try{
            $subcategoria = Subcategoria::findOrFail($id);
            $products = Product::where('subcategoria_id', $subcategoria->id)->get();
            foreach($products as $product){
                $product->subcategoria_id = null;
                $product->save();
            }
            $subcategoria->delete();
        }
        catch(\Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
        return redirect()->action([CategoriasController::class, 'index']);
    }
}
