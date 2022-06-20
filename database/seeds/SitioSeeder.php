<?php

use Illuminate\Database\Seeder;
use App\Models\Sitio;

class SitioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sitio = new Sitio();
        $sitio->name = "Casa";
        $sitio->latitude = 41.171130201100844;
        $sitio->longitude = 0.975344854673558;
        $sitio->save();
    }
}
