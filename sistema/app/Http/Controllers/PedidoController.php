<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\PedidoAprobado;
use App\Mail\PedidoSuspendido;
use App\Pedido;
use SoapClient;
use File;


class PedidoController extends Controller
{
    //
    public function index($idNotaVenta)
    {
        //
        $NotadeVenta=DB::Select('call spGetNotaVenta(?)', array($idNotaVenta) );
        $NotadeVentaDetalle=DB::Select('call spGetNotaVentaDetalle(?)', array($idNotaVenta) );
        $plantas=DB::table('plantas')->select('idPlanta', 'nombre')->get();
        $formaEntrega=DB::table('formasdeentrega')->select('idFormaEntrega', 'nombre')->get();
        $parametros=DB::table('parametros')->select('iva', 'maximo_toneladas_por_pedido', 'maximo_productos_por_pedido', 'notaPedido1', 'notaPedido2','consideracionesPedidosGranel','version')->get();
        return view('gestionarpedido')->with('NotadeVenta', $NotadeVenta)
                                      ->with('NotadeVentaDetalle', $NotadeVentaDetalle)
                                      ->with('FormasdeEntrega', $formaEntrega)
                                      ->with('Plantas', $plantas)
                                      ->with('parametros', $parametros);
    }


    public function detalleNotaVenta(Request $datos){
        if($datos->ajax()){
            $NotadeVentaDetalle=DB::Select('call spGetNotaVentaDetalle(?)', array($datos->input('idNotaVenta')) );
            return $NotadeVentaDetalle;
        }
    }

    public function clienteGestionarPedido($idNotaVenta)
    {
        //
        $NotadeVenta=DB::Select('call spGetNotaVenta(?)', array($idNotaVenta) );
        $NotadeVentaDetalle=DB::Select('call spGetNotaVentaDetalle(?)', array($idNotaVenta) );
        $plantas=DB::table('plantas')->select('idPlanta', 'nombre')->get();
        $formaEntrega=DB::table('formasdeentrega')->select('idFormaEntrega', 'nombre')->get();
        $parametros=DB::table('parametros')->select('iva', 'maximo_toneladas_por_pedido', 'maximo_productos_por_pedido', 'notaPedido1', 'notaPedido2')->get();
        return view('cliente_gestionarpedido')->with('NotadeVenta', $NotadeVenta)
                                      ->with('NotadeVentaDetalle', $NotadeVentaDetalle)
                                      ->with('FormasdeEntrega', $formaEntrega)
                                      ->with('Plantas', $plantas)
                                      ->with('parametros', $parametros);
    }

    // Vista por pedido para los usuarios Ejecutivos de Crédito    
    public function listaPedidos(){
        if( Session::get('idPerfil')=='11' ){
            $pedidos=DB::Select('call spGetPedidos');
        }else{
            $pedidos=DB::Select('call spGetProductosconPedidoPendiente(?,?,?)', array(0, Session::get('idUsuario'), Session::get('idPerfil')  ) );
        }
        
        $pedidosIngresoCliente=DB::Select('call spGetpedidosIngresadosporClientesSinAprobar');
        $cantidadIngresoCliente=count($pedidosIngresoCliente);

        $parametros=DB::table('parametros')->select('version')->get();
        return view('listaPedidos')->with('pedidos', $pedidos)
                                    ->with('cantidadIngresoCliente', $cantidadIngresoCliente)
                                    ->with('parametros', $parametros);    	
    }

