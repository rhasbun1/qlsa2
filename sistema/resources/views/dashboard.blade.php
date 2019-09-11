@extends('plantilla')      

@section('contenedorprincipal')
 <!--   <div style="padding-left: 20px">
		<h4>Hola {{ $nombreUsuario }}!</h4>
	</div>-->
@if ( Session::get('grupoUsuario')!='CL' and Session::get('idPerfil')!='6' and Session::get('idPerfil')!='9' )	
	<div class="padding-md">
		<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
		@if(Session::get('grupoUsuario')!='CL')
			<div class="row">
				<div class="col-sm-6 col-md-3">
					<a href="{{ asset('/') }}listarNotasdeVenta">
						<div class="panel-stat3 bg-danger">
							<h2 class="m-top-none" id="userCount">{{ $datos[0]->nvSinAprobar }}</h2>
							<h5>Notas de Venta sin Aprobar</h5>
						</div>
					</a>
				</div><!-- /.col -->
				<div class="col-sm-6 col-md-3">
					@if(Session::get('grupoUsuario')=='PL')
						<a href="{{ asset('/') }}programacion">
					@else
						<a href="{{ asset('/') }}listarPedidos">
					@endif		
						<div class="panel-stat3 bg-info">
							<h2 class="m-top-none"><span id="serverloadCount">{{ $datos[0]->pedidosEnProceso }}</span></h2>
							<h5>Pedidos en Proceso</h5>
						</div>
					</a>
				</div><!-- /.col -->
				<div class="col-sm-6 col-md-3">
					<div class="panel-stat3 bg-warning">
						<h2 class="m-top-none" id="orderCount">0</h2>
						<h5>Pedidos Despachados</h5>
					</div>
				</div><!-- /.col -->
				<div class="col-sm-6 col-md-3">
					<a href="{{ asset('/') }}programacion">
						<div class="panel-stat3 bg-success">
							<h2 class="m-top-none" id="visitorCount">{{ $datos[0]->pedidosEnProcesoSinTransporte }}</h2>
							<h5>Pedidos Sin Transporte Asignado</h5>
						</div>
					</a>
				</div><!-- /.col -->
			</div>
		@endif
		<div class="row" id="kanvas">
			<?php $numpedido = 0; ?>
			<?php $inicio = true; ?>
			@foreach($pedidos as $item)
				@if( $item->idEstadoPedido!='1' and $item->idEstadoPedido!='6' )
					@if( $numpedido!=$item->idPedido )
					    @if( !$inicio )
					    	</div>
					        </div>
					    @endif
					    <div class="col-md-4 col-sm-4 col-xs-12 col-lg-3">
						<div class="panel panel-body">
							<h4 style="display: inline"><b>Pedido Nº {{ $item->idPedido}}</b></h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     
							<h6 style="display: inline;">(h/t)&nbsp;{{ $item->horasTranscurridas}}</h6>
						<?php $inicio = false; ?>	
						<?php $numpedido = $item->idPedido; ?>	
					@endif
					<div style="padding-top:3px;padding-left: 5px;padding-right: 5px">
						<div class="row" style="border: 1px solid;border-color: #EBEDEF">	
							<div class="col-sm-5 col-xs-5" style="padding-top: 7px">	
								<span>{{ $item->prod_nombre }}</span>
							</div>
							<div class="col-sm-7 col-xs-7">	
				                @if ( $item->horaCarga!='' )
				                    <span><img src="{{ asset('/') }}img/iconos/time.png" border="0" title="{{$item->fechaCarga_dma}} {{$item->horaCarga}}"></span>
				                @endif
				                @if ( $item->empresaTransporte!='' )
				                    <span><img src="{{ asset('/') }}img/iconos/user.png" border="0" title="{{$item->empresaTransporte}} / {{$item->apellidoConductor}}"></span>
				                @endif					                						
				                @if ( $item->cantidadReal>0 )
				                    <span><img src="{{ asset('/') }}img/iconos/cargacompleta.png" border="0"></span>
				                @endif
				                @if ( $item->numeroGuia>0 )
				                	<a target="_blank" href="{{ asset('/') }}bajarGuiaDespacho/{{ $item->numeroGuia }}">
				                    	<span><img src="{{ asset('/') }}img/iconos/guiaDespacho2.png" border="0"></span>
				                	</a>
				                @endif
				                @if ( $item->certificado!='' )  
				                    <a target="_blank" href="{{ asset('/') }}bajarCertificado/{{ $item->certificado }}">
				                        <img src="{{ asset('/') }}img/iconos/certificado.png" border="0">
				                    </a>
				                @endif
	                            @if ( $item->salida==1 )
	                            <span><img src="{{ asset('/') }}img/iconos/enTransporte.png" border="0" onclick="verUbicacionGmaps('{{ $item->Patente }}');" style="cursor:pointer; cursor: hand"></span>                                      
	                            @endif 
				            </div>
			        	</div>
		            </div>
	            @endif		
			@endforeach
		</div>


	</div><!-- /.padding-md -->

@endif
	
@endsection


@section('javascript')
<script src="{{ asset('/') }}js/app/funciones.js"></script>
@endsection
