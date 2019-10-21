      

<?php $__env->startSection('contenedorprincipal'); ?>

<div style="padding: 20px">
    <div class="panel panel-default table-responsive">
        <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
        <div class="panel-heading">
            <b>Fletes, Distancias y Tiempos <?php echo e($subtitulo); ?></b>
        </div>

        <div class="padding-md clearfix" id="cuadro1">
	        <div style="width: 80%">        
	            <table id="tablaNotas" class="table table-hover table-condensed table-responsive" style="width: 100%">
	                <thead>
	                    <th style="width:80px">Nº Nota Venta</th>
	                    <th style="width:300px">Cliente</th>
                        <th style="width:250px">Obra</th>
                        <th style="width:120px">Planta</th>
                        <th style="width:80px">Flete</th>
                        <th style="width:80px">Distancia (km)</th>
                        <th style="width:80px">Tiempo Traslado (horas)</th>
	                </thead>
	                <tbody>
	                    <?php $__currentLoopData = $cargos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                        <tr>
	                            <td><?php echo e($item->idNotaVenta); ?></td>
	                            <td><?php echo e($item->nombreCliente); ?></td>
                                <td><?php echo e($item->nombreObra); ?></td>
                                <td data-idplanta="<?php echo e($item->idPlanta); ?>"><?php echo e($item->nombrePlanta); ?></td>
                                <td>
                                    <input class="form-control input-sm" value="<?php echo e($item->flete); ?>" maxlength="7" onkeypress='return isIntegerKey(event)'>
                                </td>
                                <td>
                                    <input class="form-control input-sm" value="<?php echo e($item->distancia); ?>" maxlength="5" onkeypress='return isIntegerKey(event)'>
                                </td>
                                <td>
                                    <input class="form-control input-sm" value="<?php echo e($item->tiempoTraslado); ?>" maxlength="3" onkeypress='return isIntegerKey(event)'>
                                </td>
	                        </tr>
	                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                </tbody>
	            </table>
	        </div>
		    <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
                <button id="btnGuardarCambios" class="btn btn-sm btn-success" style="width:120px" onclick="abrirCuadroEspera();">Guardar Cambios</button>
		        <a href="<?php echo e(asset('/')); ?>dashboard" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
		    </div>        
        </div>
		<div class="padding-md clearfix" id="cuadro2" style="display: none">

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
          guardarCambios();
        })  

        function abrirCuadroEspera(){
            $("#mdProcesando").modal('show');
        }      
		$(document).ready(function() {

            var tabla=$('#tablaNotas').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                columnDefs: [ {
                                "targets": [4,5,6],
                                "orderable": false
                                } ],                    
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



		function guardarCambios(){
            document.getElementById('btnGuardarCambios').disabled=true;
			var tabla= $("#tablaNotas").DataTable();
		    var cadena='[';
		    var costo="0";
		    for (var i = 0; i < tabla.rows().count(); i++){
		    	if(tabla.cell(i,4).node().getElementsByTagName('input')[0].value==''){
		    		flete="0";
		    	}else{
		    		flete=tabla.cell(i,4).node().getElementsByTagName('input')[0].value;
		    	}

                if(tabla.cell(i,5).node().getElementsByTagName('input')[0].value==''){
                    distancia="0";
                }else{
                    distancia=tabla.cell(i,5).node().getElementsByTagName('input')[0].value;
                }
                if(tabla.cell(i,6).node().getElementsByTagName('input')[0].value==''){
                    tiempoTraslado="0";
                }else{
                    tiempoTraslado=tabla.cell(i,6).node().getElementsByTagName('input')[0].value;
                }                

                if( isNaN(flete) || isNaN(distancia) || isNaN(tiempoTraslado) ){
                    $("#mdProcesando").modal('hide');
                    document.getElementById('btnGuardarCambios').disabled=false;
                    swal(
                        {
                            title: '¡Los valores ingresados deben ser solo números!' ,
                            text: '',
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonText: 'OK',
                            cancelButtonText: '',
                            closeOnConfirm: true,
                            closeOnCancel: false
                        }
                    )
                    return;                   
                }


                cadena+='{';
                cadena+='"idNotaVenta":"'+ tabla.cell(i,0).data() + '", ';
                cadena+='"idPlanta":"'+ tabla.cell(i,3).node().dataset.idplanta + '", ';
                cadena+='"flete":"'+ flete  + '", ';
                cadena+='"distancia":"'+ distancia  + '", ';
                cadena+='"tiempoTraslado":"' + tiempoTraslado + '"';
                cadena+='}, ';
		    }

		    cadena=cadena.slice(0,-2);
		    cadena+=']';

            $.ajax({
                url: urlApp + "actualizarNotaVentaCargos",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: {                      
                        detalle: cadena
                      },
                success:function(dato){
                    $("#mdProcesando").modal('hide');
                    document.getElementById('btnGuardarCambios').disabled=false;
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

                }
            })	

		}

	</script>

<?php $__env->stopSection(); ?>        	

<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>