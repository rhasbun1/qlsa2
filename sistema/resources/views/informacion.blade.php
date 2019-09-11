<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Logística QLSA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/') }}bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Font Awesome -->
	<link href="{{ asset('/') }}css/font-awesome.min.css" rel="stylesheet">
	
	<!-- Pace -->
	<link href="{{ asset('/') }}css/pace.css" rel="stylesheet">
	
	<!-- Color box -->
	<link href="{{ asset('/') }}css/colorbox/colorbox.css" rel="stylesheet">
	
	<!-- Morris -->
	<link href="{{ asset('/') }}css/morris.css" rel="stylesheet"/>	
	<!-- Perfect -->
	<link href="{{ asset('/') }}css/app.min.css" rel="stylesheet">
	<link href="{{ asset('/') }}css/app-skin.css" rel="stylesheet">

	<!-- Datepicker -->
	<link href="{{ asset('/') }}css/datepicker.css" rel="stylesheet"/>
	
	<!-- Timepicker -->
	<link href="{{ asset('/') }}css/bootstrap-timepicker.css" rel="stylesheet"/>
    <script type="text/javascript" src="{{ asset('/') }}js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/sweetalert.css">
   
	<!-- Datatable -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<link href="{{ asset('/') }}css/dataTables.min.css" rel="stylesheet">    
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
	<style>
		.dt-button.red {
	        color: red;
	    }
	 
	    .dt-button.orange {
	        color: orange;
	    }
	 
	    .dt-button.green {
	        color: green;
	    }   
	</style>	
	
  </head>
  <body>
  	<div style="background: #0A0909">
  		<span><img src="{{ asset('/') }}img/logo02.png" border="0" width="50%" height="50%"></span>
  	</div>
  	<div class="row" style="padding: 5px"> 
  		<div class="col-sm-12 col-md-3 col-lg-2">
	        <select id="idPlanta" name="idPlanta" class="selectpicker" data-live-search="true" data-width="100%" onchange="selPlanta();">
	        	<option value="0">Todas las Plantas</option>
	            @foreach($plantas as $item)
	               @if($idPlanta==$item->idPlanta)
	               		<option value="{{ $item->idPlanta }}" selected>{{ $item->nombre }}</option>
					@else
						<option value="{{ $item->idPlanta }}">{{ $item->nombre }}</option>
					@endif
	            @endforeach                             
	        </select>
	    </div>
  	</div>
	<div class="row" style="padding: 5px"> 
		<div class="col-sm-6 col-md-3">
			<div class="panel-stat3 bg-info">
				@foreach($datos as $item)
				<div>
					<table>
						<tr>
							<td style="width: 60px">
								<h3 style="display: inline;"  class="m-top-none"><span id="serverloadCount" style="width: 100px">{{ $item->contador }}</span></h3>
							</td>
							<td>
								<h5 style="display: inline">{{ $item->nombreEstado }}</h5>
							</td>
						</tr>
					</table>
				</div>
				@endforeach
			</div>
		</div>
	</div>
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
			                @if ( $item->cantidadReal>0 )
			                    <span><img src="{{ asset('/') }}img/iconos/cargacompleta.png" border="0"></span>
			                @endif
			                @if ( $item->numeroGuia>0 )
			                	<a href="{{ asset('/') }}bajarGuiaDespacho/{{ $item->numeroGuia }}">
			                    	<span><img src="{{ asset('/') }}img/iconos/guiaDespacho2.png" border="0"></span>
			                	</a>
			                @endif
			                @if ( $item->certificado!='' )  
			                    <a href="{{ asset('/') }}bajarCertificado/{{ $item->certificado }}">
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

  </body>
  </html>

      <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	
	<!-- Jquery -->

	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

	<!-- Bootstrap -->
    <script src="{{ asset('/') }}bootstrap/js/bootstrap.js"></script>
   
	<!-- Flot -->
	<script src="{{ asset('/') }}js/jquery.flot.min.js"></script>
   
	<!-- Morris -->
	<script src="{{ asset('/') }}js/rapheal.min.js"></script>	
	<script src="{{ asset('/') }}js/morris.min.js"></script>	
	
	<!-- Colorbox -->
	<script src="{{ asset('/') }}js/jquery.colorbox.min.js"></script>	

	<!-- Sparkline -->
	<script src="{{ asset('/') }}js/jquery.sparkline.min.js"></script>
	
	<!-- Pace -->
	<script src="{{ asset('/') }}js/uncompressed/pace.js"></script>
	
	<!-- Popup Overlay -->
	<script src="{{ asset('/') }}js/jquery.popupoverlay.min.js"></script>
	
	<!-- Slimscroll -->
	<script src="{{ asset('/') }}js/jquery.slimscroll.min.js"></script>
	
	<!-- Modernizr -->
	<script src="{{ asset('/') }}js/modernizr.min.js"></script>
	
	<!-- Cookie -->
	<script src="{{ asset('/') }}js/jquery.cookie.min.js"></script>


	<script src="{{ asset('/') }}js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
	<script src="{{ asset('/') }}js/buttons.html5.min.js"></script>	

    <!-- bootstrap-select -->
    <link rel="stylesheet" href="{{ asset('/') }}css/bootstrap-select/bootstrap-select.min.css">
    <script src="{{ asset('/') }}js/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="{{ asset('/') }}js/bootstrap-select/i18n/defaults-es_ES.min.js"></script>

    <script>
    	function selPlanta(){
    		location.href="{{ asset('/') }}/informacion/"+$("#idPlanta").val()+"/";
    	}	

    </script>