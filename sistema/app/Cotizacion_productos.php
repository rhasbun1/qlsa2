<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion_productos extends Model
{
    //

    protected $table = 'cotizaciones_productos';
    protected $primary_key = 'cp_codigo';
    public $timestamps = false;

    protected $fillable = ['prod_codigo', 'cp_cantidad', ''];


}
