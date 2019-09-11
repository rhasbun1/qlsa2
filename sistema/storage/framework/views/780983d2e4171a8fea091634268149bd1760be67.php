      

<?php $__env->startSection('contenedorprincipal'); ?>

<div style="padding: 20px">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b>Empresas de Transporte</b>
            <span class="badge badge-info pull-right"><?php echo e($listaEmpresas->count()); ?> Clientes</span>
        </div>
        <div class="padding-md clearfix">
            <table id="tabla" class="table table-hover table-condensed table-responsive" style="width: 100%">
                <thead>
                    <th>Identificador</th>
                    <th>Nombre</th>
                    <th>Rut</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Nombre Contacto</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $listaEmpresas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->idEmpresaTransporte); ?></td>
                            <td><?php echo e($item->nombre); ?></td>
                            <td><?php echo e($item->rut); ?></td>
                            <td><?php echo e($item->email); ?></td>
                            <td><?php echo e($item->telefono); ?></td>
                            <td><?php echo e($item->nombreContacto); ?></td>
                            <td>
                                <?php if( Session::get('idPerfil')=='1' or 
                                    Session::get('idPerfil')=='10' or 
                                    Session::get('idPerfil')=='5' or 
                                    Session::get('idPerfil')=='7'): ?>
                                    <a href="<?php echo e(asset('/')); ?>datosEmpresaTransporte/<?php echo e($item->idEmpresaTransporte); ?>/" class="btn btn-xs btn btn-warning" title="Editar"><i class="fa fa-edit fa-lg"></i></a>
                                <?php else: ?>
                                    <a href="<?php echo e(asset('/')); ?>datosEmpresaTransporte/<?php echo e($item->idEmpresaTransporte); ?>/" class="btn btn-xs btn btn-warning" title="Ver"><i class="fa fa-search fa-lg"></i></a>
                                <?php endif; ?>
                            </td>                                
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

    <!-- Timepicker -->
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-timepicker.min.js"></script>  

    <script src="<?php echo e(asset('/')); ?>js/app/funciones.js"></script>
    <script>

        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#tabla thead tr').clone(true).appendTo( '#tabla thead' );
            $('#tabla thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();

                if(title.trim()!='' ){
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
            var table=$('#tabla').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'Nueva Empresa',
                        action: function ( e, dt, node, config ) {
                           location.href="<?php echo e(asset('/')); ?>datosEmpresaTransporte/0/";
                        }
                    },                 
                    {
                        extend: 'excelHtml5',
                        title: 'Listado de Clientes',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'Listado de Clientes',
                        text:      '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',                         
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Listado de Clientes',
                        text:      '<i class="fa fa-file-pdf-o"></i>',
                        titleAttr: 'PDF',                          
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }
                    }
                ],                  
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
            });

        } );

    </script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>