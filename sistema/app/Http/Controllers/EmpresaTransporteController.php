<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmpresaTransporte;
use Illuminate\Support\Facades\DB;

class EmpresaTransporteController extends Controller
{
    //

    public function listaEmpresas()
    {
        //
        $listaEmpresas=EmpresaTransporte::All();
        return view('empresastransporte')->with('listaEmpresas', $listaEmpresas);
    }

    public function datosEmpresaTransporte($id){

        $empresa=DB::Select('call spGetEmpresaTransporte(?)', array($id) );
        $camiones=DB::Select('call spGetEmpresaCamiones(?)', array($id) );
        $conductores=DB::Select('call spGetEmpresaConductores(?)', array($id) );
    	return view('empresatransporte')->with('idEmpresaTransporte', $id)
                                        ->with('empresa', $empresa)
                                        ->with('camiones', $camiones)
                                        ->with('conductores', $conductores);
    }


    public function agregarEmpresaTransporte(Request $datos){
        if( $datos->ajax() ){
            $idEmpresa=DB::Select('call spInsEmpresaTransporte(?,?,?,?,?,?)', array($datos->input('idEmpresaTransporte'),
                            $datos->input('nombre'),
                            $datos->input('rut'),
                            $datos->input('email'),
                            $datos->input('telefono'),
                            $datos->input('nombreContacto')
                            ) 
                        );

            return response()->json([
                "identificador" => $idEmpresa[0]->id
            ]);
        }
    }

    public function EmpresaConductores(Request $datos){
        if( $datos->ajax() ){
            $conductores=DB::Select('call spGetEmpresaConductores(?)', array( $datos->input('idEmpresaTransporte') ) );
            return $conductores;
        }        
    }

    public function EmpresaCamiones(Request $datos){
        if( $datos->ajax() ){
            $camiones=DB::Select('call spGetEmpresaCamiones(?)', array( $datos->input('idEmpresaTransporte') ) );
            return $camiones;
        }        
    }

}
