<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaProduct extends Model
{
    protected $table = "categoria_product";
    
    protected $fillable = [
        'categoria_id',
        'product_id',
    ];
}
