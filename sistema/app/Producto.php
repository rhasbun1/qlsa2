<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $table = 'productos';
    protected $primary_key = 'prod_codigo';
    public $timestamps = false;

    protected $fillable = ['prod_codigo', 'prod_nombre', 'prod_descripcion', 'prod_estado', 'prod_visible', 'requiere_diseno', 'precio_referencia', 'prod_costo_producto', 'prod_margen', 'prod_precio'];      
}
