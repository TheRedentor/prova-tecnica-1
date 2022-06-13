<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = [
        'fecha', 'producto', 'numero', 'precio',
    ];

    public $timestamps = false;
}
