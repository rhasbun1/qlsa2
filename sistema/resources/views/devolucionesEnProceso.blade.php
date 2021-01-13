@extends('plantilla')      

@section('contenedorprincipal')

<div class="panel-body">
	<div id="divSelDevolucion" style="display: block;">
		<div>
			<h3>Devoluciones en proceso</h3>
		</div>
		<div>

			<button class="btn btn-sm btn-primary" onclick="abrirIngresoOrdenDevolucion();">Nueva Orden de Devolución</button>
			<button class="btn btn-sm btn-primary" onclick="verHistorico();">Devoluciones Históricas</button>

			<button class="btn btn-sm btn-primary" onclick="abrirRegistrarDevoluciondeSaldo();">Reg. devolución saldo granel</button>

		</div>

	    <div class="panel panel-default" id="contenedor3">
	        <div class="panel-heading">
	            <div class="panel-tab clearfix">
	                <ul class="tab-bar">
	                    <li class="active"><a href="#tabDevolucionesPorRecibir" data-toggle="tab"><b>Por recibir</b></a></li>
                        <li><a href="#tabDevolucionesDtePendiente" data-toggle="tab"><b>Recibidas con DTE pendiente</b></a></li> 
	                </ul>
	            </div>
	        </div> 			
            <div class="tab-content clearfix">
                <div class="tab-pane active" id="tabDevolucionesPorRecibir" style="padding-top: 5px;">			
				    <table id="tablaDevPorRecibir" class="table table-condensed" style="width: 100%">
				        <thead>
				        	@if ($tipo==2)
				        		<th style="width:80px">Seleccionar</th>
					            <th style="width:80px">Nº Dev.</th>
					            <th style="width:120px">Fecha de devolución</th>
					            <th style="width:100px">Nº Guía</th>
					            <th style="width:100px">Nº Pedido</th>				            
					            <th style="width:250px">Cliente</th>
					            <th style="width:250px">Obra/Planta</th>
					            <th style="width:80px">Producto</th>
					            <th style="width:80px">Unidad</th>
					            <th style="width:80px">Diseño</th> 
					            <th style="width:80px">Cantidad Informada<br>por devolver</th>
					            <th style="width:80px">Planta Dev.</th>
					            <th style="width:80px">Control de <br>Calidad</th>
							@else
					            <th style="width:80px">Nº Dev.</th>
					            <th style="width:120px">Fecha de devolución</th>
					            <th style="width:100px">Nº Guía</th>
					            <th style="width:100px">Nº Pedido</th>				            
					            <th style="width:250px">Cliente</th>
					            <th style="width:250px">Obra/Planta</th>
					            <th style="width:80px">Producto</th>
					            <th style="width:80px">Cantidad Informada<br>por devolver</th>
					            <th style="width:80px">Unidad</th>
					            <th style="width:80px">Planta Dev.</th>
					            <th style="width:80px">Control de <br>Calidad</th>							
							@endif
				        </thead>
				        <tbody>
				        	@if ($tipo==2)
				        		<tr>
				        		
				        			<td style="width:80px"><button class="btn btn-sm btn-success" onclick="registrarDevolucion();">Registrar</button></td>
					        		<td style="width:80px"><button onclick="verDevolucion();" title="Ver devolución">1</button></td>
					        		<td style="width:120px">01/01/2020</td>
					        		<td style="width:100px">100</td>
					        		<td style="width:100px">115</td>
					        		<td style="width:250px">Nombre Cliente</td>
					        		<td style="width:250px">Coquimbo Carretera Nueva</td>
					        		<td style="width:80px">CRS-2 E</td>
					        		<td style="width:80px">Ton</td>
					        		<td style="width:80px"></td>
					        		<td style="width:80px">40</td>
					        		<td style="width:80px">Viña</td>
					        		<td style="width:80px">Pendiente</td>
				        		
				        		</tr>
				        	@endif	
				        </tbody>
					</table>
					<div>
						<button class="btn btn-sm btn-warning" onclick="cerrarEmitirFactura();" style="width: 100px">Atrás</button>
					</div>					
				</div>
				<div class="tab-pane" id="tabDevolucionesDtePendiente" style="padding-top: 5px;">	
				    <table id="tablaDevDtePendiente" class="table table-condensed" style="width: 100%">
				        <thead>                      
				            <th style="width:80px">Nº Dev.</th>
				            <th style="width:120px">Fecha Orden Dev.</th>
				            <th style="width:80px">Nº Guía</th>
				            <th style="width:80px">Nº Pedido</th>
				            <th style="width:350px">Cliente</th>
				            <th style="width:350px">Obra/Planta</th>
				            <th style="width:150px">Producto</th>
				            <th style="width:150px">Unidad</th>
				            <th style="width:120px">Cantidad/Pesaje<br>informada por devolver</th>
				            <th style="width:120px">Cantidad/Pesaje<br>devuelta</th>
				            <th style="width:150px">Planta Dev.</th>
				            <th style="width:150px">Control de Calidad</th>
				            <th style="width:150px">Total Devolucion ($)</th>
				            <th style="width:150px">Flete a cobrar ($)</th>
				            <th style="width:150px">Nota de Crédito</th>
				            <th style="width:150px">Factura Flete</th>				            
				        </thead>
				        <tbody>
				        </tbody>
					</table>
					<div>
						<button class="btn btn-sm btn-warning" style="width: 100px">Atrás</button>
						<button class="btn btn-sm btn-success" onclick="gestionarFlete();" >Gestionar cobro de flete</button>
						<button class="btn btn-sm btn-info" >Emitir Nota de crédito</button>
						<button class="btn btn-sm btn-default" onclick="abrirModalDescartarNotadeCredito();" >Descartar Nota de crédito</button>
					</div>
					</div>					
				</div>			
		</div>

	</div>

	<div id="mdRegistrarDevolucion" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5><b>Ingrese Cantidad Recibida</b></h5>
            </div>
            <div class="modal-body">
            	<table id="tablaGuiasSeleccionadas" class="table table-condensed">
			        <thead>                      
			            <th style="width:80px">Producto</th>
			            <th style="width:80px">unidad</th>
			            <th style="width:80px">Cantidad/Pesaje<br>Despachado</th>
			            <th style="width:80px">Cantidad/Pesaje<br>informada por devolver</th>
			            <th style="width:80px">Cantidad/Pesaje<br>devuelto</th>
			        </thead>
			        <tbody>
			        	<tr>
			        		<td>CRS-2 E</td>
			        		<td>Ton</td>
			        		<td>20</td>
			        		<td>3</td>
			        		<td><input class="form-control input-sm"></td>
			        	</tr>
			        </tbody>
				</table>  
				<div style="padding-top: 20px">
					<h5>Calculadora</h5>
					<div class="row" style="padding-top: 10px">
						<div class="col-md-2">
							Pesaje de entrada
						</div>
						<div class="col-md-1">
							<input class="form-control input-sm">
						</div>

						<div class="col-md-2">
							Pesaje de salida
						</div>
						<div class="col-md-1">
							<input class="form-control input-sm">
						</div>

						<div class="col-md-2">
							Pesaje devolución
						</div>
						<div class="col-md-1">
							<input class="form-control input-sm">
						</div>												
					</div>
				</div>
				<div style="padding-top: 20px">
					<div class="row" style="padding-top: 10px">
						<div class="col-md-3">
							Subir Archivo de respaldo
						</div>
						<div class="col-md-6">
							<input class="form-control input-sm">
						</div>
						<div class="col-md-1">
							<button class="btn btn-success btn-sm">Buscar</button>
						</div>
					</div>
					<div class="row" style="padding-top: 10px">
						<div class="col-md-1">
							Observación
						</div>
						<div class="col-md-11">
							<input class="form-control input-sm">
						</div>
					</div>
				</div>          	

            </div>
            <div class="col-md-offset-9" style="padding-top: 20px; padding-bottom: 20px">
            	<button type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="" style="width: 80px">Registrar</button>
               	<button type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarRegistrarDevolucion();" style="width: 80px">Salir</button>
            </div>            
        </div>
    </div>
	</div>

	<div id="mdIngresoOrdenDevolucion" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	    <div class="modal-dialog modal-lg">
	    <!-- Modal content-->
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5><b>Ingreso de orden de devolución</b></h5>
	            </div>
	            <div class="modal-body">
	 
					<div style="padding-top: 20px">
						<div class="row" style="padding-top: 10px">
							<div class="col-md-2">
								Cliente
							</div>
							<div class="col-md-8">
								<input class="form-control input-sm">
							</div>
						</div>
						<div class="row" style="padding-top: 5px">
							<div class="col-md-2">
								Producto
							</div>
							<div class="col-md-8">
								<input class="form-control input-sm">
							</div>												
						</div>
						<div class="row">
							<div class="col-md-1">
								<button class="btn btn-success btn-sm">Buscar</button>
							</div>
						</div>
					</div>
					<div style="padding-top: 20px">
						<div class="row" style="padding-top: 10px">
							<div class="col-md-2">
								Nº Guia de Despacho
							</div>
							<div class="col-md-2">
								<input class="form-control input-sm">
							</div>
							<div class="col-md-1">
								<button class="btn btn-success btn-sm">Seleccionar</button>
							</div>
						</div>
						<div class="row" style="padding-top: 10px">
							<div class="col-md-2">
								Fecha de Despacho
							</div>
							<div class="col-md-2">
								<input class="form-control input-sm">
							</div>
							<div class="col-md-2">
								Planta QLSA origen
							</div>
							<div class="col-md-3">
								<input class="form-control input-sm">
							</div>						
						</div>
						<div class="row" style="padding-top: 10px">
							<div class="col-md-2">
								Obra/Planta
							</div>
							<div class="col-md-2">
								<input class="form-control input-sm">
							</div>
							<div class="col-md-2">
								Planta de devolución
							</div>
							<div class="col-md-3">
								<input class="form-control input-sm">
							</div>						
						</div>
						<div class="row" style="padding-top: 10px;padding-left: 10px; padding-right: 10px">
			            	<table id="tablaGuias" class="table table-condensed">
						        <thead>                      
						            <th style="width:80px">Devolver</th>
						            <th style="width:80px">Producto</th>
						            <th style="width:80px">Unidad</th>
						            <th style="width:80px">Cantidad/Pesaje<br>despachada</th>
						            <th style="width:80px">Cantidad/Pesaje<br>por devolver</th>
						        </thead>
						        <tbody>
						        	<tr>
						        		<td></td>
						        		<td>CRS-2 E</td>
						        		<td>Ton</td>
						        		<td>20</td>
						        		<td><input class="form-control input-sm"></td>
						        	</tr>
						        </tbody>
							</table>
						</div>
						<div class="row" style="padding-top: 10px">
							<div class="col-md-1">
								Motivo
							</div>
							<div class="col-md-11">
								<input class="form-control input-sm">
							</div>				
						</div>														
					</div>          	
	            </div>
	            <div class="col-md-offset-8" style="padding-top: 20px; padding-bottom: 20px">
	            	<button type="button" class="btn btn-success data-dismiss=modal btn-sm" onclick="">Crear Orden de Devolución</button>
	               	<button type="button" class="btn btn-warning data-dismiss=modal btn-sm" onclick="cerrarIngresoOrdenDevolucion();" style="width: 100px">Salir</button>
	            </div>            
	        </div>
	    </div>
	</div>

	<div id="mdModificarOrdenDevolucion" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
	    <div class="modal-dialog modal-lg">
	    <!-- Modal content-->
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5><b>Modificar orden de devolución</b></h5>
	            </div>
	            <div class="modal-body">
	 
					<div style="padding-top: 20px">
						<div class="row" style="padding-top: 10px">
							<div class="col-md-2">
								Nº Guia de Despacho
							</div>
							<div class="col-md-2">
								<input class="form-control input-sm">
							</div>
						</div>
						<div class="row" style="padding-top: 10px">
							<div class="col-md-2">
								Fecha de Despacho
							</div>
							<div class="col-md-2">
								<input class="form-control input-sm">
							</div>					
						</div>						
						<div class="row" style="padding-top: 10px">
							<div class="col-md-2">
								Cliente
							</div>
							<div class="col-md-8">
								<input class="form-control input-sm">
							</div>
						</div>
					</div>
					<div style="padding-top: 20px">

						<div class="row" style="padding-top: 10px">
							<div class="col-md-2">
								Obra/Planta
							</div>
							<div class="col-md-3">
								<input class="form-control input-sm">
							</div>
							<div class="col-md-2">
								Planta de devolución
							</div>
							<div class="col-md-3">
								<input class="form-control input-sm">
							</div>						
						</div>
						<div class="row" style="padding-top: 10px;padding-left: 10px; padding-right: 10px">
			            	<table id="tablaGuiasDevolucion" class="table table-condensed">
						        <thead>                      
						            <th style="width:80px">Devolver</th>
						            <th style="width:80px">Producto</th>
						            <th style="width:80px">Unidad</th>
						            <th style="width:80px">Cantidad/Pesaje<br>despachada</th>
						            <th style="width:80px">Cantidad/Pesaje<br>por devolver</th>
						        </thead>
						        <tbody>
						        	<tr>
						        		<td></td>
						        		<td>CRS-2 E</td>
						        		<td>Ton</td>
						        		<td>20</td>
						        		<td><input class="form-control input-sm"></td>
						        	</tr>
						        </tbody>
							</table>
						</div>
						<div class="row" style="padding-top: 10px">
							<div class="col-md-1">
								Motivo
							</div>
							<div class="col-md-11">
								<input class="form-control input-sm">
							</div>				
						</div>														
					</div>          	
	            </div>
	            <div class="col-md-offset-8" style="padding-top: 20px; padding-bottom: 20px">
	            	<button type="button" class="btn btn-success data-dismiss=modal btn-sm" onclick="">Guardar</button>
	               	<button type="button" class="btn btn-warning data-dismiss=modal btn-sm" onclick="cerrarModificarOrdenDevolucion();" style="width: 100px">Salir</button>
	            </div>            
	        </div>
	    </div>
	</div>

	@include('registrarDevoluciondeSaldo')

	

