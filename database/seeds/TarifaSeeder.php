<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tarifa;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TarifaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tarifa = new Tarifa();
        $tarifa->start_date = Carbon::create('2022', '01', '31');
        $tarifa->end_date = Carbon::create('2022', '12', '31');
        $tarifa->price = 13;
        $tarifa->product_id = 1;
        $tarifa->save();
    }
}
