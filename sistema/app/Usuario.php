<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
    protected $table = 'usuarios';
    protected $primary_key = 'usu_codigo';
    public $timestamps = false;

    protected $fillable = ['usu_codigo', 'usu_nombre', 'prod_descripcion', 'usu_apellido', 'usu_telefono', 'usu_email', 'usu_estado', 'usu_visible'];      
}
