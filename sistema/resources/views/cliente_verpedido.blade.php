@extends('plantilla')      

@section('contenedorprincipal')

<div style="padding: 5px">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <h5><b>Pedido Nº {{ $pedido[0]->idPedido }}</b></h5>
        </div>
        <div class="padding-md clearfix">
        	<div>
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
        		<div class="row" style="padding-top: 5px">
        			<div class="col-sm-2 col-md-2 col-lg-1">
        				Cliente
        			</div>
         			<div class="col-sm-5 col-md-4 col-lg-3">
        				<input class="form-control input-sm" readonly value="{{ $pedido[0]->emp_nombre }}">
        			</div>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        Fecha Creación
                    </div>
                    <div class="col-sm-3 col-md-2 col-lg-2">
                        <input class="form-control input-sm" readonly value="{{ $pedido[0]->fechahora_creacion }}">
                    </div> 
                    <div class="col-sm-2 col-md-2 col-lg-1">
                        N.Venta Nº
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        @if ($accion == 4)
                            <a href="{{ asset('/') }}vernotaventa/{{ $pedido[0]->idNotaVenta }}-{{ $pedido[0]->idPedido }}/2/" class="btn btn-xs btn-info disabled">{{ $pedido[0]->idNotaVenta }}</a>
                        @else
                            <a href="{{ asset('/') }}vernotaventa/{{ $pedido[0]->idNotaVenta }}-{{ $pedido[0]->idPedido }}/2/" class="btn btn-xs btn-info">{{ $pedido[0]->idNotaVenta }}</a>
                        @endif
                    </div>                          			
        		</div>
        		<div class="row" style="padding-top: 5px">
                    <div class="col-sm-2 col-md-1 col-lg-1">
                        Obra
                    </div>
                    <div class="col-sm-4 col-md-5 col-lg-5">
                        <input class="form-control input-sm" readonly value="{{ $pedido[0]->Obra }}">
                    </div>                      
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        Fecha Entrega
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <input class="form-control input-sm" readonly value="{{ $pedido[0]->fechaEntrega }}">
                    </div>                    
        			<div class="col-sm-1 col-md-1 col-lg-1">
        				Horario
        			</div>
         			<div class="col-sm-1 col-md-2 col-lg-1">
        				<input class="form-control input-sm" readonly style="width: 40px" value="{{ $pedido[0]->horarioEntrega }}">
        			</div>      			
        		</div>
        		<div class="row" style="padding-top: 5px">
        			<div class="col-sm-2 col-md-1 col-lg-1">
        				Estado
        			</div>
         			<div class="col-sm-4 col-md-2 col-lg-2">
        				<input class="form-control input-sm" readonly value="{{ $pedido[0]->estado }}">
        			</div>
                    <div class="col-lg-1 col-md-1 col-sm-2">
                        Ejecutivo&nbspQL
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <input class="form-control input-sm" readonly value="{{ $pedido[0]->usuario_encargado }}">
                    </div>                              			     			
        		</div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-sm-2 col-md-2 col-lg-1">
                        Observaciones
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <input class="form-control input-sm" readonly value="{{ $pedido[0]->observaciones }}">
                    </div>
                    @if ($pedido[0]->noExcederCantidadSolicitada==1)
                        <div class="col-sm-5 col-md-5 col-lg-4">
                            <h4><span class="label label-danger">NO EXCEDER LA CANTIDAD SOLICITADA</span></h4>
                        </div>
                    @endif                     
                </div>                      		  		
        	</div>

        </div>
        <div style="padding: 20px">
            <table id="tablaDetalle" class="table table-hover table-condensed table-responsive">
                <thead>
                    <th style="display: none">Codigo</th>
                    <th>Producto</th>
                    <th style="width: 80px">Diseño</th>
                    <th style="width: 50px">Cant.</th>
                    <th>Unidad</th>                
                    <th>Precio ($) *</th>
                    <th>Total ($) **</th>
                    <th>Planta de Origen</th>
                    <th>Entrega</th>
                    <th>Transporte</th>
                    <th>Camion</th>
                    <th>Conductor</th>
                    <th style="text-align: center;">Fecha Hora Carga<br>Programada</th>
                </thead>
            
                <tbody>
                    @foreach($listaDetallePedido as $item)
                    <tr>
                        <td style="display: none"> 
                            {{ $item->prod_codigo }}                         
                        </td>
                        <td>
                            {{ $item->prod_nombre }}
                            @if ( $item->certificado==1 )  
                                <a target="_blank" href="{{ asset('/') }}bajarCertificado/{{ $item->certificado }}">
                                    <img src="{{ asset('/') }}img/iconos/certificado.png" border="0">
                                </a>
                            @endif
                            @if ($item->modificado>0)
                                <span class="badge badge-primary" title="Nº de modificaciones">{{$item->modificado}}</span>
                            @endif                                            
                            @if ($item->tipoTransporte==2)
                                <span class="badge badge-danger" title="Pedido Mixto">M</span>
                            @endif                            
                            @if ( $item->formula!='' )
                                <span><img src="{{ asset('/') }}img/iconos/matraz.png" border="0" title="{{ $item->formula }}" width="15px" height="15pxs"></span>
                            @endif                            
                            @if ( $item->cantidadReal > 0 )
                                <span><img src="{{ asset('/') }}img/iconos/cargacompleta.png" border="0"></span>
                            @endif
                            @if ( $item->horaCarga!='' )
                                <span><img src="{{ asset('/') }}img/iconos/time.png" border="0" title="{{$item->fechaCarga_dma}} {{$item->horaCarga}}"></span>
                            @endif
                            @if ( $item->nombreEmpresaTransporte!='' )
                                <span><img src="{{ asset('/') }}img/iconos/user.png" border="0" title="{{$item->nombreEmpresaTransporte}} / {{$item->apellidoConductor}}"></span>
                            @endif                            
                            @if( $item->numeroGuia>0 )
                                <span onclick='abrirGuia(1, {{ $item->numeroGuia }}, this.parentNode.parentNode);' style="cursor:pointer; cursor: hand"><img src="{{ asset('/') }}img/iconos/guiaDespacho2.png" border="0"></span>                               
                            @endif 
                            @if ( $item->salida==1 )
                                <span><img src="{{ asset('/') }}img/iconos/enTransporte.png" border="0" onclick="verUbicacionGmaps('{{ $item->patente }}');" style="cursor:pointer; cursor: hand"></span>                                      
                            @endif                             
                        </td>
                        <td>{{ $item->formula }}</td>
                        <td style="width:50px">{{ $item->cantidad }}</td>   
                        <td> {{ $item->u_nombre }} </td>
                        @if( Session::get('grupoUsuario')=='C' or Session::get('grupoUsuario')=='CL' )   
                            <td align="right">{{ number_format( $item->cp_precio, 0, ',', '.' ) }}</td>
                            <td align="right">{{ number_format( $item->cp_precio * $item->cantidad , 0, ',', '.' ) }}</td>
                        @endif    
                        <td> {{ $item->nombrePlanta }} </td>
                        <td> {{ $item->nombreFormaEntrega }} </td>
                        <td> {{ $item->nombreEmpresaTransporte }} </td>
                        <td> {{ $item->patente }} </td>
                        <td> {{ $item->nombreConductor }} </td>
                        <td> {{ $item->fechaCarga }} {{ $item->horaCarga }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot> 
                    @if($pedido[0]->cantidadFleteFalso>0)
                        <tr>
                            <td>Flete Falso</td>
                            <td></td>
                            <td>{{$pedido[0]->cantidadFleteFalso}}</td>
                            <td>tonelada</td>
                            <td align="right">{{ number_format($pedido[0]->valorFleteFalso, 0, ',', '.' )}}</td>
                            <td align="right">{{ number_format( $pedido[0]->valorFleteFalso*$pedido[0]->cantidadFleteFalso, 0, ',', '.' ) }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>           
                        </tr>
                    @endif                       
                    @if( Session::get('idPerfil')=='14' || Session::get('idPerfil')=='15' )   
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="right"><b>Neto $</b></td>
                            <td align="right"><b>{{ number_format( $pedido[0]->totalNeto, 0, ',', '.' ) }} </b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="right"><b>Iva $</b></td>
                            <td align="right"><b>{{ number_format( $pedido[0]->montoIva, 0, ',', '.' ) }} </b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="right"><b>Total $</b></td>
                            <td align="right"><b>{{ number_format( $pedido[0]->totalNeto + $pedido[0]->montoIva, 0, ',', '.' ) }} </b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr> 
                    @endif                     
                </tfoot>
            </table>
            <br>
            <b>*</b> Precio indicado es el reajustado a la fecha de creación del pedido. Pueden existir diferencias con el precio final de facturación si el despacho se realiza en un mes distinto.<br>
            <b>**</b> El total facturado podrá ser distinto ya que se considerarán las cantidades efectivamente despachadas y los precios reajustados al mes durante el cual se realiza efectivamente el despacho.            
        </div> 

        <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
            @if ($accion == 7)
                <a href="{{ asset('/') }}clientePedidos/" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>  
            @else
                <a href="{{ URL::previous() }}" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
            @endif                             
        </div>        
    </div>
</div>

@endsection

@section('javascript')
    <!-- Datepicker -->
    <script src="{{ asset('/') }}js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('/') }}locales/bootstrap-datepicker.es.min.js"></script>  

    <!-- Timepicker -->
    <script src="{{ asset('/') }}js/bootstrap-timepicker.min.js"></script>  

    <script src="{{ asset('/') }}js/app/funciones.js"></script>
    <script src="{{ asset('/') }}js/app/verpedido.js"></script>
    <!-- Datatable -->
    <script src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // Datepicker      
            $('.date').datepicker({
                todayHighlight: true,
                format: "dd/mm/yyyy",
                weekStart: 1,
                language: "es",
                autoclose: true,
                startDate: '+0d'
            }) 
            cargarListas();
        });         
    </script>
       
@endsection