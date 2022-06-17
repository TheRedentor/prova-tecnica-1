<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'subcategoria_id',
        'stock',
    ];

    public function categorias(){
        return $this->belongsToMany('App\Models\Categoria', 'categoria_product', 'product_id', 'categoria_id');
    }

    public function subcategoria(){
        return $this->belongsTo('App\Models\Subcategoria');
    }

    public function tarifas(){
        return $this->hasMany('App\Models\Tarifa');
    }
}
