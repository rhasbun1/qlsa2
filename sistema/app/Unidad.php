<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    //
    protected $table = 'unidades';
    protected $primary_key = 'u_codigo';
    public $timestamps = false;

    protected $fillable = ['u_codigo', 'u_nombre'];    
}
