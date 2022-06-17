<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = [
        'fecha',
        'producto',
        'numero',
        'precio',
        //'user_id',
    ];

    public $timestamps = false;

    /*
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    */
}
