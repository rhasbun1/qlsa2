@extends('plantilla')      

@section('contenedorprincipal')

<div class="panel-body">
	<div id="divSelGuias" style="display: block;">
		<div>
			<h3>Guias de despacho por facturar</h3>
		</div>
		<div style="padding-top: 10px">
			<div class="row" style="padding-top: 5px">
				<div class="col-md-2">
					Nombre Cliente
				</div>
				<div class="col-md-3">
					<select class="form-control input-sm">
	                    @foreach($clientes as $item)
	                        <option value="{{ $item->emp_codigo }}">{{ $item->emp_nombre }}</option>
	                    @endforeach					
					</select>
				</div>
				<div class="col-md-1">
					<button class="btn btn-sm btn-warning">Buscar</button>
				</div>
			</div>
			<div class="row" style="padding-top: 5px">
				<div class="col-md-2">
					Rut del Cliente
				</div>
				<div class="col-md-3">
					<input class="form-control input-sm" style="width: 200px">
				</div>
				<div class="col-md-1">
					<button class="btn btn-sm btn-warning">Buscar</button>
				</div>
			</div>
			<div class="row" style="padding-top: 5px">
				<div class="col-md-2">
					Nº Nota de venta
				</div>
				<div class="col-md-3">
					<input class="form-control input-sm" style="width: 200px">
				</div>
				<div class="col-md-1">
					<button class="btn btn-sm btn-warning">Buscar</button>
				</div>
			</div>
			<div class="row" style="padding-top: 5px">
				<div class="col-md-2">
					Nº Pedido
				</div>
				<div class="col-md-3">
					<input class="form-control input-sm" style="width: 200px">
				</div>
				<div class="col-md-1">
					<button class="btn btn-sm btn-warning">Buscar</button>
				</div>
			</div>
			<div class="row" style="padding-top: 5px">
				<div class="col-md-2">
					Fecha emisión guía de despacho
				</div>
				<div class="col-md-2">
					<input class="form-control input-sm" style="width: 200px">
				</div>
				<div class="col-md-2">
					<input class="form-control input-sm" style="width: 200px">
				</div>			
				<div class="col-md-1">
					<button class="btn btn-sm btn-warning">Buscar</button>
				</div>
			</div>		
		</div>
	    <div class="panel panel-default" id="contenedor3">
	        <div class="panel-heading">
	            <div class="panel-tab clearfix">
	                <ul class="tab-bar">
	                    <li class="active"><a href="#tabGuiasPorFacturar" data-toggle="tab"><b>Guías de despacho por facturar</b></a></li>
                        <li><a href="#tabDevoluciones" data-toggle="tab"><b>Devoluciones con DTE pendientes</b></a></li> 
	                </ul>
	            </div>
	        </div> 			
            <div class="tab-content clearfix">
                <div class="tab-pane active" id="tabGuiasPorFacturar" style="padding-top: 5px;max-width: 1820px">			
				    <table id="tablaGuias" class="table table-condensed">
				        <thead>                      
				            <th style="width:50px">Sel.</th>
				            <th style="width:80px">Nº Guía</th>
				            <th style="width:120px">Fecha Emisión Guía</th>
				            <th style="width:80px">Nº Pedido</th>
				            <th style="width:80px">Nº Nota de Venta</th>
				            <th style="width:350px">Cliente</th>
				            <th style="width:350px">Obra/Planta</th>
				            <th style="width:150px">Planta de Origen</th>
				            <th style="width:120px">Total Neto $</th>
				        </thead>
				        <tbody>
				        </tbody>
					</table>
					<div>
						<button class="btn btn-sm btn-warning" onclick="cerrarEmitirFactura();" style="width: 100px">Atrás</button>
						<button class="btn btn-sm btn-success" onclick="emitirFactura();" style="width: 100px">Emitir Factura</button>
					</div>					
				</div>
				<div class="tab-pane" id="tabDevoluciones" style="padding-top: 5px;max-width: 1820px">	
				    <table id="tablaDevolucionesPendientes" class="table table-condensed">
				        <thead>                      
				            <th style="width:80px">Nº Devolución</th>
				            <th style="width:250px">Fecha de devolución</th>
				            <th style="width:80px">Cliente</th>
				            <th style="width:100px">Planta de Origen</th>
				            <th style="width:100px">Planta de devolución</th>
				            <th style="width:100px">Obra/Planta</th>
				            <th style="width:100px">Nº Guía</th>
				            <th style="width:100px">Nº Pedido</th>
				            <th style="width:100px">Nº Factura</th>
				            <th style="width:100px">Producto</th>
				            <th style="width:100px">Cantidad/Pesaje Despachado</th>
				            <th style="width:100px">Cantidad Informada por Devolver</th>
				            <th style="width:100px">Cantidad/Pesaje Devuelto</th>
				            <th style="width:100px">Nota de Crédito</th>
				            <th style="width:100px">Cobro flete</th>
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

	@include('emitirFactura')	

    @include('gestionarCobroFlete')	

    @include('emitirNotaCredito')
