<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notaventa extends Model
{
    //

    protected $table = 'notasdeventas';
    protected $primaryKey = 'idNotaVenta';
    public $timestamps = false;

    protected $fillable = ['idNotaVenta', 'cot_ano', 'fechahora_creacion', 'hora_creacion', 'idObra', 'idPlanta', 'idFormaEntrega', 'aprobada', 'ordenCompraCliente','nombreArchivoOC', 'contacto', 'correo', 'telefono', 'observaciones', 'idCondiciondePago', 'codigoClienteSoftland', 'idUsuarioEncargado'];

}
