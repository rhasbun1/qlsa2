<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    //
    protected $table = 'obras';
    protected $primary_key = 'idObra';
    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion', 'nombreContacto', 'correoContacto', 'telefonoContacto', 'emp_codigo', 'distancia', 'tiempo', 'costoFlete'];    
}