</div>

<div id="mdGuiasSeleccionadas" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5><b>Detalle de guías seleccionadas</b></h5>
            </div>
            <div class="modal-body">
            	<table id="tablaGuiasSeleccionadas" class="table table-condensed">
			        <thead>                      
			            <th style="width:80px">Nº Guía</th>
			            <th style="width:80px">Nº Pedido</th>
			            <th style="width:80px">O.de compra</th>
			            <th style="width:80px">Fecha Emisión</th>
			            <th style="width:80px">Código</th>
			            <th style="width:80px">Descripción</th>
			            <th style="width:80px">UM</th>
			            <th style="width:80px">Cantidad</th>
			            <th style="width:80px">P.Unitario</th>
			            <th style="width:80px">Dscto.</th>
			            <th style="width:80px">Subtotal</th>
			        </thead>
			        <tbody>
			        </tbody>
				</table>            	

            </div>
            <div class="col-md-offset-10" style="padding-top: 20px; padding-bottom: 20px">
               <button type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarModalGuiasSeleccionadas()" style="width: 80px">Volver</button>
            </div>            
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script src="{{ asset('/') }}js/app/funciones.js"></script>
<script>
	$(document).ready(function() {
            var table=$('#tablaGuias').DataTable({
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

	function emitirFactura(){
		divSelGuias.style.display='none';
		divGestionarFlete.style.display='none';
		divEmitirFactura.style.display='block';
	}

	function abrirModalGuiasSeleccionadas(){
		$("#mdGuiasSeleccionadas").modal('show');
	}

	function cerrarModalGuiasSeleccionadas(){
		$("#mdGuiasSeleccionadas").modal('hide');
	}


	function cerrarEmitirFactura(){
		divSelGuias.style.display='block';
		divEmitirFactura.style.display='none';
		divGestionarFlete.style.display='none';	
	}

	function gestionarFlete(){
		divSelGuias.style.display='none';
		divEmitirFactura.style.display='none';
		divGestionarFlete.style.display='block';	
	}	

	function abrirModalDescartarNotadeCredito(){
		$("#mdDescartarNotaCredito").modal('show');
	}

	function cerrarModalDescartarNotadeCredito(){
		$("#mdDescartarNotaCredito").modal('hide');
	}

	function abrirModalsubirNotadeCredito(){
		$("#mdSubirNotaCredito").modal('show');
	}

	function cerrarModalSubirNotadeCredito(){
		$("#mdSubirNotaCredito").modal('hide');
	}

	function abrirModalSubirFactura(){
		$("#mdSubirFactura").modal('show');
	}

	function cerrarModalSubirFactura(){
		$("#mdSubirFactura").modal('hide');
	}

	function abrirModalDescartarCobroFlete(){
		$("#mdDescartarCobroFlete").modal('show');
	}

	function cerrarModalDescartarCobroFlete(){
		$("#mdDescartarCobroFlete").modal('hide');
	}

</script>
@endsection