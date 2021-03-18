<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    public function despachosPorMes(){
        $plantas=DB::table('plantas')->select('idPlanta', 'nombre')->orderBy('nombre','asc')->get();
        return view('informes.despachosporMes')->with('plantas', $plantas);
    }

    public function obtenerDespachosPorMes(Request $datos){
        $despachos=DB::Select('call spGetProductosDespachadosPorMes(?,?,?,?)', array(
                        $datos->input('mesInicio'),
                        $datos->input('mesTermino'),
                        $datos->input('unidad'),
                        $datos->input('idPlanta')
                        ) 
                    );
        foreach ($despachos as $d) {
           $d->TotalDespachado=floatval($d->TotalDespachado);
           $d->TotalDespachado2=floatval($d->TotalDespachado2);
        }        
        return $despachos;        
    }

    public function despachosPorAno(){
        $plantas=DB::table('plantas')->select('idPlanta', 'nombre')->get();
        return view('informes.despachosporAno')->with('plantas', $plantas);
    }

    public function obtenerDespachosPorAno(Request $datos){
        $despachos=DB::Select('call spGetProductosDespachadosPorAno(?,?,?,?)', array(
                        $datos->input('anoInicio'),
                        $datos->input('anoTermino'),
                        $datos->input('unidad'),
                        $datos->input('idPlanta')
                        ) 
                    );
        foreach ($despachos as $d) {
           $d->TotalDespachado=floatval($d->TotalDespachado);
           $d->TotalDespachado2=floatval($d->TotalDespachado2);
        }

        return $despachos;        
    }

    public function notasdeVentaMargenes(){
        return view('informes.notasdeventaMargenes');
    }

    public function obtenerNotasdeVentaMargenes(){
        $notas=DB::Select('call spGetNotasdeVentasMargenes()');
        foreach ($notas as $d) {
           $d->saldo=floatval($d->saldo);
        }        
        return $notas;     
    }


}