</div>



@include('verDevolucion')

@include('historicoDevoluciones')

@endsection

@section('javascript')
<script src="{{ asset('/') }}js/app/funciones.js"></script>
<script>
	$(document).ready(function() {
            var table=$('#tablaDevPorRecibir').DataTable({
                 orderCellsTop: true,
                 fixedHeader: true,         
                "lengthMenu": [[6, 12, 20, -1], ["6", "12", "20", "Todos"]],
                dom: 'Bfrtip',
                "scrollX": true,
                buttons: [               
                    'pageLength'
                ],                  
                "order": [[ 1, "desc" ]],                        
                language:{url: "{{ asset('/') }}locales/datatables_ES.json"}

            });

            var table2=$('#tablaDevDtePendiente').DataTable({
                 orderCellsTop: true,
                 fixedHeader: true,         
                "lengthMenu": [[6, 12, 20, -1], ["6", "12", "20", "Todos"]],
                dom: 'Bfrtip',
                "scrollX": true,
                buttons: [               
                    'pageLength'
                ],                  
                "order": [[ 1, "desc" ]],                        
                language:{url: "{{ asset('/') }}locales/datatables_ES.json"}

            }); 

	});

	function registrarDevolucion(){
		$("#mdRegistrarDevolucion").modal('show');
	}

	function cerrarRegistrarDevolucion(){
		$("#mdRegistrarDevolucion").modal('hide');
	}

	function abrirIngresoOrdenDevolucion(){
		$("#mdIngresoOrdenDevolucion").modal('show');
	}

	function cerrarIngresoOrdenDevolucion(){
		$("#mdIngresoOrdenDevolucion").modal('hide');
	}

	function verDevolucion(){
		divSelDevolucion.style.display='none';
		divVerDevolucion.style.display='block';
	}

	function cerrarVerDevolucion(){
		divSelDevolucion.style.display='block';
		divVerDevolucion.style.display='none';
	}

	function verHistorico(){
		divSelDevolucion.style.display='none';
		divDevHistorico.style.display='block';

		console.log(divDevHistorico.style.display);
	}

	function cerrarHistorico(){
		divSelDevolucion.style.display='block';
		divDevHistorico.style.display='none';
	}	

	function abrirModificarOrdenDevolucion(){
		$("#mdModificarOrdenDevolucion").modal('show');
	}

	function cerrarModificarOrdenDevolucion(){
		$("#mdModificarOrdenDevolucion").modal('hide');
	}	


	function abrirRegistrarDevoluciondeSaldo(){
		$("#mdRegistrarDevoluciondeSaldo").modal('show');	
	}

	function cerrarRegistrarDevoluciondeSaldo(){
		$("#mdRegistrarDevoluciondeSaldo").modal('hide');
	}		
</script>
@endsection