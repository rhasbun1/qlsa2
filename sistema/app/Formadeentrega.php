<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formadeentrega extends Model
{
    //
    protected $table = 'formasdeentrega';
    protected $primary_key = 'idFormaEntrega';
    public $timestamps = false;

    protected $fillable = ['idFormaEntrega', 'nombre'];       
}
