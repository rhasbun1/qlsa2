<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccionesController extends Controller
{
	public function registroAcciones(){
		$itemAcciones=DB::Select('call spGetItemAcciones()');
		return view('consultarRegAcciones')->with('itemAcciones', $itemAcciones);
	}

	public function consultarProductoAcciones(Request $datos){
        if( $datos->ajax() ){
            $acciones=DB::Select('call spGetProductoAcciones(?)', array(
                            $datos->input('cadena')
                            ) 
                        );

            return $acciones;
        }		
	}
	
	public function consultarRegistroAcciones(Request $datos){
        if( $datos->ajax() ){
            $acciones=DB::Select('call spGetAccionesporItem(?,?)', array(
                            $datos->input('item'),
                            $datos->input('numero'),
                            ) 
                        );

            return $acciones;
        }		
	}	
}