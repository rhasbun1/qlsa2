<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CamionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listaCamiones()
    {
           // 
            return DB::Select('call spGetCamiones()'); 

    }

    public function grabarCamion(Request $datos){
        if( $datos->ajax() ){
            $camion=DB::Select('call spInsCamion(?,?,?,?,?)', array(
                            $datos->input('idCamion'),
                            $datos->input('idEmpresaTransporte'),
                            $datos->input('patente'),
                            $datos->input('patenteRampla'),
                            $datos->input('gps')
                            ) 
                        );

            return response()->json([
                "idCamion" => $camion[0]->idCamion,
                "nombreEmpresa" => $camion[0]->nombreEmpresa,
            ]);
        }
    }

    public function eliminarCamion(Request $datos){
        if( $datos->ajax() ){
            $camion=DB::Select('call spDelCamion(?)', array(
                            $datos->input('idCamion')
                            ) 
                        );

            return response()->json([
                "idCamion" => $camion[0]->idCamion
            ]);
        }
    }    


}
