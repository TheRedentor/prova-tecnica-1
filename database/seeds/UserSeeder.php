<?php

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Pere";
        $user->email = "pere@pere";
        $user->password = Hash::make('1234');
        $user->api_token = Str::random(60);
        $user->is_admin = true;
        $user->save();

        $user = new User();
        $user->name = "Joan";
        $user->email = "joan@joan";
        $user->password = Hash::make('1234');
        //$user->api_token = Str::random(60);
        $user->is_admin = false;
        $user->save();
    }
}
