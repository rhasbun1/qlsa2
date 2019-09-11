      

<?php $__env->startSection('contenedorprincipal'); ?>
 <!--   <div style="padding-left: 20px">
		<h4>Hola <?php echo e($nombreUsuario); ?>!</h4>
	</div>-->
<?php if( Session::get('grupoUsuario')!='CL' and Session::get('idPerfil')!='6' and Session::get('idPerfil')!='9' ): ?>	
	<div class="padding-md">
		<input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
		<?php if(Session::get('grupoUsuario')!='CL'): ?>
			<div class="row">
				<div class="col-sm-6 col-md-3">
					<a href="<?php echo e(asset('/')); ?>listarNotasdeVenta">
						<div class="panel-stat3 bg-danger">
							<h2 class="m-top-none" id="userCount"><?php echo e($datos[0]->nvSinAprobar); ?></h2>
							<h5>Notas de Venta sin Aprobar</h5>
						</div>
					</a>
				</div><!-- /.col -->
				<div class="col-sm-6 col-md-3">
					<?php if(Session::get('grupoUsuario')=='PL'): ?>
						<a href="<?php echo e(asset('/')); ?>programacion">
					<?php else: ?>
						<a href="<?php echo e(asset('/')); ?>listarPedidos">
					<?php endif; ?>		
						<div class="panel-stat3 bg-info">
							<h2 class="m-top-none"><span id="serverloadCount"><?php echo e($datos[0]->pedidosEnProceso); ?></span></h2>
							<h5>Pedidos en Proceso</h5>
						</div>
					</a>
				</div><!-- /.col -->
				<div class="col-sm-6 col-md-3">
					<div class="panel-stat3 bg-warning">
						<h2 class="m-top-none" id="orderCount">0</h2>
						<h5>Pedidos Despachados</h5>
					</div>
				</div><!-- /.col -->
				<div class="col-sm-6 col-md-3">
					<a href="<?php echo e(asset('/')); ?>programacion">
						<div class="panel-stat3 bg-success">
							<h2 class="m-top-none" id="visitorCount"><?php echo e($datos[0]->pedidosEnProcesoSinTransporte); ?></h2>
							<h5>Pedidos Sin Transporte Asignado</h5>
						</div>
					</a>
				</div><!-- /.col -->
			</div>
		<?php endif; ?>
		<div class="row" id="kanvas">
			<?php $numpedido = 0; ?>
			<?php $inicio = true; ?>
			<?php $__currentLoopData = $pedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if( $item->idEstadoPedido!='1' and $item->idEstadoPedido!='6' ): ?>
					<?php if( $numpedido!=$item->idPedido ): ?>
					    <?php if( !$inicio ): ?>
					    	</div>
					        </div>
					    <?php endif; ?>
					    <div class="col-md-4 col-sm-4 col-xs-12 col-lg-3">
						<div class="panel panel-body">
							<h4 style="display: inline"><b>Pedido Nº <?php echo e($item->idPedido); ?></b></h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     
							<h6 style="display: inline;">(h/t)&nbsp;<?php echo e($item->horasTranscurridas); ?></h6>
						<?php $inicio = false; ?>	
						<?php $numpedido = $item->idPedido; ?>	
					<?php endif; ?>
					<div style="padding-top:3px;padding-left: 5px;padding-right: 5px">
						<div class="row" style="border: 1px solid;border-color: #EBEDEF">	
							<div class="col-sm-5 col-xs-5" style="padding-top: 7px">	
								<span><?php echo e($item->prod_nombre); ?></span>
							</div>
							<div class="col-sm-7 col-xs-7">	
				                <?php if( $item->horaCarga!='' ): ?>
				                    <span><img src="<?php echo e(asset('/')); ?>img/iconos/time.png" border="0" title="<?php echo e($item->fechaCarga_dma); ?> <?php echo e($item->horaCarga); ?>"></span>
				                <?php endif; ?>
				                <?php if( $item->empresaTransporte!='' ): ?>
				                    <span><img src="<?php echo e(asset('/')); ?>img/iconos/user.png" border="0" title="<?php echo e($item->empresaTransporte); ?> / <?php echo e($item->apellidoConductor); ?>"></span>
				                <?php endif; ?>					                						
				                <?php if( $item->cantidadReal>0 ): ?>
				                    <span><img src="<?php echo e(asset('/')); ?>img/iconos/cargacompleta.png" border="0"></span>
				                <?php endif; ?>
				                <?php if( $item->numeroGuia>0 ): ?>
				                	<a target="_blank" href="<?php echo e(asset('/')); ?>bajarGuiaDespacho/<?php echo e($item->numeroGuia); ?>">
				                    	<span><img src="<?php echo e(asset('/')); ?>img/iconos/guiaDespacho2.png" border="0"></span>
				                	</a>
				                <?php endif; ?>
				                <?php if( $item->certificado!='' ): ?>  
				                    <a target="_blank" href="<?php echo e(asset('/')); ?>bajarCertificado/<?php echo e($item->certificado); ?>">
				                        <img src="<?php echo e(asset('/')); ?>img/iconos/certificado.png" border="0">
				                    </a>
				                <?php endif; ?>
	                            <?php if( $item->salida==1 ): ?>
	                            <span><img src="<?php echo e(asset('/')); ?>img/iconos/enTransporte.png" border="0" onclick="verUbicacionGmaps('<?php echo e($item->Patente); ?>');" style="cursor:pointer; cursor: hand"></span>                                      
	                            <?php endif; ?> 
				            </div>
			        	</div>
		            </div>
	            <?php endif; ?>		
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>


	</div><!-- /.padding-md -->

<?php endif; ?>
	
<?php $__env->stopSection(); ?>


<?php $__env->startSection('javascript'); ?>
<script src="<?php echo e(asset('/')); ?>js/app/funciones.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>