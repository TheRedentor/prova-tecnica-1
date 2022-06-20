<?php

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*$this->truncateTables([
            'users',
        ]);*/
        $this->call([UserSeeder::class]);
        $this->call([CategoriaSeeder::class]);
        $this->call([SubcategoriaSeeder::class]);
        $this->call([ProductSeeder::class]);
        $this->call([TarifaSeeder::class]);
        $this->call([CategoriaProductSeeder::class]);
        $this->call([SitioSeeder::class]);
        
    }
}
