<?php

namespace App\Http\Controllers;

use App\Obra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObraController extends Controller
{

    public function agregarObra(Request $datos)
    {
        //
        if($datos->ajax()){

            $detalle=$datos->input('distanciaplantas');
            if($detalle!=''){
                $detalle= json_decode($detalle);
            }
            $obra=DB::Select("call spInsObra(?,?,?,?,?,?,?,?,?,?,?,?)", array( $datos->input('idObra'), 
                                                                        $datos->input('nombre'),
                                                                        $datos->input('descripcion'),
                                                                        $datos->input('nombreContacto'),
                                                                        $datos->input('correoContacto'),
                                                                        $datos->input('telefonoContacto'),
                                                                        $datos->input('emp_codigo'),
                                                                        $datos->input('distancia'),
                                                                        $datos->input('tiempo'),
                                                                        $datos->input('costoFlete'),
                                                                        0,
                                                                        $datos->input('habilitada'),
                                                                    ));
            if($detalle!=''){
                foreach ( $detalle as $item){
                    DB::Select("call spInsObraTiempoTrasladoPlanta(?,?,?)", array( $obra[0]->idObra, $item->idPlanta, $item->tiempoTraslado ) );
                }
            }
            
            return response()->json([
                "idObra" => $obra[0]->idObra,
                "codigoSoftland" => $obra[0]->codigoSoftland
            ]);
        }
        
    }

    public function listarObras(Request $datos)
    {
        //
        if($datos->ajax()){
            return DB::table('obras')->select('idObra', 'nombre')->where('emp_codigo', $datos->input('emp_codigo') )->where('habilitada', 1 )->get();
        }
    }    

    public function listadeObras(){
        $obras=DB::Select('call spGetObras()');
        $clientes=DB::table('empresas')->select('emp_codigo', 'emp_nombre')->orderBy(DB::raw("TRIM(emp_nombre)"))->get();
        return view('listadeObras')->with('listaObras', $obras)->with('clientes', $clientes);
    }

    public function datosObra(Request $datos)
    {
        if($datos->ajax()){
            $obra=DB::table('obras')->select('nombre', 'nombreContacto', 'correoContacto', 'telefonoContacto', 'emp_codigo', 'descripcion', 'distancia', 'tiempo', 'costoFlete', 'codigoSoftland', 'habilitada')->where('obras.idObra', $datos->idObra)->get();
            $distancias=DB::Select('call spGetObraDistanciaPlantas(?)', array( $datos->idObra ) );
            $data = [
                'obra' => $obra,
                'distancias'=>$distancias
            ];
            return $data;
        }
    }

    public function eliminarObra(Request $datos){
        if($datos->ajax()){
            $obra=DB::Select('call spDelObra(?)', array( $datos->input('idObra') ) );
            return $obra;
        }
    }



}
