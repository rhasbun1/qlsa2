<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notaventa_detalle extends Model
{
    //
    protected $table = 'notasdeventas_detalle';
    protected $primary_key = 'idNotaVentaDetalle';
    public $timestamps = false;

    protected $fillable = ['idNotaVentaDetalle', 'idNotaVenta', 'prop_codigo', 'formula', 'cantidad', 'idPlanta', 'u_codigo'];    
}
