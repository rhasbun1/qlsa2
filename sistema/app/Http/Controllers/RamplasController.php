<?php

namespace App\Http\Controllers;

use App\Plantas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RamplasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listaRamplas()
    {
        //
        $lista=DB::Select('call spGetRamplas');        
        return view('listaRamplas')->with('ramplas', $lista);
    }

    public function guardarRampla(Request $datos){
        if($datos->ajax()){
            $rampla=DB::Select('call spInsRampla(?,?)', array(
                            $datos->input('numeroRampla'),
                            $datos->input('patenteRampla')
                            ) 
                        );  

            return response()->json([
                "respuesta" =>  $rampla[0]->respuesta
            ]);
        }             
    }

    public function eliminarRampla(Request $datos){
        if($datos->ajax()){
            $rampla=DB::Select('call spDelRampla(?)', array(
                            $datos->input('numeroRampla')
                            ) 
                        );  

            return response()->json([
                "respuesta" =>  $rampla[0]->respuesta
            ]);
        }             
    }

}
