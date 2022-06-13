<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Subcategoria;
use Illuminate\Support\Str;

class SubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategoria = new Subcategoria();
        $subcategoria->name = "Verdes";
        $subcategoria->description = "Manzanas verdes";
        $subcategoria->categoria_id = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->name = "Rojas";
        $subcategoria->description = "Manzanas rojas";
        $subcategoria->categoria_id = 1;
        $subcategoria->save();

        $subcategoria = new Subcategoria();
        $subcategoria->name = "Rojas";
        $subcategoria->description = "Carnes rojas";
        $subcategoria->categoria_id = 2;
        $subcategoria->save();
    }
}
