@extends('plantilla')      

@section('contenedorprincipal')

<div class="panel-body">
	<div id="divConsultaDte" style="display: block;padding-bottom: 15px">
		<div>
			<h3>Consulta y Gestión de DTE Emitidos</h3>
		</div>
		<div style="padding-top: 10px;padding-bottom: 15px">
			<div class="row" style="padding-top: 5px">
				<div class="col-md-2">
					Tipo Documento
				</div>
				<div class="col-md-3">
					<select class="form-control input-sm"></select>
				</div>
				<div class="col-md-1">
					<button class="btn btn-sm btn-warning">Buscar</button>
				</div>
			</div>
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
					Fecha emisión
				</div>
				<div class="col-md-3">
					<input class="form-control input-sm" style="width: 200px">
				</div>		
				<div class="col-md-1">
					<button class="btn btn-sm btn-warning">Buscar</button>
				</div>
			</div>		
		</div>
		<div style="border-top: 1px solid black;padding-top: 15px">
	        <table id="tablaDtes" class="table table-condensed" style="width:100%">
		        <thead>                      
		            <th style="width:80px">Tipo Documento</th>
		            <th style="width:80px">Nº Documento</th>
		            <th style="width:80px">Concepto</th>
		            <th style="width:80px">Razón social<br>del cliente</th>
		            <th style="width:80px">Rut del cliente</th>
		            <th style="width:80px">Fecha de emisión factura</th>
		            <th style="width:80px">Nº de Guía</th>
		            <th style="width:80px">Nota de venta</th>
		            <th style="width:80px">Total Neto</th>
		        </thead>
		        <tbody>
		        	<tr>
		        		<td>
		        			Factura Afecta
		        		</td>
		        		<td>
		        			<a onclick="verDte();"  style="cursor:zoom-in;" >1001</a>
		        		</td>
		        		<td>
		        			Producto
		        		</td>
		        		<td>
		        			Nombre Cliente
		        		</td>
		        		<td>
		        			XX.XXX.XXX-X
		        		</td>
		        		<td>
		        			00/00/0000
		        		</td>
		        		<td>
		        			<select class="form-control input-sm" >
		        				<option>
		        					1
								</option>
								<option>	        					
		        					2
		        				</option>
		        				<option>	
		        					3
		        				</option>
		        			</select>
		        		</td>
		        		<td>
		        			14
		        		</td>
		        		<td>
		        			$ 100
		        		</td>		        		     		
		        	</tr>
		        </tbody>
			</table>
		</div>		
	</div>

	@include('verDte')

	@include('emitirNotaCredito')

	@include('emitirNotaDebito')

</div>


@endsection

@section('javascript')
<script src="{{ asset('/') }}js/app/funciones.js"></script>
<script>
	$(document).ready(function() {
            var table=$('#tablaDtes').DataTable({
                 orderCellsTop: true,
                 fixedHeader: true,         
                "lengthMenu": [[10, 50, -1], ["10", "50", "Todos"]],
                dom: 'Bfrtip',
                "scrollX": true,
                buttons: [               
                    'pageLength'
                ],                  
                "order": [[ 1, "desc" ]],                        
                language:{url: "{{ asset('/') }}locales/datatables_ES.json"}

            }); 
	});

	function verDte(){
		divConsultaDte.style.display='none';
		divVerFactura.style.display='block';
		divEmitirNotaCredito.style.display='none';
		divEmitirNotaDebito.style.display='none';
	}

	function cerrarVerDte(){
		divConsultaDte.style.display='block';
		divVerFactura.style.display='none';
		divEmitirNotaCredito.style.display='none';
		divEmitirNotaDebito.style.display='none';
	}	

	function abrirModalReemplazarFactura(){
		$("#mdReemplazarFactura").modal('show');
	}

	function cerrarModalReemplazarFactura(){
		$("#mdReemplazarFactura").modal('hide');
	}

	function emitirNotaCredito(){
		divConsultaDte.style.display='none';
		divVerFactura.style.display='none';		
		divEmitirNotaCredito.style.display='block';
		divEmitirNotaDebito.style.display='none';
	}

	function cerrarEmitirNotaCredito(){
		divConsultaDte.style.display='none';
		divVerFactura.style.display='block';		
		divEmitirNotaCredito.style.display='none';
		divEmitirNotaDebito.style.display='none';
	}

	function emitirNotaDebito(){
		divConsultaDte.style.display='none';
		divVerFactura.style.display='none';
		divEmitirNotaCredito.style.display='none';
		divEmitirNotaDebito.style.display='block';
	}

	function cerrarEmitirNotaDebito(){
		divConsultaDte.style.display='none';
		divVerFactura.style.display='block';
		divEmitirNotaCredito.style.display='none';		
		divEmitirNotaDebito.style.display='none';
	}

	function abrirModalSubirNotaCredito(){
		$("#mdSubirNotaCredito").modal('show');
	}

	function cerrarModalSubirNotaCredito(){
		$("#mdSubirNotaCredito").modal('hide');
	}

	function abrirModalSubirNotaDebito(){
		$("#mdSubirNotaDebito").modal('show');
	}

	function cerrarModalSubirNotaDebito(){
		$("#mdSubirNotaDebito").modal('hide');
	}
</script>
@endsection	