    public function historicoPedidos(){
        $fecha_termino = date('Y-m-d'); 
        $fecha_inicio = date("Y-m-d",strtotime($fecha_termino."- 60 days"));
        if( Session::get('empresaUsuario')!='0' ){
            $clientes=DB::table('empresas')->select('emp_codigo', 'emp_nombre')->where('emp_codigo',"=",Session::get('empresaUsuario') )->get();
        }else{
            $clientes=DB::table('empresas')->select('emp_codigo', 'emp_nombre')->orderBy('emp_nombre')->get();
        }


        if( Session::get('idPerfil')=='11' ){
            $pedidos=DB::Select('call spGetHistoricoPedidoDetalle(?,?,?,?,?,?,?,?,?,?)', array($fecha_inicio, $fecha_termino, Session::get('empresaUsuario'), 0, 0,0,0,0, Session::get('idUsuario'), Session::get('idPerfil') ) );
        }else{
            $pedidos=DB::Select('call spGetHistoricoPedidoDetalle(?,?,?,?,?,?,?,?,?,?)', array($fecha_inicio, $fecha_termino, Session::get('empresaUsuario'), Session::get('idPlanta'), 0,0,0,0, Session::get('idUsuario'), Session::get('idPerfil') ) );
        }        
        $parametros=DB::table('parametros')->select('version')->get();     
        $plantas=DB::Select('call spGetUsuarioPerfilPlantas(?,?)', array( Session::get('idUsuario'), Session::get('idPerfil') ));

        return view('historicoPedidos')->with('pedidos', $pedidos)
                                    ->with('parametros', $parametros)
                                    ->with('clientes', $clientes)
                                    ->with('plantas', $plantas)
                                    ->with('fecInicio', $fecha_inicio)
                                    ->with('fecTermino', $fecha_termino);     
    }


    public function obtenerHistoricoPedidos(Request $datos){
        $fechaInicio=strtotime( str_replace('/', '-', $datos->input("salidaDesde") ) );
        $fechaTermino=strtotime( str_replace('/', '-', $datos->input("salidaHasta") ) );
        $fechaInicio = date('Y-m-d', $fechaInicio);
        $fechaTermino = date('Y-m-d', $fechaTermino);        
        if( Session::get('idPerfil')=='11' ){
            $pedidos=DB::Select('call spGetHistoricoPedidoDetalle(?,?,?,?,?,?,?,?,?,?)', array($fechaInicio, $fechaTermino, $datos->input("emp_codigo"), $datos->input("idPlanta"), $datos->input("pedidoDesde"), $datos->input("pedidoHasta"), $datos->input("guiaDesde"), $datos->input("guiaHasta"), Session::get('idUsuario'), Session::get('idPerfil') ) );
        }else{
            $pedidos=DB::Select('call spGetHistoricoPedidoDetalle(?,?,?,?,?,?,?,?,?,?)', array($fechaInicio, $fechaTermino, $datos->input("emp_codigo"), 
                $datos->input('idPlanta'), $datos->input("pedidoDesde"), $datos->input("pedidoHasta"), $datos->input("guiaDesde"), $datos->input("guiaHasta"), Session::get('idUsuario'), Session::get('idPerfil') ) );
        }        
        return $pedidos; 
    }



    // Vista para Pre Aprobar pedidos ingresados por Clientes  
    public function listaIngresosClienteporAprobar(){
        $pedidos=DB::Select('call spGetpedidosIngresadosporClientesSinAprobar');
        return view('listaIngresosClienteporAprobar')->with('pedidos', $pedidos);          
    }

    public function listaPedidosDetallado(){
        $pedidos=DB::Select('call spGetProductosconPedidoPendiente(?)', array(0) );
        $pedidosIngresoCliente=DB::Select('call spGetpedidosIngresadosporClientesSinAprobar');
        $cantidadIngresoCliente=count($pedidosIngresoCliente);
        $parametros=DB::table('parametros')->select('version')->get();
        return view('listaPedidos')->with('pedidos', $pedidos)
                ->with('cantidadIngresoCliente', $cantidadIngresoCliente)
                ->with('parametros', $parametros);
    }    


    // Vista para Aprobar pedidos por Usuarios Comerciales  
    public function clientePedidos(){
        $pedidos=DB::Select('call spGetProductosconPedidoPendiente(?,?)', array( Session::get('empresaUsuario' ), Session::get('idPlanta' ) ) );
        return view('cliente_pedidos')->with('pedidos', $pedidos);  
    }    

    public function programacion(){
        $pedidos=DB::Select('call spGetProductosconPedidoPendiente(?,?,?)', array(0,Session::get('idUsuario' ), Session::get('idPerfil')  ) );
        $parametros=DB::table('parametros')->select('version')->get();
        return view('programacion')->with('pedidos', $pedidos)->with('parametros', $parametros);     
    }



