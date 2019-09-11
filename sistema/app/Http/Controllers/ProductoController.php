<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Productolistaprecio;
use App\Unidad;
use App\Planta;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    //

    public function listaProductos()
    {
        //
        $listaProductos=DB::Select('call spGetProductosPrecios()' );
        $unidades=Unidad::All();
        $plantas=Planta::All();

        return view('productos')->with('listaProductos', $listaProductos)->with('unidades', $unidades)->with('plantas', $plantas);
    }

    public function guardarDatosProducto(Request $datos){
        if($datos->ajax()){
            $producto=DB::Select('call spUpdProducto(?,?,?,?,?,?)', array(
                            $datos->input('prod_codigo'),
                            $datos->input('nombre'),
                            $datos->input('descripcion'),
                            $datos->input('precioReferencia'),
                            $datos->input('requiereDiseno'),
                            $datos->input('codigoSoftland')
                            ) 
                        );  

            return response()->json([
                "identificador" =>  $producto[0]->prod_codigo
            ]);
        }   
    }

    public function productosCodigosSoftland(){

            $productosCodigosSoftland=Productolistaprecio::All();
            return response()->json($productosCodigosSoftland);   

    }

    public function guardarDatosProductoListaPrecio(Request $datos){
        if($datos->ajax()){
            $respuesta=DB::Select('call spInsProductoListaPrecio(?,?,?,?,?,?,?,?,?,?)', array(
                            $datos->input('idProductoListaPrecios'),
                            $datos->input('nombreProducto'),
                            $datos->input('unidad'),
                            $datos->input('idPlanta'),
                            $datos->input('costo'),
                            $datos->input('precioReferencia'), 
                            $datos->input('codigoSoftland'),
                            $datos->input('requiereDiseno'),
                            $datos->input('granel'),
                            $datos->input('solicitaCertificado')
                            ) 
                        );  

            return response()->json($respuesta);
        }         
    }

    public function eliminarProductoListaPrecio(Request $datos){
        if($datos->ajax()){
            $respuesta=DB::Select('call spDelProductoListaPrecio(?)', array($datos->input('idProductoListaPrecios') ) );
            return response()->json($respuesta);
        }
    }

}    
