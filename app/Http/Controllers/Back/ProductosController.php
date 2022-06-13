<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductsRequest;
use App\Models\Tarifa;
use App\Models\CategoriaProduct;
use App\Models\Categoria;
use App\Models\Subcategoria;

use Illuminate\Support\Facades\DB;

use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductosController extends Controller
{
    public function index(){
        $fecha = date('Y-m-d');
        $products = Product::all();
        $tarifas = Tarifa::all();
        $categoria_products = CategoriaProduct::all();
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        return view('productos', compact('products', 'tarifas', 'categoria_products', 'categorias', 'subcategorias', 'fecha'));
    }

    public function create(){
        return view('crear-producto');
    }

    public function store(Request $request){
        $name = $request->input('name');
        $description = $request->input('description');
        $image = $request->input('image');
        $categoria_name = $request->input('categoria');
        $categoria = Categoria::where('name', $categoria_name)->first();
        $subcategoria_name = $request->input('subcategoria');
        $subcategoria = Subcategoria::where('name', $subcategoria_name)->first();
        $tarifa_start_date = $request->input('tarifa_start_date');
        $tarifa_end_date = $request->input('tarifa_end_date');
        $tarifa_price = $request->input('tarifa_price');
        try{
            $product = Product::create([
                'name' => $name,
                'description' => $description,
                'image' => $image,
                'subcategoria_id' => $subcategoria->id,
            ]);
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'Uno o varios campos no son correctos']);
        }

        $tarifa = Tarifa::create([
            'start_date' => $tarifa_start_date,
            'end_date' => $tarifa_end_date,
            'price' => $tarifa_price,
            'product_id' => $product->id,
        ]);

        $categoria_product = CategoriaProduct::create([
            'categoria_id' => $categoria->id,
            'product_id' => $product->id,
        ]);

        //dd($name, $description);
        return redirect()->action([ProductosController::class, 'index']);
    }

    public function edit($id){
        try{
            $product = Product::findOrFail($id);
            $name = $product->name;
            $description = $product->description;
            $image = $product->image;
            try{
                $categoria_product = CategoriaProduct::where('product_id', $product->id)->first();
                $categoria_id = $categoria_product->categoria_id;
                $categoria = Categoria::where('id', $categoria_id)->first();
                $categoria_name = $categoria->name;
            }
            catch(\Exception $e){
                $categoria_name = null;
            }
            try{
                $subcategoria_id = $product->subcategoria_id;
                $subcategoria = Subcategoria::where('id', $subcategoria_id)->first();
                $subcategoria_name = $subcategoria->name;
            }
            catch(\Exception $e){
                $subcategoria_name = null;
            }
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'Excepción capturada: ',  $e->getMessage(), "\n"]);
        }
        return view('editar-producto', compact('product', 'id', 'name', 'description', 'image', 'categoria_name', 'subcategoria_name'));
    }

    public function update($id, ProductsRequest $request){
        try{
            $product = Product::findOrFail($id);
            $categoria_product = CategoriaProduct::where('product_id', $product->id)->first();
            $tarifa = Tarifa::where('product_id', $product->id)->first();
            $categoria_name = $request->input('categoria');
            $categoria = Categoria::where('name', $categoria_name)->first();
            $subcategoria_name = $request->input('subcategoria');
            $subcategoria = Subcategoria::where('name', $subcategoria_name)->first();

            $product->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'image' => $request->input('image'),
                'subcategoria_id' => $subcategoria->id,
            ]);
            if($categoria_product != null){
                $categoria_product->update([
                    'categoria_id' => $categoria->id,
                    'product_id' => $product->id,
                ]);
            }
            else{
                $categoria_product = CategoriaProduct::create([
                    'categoria_id' => $categoria->id,
                    'product_id' => $product->id,
                ]);
            }
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'Uno o varios campos no son correctos']);
        }
        return redirect()->action([ProductosController::class, 'index']);
    }

    public function delete($id){
        try{
            $product = Product::findOrFail($id);
            $tarifas = Tarifa::where('product_id', $product->id)->get();
            foreach($tarifas as $tarifa){
                $tarifa->delete();
            }
            $product->delete();
        }
        catch(\Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
        return redirect()->action([ProductosController::class, 'index']);
    }

    public function export(){
        return Excel::download(new ProductsExport, 'productos.xlsx');
    }

    public function show_product($id){
        try{
            $fecha = date('Y-m-d');
            $product = Product::findOrFail($id);
            $name = $product->name;
            $description = $product->description;
            $image = $product->image;
            $tarifas = Tarifa::where('product_id', $product->id)->get();
            $categoria_products = CategoriaProduct::all();
            $categorias = Categoria::all();
            $subcategorias = Subcategoria::all();
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'Excepción capturada: ',  $e->getMessage(), "\n"]);
        }
        return view('producto', compact('product', 'name', 'description', 'image', 'tarifas', 'categoria_products', 'categorias', 'subcategorias', 'fecha'));
    }

    public function export1($id){
        try{
            $fecha = date('Y-m-d');
            $product = Product::findOrFail($id);
            $name = $product->name;
            $description = $product->description;
            $image = $product->image;
            $tarifas = Tarifa::all();
            $categoria_products = CategoriaProduct::all();
            $categorias = Categoria::all();
            $subcategorias = Subcategoria::all();
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'Excepción capturada: ',  $e->getMessage(), "\n"]);
        }
        $pdf = \PDF::loadView('producto', compact('product', 'name', 'description', 'image', 'tarifas', 'categoria_products', 'categorias', 'subcategorias', 'fecha'));
        return $pdf->download('product.pdf');
    }


}
