<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    //

    protected $table = 'cotizaciones';
    protected $primary_key = 'cot_numero';
    public $timestamps = false;

    protected $fillable = ['cot_numero', 'cot_año', 'cot_obra', 'emp_codigo', 'cot_fecha_creacion', 'cot_fecha_validacion', 'usu_validacion', 'cot_estado'];

}
