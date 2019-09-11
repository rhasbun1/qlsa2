      

<?php $__env->startSection('contenedorprincipal'); ?>

  
<div style="padding: 20px">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b>Notas de Venta por Aprobar</b>
        </div>
        <div class="padding-md clearfix"> 
            <table id="tablaDetalle" class="table table-hover table-condensed table-responsive">
                <thead>
                    <th>Nota Venta</th>
                    <th>Cotización</th>
                    <th>Año</th>
                    <th>Fecha Creación</th>
                    <th>Cliente</th>
                    <th>Obra</th>
                    <th>Estado</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $listaNotasdeVenta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->idNotaVenta); ?></td>
                            <td><?php echo e($item->cot_numero); ?></td>
                            <td><?php echo e($item->cot_año); ?></td>
                            <td><?php echo e($item->fechahora_creacion); ?></td>
                            <td><?php echo e($item->emp_nombre); ?></td>
                            <td><?php echo e($item->Obra); ?></td>
                            <?php if($item->aprobada==1): ?>
                                <td>Aprobada</td>
                            <?php else: ?>
                                <td>Pendiente de Aprobación</td>
                            <?php endif; ?>
                            <td>
                                <a href="<?php echo e(asset('/')); ?>vernotaventa/<?php echo e($item->idNotaVenta); ?>/2/" class="btn btn-xs btn-info" style="width: 60px">Ver</a>
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
    <!-- Datatable -->
    <script src="<?php echo e(asset('/')); ?>js/jquery.dataTables.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>