<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresaTransporte extends Model
{
    //
    protected $table = 'empresastransporte';
    protected $primary_key = 'idEmpresaTransporte';
    public $timestamps = false;

    protected $fillable = ['idEmpresaTransporte', 'nombre', 'rut', 'nombreContacto', 'email', 'telefono'];
        
}
