<?php

namespace App\Http\Controllers;

use App\Cotizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function datosCotizacion(Request $datos){
        if( $datos->ajax() ){
            // 

            return DB::Select('call spGetCotizacion(?,?)', array( $datos->input('idCotizacion'), $datos->input('ano') ) ); 
        }
     
    }

    public function cotizacionProductos(Request $datos){
        if( $datos->ajax() ){
           /* $resultado = DB::table('cotizaciones_productos')
                        ->join('productos','productos.prod_codigo', '=', 'cotizaciones_productos.prod_codigo')
                        ->join('unidades', 'unidades.u_codigo', '=', 'cotizaciones_productos.u_codigo' )
                        ->select('cotizaciones_productos.prod_codigo', 'cotizaciones_productos.cp_glosa_reajuste', 'productos.prod_nombre', 'unidades.u_nombre', 'cotizaciones_productos.cp_cantidad', 'cotizaciones_productos.cp_precio', 'productos.requiere_diseno', 'cotizaciones_productos.cp_costo_flete', 'cotizaciones_productos.cp_varios')
                        ->where('cotizaciones_productos.cot_codigo', $datos->input('prod_codigo') )
                        ->where('cotizaciones_productos.cot_ano', $datos->input('ano') )
                        ->get();*/

            $resultado=DB::Select('call spGetCotizacionDetalle(?,?)', array( $datos->input('idCotizacion'), $datos->input('ano') ) );     
            return $resultado;
        }    
    }      

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function show(Cotizacion $cotizacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Cotizacion $cotizacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cotizacion $cotizacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cotizacion $cotizacion)
    {
        //
    }
}
