    <div id="divEmitirNotaDebito" style="display: none">
      	<div>
      		<h4>Emitir Nota de Débito</h4>
      	</div>
		<div class="row" style="padding-top: 5px">
			<div class="col-md-1">
				Fecha emisión
			</div>
			<div class="col-md-2">
				<input class="form-control input-sm" >
			</div>
			<div class="col-md-1">
				Tipo Factura
			</div>
			<div class="col-md-3">
				<select class="form-control input-sm">
                    <option value="1">Afecta</option>
                    <option value="2">Exenta</option>
				</select>
			</div>
			<div class="col-md-1">
				Cond.Pago
			</div>
			<div class="col-md-3">
				<select class="form-control input-sm">
				</select>
			</div>						
		</div>      	

		<div class="row" style="padding-top: 5px">
			<div class="col-md-1">
				Razón Social
			</div>
			<div class="col-md-3">
				<input class="form-control input-sm" >
			</div>
			<div class="col-md-1">
				Rut
			</div>
			<div class="col-md-2">
				<input class="form-control input-sm" >
			</div>
			<div class="col-md-1">
				Giro
			</div>
			<div class="col-md-3">
				<input class="form-control input-sm" >
			</div>						
		</div> 
		<div class="row" style="padding-top: 5px">
			<div class="col-md-1">
				Dirección
			</div>
			<div class="col-md-3">
				<input class="form-control input-sm" >
			</div>
			<div class="col-md-1">
				Ciudad
			</div>
			<div class="col-md-2">
				<select class="form-control input-sm">
				</select>
			</div>
			<div class="col-md-1">
				Comuna
			</div>
			<div class="col-md-2">
				<select class="form-control input-sm">
				</select>
			</div>						
		</div>

		<div class="row" style="padding-top: 5px">
			<div class="col-md-1">
				Teléfono
			</div>
			<div class="col-md-2">
				<input class="form-control input-sm" >
			</div>
			<div class="col-md-1">
				Nota Venta
			</div>
			<div class="col-md-2">
				<input class="form-control input-sm" >
			</div>
			<div class="col-md-1">
				O.de Compra
			</div>
			<div class="col-md-2">
				<input class="form-control input-sm" >
			</div>
			<div class="col-md-1">
				Vendedor
			</div>
			<div class="col-md-2">
				<input class="form-control input-sm" >
			</div>									
		</div>
		<div class="row" style="padding-top: 15px">
			<div class="col-md-8">
				<div>
					<h5>Referencias</h5>
				    <table id="tablaReferencias" class="table table-condensed">
				        <thead>                      
				            <th style="width:80px">Nº Referencia</th>
				            <th style="width:120px">Tipo Documento</th>
				            <th style="width:80px">Nº Documento</th>
				            <th style="width:120px">Fecha emisión</th>
				        </thead>
				        <tbody>
				        </tbody>
					</table>			
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-12">
						<h5>Bodega</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<input class="form-control input-sm">
					</div>
					<div class="col-md-8">
						<input class="form-control input-sm">
					</div>					
				</div>
				<div class="row">
					<div class="col-md-12">
						<h5>Centro de Costo</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<input class="form-control input-sm">
					</div>
					<div class="col-md-8">
						<input class="form-control input-sm">
					</div>					
				</div>
			</div>
		</div>
		<div class="row" style="padding-top: 15px">
			<div class="col-md-1">
				Motivo
			</div>
			<div class="col-md-2">
				<select class="form-control input-sm"></select>
			</div>			
		</div>		
		<div class="row" style="padding-top: 15px">
			<div class="col-md-1">
				Descripción
			</div>
			<div class="col-md-11">
				<input class="form-control input-sm" >
			</div>			
		</div>
		<div class="row" style="padding-top: 15px">
			<div class="col-md-12">
			    <table id="tablaDetalle" class="table table-condensed">
			        <thead>                      
			            <th style="width:80px">Código</th>
			            <th style="width:250px">Descripción</th>
			            <th style="width:80px">UM</th>
			            <th style="width:80px">Cantidad Factura</th>
			            <th style="width:80px">Cantidad/Pesaje<br>Nota de Crédito</th>
			            <th style="width:80px">Precio unit.<br>facturado</th>
			            <th style="width:100px">Precio unit. NC</th>
			            <th style="width:100px">Subtotal</th>
			        </thead>
			        <tbody>
			        </tbody>
				</table>			
			</div>
		</div>
		<div class="row" style="padding-top: 15px">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-2">
						Son :
					</div>
					<div class="col-md-8">
						<input class="form-control input-sm">
					</div>
				</div>
				<div class="row" style="padding-top: 10px">
					<div class="col-md-2">
						Referencia Interna
					</div>
					<div class="col-md-8">
						<input class="form-control input-sm">
					</div>
				</div>				
			</div>
			<div class="col-md-4">
				<div class="row">
					<div class="col-md-2">
						Neto
					</div>
					<div class="col-md-6">
						<input class="form-control input-sm" readonly>
					</div>					
				</div>				
				<div class="row" style="padding-top: 15px">
					<div class="col-md-2">
						IVA
					</div>
					<div class="col-md-6">
						<input class="form-control input-sm" readonly>
					</div>					
				</div>
				<div class="row" style="padding-top: 15px">
					<div class="col-md-2">
						Total
					</div>
					<div class="col-md-6">
						<input class="form-control input-sm" readonly>
					</div>					
				</div>	

			</div>
		</div>		
		<div>
			<button class="btn btn-sm btn-success" onclick="cerrarEmitirFactura();" style="width: 100px">Emitir</button>
			<button class="btn btn-sm btn-info" onclick="abrirModalSubirNotaDebito();">Subir Nota de Débito</button>
			<button class="btn btn-sm btn-warning" onclick="cerrarEmitirNotaCredito();" style="width: 100px">Atrás</button>
		</div>
    </div>

<div id="mdDescartarNotaDebito" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5><b>Motivo</b></h5>
            </div>
            <div class="modal-body">
            	<input class="form-control input-sm">        	
            </div>
            <div class="col-md-offset-8" style="padding-top: 20px; padding-bottom: 20px">
            	<button type="button" class="btn btn-danger data-dismiss=modal btn-sm" style="width: 80px">Aceptar</button>
               	<button type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarModalDescartarNotadeCredito();" style="width: 80px">Volver</button>
            </div>            
        </div>
    </div>
</div>


<div id="mdSubirNotaDebito" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5><b>Subir Nota de Débito en PDF</b></h5>
            </div>
            <div class="modal-body">
            	<div class="row">
            		<div class="col-md-4">
            			Nº Nota de débito
            		</div>
            		<div class="col-md-3">
            			<input class="form-control input-sm">
            		</div>
            	</div>
            	<div class="row">
            		<div class="col-md-8">
            			<input class="form-control input-sm">
            		</div>
            		<div class="col-md-4">
            			<button class="btn btn-sm btn-success">Buscar</button>
            		</div>            		
            	</div>
            </div>
            <div class="col-md-offset-8" style="padding-top: 20px; padding-bottom: 20px">
            	<button type="button" class="btn btn-danger data-dismiss=modal btn-sm" style="width: 80px">Aceptar</button>
               	<button type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarModalSubirNotaDebito();" style="width: 80px">Volver</button>
            </div>            
        </div>
    </div>
</div>