      

<?php $__env->startSection('contenedorprincipal'); ?>

<script>
    function aprobarPedido(idPedido, fila){
        return;
        $.ajax({
            url: urlApp + "aprobarPedido",
            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
            type: 'POST',
            dataType: 'json',
            data: { idPedido: idPedido
                  },
            success:function(dato){
                var tabla=document.getElementById('tablaDetalle');
                tabla.rows[fila].cells[6].innerHTML="Aprobado";
                tabla.rows[fila].cells[7].getElementsByTagName('button')[0].style.visibility = 'hidden';
            }
        })
    }
</script>

<div style="padding: 5px">
    <div class="panel panel-default table-responsive">
        <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <b>PEDIDOS INGRESADOS POR CLIENTE EN ESPERA DE PRE-APROBACION</b>
                </div>   
        </div>
        <div class="padding-md clearfix">
            <div style="padding-bottom: 15px">  
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-2">
                        Filtrar por Fecha de Entrega
                    </div>
                    <div class="col-md-2">
                        <div class="input-group date" id="divFechaMin">
                            <input type="text" class="form-control input-sm" id="min">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group date" id="divFechaMax">
                            <input type="text" class="form-control input-sm" id="max">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

            <table id="tablaDetalle" class="table table-hover table-condensed table-responsive">
                <thead>
                    <th>Pedido Nº</th>
                    <th style="width: 30px"></th>
                    <th>Fecha Creación</th>
                    <th>Cliente</th>
                    <th>Obra/Planta</th>
                    <?php if( Session::get('idPerfil')=='11' ): ?>
                        <th><b>Total c/IVA</b></th>
                    <?php else: ?>
                        <th style="display: none"><b>Total c/IVA</b></th>
                    <?php endif; ?>    
                    <th>Fecha Entrega</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th width="70px"></th>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $pedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->idPedido); ?></td>
                            <td style="width: 30px">
                                <?php if($item->tipoTransporte==2): ?>
                                    <span class="badge badge-danger">M</span>
                                <?php endif; ?>
                            </td>                         
                            <td><?php echo e($item->fechahora_creacion); ?></td>
                            <td><?php echo e($item->emp_nombre); ?></td>
                            <td><?php echo e($item->Obra); ?></td>
                            <?php if( Session::get('idPerfil')=='11' ): ?>
                                <td align="right"><b>$ <?php echo e(number_format( $item->totalNeto + $item->montoIva, 0, ',', '.' )); ?></b></td>
                            <?php else: ?>
                                <td align="right" style="display: none"><b>$ <?php echo e(number_format( $item->totalNeto + $item->montoIva, 0, ',', '.' )); ?></b></td>
                            <?php endif; ?>    
                            <td><?php echo e($item->fechaEntrega); ?></td>
                            <td><?php echo e($item->prod_nombre); ?></td>
                            <td><?php echo e(number_format( $item->cantidad, 0, ',', '.' )); ?></td>
                            <td>
                                <a href="<?php echo e(asset('/')); ?>verpedido/<?php echo e($item->idPedido); ?>/6/" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-zoom-in"></span></a>
                            </td>
                            
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>            
            </table>      
        </div>
    </div>
    <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
        <a href="<?php echo e(asset('/')); ?>listarPedidos" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
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

    <script>

        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#tablaDetalle thead tr').clone(true).appendTo( '#tablaDetalle thead' );
            $('#tablaDetalle thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();

                if(title.trim()!='' && title.trim()!='Estado' ){
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


            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {

                    var min = fechaIngles( $('#min').val().trim() );
                    var max = fechaIngles( $('#max').val().trim() );

                    var startDate=fechaIngles(data[6].substr(0,10));
                    if (min == '' && max == '') { return true; }
                    if (min == '' && startDate <= max) { return true;}
                    if(max == '' && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );



            // DataTable
            var table=$('#tablaDetalle').DataTable({
                autoWidth: false,
                orderCellsTop: true,
                fixedHeader: true,                
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Pedidos en Proceso',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'Pedidos en Proceso',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Pedidos en Proceso',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                        }
                    }
                ],                
                "order": [[ 0, "desc" ]],
                columnDefs: [
                    { width: 75, targets: 0 },
                    { width: 100, targets: 1 },
                    { width: 200, targets: 2 },
                    { width: 100, targets: 4 },
                    { width: 100, targets: 5 }
                ],                
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"},
                initComplete: function () {
                    this.api().columns(6).every( function () {
                        var column = this;

                        var select = $('<select class="form-control input-sm" style="width:100px"><option value=""></option></select>')
                            .appendTo( $( '#tablaDetalle thead tr:eq(1) th:eq(6)' ).empty() )
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

            $('.date').datepicker({
                todayHighlight: true,
                format: "dd/mm/yyyy",
                weekStart: 1,
                language: "es",
                autoclose: true
            }) 


            //$("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            //$("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });

            // Event listener to the two range filtering inputs to redraw on input
            $('#min, #max').change(function () {
                table.draw();
            });            

        } );

    </script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>