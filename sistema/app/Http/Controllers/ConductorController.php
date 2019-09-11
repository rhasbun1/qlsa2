<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConductorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listaConductores()
    {
           // 
            return DB::Select('call spGetConductores()'); 

    }

    public function grabarConductor(Request $datos){
        if( $datos->ajax() ){
            $conductor=DB::Select('call spInsConductor(?,?,?,?,?,?,?,?)', array(
                            $datos->input('idConductor'),
                            $datos->input('idEmpresaTransporte'),
                            $datos->input('nombre'),
                            $datos->input('apellidoPaterno'),
                            $datos->input('apellidoMaterno'),
                            $datos->input('rut'),
                            $datos->input('telefono'),
                            $datos->input('email')
                            ) 
                        );

            return response()->json([
                "idConductor" => $conductor[0]->idConductor
            ]);
        }
    }

    public function eliminarConductor(Request $datos){
        if( $datos->ajax() ){
            $conductor=DB::Select('call spDelConductor(?)', array(
                            $datos->input('idConductor')
                            ) 
                        );

            return response()->json([
                "idConductor" => $conductor[0]->idConductor
            ]);
        }
    }    
}
