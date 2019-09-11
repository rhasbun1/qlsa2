<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parametro extends Model
{
    //
    protected $table = 'parametros';
    public $timestamps = false;

    protected $fillable = ['iva', 'maximo_toneladas_por_pedido', 'maximo_productos_por_pedido', 'notaPedido1', 'notaPedido2', 'numeroGuia', 'sitrack_usuario', 'sitrack_contrasena', 'consideracionesPedidosGranel', 'version'];    
}