    public function productosconPedidoPendientePorFechaEntrega(Request $datos){
        if($datos->ajax()){ 
            $pedidos=DB::Select('call spGetProductosconPedidoPendientePorFechaEntrega(?,?,?,?,?,?)', array(0,Session::get('idPlanta' ), $datos->input('fechaInicio'), $datos->input('fechaTermino'), Session::get('idUsuario' ), Session::get('idPerfil')  ) );
            return $pedidos;
        }
    }

    public function productosconPedidoPendientePorFechaCarga(Request $datos){
        if($datos->ajax()){ 
            $pedidos=DB::Select('call spGetProductosconPedidoPendientePorFechaCarga(?,?,?,?,?,?)', array(0,Session::get('idPlanta' ), $datos->input('fechaInicio'), $datos->input('fechaTermino'), Session::get('idUsuario' ), Session::get('idPerfil')  ) );
            return $pedidos;
        }
    }


    /* Este procedimiento esta obsoleto*/
    public function pedidosEnProceso(){
        $pedidos=DB::Select('call spGetProductosconPedidoPendiente(?)', array(0) );
        $parametros=DB::table('parametros')->select('version')->get();
        return view('pedidosEnProceso')->with('pedidos', $pedidos)->with('parametros', $parametros);    
    }    


    public function AprobarPedidos(){
        $listaPedidos=DB::Select('call spGetAprobarPedidos');
        $parametros=DB::table('parametros')->select('version')->get();
        return view('aprobarpedidos')->with('pedidos', $listaPedidos)->with('parametros', $parametros);
    } 

     public function aprobarPedidoCliente(Request $datos){
        if($datos->ajax()){
            $pedido=DB::Select("call spUpdAprobarPedidoCliente(?, ?)", array( $datos->input('idPedido'), Session::get('idUsuario') ) );
            return response()->json([
                "identificador" => $pedido[0]->idPedido
            ]);
        }
    }    


    public function aprobarPedido(Request $datos){
        if($datos->ajax()){
            $pedido=DB::Select("call spUpdAprobarPedido(?,?)", array( $datos->input('idPedido'), Session::get('idUsuario')  ));
         //   $this->avisoPedidoAprobado($datos->input('idPedido'));                     
            return response()->json([
                "identificador" => $pedido[0]->idPedido
            ]);
        }
    }

    public function desaprobarPedido($idPedido){
        $pedido=DB::Select('call spUpdDesaprobarPedido(?,?)', array( $idPedido, Session::get('idUsuario') ) );      
        return redirect('listarPedidos');
    }

    public function suspenderPedido(Request $datos){
        if($datos->ajax()){
            $pedido=DB::Select('call spUpdSuspenderPedido(?,?,?)', array( $datos->input('idPedido'), $datos->input('motivo'), Session::get('idUsuario') ) );

            // $destinatarios= DB::Select('call spGetListaDestinatarios(?)', array( 'P' ));        
            // Mail::to($destinatarios)->send(new PedidoSuspendido($pedido) );
            return response()->json([ 
                        "url" => asset('/').'listarPedidos'
                    ]);
        }   
        
    }

    public function cerrarPedido($idPedido){
        $pedido=DB::Select('call spUpdCerrarPedido(?,?)', array( $idPedido, Session::get('idUsuario') ) );
        if (Session::get('grupoUsuario')=='P'){
            return redirect('programacion');
        }else{
            return redirect('listarPedidos');
        }
        
    }      

