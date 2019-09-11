      

<?php $__env->startSection('contenedorprincipal'); ?>

<div style="padding: 5px">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <h5><b>Pedido Nº <?php echo e($pedido[0]->idPedido); ?></b></h5>
        </div>
        <div class="padding-md clearfix">
        	<div>
                <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
        		<div class="row" style="padding-top: 5px">
        			<div class="col-sm-2 col-md-2 col-lg-1">
        				Cliente
        			</div>
         			<div class="col-sm-5 col-md-4 col-lg-3">
        				<input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->emp_nombre); ?>">
        			</div>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        Fecha Creación
                    </div>
                    <div class="col-sm-3 col-md-2 col-lg-2">
                        <input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->fechahora_creacion); ?>">
                    </div> 
                    <div class="col-sm-2 col-md-2 col-lg-1">
                        N.Venta Nº
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <a href="<?php echo e(asset('/')); ?>vernotaventa/<?php echo e($pedido[0]->idNotaVenta); ?>/1/" class="btn btn-xs btn-info"><?php echo e($pedido[0]->idNotaVenta); ?></a>
                    </div>                          			
        		</div>
        		<div class="row" style="padding-top: 5px">
                    <div class="col-sm-2 col-md-1 col-lg-1">
                        Obra
                    </div>
                    <div class="col-sm-4 col-md-5 col-lg-5">
                        <input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->Obra); ?>">
                    </div>                      
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        Fecha Entrega
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->fechaEntrega); ?>">
                    </div>                    
        			<div class="col-sm-1 col-md-1 col-lg-1">
        				Horario
        			</div>
         			<div class="col-sm-1 col-md-2 col-lg-1">
        				<input class="form-control input-sm" readonly style="width: 40px" value="<?php echo e($pedido[0]->horarioEntrega); ?>">
        			</div>      			
        		</div>
        		<div class="row" style="padding-top: 5px">
        			<div class="col-sm-2 col-md-1 col-lg-1">
        				Estado
        			</div>
         			<div class="col-sm-4 col-md-2 col-lg-2">
        				<input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->estado); ?>">
        			</div>
                    <div class="col-lg-1 col-md-1 col-sm-2">
                        Ejecutivo&nbspQL
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->usuario_encargado); ?>">
                    </div>                              			     			
        		</div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-sm-2 col-md-2 col-lg-1">
                        Observaciones
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->observaciones); ?>">
                    </div>
                    <?php if($pedido[0]->noExcederCantidadSolicitada==1): ?>
                        <div class="col-sm-5 col-md-5 col-lg-4">
                            <h4><span class="label label-danger">NO EXCEDER LA CANTIDAD SOLICITADA</span></h4>
                        </div>
                    <?php endif; ?>                     
                </div>                      		  		
        	</div>

        </div>
        <div style="padding: 20px">
            <table id="tablaDetalle" class="table table-hover table-condensed table-responsive">
                <thead>
                    <th style="display: none">Codigo</th>
                    <th>Producto</th>
                    <th style="width: 80px">Diseño</th>
                    <th style="width: 50px">Cant.</th>
                    <th>Unidad</th>
                    <th>Precio ($) <b>*</b></th>
                    <th>Total ($)</th>
                    <th>Planta de Origen</th>
                    <th>Entrega</th>
                    <th>Transporte</th>
                    <th>Camion</th>
                    <th>Conductor</th>
                    <th style="text-align: center;">Fecha Hora Carga<br>Programada</th>
                </thead>
            
                <tbody>
                    <?php $__currentLoopData = $listaDetallePedido; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="display: none"> 
                            <?php echo e($item->prod_codigo); ?>                         
                        </td>
                        <td>
                            <?php echo e($item->prod_nombre); ?>

                            <?php if( $item->certificado==1 ): ?>  
                                <a target="_blank" href="<?php echo e(asset('/')); ?>bajarCertificado/<?php echo e($item->certificado); ?>">
                                    <img src="<?php echo e(asset('/')); ?>img/iconos/certificado.png" border="0">
                                </a>
                            <?php endif; ?>
                            <?php if($item->modificado>0): ?>
                                <span class="badge badge-primary" title="Nº de modificaciones"><?php echo e($item->modificado); ?></span>
                            <?php endif; ?>                                            
                            <?php if($item->tipoTransporte==2): ?>
                                <span class="badge badge-danger" title="Pedido Mixto">M</span>
                            <?php endif; ?>                            
                            <?php if( $item->formula!='' ): ?>
                                <span><img src="<?php echo e(asset('/')); ?>img/iconos/matraz.png" border="0" title="<?php echo e($item->formula); ?>" width="15px" height="15pxs"></span>
                            <?php endif; ?>                            
                            <?php if( $item->cantidadReal > 0 ): ?>
                                <span><img src="<?php echo e(asset('/')); ?>img/iconos/cargacompleta.png" border="0"></span>
                            <?php endif; ?>
                            <?php if( $item->horaCarga!='' ): ?>
                                <span><img src="<?php echo e(asset('/')); ?>img/iconos/time.png" border="0" title="<?php echo e($item->fechaCarga_dma); ?> <?php echo e($item->horaCarga); ?>"></span>
                            <?php endif; ?>
                            <?php if( $item->nombreEmpresaTransporte!='' ): ?>
                                <span><img src="<?php echo e(asset('/')); ?>img/iconos/user.png" border="0" title="<?php echo e($item->nombreEmpresaTransporte); ?> / <?php echo e($item->apellidoConductor); ?>"></span>
                            <?php endif; ?>                            
                            <?php if( $item->numeroGuia>0 ): ?>
                                <span onclick='abrirGuia(1, <?php echo e($item->numeroGuia); ?>, this.parentNode.parentNode);' style="cursor:pointer; cursor: hand"><img src="<?php echo e(asset('/')); ?>img/iconos/guiaDespacho2.png" border="0"></span>                               
                            <?php endif; ?> 
                            <?php if( $item->salida==1 ): ?>
                                <span><img src="<?php echo e(asset('/')); ?>img/iconos/enTransporte.png" border="0" onclick="verUbicacionGmaps('<?php echo e($item->patente); ?>');" style="cursor:pointer; cursor: hand"></span>                                      
                            <?php endif; ?>                             
                        </td>
                        <td><?php echo e($item->formula); ?></td>
                        <td style="width:50px"><?php echo e($item->cantidad); ?></td>   
                        <td> <?php echo e($item->u_nombre); ?> </td>
                        <?php if( Session::get('grupoUsuario')=='C' or Session::get('grupoUsuario')=='CL' ): ?>   
                            <td align="right"><?php echo e(number_format( $item->cp_precio, 0, ',', '.' )); ?></td>
                            <td align="right"><?php echo e(number_format( $item->cp_precio * $item->cantidad , 0, ',', '.' )); ?></td>
                        <?php endif; ?>    
                        <td> <?php echo e($item->nombrePlanta); ?> </td>
                        <td> <?php echo e($item->nombreFormaEntrega); ?> </td>
                        <td> <?php echo e($item->nombreEmpresaTransporte); ?> </td>
                        <td> <?php echo e($item->patente); ?> </td>
                        <td> <?php echo e($item->nombreConductor); ?> </td>
                        <td> <?php echo e($item->fechaCarga); ?> <?php echo e($item->horaCarga); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot> 
                    <?php if($pedido[0]->cantidadFleteFalso>0): ?>
                        <tr>
                            <td>Flete Falso</td>
                            <td></td>
                            <td><?php echo e($pedido[0]->cantidadFleteFalso); ?></td>
                            <td>tonelada</td>
                            <td align="right"><?php echo e(number_format($pedido[0]->valorFleteFalso, 0, ',', '.' )); ?></td>
                            <td align="right"><?php echo e(number_format( $pedido[0]->valorFleteFalso*$pedido[0]->cantidadFleteFalso, 0, ',', '.' )); ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>           
                        </tr>
                    <?php endif; ?>                       
                    <?php if( Session::get('idPerfil')=='14' || Session::get('idPerfil')=='15' ): ?>   
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="right"><b>Neto $</b></td>
                            <td align="right"><b><?php echo e(number_format( $pedido[0]->totalNeto, 0, ',', '.' )); ?> </b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="right"><b>Iva $</b></td>
                            <td align="right"><b><?php echo e(number_format( $pedido[0]->montoIva, 0, ',', '.' )); ?> </b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="right"><b>Total $</b></td>
                            <td align="right"><b><?php echo e(number_format( $pedido[0]->totalNeto + $pedido[0]->montoIva, 0, ',', '.' )); ?> </b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr> 
                    <?php endif; ?>                     
                </tfoot>
            </table>
        </div> 

        <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
            <a href="<?php echo e(asset('/')); ?>clientePedidos" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>                                    
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
    <script src="<?php echo e(asset('/')); ?>js/app/verpedido.js"></script>
    <!-- Datatable -->
    <script src="<?php echo e(asset('/')); ?>js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // Datepicker      
            $('.date').datepicker({
                todayHighlight: true,
                format: "dd/mm/yyyy",
                weekStart: 1,
                language: "es",
                autoclose: true,
                startDate: '+0d'
            }) 
            cargarListas();
        });         
    </script>
       
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>