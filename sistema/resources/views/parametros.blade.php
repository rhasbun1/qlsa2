@extends('plantilla')      

@section('contenedorprincipal')
	<div class="padding-md">
		<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
		<div style="padding:20px">
			<div class="row" style="padding:3px">
				<div class="col-md-2">
					Correlativo Guía Despacho
				</div>
				<div class="col-md-2 col-lg-1">
					<input class="form-control input-sm" type="number" id="correlativoGuias" value="{{ $param[0]->numeroGuia }}">
				</div>
			</div>
			<div class="row" style="padding:3px">
				<div class="col-md-2">
					IVA
				</div>
				<div class="col-md-1">
					<input class="form-control input-sm" type="number" id="iva" value="{{ $param[0]->iva }}">
				</div>
			</div>		
			<div class="row" style="padding:3px">
				<div class="col-md-2">
					Carga Máx. Granel, Tipo Transporte Normal
				</div>
				<div class="col-md-1">
					<input class="form-control input-sm" type="number" id="cmgttn" value="{{ $param[0]->carga_max_granel_tte_normal }}">
				</div>
			</div>
			<div class="row" style="padding:3px">
				<div class="col-md-2">
					Carga Máx. Granel, Tipo Transporte Mixto 1
				</div>
				<div class="col-md-1">
					<input class="form-control input-sm" type="number" id="cmgttm1" value="{{ $param[0]->carga_max_granel_tte_mixto_1 }}">
				</div>
			</div>
			<div class="row" style="padding:3px">
				<div class="col-md-2">
					Carga Máx. Granel, Tipo Transporte Mixto 2
				</div>
				<div class="col-md-1">
					<input class="form-control input-sm" type="number" id="cmgttm2" value="{{ $param[0]->carga_max_granel_tte_mixto_2 }}">
				</div>
			</div>			
			<br>
			<B>NOTAS INFORMATIVAS EN PANTALLA DE PEDIDO</B>			
			<div class="row" style="padding:3px">
				<div class="col-md-2">
					Nota 1 
				</div>
				<div class="col-md-8">
					<textarea class="form-control input-sm" id="notaPedido1" rows="3">{{ $param[0]->notaPedido1 }}</textarea>					
				</div>
			</div>	
			<div class="row" style="padding:3px">
				<div class="col-md-2">
					Nota 2 
				</div>
				<div class="col-md-8">
					<textarea class="form-control input-sm" id="notaPedido2" rows="3">{{ $param[0]->notaPedido2 }}</textarea>
				</div>
			</div>
			<div class="row" style="padding:3px">
				<div class="col-md-2">
					Consideraciones para Pedidos a granel 
				</div>
				<div class="col-md-8">
					<textarea class="form-control input-sm" id="consideracionesPedidosGranel" rows="10">{{ $param[0]->consideracionesPedidosGranel }}</textarea>
				</div>
			</div>			
			<br>
			<B>ACCESO WEBSERVICE SITRACK</B>
			<div class="row" style="padding:3px">
				<div class="col-md-2">
					Usuario
				</div>
				<div class="col-md-3">
					<input class="form-control input-sm" id="usuarioSitrack" value="{{ $param[0]->sitrack_usuario }}">
				</div>
			</div>
			<div class="row" style="padding:3px">
				<div class="col-md-2">
					Contraseña
				</div>
				<div class="col-md-2">
					<input class="form-control input-sm" id="contrasenaSitrack" value="{{ $param[0]->sitrack_contrasena }}">
				</div>				
			</div>
			<br>
			<B>NOTAS DE VENTAS</B>
			<div class="row" style="padding:3px">
				<div class="col-md-3">
					Tope de días para aprobación automática
				</div>
				<div class="col-md-2">
					<input class="form-control input-sm" type="number" id="antiguedadDias" value="{{ $param[0]->antiguedad_dias }}">
				</div>
			</div>
			<div class="row" style="padding:3px">
				<div class="col-md-3">
					Monto Tope para aprobación automática
				</div>
				<div class="col-md-2">
					<input class="form-control input-sm" type="number" id="montoTopeNV" value="{{ $param[0]->monto_TopeNV }}">
				</div>				
			</div>
			<br>
			<B>USUARIO ENCARGADO DE AUTORIZAR PEDIDOS</B>
			<div class="row" style="padding:3px">
				<div class="col-md-2">
					Usuario
				</div>
				<div class="col-md-3">
					<select id="usuarios" class="form-control input-sm">
                    @foreach($usuarios as $item)
                    	@if( $item->usu_codigo==$param[0]->idUsuarioAutoriza )
                        	<option value="{{ $item->usu_codigo }}" selected>{{ $item->usu_nombre }} {{ $item->usu_apellido }}</option>
                        @else
                        	<option value="{{ $item->usu_codigo }}">{{ $item->usu_nombre }} {{ $item->usu_apellido }}</option>
                        @endif	
                    @endforeach    
                    </select>					
				</div>
			</div>			
			<br>			
			<br>
			<button id="grabar" class="btn btn-sm btn-success" onclick="grabarParametros();">Grabar Cambios</button>
		</div>
	</div><!-- /.padding-md -->
@endsection


@section('javascript')
<script src="{{ asset('/') }}js/app/funciones.js"></script>


<script>
	function grabarParametros(){
			var idUsuario;

			if(usuarios.selectedIndex<0){
				idUsuario=0;
			}else{
				idUsuario=$("#usuarios").val();
			}

	        $.ajax({
	            url: urlApp + "grabarParametros",
	            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
	            type: 'POST',
	            dataType: 'json',
	            data: { 
	            		iva: $("#iva").val(),
	                    numeroGuia: $("#correlativoGuias").val(),
	                    cmgttn: $("#cmgttn").val(),
	                    cmgttm1: $("#cmgttm1").val(),
	                    cmgttm2: $("#cmgttm2").val(),
	                    notaPedido1: $("#notaPedido1").text(),
	                    notaPedido2: $("#notaPedido2").text(),
	                    sitrack_usuario: $("#usuarioSitrack").val(),
	                    sitrack_contrasena: $("#contrasenaSitrack").val(),
	                    antiguedad_dias: $("#antiguedadDias").val(),
	                    monto_TopeNV: $("#montoTopeNV").val(),
	                    consideracionesPedidosGranel: $("#consideracionesPedidosGranel").val(),
	                    idUsuarioAutoriza: idUsuario
	                  },
	            success:function(dato){

		            swal(
		                {
		                    title: "Los parámetros han sido actualizados",
		                    text: '',
		                    type: 'warning',
		                    showCancelButton: false,
		                    confirmButtonText: 'OK',
		                    cancelButtonText: '',
		                    closeOnConfirm: true,
		                    closeOnCancel: false
		                },
		                function(isConfirm)
		                {       
		                	return;
			            }       
		            ) 	                
	            }
	        })                


	}

</script>

@endsection
