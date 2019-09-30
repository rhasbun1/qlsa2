      

<?php $__env->startSection('contenedorprincipal'); ?>

<div style="padding: 5px">
    <div class="panel panel-default">
        <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
        <input type="hidden" id="idPerfil" value="<?php echo e(Session::get('idPerfil')); ?>">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-3">
                    <b>Registro de Salidas</b>
                </div>
                <div class="col-md-3">
                    <button id="btnRefresh" class="btn btn-sm btn-success" onclick="reFresh();" style="display: none;">Actualizar</button>
                </div>
            </div>

        </div>
        <div class="panel-body" style="width: 100%; max-height: 1320px">
            <div class="padding-md clearfix">
                <table id="tablaDetalle" class="table table-hover table-condensed"  style="width: 100%">
                    <thead>
                        <th style="width: 50px">Nº Guía</th>
                        <th style="width: 120px">Fecha Creación</th>
                        <th style="width: 50px">Nº Pedido</th>
                        <th style="width: 100px">Planta</th>
                        <th style="width: 250px">Cliente</th>
                        <th style="width: 70px">Patente</th>
                        <th style="width: 150px">Nombre Conductor</th>
                        <th style="width: 150px">Empresa de Transportes</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $guias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="width:50px"><button class="btn btn-success btn-sm" style="width: 80px" onclick="registrarSalida(<?php echo e($item->tipoGuia); ?>, <?php echo e($item->numeroGuia); ?>, this.parentNode.parentNode.rowIndex)"><?php echo e($item->folioDTE); ?></button></td>
                                <td style="width: 120px"><?php echo e($item->fechaHoraCreacion); ?></td>
                                <td style="width: 50px"><?php echo e($item->idPedido); ?></td>
                                <td style="width: 100px"><?php echo e($item->nombrePlanta); ?></td>
                                <td style="width: 250px"><?php echo e($item->nombreCliente); ?></td>
                                <td style="width: 70px"><?php echo e($item->patente); ?></td>
                                <td style="width: 150px"><?php echo e($item->nombreConductor); ?></td>
                                <td style="width: 150px"><?php echo e($item->nombreEmpresaTransportes); ?></td>                               
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>            
                </table>   

            </div>
        </div>
    </div>
 
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <!-- Datepicker -->
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo e(asset('/')); ?>locales/bootstrap-datepicker.es.min.js"></script>

    <!-- Timepicker -->
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-timepicker.min.js"></script>  

    <script src="<?php echo e(asset('/')); ?>js/app/funciones.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.2.5/js/dataTables.fixedColumns.min.js"></script>

    <script>
        function reFresh(){ 
            location.reload(true)
            $("#btnRefresh").attr("disabled", true);
        }

        function registrarSalida(tipo, numero, fila){
            swal(
                {
                    title: "¿Desea confirmar la salida del pedido con guía Nº " + numero + " ?" ,
                    text: '',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm)
                {
                    if(isConfirm){
                        $.ajax({
                            url: urlApp + "registrarSalidaDespacho",
                            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                            type: 'POST',
                            dataType: 'json',
                            data: { tipoGuia: tipo,
                                    numeroGuia: numero
                                  },
                            success:function(dato){
                                document.getElementById('tablaDetalle').deleteRow(fila);
                            }
                        })                
                        return;                        
                    }

                }
            )              
          
        }        

        $(document).ready(function() {
            // Setup - add a text input to each footer cell

            $('#tablaDetalle thead tr').clone(true).appendTo( '#tablaDetalle thead' );
            $('#tablaDetalle thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                if(title.trim()!='' && title.trim()=='Planta' ){
                    $(this).html( '<select id="selPlanta" class="form-control input-sm"></select>' );                    
                }else if(title.trim()!='' ){
                    $(this).html( '<input type="text" class="form-control input-sm" placeholder="Buscar..." />' );
                    $( 'input', this ).on( 'keyup change', function () {
                        if ( table.column(i).search() !== this.value ) {
                            table
                                .column(i)
                                .search( this.value )
                                .draw();
                        }
                    } );                    
                } 
  
            } );


            // DataTable
            var table=$('#tablaDetalle').DataTable({
                 orderCellsTop: true,
                 fixedHeader: true,         
                "scrollX": true,
                "order": [[ 0, "desc" ]],
                "paging": false,             
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"},
                initComplete: function () {
                    this.api().columns(3).every( function () {
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
            });

            document.getElementById('btnRefresh').style.display="block";

        } );

    </script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>