<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Parametro;
use App\Planta;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function dashboard(){
    	$datos=DB::Select('call spGetDashBoard');
    	$nombreUsuario= explode(" ", Session::get('nombreUsuario'));


    	$pedidos=DB::Select('call spGetProductosconPedidoPendiente(?,?,?)', array( Session::get('empresaUsuario' ), Session::get('idPlanta'), Session::get('idPerfil')  ) );

        return view('dashboard')->with('datos', $datos)->with('nombreUsuario', $nombreUsuario[0])->with('pedidos', $pedidos);
    }

    public function informacion($idPlanta=0){
        $datos=DB::Select('call spGetDashBoardPlanta(?)', array( $idPlanta ));
        $pedidos=DB::Select('call spGetPedidoPendientePorPlanta(?,?)', array( 0, $idPlanta ) );            
        $plantas= Planta::All();
        return view('informacion')->with('datos', $datos)->with('pedidos', $pedidos)->with('plantas', $plantas)->with('idPlanta', $idPlanta);
    }

    public function volver(){
    	return redirect(redirect()->getUrlGenerator()->previous());
    }

    public function parametros(){
        $param=Parametro::All();
        $usuarios=DB::Select('call spGetUsuarios()');
        return view('parametros')->with('param', $param)->with('usuarios', $usuarios);
    }

    public function obtenerParametros(){
        $param=Parametro::All();
        return $param;
    }

    public function grabarParametros(Request $datos){
        $param=DB::Select('call spUpdParametros(?,?,?,?,?,?,?,?,?,?,?,?,?)', array( $datos->input('iva'), $datos->input('numeroGuia'), $datos->input('cmgttn'), $datos->input('cmgttm1'), $datos->input('cmgttm2'), $datos->input('notaPedido1'), $datos->input('notaPedido2'), $datos->input('sitrack_usuario'), $datos->input('sitrack_contrasena'), $datos->input('antiguedad_dias'), $datos->input('monto_TopeNV'), $datos->input('consideracionesPedidosGranel'), $datos->input('idUsuarioAutoriza')  ) );

        return response()->json([
                "mensaje" => $param[0]->mensaje
            ]);
    }

    public function nuevaVersion(){
        $version=DB::Select('call spUpdVersion');
        return "Nueva Version: ".$version[0]->version;
    }
    
}
