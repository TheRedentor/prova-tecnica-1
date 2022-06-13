<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $fillable = [
        'name',
        'description',
        'categoria_id',
    ];

    public function categoria(){
        return $this->belongsTo('App\Models\Categoria');
    }

    public function products(){
        return $this->hasMany('App\Models\Product');
    }
}
