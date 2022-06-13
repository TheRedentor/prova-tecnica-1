<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function products(){
        return $this->belongsToMany('App\Models\Product', 'categoria_product', 'categoria_id', 'product_id');
    }

    public function subcategorias(){
        return $this->hasMany('App\Models\Subcategoria');
    }
}
