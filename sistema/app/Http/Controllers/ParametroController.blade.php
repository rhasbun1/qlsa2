<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParametroController extends Controller
{

    public function nuevaVersion()
    {
        DB::Select('call spGetNuevaVersion()'); 
        return;
    }	

    

}