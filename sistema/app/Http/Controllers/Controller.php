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
        
        $nombreUsuario= explode(" ", Session::get('nombreUsuario'));
        $empresaUsuario= explode(" ", Session::get('empresaUsuario'));


        
        $datos=DB::Select('call sp_GetDatosDashboard(?,?,?)', array(0,Session::get('idUsuario'), Session::get('idPerfil')));

        $listaNotasdeVenta=DB::Select('call spGetNotasdeVentasPendientesAprobacion(?)', array(0) );
        
        $listaPedidosIngresadosporClientesSinAprobar=DB::Select('call spGetpedidosIngresadosporClientesSinAprobar', array(0) );

        $listaPedidosEnProceso=DB::Select('call spGetProductosconPedidoPendiente(?,?,?)', array(0, Session::get('idUsuario'), Session::get('idPerfil')  ) );

        $listaToneladasaMensuales=DB::Select('call spGetToneladasMensuales()', array(0));

        $listatoneladasAnuales=DB::Select('call spGetToneladasAnuales()', array(0));

        $listaJefePedidoEnProceso=DB::Select('call spGetProductosconPedidoPendiente(?,?,?)', array(0, Session::get('idUsuario'), Session::get('idPerfil')  ) );

        $listaClientePedidosEnProceso=DB::Select('call spGetProductosconPedidoPendienteCliente(?)', array(Session::get('idUsuario')));

        $listaJefeGranelSinAsignacionDeHorario=DB::Select('call spGetGranelSinAsignacionDeHorario(?,?,?)', array(0, Session::get('idUsuario'), Session::get('idPerfil')  ) );

        $listaJefePedidosAtrasados=DB::Select('call spGetPedidosAtrasadosJefe(?,?,?)', array(0, Session::get('idUsuario'), Session::get('idPerfil')  ) );

        $listaJefeLabCertificadosPorSubir=DB::Select('call spCertificadosPendienteSubir(?,?,?)', array(0, Session::get('idUsuario'), Session::get('idPerfil')  ) );

        $listaAccionesHaceUnaHora=DB::Select('call spAccionesHaceUnaHora()', array(0));

        $listaNotaVentaSinFlete=DB::Select('call spGetNotasdeVentasSinFlete()', array(0));

        $listaPedidoSinFechaDeCarga=DB::Select('call spGetPedidosSinAsignacionDeCarga()', array(0));

        $listaPedidoAtrasadoTransporte=DB::Select('call spGetPedidosAtrasadoTransporte()', array(0));

        $listaPedidoClienteEnProceso=DB::Select('call spGetProductosconPedidoPendienteCliente(?)', array(Session::get('idUsuario')));
        
        $listaPedidoClienteEnDespacho=DB::Select('call spGetPedidoEnDespachoCliente(?)', array(Session::get('idUsuario')));

        $listaPedidoSinAprobar=DB::Select('call spGetPedidoSinAprobar()', array(0));

        $listaPedidoSinAprobarCliente=DB::Select('call spGetClientePedidosSinAprobar(?)', array(Session::get('idUsuario')));

        $listaPedidoSinAprobarClientes=DB::Select('call spGetPedidoSinAprobarClientes(?)', array(Session::get('empresaUsuario')));

        
        
       


        

        

        



        /*
    	$datos=DB::Select('call spGetDashBoard');
    	$pedidos=DB::Select('call spGetProductosconPedidoPendiente(?,?,?)', array( Session::get('empresaUsuario' ), Session::get('idPlanta'), Session::get('idPerfil')  ) );
        
        return view('dashboard')->with('datos', $datos)
                                ->with('nombreUsuario', $nombreUsuario[0])
                                ->with('pedidos', $pedidos);
        */
        return view('dashboard')->with('nombreUsuario', $nombreUsuario[0])
                                ->with('datos', $datos)
                                ->with('listaNotasdeVenta', $listaNotasdeVenta)
                                ->with('listaPedidosIngresadosporClientesSinAprobar', $listaPedidosIngresadosporClientesSinAprobar)
                                ->with('listaPedidosEnProceso', $listaPedidosEnProceso)
                                ->with('listaToneladasaMensuales', $listaToneladasaMensuales)
                                ->with('listatoneladasAnuales', $listatoneladasAnuales)
                                ->with('listaClientePedidosEnProceso', $listaClientePedidosEnProceso)
                                ->with('listaJefePedidoEnProceso', $listaJefePedidoEnProceso)
                                ->with('listaJefeGranelSinAsignacionDeHorario', $listaJefeGranelSinAsignacionDeHorario)
                                ->with('listaJefePedidosAtrasados', $listaJefePedidosAtrasados)
                                ->with('listaJefeLabCertificadosPorSubir', $listaJefeLabCertificadosPorSubir)
                                ->with('listaAccionesHaceUnaHora', $listaAccionesHaceUnaHora)
                                ->with('listaNotaVentaSinFlete', $listaNotaVentaSinFlete)
                                ->with('listaPedidoSinFechaDeCarga', $listaPedidoSinFechaDeCarga)
                                ->with('listaPedidoAtrasadoTransporte', $listaPedidoAtrasadoTransporte)
                                ->with('listaPedidoClienteEnProceso', $listaPedidoClienteEnProceso)
                                ->with('listaPedidoClienteEnDespacho', $listaPedidoClienteEnDespacho)
                                ->with('listaPedidoSinAprobar', $listaPedidoSinAprobar)
                                ->with('listaPedidoSinAprobarClientes', $listaPedidoSinAprobarClientes)
                                ->with('listaPedidoSinAprobarCliente', $listaPedidoSinAprobarCliente);
    }
    public function notaVentas(){
        $listaNotasdeVenta=DB::Select('call spGetNotasdeVentas(?)', array(0) );

        return $listaNotasdeVenta;

    }

    public function informacion($idPlanta=0){
        $datos=DB::Select('call spGetDashBoardPlanta(?)', array( $idPlanta ));
        $pedidos=DB::Select('call spGetPedidoPendientePorPlanta(?,?)', array( 0, $idPlanta ) );            
        $plantas= Planta::All();
        var_dump($pedidos);
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
