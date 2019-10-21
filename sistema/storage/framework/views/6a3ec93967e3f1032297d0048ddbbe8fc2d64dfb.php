      

<?php $__env->startSection('contenedorprincipal'); ?>
<div style="padding: 20px">
    <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b>Consultar Registro de Acciones</b>
        </div>
        <div class="padding-md clearfix"  style="width:900px">
	        <div>
	        	<div class="row">
	        		<div class="col-md-1">
						Item
	        		</div>
	        		<div class="col-md-3">
	        			<select id="item" class="form-control input-sm" onchange="limpiarBusqueda();">
                            <?php $__currentLoopData = $itemAcciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <option value="<?php echo e($item->item); ?>"><?php echo e($item->descripcion); ?> </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
	        			</select>
	        		</div>
	        		<div class="col-md-1" id="etiqueta">
	        			Número
	        		</div>
	        		<div class="col-md-3">
	        			<input id="cadenaBusqueda" class="form-control input-sm" maxlength="30">
	        		</div>
	        		<div class="col-md-1">
	        			<button class="btn btn-sm btn-warning" onclick="consultarRegistroAcciones();">Buscar</button>
	        		</div>
	        	</div>
	        </div>
	        <br>           
            <table id="tabla" class="table table-hover table-condensed table-responsive">
                <thead>
                    <th style="width: 80px">Tipo</th>
                    <th style="width: 500px">Motivo</th>
                    <th style="width: 120px">Fecha/Hora</th>
                    <th style="width: 200px">Usuario</th>
                </thead>
                <tbody>
                </tbody>
            </table>      
        </div>
    </div>
    <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
        <a href="<?php echo e(asset('/')); ?>dashboard" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
    </div>    
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <!-- Datepicker -->
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-datepicker.min.js"></script>  
    <script src="<?php echo e(asset('/')); ?>js/app/funciones.js"></script>
    <script>

		$(document).ready(function() {

        	$('#tabla thead tr').clone(true).appendTo( '#tabla thead' );
            $('#tabla thead tr:eq(1) th').each( function (i) {
                $(this).html( '<input type="text" class="form-control input-sm" placeholder="Buscar..." />' );
                $( 'input', this ).on( 'keyup change', function () {
                    if ( tabla.column(i).search() !== this.value ) {
                        tabla
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );                              
            } );

            var table=$('#tabla').DataTable({
                orderCellsTop: true,
                fixedHeader: true,                        
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}              
            });
        } );

		function limpiarBusqueda(){
			var valor=document.getElementById('item').value;

			if(valor=='NV' || valor=='GD' || valor == 'Ped'){
				document.getElementById('etiqueta').innerHTML='Número'
			}else{
				document.getElementById('etiqueta').innerHTML='Descripción'
			}
			document.getElementById('cadenaBusqueda').value='';

		}

    	function consultarRegistroAcciones(){
        	var tabla=$('#tabla').DataTable();
        	tabla.rows().remove().draw();

        	if(document.getElementById('item').value=='PROD'){
	            $.ajax({
	                url: urlApp +'consultarProductoAcciones',
	                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
	                type: 'POST',
	                dataType: 'json',
	                data: { 
	                		cadena: document.getElementById('cadenaBusqueda').value
	                      },
	                success:function(dato){
	                    for(var x=0;x<dato.length;x++){
	                        var fila=tabla.row.add( [
	                                dato[x].tipo,
	                                dato[x].motivo,
	                                dato[x].fechaHora,
	                                dato[x].nombreUsuario
	                            ] );
	                    }
	                    tabla.draw();
	                }
	            })         		
        	}else{
	            $.ajax({
	                url: urlApp +'consultarRegistroAcciones',
	                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
	                type: 'POST',
	                dataType: 'json',
	                data: { 
	                		item: document.getElementById('item').value,
	                		numero: document.getElementById('cadenaBusqueda').value
	                      },
	                success:function(dato){
	                    for(var x=0;x<dato.length;x++){
	                        var fila=tabla.row.add( [
	                                dato[x].tipo,
	                                dato[x].motivo,
	                                dato[x].fechaHora,
	                                dato[x].nombreUsuario
	                            ] );
	                    }
	                    tabla.draw();
	                }
	            })           		
        	}
   		
    	}

    </script>
   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>