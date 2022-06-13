<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

use App\Models\Categoria;
use App\Models\CategoriaProduct;
use App\Models\Tarifa;

class ProductsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $products = Product::all();
        $i = 0;
        foreach($products as $product){
            $categoria_product = CategoriaProduct::where('product_id', $product->id)->first();
            $product->categoria_id = $categoria_product->categoria_id;
            /*$tarifas = Tarifa::where('product_id', $product->id)->get();
            foreach($tarifas as $tarifa){
                $product->tarifa_start_date.$i = $tarifa->start_date;
                $product->tarifa_end_date.$i = $tarifa->end_date;
                $i++;
            }*/
        }
        return $products;
    }
}
