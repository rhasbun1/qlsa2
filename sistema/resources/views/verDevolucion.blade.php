<div class="panel-body" id="divVerDevolucion" style="display: none">
	<h4>Devolucion Nº XXXXXXX</h4>
	<br>
	<div class="row" style="padding-top: 5px">
		<div class="col-md-2">
			Fecha Orden de Devolución
		</div>
		<div class="col-md-2">
			<input class="form-control input-sm">
		</div>
		<div class="col-md-2">
			Fecha de Devolución
		</div>
		<div class="col-md-2">
			<input class="form-control input-sm">
		</div>		
	</div>

	<div class="row" style="padding-top: 5px">
		<div class="col-md-2">
			Cliente
		</div>
		<div class="col-md-4">
			<input class="form-control input-sm">
		</div>
		<div class="col-md-2">
			Planta de Origen
		</div>
		<div class="col-md-3">
			<input class="form-control input-sm">
		</div>
	</div>


	<div class="row" style="padding-top: 5px">
		<div class="col-md-2">
			Obra/Planta
		</div>
		<div class="col-md-4">
			<input class="form-control input-sm">
		</div>
		<div class="col-md-2">
			Planta de Devolución
		</div>
		<div class="col-md-3">
			<input class="form-control input-sm">
		</div>
	</div>
	<br>

	<div class="row" style="padding-top: 5px">
		<div class="col-md-1">
			Nº Guía
		</div>
		<div class="col-md-2">
			<input class="form-control input-sm">
		</div>
		<div class="col-md-2">
			Nota de Venta
		</div>
		<div class="col-md-2">
			<input class="form-control input-sm">
		</div>
		<div class="col-md-1">
			Nº Pedido
		</div>
		<div class="col-md-2">
			<input class="form-control input-sm">
		</div>		
	</div>

	<div class="row" style="padding-top: 5px;">
		<div class="col-md-2">
			Nº Ingreso Softland
		</div>
		<div class="col-md-2">
			<input class="form-control input-sm">
		</div>
		<div class="col-md-1">
			Motivo
		</div>
		<div class="col-md-7">
			<input class="form-control input-sm">
		</div>			
	</div>
	<br>
	<br>
    <table id="tablaDetalle" class="table table-condensed" style="width: 100%">
	    <thead>                      
	        <th style="width:50px">Producto</th>
	        <th style="width:80px">Diseño</th>
	        <th style="width:120px">Unidad</th>
	        <th style="width:80px">Cantidad/Pesaje<br>informada por devolver</th>
	        <th style="width:80px">Cantidad/Pesaje<br>devuelto</th>
	        <th style="width:350px">Control de Calidad</th>
	        <th style="width:350px">Nota de Crédito</th>
	        <th style="width:150px">Facturación flete</th>
	    </thead>
	    <tbody>
	    </tbody>
	</table>
	<div class="row">
		<div class="col-md-12">
			Observaciones:
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<input class="form-control input-sm">
		</div>
	</div>
	<br>
	<button class="btn btn-sm btn-success" onclick="abrirModificarOrdenDevolucion();">Modificar</button>
	<button class="btn btn-sm btn-danger" onclick="eliminarDevolucion();">Eliminar</button>
	<button class="btn btn-sm btn-warning" onclick="cerrarVerDevolucion();">Atrás</button>
	<br>
	<br>
	<b>Registro de Acciones</b>

</div>