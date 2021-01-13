<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use SoapClient;
use File;
use \Mailjet\Resources;


class DevolucionController extends Controller
{
	public function devolucionesEnProceso($tipo){
		return view('devolucionesEnProceso')->with("tipo", $tipo);
	}

	public function verDevolucion(){
		return view('verDevolucion');
	}	
}