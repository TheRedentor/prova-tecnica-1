<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;
use Illuminate\Support\Str;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoria = new Categoria();
        $categoria->name = "Frutas";
        $categoria->description = "Frutas frescas";
        $categoria->save();

        $categoria = new Categoria();
        $categoria->name = "Carnes";
        $categoria->description = "Carnes frescas";
        $categoria->save();
    }
}
