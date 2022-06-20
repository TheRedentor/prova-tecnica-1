<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sitio extends Model
{
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
    ];
}
