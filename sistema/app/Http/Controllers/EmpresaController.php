<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listaEmpresas()
    {
        //

        $listaEmpresas=DB::Select('call spGetEmpresas');
        return view('clientes')->with('listaEmpresas', $listaEmpresas);
    }

    public function guardarDatosCliente(Request $datos){
        if($datos->ajax()){
            $empresa=DB::Select('call spUpdEmpresa(?,?,?,?,?,?,?,?,?,?)', array(
                            $datos->input('emp_codigo'),
                            $datos->input('rutEmpresa'),
                            $datos->input('razonSocial'),
                            $datos->input('nombre'),
                            $datos->input('direccion'),
                            $datos->input('comuna'),
                            $datos->input('ciudad'),
                            $datos->input('solicitaOC'),
                            $datos->input('codigoSoftland'),
                            $datos->input('crearEnNotaVenta'),
                            ) 
                        );  

            return response()->json([
                "identificador" =>  $empresa[0]->emp_codigo
            ]);
        }             
    }

}
