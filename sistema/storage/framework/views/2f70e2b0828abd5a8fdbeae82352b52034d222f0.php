      

<?php $__env->startSection('contenedorprincipal'); ?>

<div style="padding: 20px">
    <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b>Obras y Plantas (Clientes)</b>
            <span class="badge badge-info pull-right"><?php echo e(count($listaObras)); ?> Obras</span>
        </div>
        <div class="padding-md clearfix"> 
            <table id="tabla" class="table table-hover table-condensed table-responsive" style="width:100%">
                <thead>
                    <th>Nombre Obra</th>
                    <th>Cliente</th>
                    <th>Nombre Contacto</th>
                    <th style="width: 40px"></th>
                </thead> 
                <tbody>
                    <?php $__currentLoopData = $listaObras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->nombreObra); ?></td>
                            <td><?php echo e($item->nombreCliente); ?></td>
                            <td><?php echo e($item->nombreContacto); ?></td>
                            <td style="width: 40px">
                                <button class="btn btn-xs btn btn-warning" onclick="editarObra( <?php echo e($item->idObra); ?>, this.parentNode.parentNode )" title="Editar" ><i class="fa fa-edit fa-lg"></i></button>
                                <button class="btn btn-xs btn btn-danger"  onclick="eliminarObra( <?php echo e($item->idObra); ?>, this.parentNode.parentNode )" title="Eliminar" ><i class="fa fa-trash-o fa-lg"></i></button>
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


        <div id="mdNuevaObra" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5><b>Nueva Obra/Planta</b></h5>
                </div>
                <div id="bodyCajaEliminaBodega" class="modal-body">
                    <input type="hidden" id="idObra">
                    <input type="hidden" id="filaObra">                    
                    <div class="row">
                        <div class="col-md-1">
                            Cliente
                        </div>
                        <div class="col-md-4">
                            <select id="idCliente" class="form-control input-sm">
                                <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->emp_codigo); ?>"><?php echo e($item->emp_nombre); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>                            
                        </div>
                        <div class="col-md-2">
                            Nombre Obra/Planta(*)
                        </div>
                        <div class="col-md-5">
                            <input type="text" id="txtNombreObra" class="form-control input-sm" maxlength="50">
                        </div>
                    </div>
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Nombre Contacto (*)
                        </div>
                        <div class="col-sm-5">
                            <input type="text" id="txtNombreContactoObra" class="form-control input-sm" maxlength="50">
                        </div>
                        <div class="col-sm-1">
                            Email
                        </div>
                        <div class="col-sm-4">
                            <input type="text" id="txtCorreoContactoObra" class="form-control input-sm" maxlength="80">
                        </div>
                    </div>
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Teléfono/Movil (*)
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="txtTelefonoObra" class="form-control input-sm" maxlength="30">
                        </div>
                    </div>               
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Descripción
                        </div>
                        <div class="col-md-10">
                            <textarea id="txtDescripcionObra" class="form-control input-sm" maxlength="255" rows="3"></textarea>
                        </div>
                    </div> 
                    <div class="row" style="padding: 15px">
                        <table id="tabDistancias" class="table table-hover table-condensed table-responsive">
                            <thead>
                                <th style="width: 200px">Planta QLSA</th>
                                <th style="width: 200px">Tiempo Traslado</th>
                            </thead>
                            <tbody></tbody>
                        </table>                                    
                    </div> 
                </div>        
                <div style="padding-left: 15px; padding-top: 5px">
                    <h5><b> (*) Dato Obligatorio</b></h5>
                </div>
                <div class="col-md-offset-8" style="padding-top: 20px; padding-bottom: 20px">
                   <button id="btnAgregarObra" type="button" class="btn btn-success btn-sm" onclick="agregarNuevaObra();" style="width: 80px">Crear</button>
                   <button id="btnCerrarCajaBodega" type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarNuevaObra()" style="width: 80px">Salir</button>
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
    <script src="<?php echo e(asset('/')); ?>js/app/listadeObras.js"></script>
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
                        text: 'Nueva Obra',
                        action: function ( e, dt, node, config ) {
                            nuevaObra(1);
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