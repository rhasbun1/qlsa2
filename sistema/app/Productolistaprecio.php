<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productolistaprecio extends Model
{
    //
    protected $table = 'productoListaPrecios';
    public $timestamps = false;

    protected $fillable = ['prod_nombre', 'u_nombre', 'idPlanta', 'codigoSoftland', 'prod_costo_producto', 'prod_margen', 'prod_precio', 'precioReferencia', 'granel', 'requiere_diseno'];      
}
