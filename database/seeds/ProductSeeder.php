<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->name = "Manzana";
        $product->description = "Manzana fresca";
        $product->image = "https://img.huffingtonpost.com/asset/5ef9ffab250000a502c28ec2.jpeg?ops=scalefit_720_noupscale";
        $product->subcategoria_id = 1;
        $product->save();
    }
}
