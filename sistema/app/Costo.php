<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Costo extends Model
{
    //
    //

    protected $table = 'rtl_costos';
    public $timestamps = false;
    protected $fillable = [ 'idRegistroUpload', 'prod_nombre', 'u_nombre', 'nombrePlanta', 'costo' ];    
}
