<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Planta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlantaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listaPlantas()
    {
        //
        $listaPlantas=Planta::All();
        return view('plantas')->with('listaPlantas', $listaPlantas);
    }

    public function apiPlantas()
    {
        //
        return Planta::All();
    }    

    public function selectPlantas(Request $datos)
    {
        $planta=DB::Select('call spGetPlantasSelect(?,?,?)', array(
            $datos->input('codigoProducto'),
            $datos->input('codigoUnidad'),
            $datos->input('codigoPlanta'),
            ) 
        );
        return response()->json([
            "identificador" => $planta[0]->identificador
        ]);
    }

    public function verificarTiempoProduccion(Request $datos)
    {     
        $tiempoProduccion=DB::Select('call spGetVerificarTiempoProduccion(?,?,?)', array(
            $datos->input('codigoProducto'),
            $datos->input('codigoUnidad'),
            $datos->input('codigoPlanta'),
            ) 
        );
        return response()->json([
            "identificador" => $tiempoProduccion[0]->identificador
        ]);
    }

   
    public function grabarPlanta(Request $datos){
        if( $datos->ajax() ){
            $planta=DB::Select('call spInsPlanta(?,?,?)', array(
                            $datos->input('idPlanta'),
                            $datos->input('nombre'),
                            $datos->input('codigoSoftland')
                            ) 
                        );

            return response()->json([
                "idPlanta" => $planta[0]->idPlanta
            ]);
        }
    }

    public function eliminarPlanta(Request $datos){
        if( $datos->ajax() ){
            $planta=DB::Select('call spDelPlanta(?,?)', array(
                            $datos->input('idPlanta'),
                            Session::get('idUsuario')
                            ) 
                        );

            return response()->json([
                "idPlanta" => $planta[0]->idPlanta
            ]);
        }        
    }
}
