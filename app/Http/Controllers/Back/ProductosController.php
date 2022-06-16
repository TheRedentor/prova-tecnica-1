<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductsRequest;
use App\Http\Requests\EditProductsRequest;
use App\Models\Tarifa;
use App\Models\CategoriaProduct;
use App\Models\Categoria;
use App\Models\Subcategoria;

use Illuminate\Support\Facades\DB;

use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductosController extends Controller
{
    public function index(Request $request){
        if($request->isMethod('post')){
            $products = DB::table('products')->where('name', 'like', $request->input('name').'%')->get();
        }
        else{
            $products = DB::table('products')->get();
        }
        $fecha = date('Y-m-d');
        $tarifas = DB::table('tarifas')->get();
        $categoria_products = DB::table('categoria_product')->get();
        $categorias = DB::table('categorias')->get();
        $subcategorias = DB::table('subcategorias')->get();
        
        return view('productos', compact('products', 'tarifas', 'categoria_products', 'categorias', 'subcategorias', 'fecha'));
    }

    public function create(){
        $categorias = DB::table('categorias')->get();
        $subcategorias = DB::table('subcategorias')->get();
        return view('crear-producto', compact('categorias', 'subcategorias'));
    }

    public function store(ProductsRequest $request){
        $name = $request->input('name');
        $description = $request->input('description');
        $image = $request->input('image');
        $categoria_name = $request->input('categoria');
        $categoria = DB::table('categorias')->where('name', $categoria_name)->first();
        $subcategoria_name = $request->input('subcategoria');
        $subcategoria = DB::table('subcategorias')->where('name', $subcategoria_name)->first();
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
            $categorias = DB::table('categorias')->get();
            $subcategorias = DB::table('subcategorias')->get();
            try{
                $categoria_product = DB::table('categoria_product')->where('product_id', $product->id)->first();
                $categoria = DB::table('categorias')->where('id', $categoria_product->categoria_id)->first();
                $categoria_name = $categoria->name;
            }
            catch(\Exception $e){
                $categoria_name = null;
            }
            try{
                $subcategoria = DB::table('subcategorias')->where('id', $product->subcategoria_id)->first();
                $subcategoria_name = $subcategoria->name;
            }
            catch(\Exception $e){
                $subcategoria_name = null;
            }
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'El producto no existe']);
        }
        return view('editar-producto', compact('product', 'id', 'categoria_name', 'subcategoria_name', 'categorias', 'subcategorias'));
    }

    public function update($id, EditProductsRequest $request){
        try{
            $product = Product::findOrFail($id);
            $categoria_product = DB::table('categoria_product')->where('product_id', $product->id)->first();
            $tarifa = DB::table('tarifas')->where('product_id', $product->id)->first();
            $categoria_name = $request->input('categoria');
            $categoria = DB::table('categorias')->where('name', $categoria_name)->first();
            $subcategoria_name = $request->input('subcategoria');
            $subcategoria = DB::table('subcategorias')->where('name', $subcategoria_name)->first();

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
            $tarifas = DB::table('tarifas')->where('product_id', $product->id)->get();
            foreach($tarifas as $tarifa){
                $tarifa->delete();
            }
            $product->delete();
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'El producto no existe']);
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
            $tarifas = DB::table('tarifas')->where('product_id', $product->id)->get();
            $categoria_products = DB::table('categoria_product')->all();
            $categorias = DB::table('categorias')->get();
            $subcategorias = DB::table('subcategorias')->get();
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
            $tarifas = DB::table('tarifas')->get();
            $categoria_products = DB::table('categoria_product')->get();
            $categorias = DB::table('categorias')->get();
            $subcategorias = DB::table('subcategorias')->get();
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'Excepción capturada: ',  $e->getMessage(), "\n"]);
        }
        $pdf = \PDF::loadView('exports.producto_pdf', compact('product', 'name', 'description', 'image', 'tarifas', 'categoria_products', 'categorias', 'subcategorias', 'fecha'));
        return $pdf->download('product.pdf');
    }


}
