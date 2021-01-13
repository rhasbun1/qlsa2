
	
	
	<div id="divDevHistorico" style="display: none;">

		<h3>Devoluciones históricas</h3>
		<div style="padding-top: 10px">
			<div class="row" style="padding-top: 5px">
				<div class="col-md-2">
					Rango Orden Devolución
				</div>
				<div class="col-md-1">
					<input class="form-control input-sm">
				</div>
				<div class="col-md-1">
					<input class="form-control input-sm">
				</div>
				<div class="col-md-1">
					<button class="btn btn-sm btn-success">Buscar</button>
				</div>				
			</div>
			<div class="row" style="padding-top: 5px">
				<div class="col-md-2">
					Fecha Orden Devolucíon
				</div>
				<div class="col-md-1">
					<input class="form-control input-sm">
				</div>
				<div class="col-md-1">
					<input class="form-control input-sm">
				</div>
				<div class="col-md-1">
					<button class="btn btn-sm btn-success">Buscar</button>
				</div>					
			</div>
			<div class="row" style="padding-top: 5px">
				<div class="col-md-1">
					Cliente
				</div>
				<div class="col-md-3">
					<input class="form-control input-sm">
				</div>
				<div class="col-md-1">
					<button class="btn btn-sm btn-success">Buscar</button>
				</div>					
			</div>			
		</div>


	    <table id="tablaDevHistorica" class="table table-condensed" style="width: 100%">
	        <thead>                      
	            <th style="width:80px">Nº Dev.</th>
	            <th style="width:80px">Nº Ingreso<br>softland</th>
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
		<button class="btn btn-sm btn-warning" onclick="cerrarHistorico();">Atrás</button>
	</div>