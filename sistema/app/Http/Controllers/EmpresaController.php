<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

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



    public function validarCodigoSoftlandEmpresa(Request $datos){
        if($datos->ajax()){
            $client = new Client();
            $url="http://webservice.quimicalatinoamericana.cl:8082/qrysoftland/api/datoscliente";

            $params=[
                "codigoSoftland" => $datos->input('codigoSoftland')
            ];

            $headers = [
                'X-CSRF-TOKEN' => 'WiyfqvBuHrUnzT6zCvidq9lMVIQSB220Wtsx8EK5'
            ];

            $response= $client->request('POST', $url, [
                'json' => $params,
                'headers' => $headers,
                'verify' => false
            ]);

            $respuesta=json_decode( $response->getBody() );
            $cont=0;
            foreach($respuesta as $item){
                $cont++;
            }

            return response()->json([
                "identificador" =>  $cont
            ]);
        }
    }    

    public function guardarDatosCliente(Request $datos){
        if($datos->ajax()){

            $client = new Client();
            $url="http://webservice.quimicalatinoamericana.cl:8082/qrysoftland/api/datoscliente";

            $params=[
                "codigoSoftland" => $datos->input('codigoSoftland')
            ];

            $headers = [
                'X-CSRF-TOKEN' => 'WiyfqvBuHrUnzT6zCvidq9lMVIQSB220Wtsx8EK5'
            ];

            $response= $client->request('POST', $url, [
                'json' => $params,
                'headers' => $headers,
                'verify' => false
            ]);

            $respuesta=json_decode( $response->getBody() );
            $cont=0;
            foreach($respuesta as $item){
                $cont++;
            }

            if($cont==0){
                return response()->json([
                    "identificador" =>  -1
                ]);                
            }

            $empresa=DB::Select('call spUpdEmpresa(?,?,?,?,?,?,?,?,?,?  )', array(
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
