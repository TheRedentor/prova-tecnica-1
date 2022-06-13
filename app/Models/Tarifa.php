<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'price',
        'product_id',
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}