<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    //
    protected $table = 'empresas';
    protected $primary_key = 'emp_codigo';
    public $timestamps = false;

    protected $fillable = ['emp_codigo', 'emp_razon_social', 'emp_rut', 'emp_nombre', 'emp_direccion', 'emp_estado', 'emp_visible', 'notaVentaSolicitaCodigo'];
}
