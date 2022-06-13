<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CategoriaProduct;
use Illuminate\Support\Str;

class CategoriaProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria_product = new CategoriaProduct();
        $categoria_product->categoria_id = 1;
        $categoria_product->product_id = 1;
        $categoria_product->save();
    }
}
