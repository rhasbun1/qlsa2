<div id="mdRegistrarDevoluciondeSaldo" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5><b>Registro de devolución de saldo (despachos a granel)</b></h5>
                **Esta función solo puede utilizarse para saldos de hasta 2 toneladas. Para saldos superiores debe solicitar al ejecutivo comercial que ingrese una nueva orden de devolución.
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
            	<button type="button" class="btn btn-success data-dismiss=modal btn-sm" onclick="">Registrar Devolución</button>
               	<button type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarRegistrarDevoluciondeSaldo();" style="width: 80px">Salir</button>
            </div>            
        </div>
    </div>
</div>