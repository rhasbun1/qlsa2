      

<?php $__env->startSection('contenedorprincipal'); ?>

<div style="padding: 5px">

    <div class="panel panel-default" id="contenedor3">
        <div class="panel-heading">
            <div class="panel-tab clearfix">
                <ul class="tab-bar">
                    <li class="active"><a href="#tabAprobados" data-toggle="tab"><b>Pedidos Ingresados Aprobados</b></a></li> 
                </ul>
            </div>
        </div> 
        <div class="panel-body">
            <div class="tab-content clearfix">
                <div class="tab-pane active" id="tabAprobados" style="padding-top: 5px">
                    <table id="tablaAprobados" class="pedidos table table-hover table-condensed" style="width:100%">
                        <thead>
                            <th style="width:150px">Pedido</th>
                            <th style="width:80px">Estado</th>
                            <th>Fecha Creación</th>
                            <th>Cliente</th>
                            <th>Obra/Planta</th>
                            <th>Producto</th>
                            <th style="text-align: right">Cantidad</th>
                            <th>Planta Origen</th>
                            <th>Forma Entrega</th>
                            <th>Fecha Entrega</th>
                            <th>Transporte</th>
                            <th>Fecha Carga</th>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $pedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="width:150px">
                                        <a href="<?php echo e(asset('/')); ?>clienteVerPedido/<?php echo e($item->idPedido); ?>/7/" class="btn btn-xs btn-success"><?php echo e($item->idPedido); ?></a>
                                        <?php if( $item->cantidadReal>0 ): ?>
                                            <span><img src="<?php echo e(asset('/')); ?>img/iconos/cargacompleta.png" border="0"></span>
                                        <?php endif; ?>
                                        <?php if( $item->numeroGuia>0 ): ?>
                                            <span><img src="<?php echo e(asset('/')); ?>img/iconos/guiaDespacho2.png" border="0" onclick="abrirModalGuia('<?php echo e($item->numeroGuia); ?>');" style="cursor:pointer; cursor: hand"></span>
                                        <?php endif; ?>    
                                        <?php if( $item->certificado==1 ): ?>  
                                            <span><img src="<?php echo e(asset('/')); ?>img/iconos/certificado.png" border="0"></span>
                                        <?php endif; ?>
                                        <?php if( $item->salida==1 ): ?>
                                        <span><img src="<?php echo e(asset('/')); ?>img/iconos/enTransporte.png" border="0" onclick="verUbicacionGmaps('<?php echo e($item->Patente); ?>');" style="cursor:pointer; cursor: hand"></span>                                      
                                        <?php endif; ?>                                         
                                    </td>                                        
                                    <td style="width:80px"><?php echo e($item->estadoPedido); ?></td>
                                    <td><?php echo e($item->fechahora_creacion); ?></td>
                                    <td><?php echo e($item->nombreCliente); ?></td>
                                    <td><?php echo e($item->nombreObra); ?></td>
                                    <td><?php echo e($item->prod_nombre); ?></td>
                                    <td style="text-align: right"><?php echo e($item->cantidad); ?></td>
                                    <td><?php echo e($item->nombrePlanta); ?></td>
                                    <td><?php echo e($item->formaEntrega); ?></td>
                                    <td><?php echo e($item->fechaEntrega); ?> <?php echo e($item->horarioEntrega); ?></td>
                                    <td><?php echo e($item->apellidoConductor); ?> / <?php echo e($item->empresaTransporte); ?></td>
                                    <td><?php echo e($item->fechaCarga); ?> <?php echo e($item->horaCarga); ?> </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>            
                    </table>
                </div>
            </div>
        </div>
    </div>
   
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>

    
    
    <script src="https://cdn.datatables.net/fixedcolumns/3.2.5/js/dataTables.fixedColumns.min.js"></script>

    <script>
        
        $(document).ready(function() {
            // Setup - add a text input to each footer cell

            // DataTable

            // Setup - add a text input to each footer cell
            $('#tablaAprobados thead tr').clone(true).appendTo( '#tablaAprobados thead' );
            $('#tablaAprobados thead tr:eq(1) th').each( function (i) {
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

                        
            var table=$('#tablaAprobados').DataTable({
                 orderCellsTop: true,
                 fixedHeader: true,         
                "lengthMenu": [[6, 12, 20, -1], ["6", "12", "20", "Todos"]],
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'Nuevo Pedido',
                        className: 'orange',
                        attr:  {
                                    id: 'btnNuevoPedido'
                                },
                        action: function ( e, dt, node, config ) {
                                location.href="<?php echo e(asset('/')); ?>clienteNotasdeVenta";
                            }
                    },
                    'pageLength',
                    {
                        extend: 'excelHtml5',
                        title: 'Notas de Venta Vigentes',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'Notas de Venta Vigentes',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Notas de Venta Vigentes',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    }
                ],                       
                "order": [[ 0, "desc" ]],                        
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"},
                initComplete: function () {
                    this.api().columns(1).every( function () {
                        var column = this;

                        var select = $('<select class="form-control input-sm"><option value=""></option></select>')
                            .appendTo( $( '#tablaAprobados thead tr:eq(1) th:eq(1)' ).empty() )
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
                    this.api().columns(4).every( function () {
                        var column = this;

                        var select = $('<select class="form-control input-sm"><option value=""></option></select>')
                            .appendTo( $( '#tablaAprobados thead tr:eq(1) th:eq(4)' ).empty() )
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
                    this.api().columns(7).every( function () {
                        var column = this;

                        var select = $('<select class="form-control input-sm"><option value=""></option></select>')
                            .appendTo( $( '#tablaAprobados thead tr:eq(1) th:eq(7)' ).empty() )
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
                    this.api().columns(8).every( function () {
                        var column = this;

                        var select = $('<select class="form-control input-sm"><option value=""></option></select>')
                            .appendTo( $( '#tablaAprobados thead tr:eq(1) th:eq(8)' ).empty() )
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




          

        } );


    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>