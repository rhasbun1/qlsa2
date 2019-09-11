<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planta extends Model
{
    //
    protected $table = 'plantas';
    protected $primary_key = 'idPlanta';
    public $timestamps = false;

    protected $fillable = ['idPlanta', 'nombre'];    
}
