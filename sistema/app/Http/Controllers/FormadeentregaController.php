<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formadeentrega;
class FormadeentregaController extends Controller
{
    //
    public function apiFormadeEntrega()
    {
        //
        return Formadeentrega::All();
    }       
}