    public function editarPedido($idPedido){
        $pedido=DB::Select('call spGetPedido(?)', array($idPedido) );
        $listaDetallePedido=DB::Select('call spGetPedidoDetalle(?)', array($idPedido) );
        $log = DB::Select('call spGetPedidoLog(?)', array($idPedido) );
        $emptransporte = DB::table('empresastransporte')->select('idEmpresaTransporte','nombre')->get();
        $plantas=DB::table('plantas')->select('idPlanta', 'nombre')->get();
        $formasdeentrega=DB::table('formasdeentrega')->select('idFormaEntrega', 'nombre')->get();
        return view('editarpedido')->with('pedido', $pedido)
                                ->with('listaDetallePedido', $listaDetallePedido)
                                ->with('emptransporte', $emptransporte)
                                ->with('log', $log)
                                ->with('plantas', $plantas)
                                ->with('formasdeentrega', $formasdeentrega);
    }      

    public function verpedido($idPedido, $accion){
        $pedido=DB::Select('call spGetPedido(?)', array($idPedido) );
        $listaDetallePedido=DB::Select('call spGetPedidoDetalle(?)', array($idPedido) );
        $log = DB::Select('call spGetPedidoLog(?)', array($idPedido) );
        $notas = DB::Select('call spGetPedidoNotas(?)', array($idPedido) );
        $emptransporte = DB::table('empresastransporte')->select('idEmpresaTransporte','nombre')->get();
        $parametros=DB::table('parametros')->select('version')->get();
        return view('verpedido')->with('pedido', $pedido)
                                ->with('listaDetallePedido', $listaDetallePedido)
                                ->with('accion', $accion)
                                ->with('emptransporte', $emptransporte)
                                ->with('log', $log)
                                ->with('notas', $notas)
                                ->with('parametros', $parametros)
                                ->with('plantilla', 'plantilla');
    }

    public function verpedidoNuevaVentana($idPedido, $accion){
        $pedido=DB::Select('call spGetPedido(?)', array($idPedido) );
        $listaDetallePedido=DB::Select('call spGetPedidoDetalle(?)', array($idPedido) );
        $log = DB::Select('call spGetPedidoLog(?)', array($idPedido) );
        $notas = DB::Select('call spGetPedidoNotas(?)', array($idPedido) );
        $emptransporte = DB::table('empresastransporte')->select('idEmpresaTransporte','nombre')->get();
        $parametros=DB::table('parametros')->select('version')->get();
        return view('verpedido')->with('pedido', $pedido)
                                ->with('listaDetallePedido', $listaDetallePedido)
                                ->with('accion', $accion)
                                ->with('emptransporte', $emptransporte)
                                ->with('log', $log)
                                ->with('notas', $notas)
                                ->with('parametros', $parametros)
                                ->with('plantilla', 'plantilla2');
    }


    public function clienteVerPedido($idPedido, $accion){
        $pedido=DB::Select('call spGetPedido(?)', array($idPedido) );
        $listaDetallePedido=DB::Select('call spGetPedidoDetalle(?)', array($idPedido) );
        $emptransporte = DB::table('empresastransporte')->select('idEmpresaTransporte','nombre')->get();
        return view('cliente_verpedido')->with('pedido', $pedido)
                                ->with('listaDetallePedido', $listaDetallePedido)
                                ->with('accion', $accion)
                                ->with('emptransporte', $emptransporte);
    }
    
    public function programarpedido($idPedido){
        $pedido=DB::Select('call spGetPedido(?)', array($idPedido) );
        $listaDetallePedido=DB::Select('call spGetPedidoDetalle(?)', array($idPedido) );
        $log = DB::Select('call spGetPedidoLog(?)', array($idPedido) );
        $notas = DB::Select('call spGetPedidoNotas(?)', array($idPedido) );
        $emptransporte = DB::table('empresastransporte')->select('idEmpresaTransporte','nombre')->get();
        $plantas=DB::table('plantas')->select('idPlanta', 'nombre')->get();
        $parametros=DB::table('parametros')->select('version')->get();
        return view('programacionPedido')->with('pedido', $pedido)
                                ->with('listaDetallePedido', $listaDetallePedido)
                                ->with('emptransporte', $emptransporte)
                                ->with('log', $log)
                                ->with('notas', $notas)
                                ->with('plantas', $plantas)
                                ->with('parametros', $parametros);
    }    

