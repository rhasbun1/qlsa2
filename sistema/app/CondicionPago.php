<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CondicionPago extends Model
{
    //
    protected $table = 'condicionesdepago';
    protected $primary_key = 'idCondiciondePago';
    public $timestamps = false;

    protected $fillable = ['idCondiciondePago','nombre'];
}
