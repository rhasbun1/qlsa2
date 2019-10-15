      

<?php $__env->startSection('contenedorprincipal'); ?>

<div style="padding: 20px">
    <div class="panel panel-default table-responsive">
        <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
        <div class="panel-heading">
            <b>Costos Mensuales</b>
        </div>

        <div class="padding-md clearfix" id="cuadro1">
	        <div class="row" style="padding-bottom: 15px">
	        	<div class="col-md-1">
	        		Año
	        	</div>
	        	<div class="col-md-1">
	        		<input id="ano" class="form-control input-sm" maxlength="4">
	        	</div>
	        	<div class="col-md-1">
	        		Mes
	        	</div>
	        	<div class="col-md-2">
	        		<select id="mes" class="form-control input-sm">
	        			<option value="1">Enero</option>
	        			<option value="2">Febrero</option>
	        			<option value="3">Marzo</option>
	        			<option value="4">Abril</option>
	        			<option value="5">Mayo</option>
	        			<option value="6">Junio</option>
	        			<option value="7">Julio</option>
	        			<option value="8">Agosto</option>
	        			<option value="9">Septiembre</option>
	        			<option value="10">Octubre</option>
	        			<option value="11">Noviembre</option>
	        			<option value="12">Diciembre</option>
	        		</select>
	        	</div>
	        	<div class="col-md-1">
	        		<button class="btn btn-success btn-sm" onclick="agregarMes()">Agregar</button>
	        	</div>        	
	        </div>
	        <div style="width: 50%">        
	            <table id="tabla" class="table table-hover table-condensed table-responsive" style="width: 100%">
	                <thead>
	                    <th style="width:80px">Año</th>
	                    <th style="width:100px">Mes</th>
	                    <th style="width:40px"></th>
	                </thead>
	                <tbody>
	                    <?php $__currentLoopData = $costosMensuales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                        <tr data-nummes="<?php echo e($item->mes); ?>">
	                            <td><?php echo e($item->ano); ?></td>
	                            <td><?php echo e($item->nombreMes); ?></td>
	                            <td style="width:40px">
	                            	<button class="btn btn-xs btn btn-warning btnEditar" title="Ver Costos" onclick="listarCostosProductos(this.parentNode.parentNode);"><i class="fa fa-edit fa-lg"></i></button>
	                            </td>
	                        </tr>
	                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                </tbody>
	            </table>
	        </div>
		    <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
		        <a href="<?php echo e(asset('/')); ?>dashboard" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
		    </div>        
        </div>
		<div class="padding-md clearfix" id="cuadro2" style="display: none">

    </div>
 
</div>

<div id="mdCostos" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      	<div class="modal-body">
				<div class="row">
					<div class="col-md-1">
						Año
					</div>
					<div class="col-md-2">
						<input id="anoSel" class="form-control input-sm" readonly>
					</div>
					<div class="col-md-1">
						Mes
					</div>
					<div class="col-md-2">
						<input id="mesSel" class="form-control input-sm" readonly data-numeromes="0">
					</div>				
				</div>
				<br>
		        <div style="width: 80%">        
		            <table id="tablaProductos" class="table table-hover table-condensed table-responsive" style="width: 100%">
		                <thead>
		                    <th style="width:120px">Producto</th>
		                    <th style="width:60px">Unidad</th>
		                    <th style="width:80px">Planta</th>
		                    <th style="width:80px">Costo ($)</th>
		                </thead>
		                <tbody>
		                </tbody>
		            </table>
		        </div>
			    <div style="text-align: right;">
			    	<button class="btn btn-sm btn-success" style="width:120px" onclick="abrirCuadroEspera();">Guardar Cambios</button>
			        <button class="btn btn-sm btn-warning" style="width:100px" onclick="cerrarListaProductos();">Cerrar</button>
			    </div>  	        		
			</div>
	      </div>
	    </div>
  	</div>
</div>