    public function grabarNuevoPedido(Request $datos){
        if($datos->ajax()){
            $extension="";
            $archivo=$datos->file("upload-demo");
            if(isset($archivo)){
                $extension = $archivo->getClientOriginalExtension();               
            }

            //$detalle = json_decode($datos->input('detalle'));
            $detalle=$datos->input('detalle');
            $detalle= json_decode($detalle);
            
            $idPedido=DB::Select('call spInsPedido(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,? )', array(
                            $datos->input('idNotaVenta'),
                            $datos->input('fechaEntrega'),
                            $datos->input('observaciones'),
                            $datos->input('horarioEntrega'),
                            $datos->input('idEstadoPedido'),
                            $datos->input('usu_codigo_estado'),
                            $datos->input('totalNeto'),
                            $datos->input('contacto'),
                            $datos->input('telefono'),
                            $datos->input('email'),
                            $datos->input('noExcederCantidad'),
                            $datos->input('tipoCarga'),
                            $datos->input('tipoTransporte'),
                            Session::get('empresaUsuario'),
                            $datos->input('ordenCompra'),
                            $extension,
                            $datos->input('incluyeFleteFalso'),
                            $datos->input('valorFleteFalso'),
                            $datos->input('cantidadFleteFalso'),
                            ) 
                        );  

            foreach ( $detalle as $item){
                DB::Select("call spInsPedidoDetalle(?,?,?,?,?,?,?,?)", array( $idPedido[0]->idPedido, $item->idNotaVenta, $item->prod_codigo, $item->u_codigo, $item->cantidad, $item->precio, $item->idPlanta, $item->idFormaEntrega) );
            }

            if(!isset($archivo)){
                if($idPedido[0]->nombreArchivo<>''){
                    if( File::exists( public_path('ocompra/nventa/'.$idPedido[0]->nombreArchivo) )){
                        $origen=public_path('ocompra/nventa/'.$idPedido[0]->nombreArchivo);
                        $pos = strripos($idPedido[0]->nombreArchivo, ".");
                        $extension=substr($idPedido[0]->nombreArchivo,$pos);

                        $destino=public_path('ocompra/pedido/'."OC".$idPedido[0]->idPedido.$extension);

                        File::copy($origen, $destino);

                        $pd = Pedido::find($idPedido[0]->idPedido);
                        $pd->nombreArchivoOC = "OC".$idPedido[0]->idPedido.$extension;
                        $pd->save();
                    }                     
                }

            }else{
                if($idPedido[0]->nombreArchivo!=""){
                    Storage::disk('ocpedido')->put($idPedido[0]->nombreArchivo, \File::get( $archivo) );
                }
            }

            return response()->json([
                "identificador" => $idPedido[0]->idPedido,
                "nombreArchivo" => $idPedido[0]->nombreArchivo
            ]);
        }
    }

    public function actualizarPedido(Request $datos){
        if($datos->ajax()){
            $detalle=$datos->input('detalle');
            $detalle= json_decode($detalle);
            
            $idPedido=DB::Select('call spUpdPedido(?,?,?,?,?,?,?,?)', array(
                            $datos->input('idPedido'),
                            $datos->input('fechaEntrega'),
                            $datos->input('horarioEntrega'),
                            $datos->input('observaciones'),
                            $datos->input('totalNeto'),
                            Session::get('idUsuario'),
                            $datos->input('motivo'),
                            $datos->input('ordenCompraCliente')
                            ) 
                        );  

            foreach ( $detalle as $item){
                DB::Select("call spUpdPedidoDetalle(?,?,?,?,?)", array( $idPedido[0]->idPedido, $item->prod_codigo,  $item->cantidad, $item->idPlanta, $item->idFormaEntrega ) );
            }

            return response()->json([
                "identificador" => $idPedido[0]->idPedido
            ]);
        }
    }

    public function agregarNota(Request $datos){
        if($datos->ajax()){
            
            $nota=DB::Select('call spInsPedidoNota(?,?,?)', array(
                            $datos->input('idPedido'),
                            $datos->input('nota'),
                            Session::get('idUsuario')
                            ) 
                        );  

            return $nota;
        }
    }

