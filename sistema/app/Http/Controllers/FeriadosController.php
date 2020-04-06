<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeriadosController extends Controller
{
	public function listaFeriados()
    {
        $listaFeriados=DB::Select('call spGetFeriados()');
        
        return view('feriados')->with('listaFeriados', $listaFeriados);
    }

    public function guardarDatosFeriado(Request $datos){
        if($datos->ajax()){
            $respuesta=DB::Select('call spInsFeriado(?,?,?)', array(
                            $datos->input('idFeriado'),
                            $datos->input('fecha'),
                            $datos->input('descripcion')
                            ) 
                        );

            return response()->json($respuesta);
        }         
    }

    public function eliminarFeriado(Request $datos){
        if($datos->ajax()){
            $respuesta=DB::Select('call spDelFeriado(?)', array($datos->input('idFeriado') ) );
            return response()->json($respuesta);
        }
    }

    public function filtrarFeriados(Request $datos){
        if($datos->ajax()){
            $respuesta=DB::Select('call spGetFeriadosFiltro(?)', array(
                            $datos->input('ano')
                            ) 
                        );
            return response()->json($respuesta);
        }         
    }
}