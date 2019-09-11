<?php

namespace App\Http\Controllers;

use App\CondicionPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CondiciondePagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listaCondicionesdePago()
    {
        //
        $listaCondiciones=CondicionPago::orderBy('nombre')->get();
        return view('listaCondicionesdePago')->with('condiciones', $listaCondiciones);
    }

    public function guardarDatosCondicionPago(Request $datos){
        if($datos->ajax()){
            $condicion=DB::Select('call spInsCondiciondePago(?,?)', array(
                            $datos->input('idCondiciondePago'),
                            $datos->input('nombre')
                            ) 
                        );  

            return response()->json([
                "idCondiciondePago" =>  $condicion[0]->idCondiciondePago
            ]);
        }             
    }

    public function eliminarCondiciondePago(Request $datos){
        if($datos->ajax()){
            $condicion=DB::Select('call spDelCondiciondePago(?)', array(
                            $datos->input('idCondiciondePago')
                            ) 
                        );  

            return response()->json([
                "idCondiciondePago" =>  $condicion[0]->idCondiciondePago
            ]);
        }             
    }

}