    public function eliminarNota(Request $datos){
        if($datos->ajax()){
            $nota=DB::Select('call spDelPedidoNota(?)', array(
                            $datos->input('idNota')
                            ) 
                        );  
            return $nota;
        }
    }


    public function guardarDatosProgramacion(Request $datos){
        if($datos->ajax()){

            $detalle=$datos->input('detalle');
            $detalle= json_decode($detalle);           
            foreach ( $detalle as $item){
                DB::Select("call spUpdPedidoProgramacion(?,?,?,?,?,?,?,?,?,?,?,?,?)", array( $datos->input('idPedido'),
                    $item->prod_codigo, 
                    $item->idEmpresaTransporte, 
                    $item->idCamion, 
                    $item->idConductor, 
                    $item->fechaCarga, 
                    $item->horaCarga,
                    $item->peso,
                    Session::get('idUsuario'),
                    $item->nombreEmpresaTransporte,
                    $item->patente,
                    $item->nombreConductor,
                    $item->idPlanta
                ) 
            );
            }

            return response()->json([
                "identificador" =>  $datos->input('idPedido')
            ]);
        } 

    }

    public function bajarOCpedido($nombreArchivo){
        $pathtoFile = public_path().'/ocompra/pedido/'.$nombreArchivo;
        return response()->download($pathtoFile);        
    }

    function subirOCpedido(Request $datos){
        if($datos->ajax()){
              
            $archivo=$datos->file("upload-demo");
            $extension = $archivo->getClientOriginalExtension();
            $nombreArchivo= "OC".$datos->input('idPedido').".".$extension;
            if( File::exists(public_path('ocompra/pedido/'."OC".$datos->input('idPedido').'.*'))){
                File::delete(public_path('ocompra/pedido/'."OC".$datos->input('idPedido').'.*'));
            }            
            Storage::disk('ocpedido')->put($nombreArchivo, \File::get( $archivo) );
            $pd = Pedido::find($datos->input('idPedido'));
            $pd->nombreArchivoOC = $nombreArchivo;
            $pd->save();            
            return response()->json([
                "nombreArchivo" => $nombreArchivo
            ]);            
        }
    }


    public function avisoPedidoAprobado($idPedido){
        $pedido= DB::Select('call spGetPedido(?)', array( $idPedido ));
        $destinatarios= DB::Select('call spGetListaDestinatarios(?)', array( 'P' ));        
        Mail::to($destinatarios)->send(new PedidoAprobado($pedido) );
        return;
    }

    public function verResumenGranel(){  
        $plantas=DB::Select('call spGetUsuarioPerfilPlantas(?,?)', array( Session::get('idUsuario'), Session::get('idPerfil') ));
        return view("resumenGranel")->with('plantas', $plantas);
    }

    public function resumenGranel(Request $datos){
        if($datos->ajax()){    
            $resumen= DB::Select('call spGetResumenGranel(?,?,?,?,?,?)', array( $datos->input('idPlanta'), $datos->input('fechaInicio'), $datos->input('fechaTermino'), $datos->input('incluirSinFecha'), Session::get('idUsuario'), Session::get('idPerfil') ));
            return $resumen;
        }    
    }

    public function verPedidosDespachados(){  
        $plantas=DB::Select('call spGetUsuarioPerfilPlantas(?,?)', array( Session::get('idUsuario'), Session::get('idPerfil') ));
        return view("pedidosDespachados")->with('plantas', $plantas);
    }

    public function obtenerPedidosDespachados(Request $datos){
        if($datos->ajax()){    
            $resumen= DB::Select('call spGetPedidosDespachados(?,?,?,?,?)', array( $datos->input('idPlanta'), $datos->input('fechaInicio'), $datos->input('fechaTermino'), Session::get('idUsuario'), Session::get('idPerfil')  ));
            return $resumen;
        }    
    }

    public function actualizarNumeroAuxiliar(Request $datos){
        if($datos->ajax()){
             DB::Select('call spUpdNumeroAuxiliar(?,?)', array($datos->input('idPedido'), $datos->input('numeroAuxiliar')) );
             return;
        }
    }


}