<div id="mdProcesando" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" style="text-align: center">
          <img src="<?php echo e(asset('/')); ?>img/procesando.gif" alt="User Avatar">
      </div>
    </div>
  </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <!-- Datepicker -->
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-datepicker.min.js"></script>  

    <!-- Timepicker -->
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-timepicker.min.js"></script>  
    <script src="<?php echo e(asset('/')); ?>js/app/funciones.js"></script>
    <script src="js/syncfusion/ej.web.all.min.js"> </script>
    <script src="<?php echo e(asset('/')); ?>js/syncfusion/lang/ej.culture.de-DE.min.js"></script>

	<script>
        $('#mdProcesando').on('shown.bs.modal', function (e) {
          guardarCostos();
        })  

        function abrirCuadroEspera(){
            $("#mdProcesando").modal('show');
        }      

		$(document).ready(function() {

            // Setup - add a text input to each footer cell
            $('#tablaProductos thead tr').clone(true).appendTo( '#tablaProductos thead' );
            $('#tablaProductos thead tr:eq(1) th').each( function (i) {
                if(i==0 ){
                    $(this).html( '<select id="selProducto" class="form-control input-sm"></select>' );
                }else if(i==1 ){
                    $(this).html( '<select id="selUnidad" class="form-control input-sm"></select>' );
                }else if(i==2 ){
                    $(this).html( '<select id="selPlanta" class="form-control input-sm"></select>' );
                }else if(i==3 ){
                    $(this).html( '' );                                   
                }
            } );

            // DataTable
            var table=$('#tabla').DataTable({
                orderCellsTop: true,
                fixedHeader: true,      
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}              
            });

            var productos=$('#tablaProductos').DataTable({
                orderCellsTop: true,
                fixedHeader: true,      
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"},
                initComplete: function () {
                    actualizarFiltros(this.api());
                }                
            });             

        } );

        function actualizarFiltros(tabla){
            tabla.columns(0).every( function () {
                var column = this;
                var select = $("#selProducto" ).empty().append( '<option value=""></option>' )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
            tabla.columns(1).every( function () {
                var column = this;
                var select = $("#selUnidad" ).empty().append( '<option value=""></option>' )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
            tabla.columns(2).every( function () {
                var column = this;
                var select = $("#selPlanta" ).empty().append( '<option value=""></option>' )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );                      
        }


        function listarCostosProductos(row){
        	var table=$('#tabla').DataTable();
        	var fila=table.row(row).index();
        	var ano=table.cell(fila,0).data();
        	var mes=table.row(row).node().dataset.nummes;

        	$("#anoSel").val(ano);
        	$("#mesSel").val(table.cell(fila,1).data());

        	document.getElementById('mesSel').dataset.numeromes=mes;

        	var productos=$("#tablaProductos").DataTable();

        	productos.rows().remove().draw();

            $.ajax({
                url: urlApp +'costosMensualesProductos',
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        ano: ano,
                        mes: mes
                      },
                success:function(dato){
                    for(var x=0;x<dato.length;x++){
                        var fila=productos.row.add( [
                                dato[x].prod_nombre,
                                dato[x].u_nombre,
                                dato[x].nombrePlanta,
                                "<input class='form-control input-sm' value='" + dato[x].costo +"' style='width: 100px' onkeypress='return isIntegerKey(event)'>", 
                            ] ).index();

                        productos.cell(fila,0).node().dataset.idproductolistaprecio=dato[x].idProductoListaPrecio;
                    }
                    productos.draw();
                    actualizarFiltros(productos);

                    $("#mdCostos").modal('show');
            
                }
            })

        }

        function cerrarListaProductos(){
        	$("#mdCostos").modal('hide');
        }


		function agregarMes(){
			var table=$('#tabla').DataTable();

			for (var i = 0; i < table.rows().count(); i++){

				var m = table.row(i).node().dataset.nummes;
				if(table.cell(i,0).data()==$("#ano").val() && m==$("#mes").val() ){
                    swal(
                        {
                            title: '¡Mes ya existe!',
                            text: 'El año y mes ingresados ya existen en la lista',
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonText: 'OK',
                            cancelButtonText: 'NO',
                            closeOnConfirm: true,
                            closeOnCancel: false
                        });
                    return;
				}
			}

            $.ajax({
                url: urlApp + "crearCostosMensuales",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: {                      
                        ano: $("#ano").val(),
                        mes: $("#mes").val()
                      },
                success:function(dato){
		            var nodo=table.row.add( [
		                    $("#ano").val(),
		                    $("#mes option:selected").html(),
		                    '<td style="width:40px"><button class="btn btn-xs btn btn-warning btnEditar" title="Ver Costos"><i class="fa fa-edit fa-lg"></i></button></td>'
		                    ] ).draw().node();

		            nodo.dataset.nummes=$("#mes").val();
                }

            })			
                      
		}


		function guardarCostos(){
			var tabla= $("#tablaProductos").DataTable();
		    var cadena='[';
		    var costo="0";
		    for (var i = 0; i < tabla.rows().count(); i++){
		    	if(tabla.cell(i,3).data()==''){
		    		costo="0";
		    	}else{
		    		costo=tabla.cell(i,3).node().getElementsByTagName('input')[0].value;
		    	}



                cadena+='{';
                cadena+='"idProductoListaPrecio":"'+ tabla.cell(i,0).node().dataset.idproductolistaprecio  + '", ';
                cadena+='"costo":"' + costo + '"';
                cadena+='}, ';

		    }
		    cadena=cadena.slice(0,-2);
		    cadena+=']';

            $.ajax({
                url: urlApp + "actualizarCostos",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: {                      
                        ano: $("#anoSel").val(),
                        mes: document.getElementById('mesSel').dataset.numeromes,
                        detalle: cadena
                      },
                success:function(dato){
                    $("#mdProcesando").modal('hide');
                    swal(
                        {
                            title: '¡Los cambios han sido guardados!' ,
                            text: '',
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonText: 'OK',
                            cancelButtonText: '',
                            closeOnConfirm: true,
                            closeOnCancel: false
                        }
                    ) 
                	cerrarListaProductos();
                }

            })	

		}

	</script>

<?php $__env->stopSection(); ?>        	

<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>