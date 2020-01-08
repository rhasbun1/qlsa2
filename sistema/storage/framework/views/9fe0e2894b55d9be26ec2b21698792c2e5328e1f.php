      

<?php $__env->startSection('contenedorprincipal'); ?>
	<div class="padding-md">
		<input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
		<div style="padding:20px">
			<h3><?php echo e($datosUsuario[0]->nombreUsuario); ?></h3><br>
			<div class="row" style="padding:3px">
				<div class="col-md-2">
					Correo
				</div>
				<div class="col-md-3 col-lg-2">
					<input class="form-control input-sm" id="correlativoGuias" value="<?php echo e($datosUsuario[0]->usu_correo); ?>">
				</div>
			</div>
			<br>
			<b>Indique que notificaciones desea recibir por correo:</b>
			<br>
			<div style="padding-top: 20px">
				<label style="width:120px">Aviso de Despacho</label>
				<?php if($datosUsuario[0]->avisoDespacho==1): ?>
					<input type="checkbox" class="chk" id="despacho" checked>
				<?php else: ?>
					<input type="checkbox" class="chk" id="despacho" >
				<?php endif; ?>
				<span class="custom-checkbox"></span> 
			</div>
			<div style="padding-top: 10px">
				<label style="width:120px">Novedades</label>
				<?php if($datosUsuario[0]->novedades==1): ?>
					<input type="checkbox" class="chk" id="novedades" checked>
				<?php else: ?>
					<input type="checkbox" class="chk" id="novedades">
				<?php endif; ?>
				<span class="custom-checkbox"></span> 
			</div>
			<br>
			<button id="grabar" class="btn btn-sm btn-success" onclick="grabarCambios();">Grabar Cambios</button>
		</div>
	</div><!-- /.padding-md -->
<?php $__env->stopSection(); ?>


<?php $__env->startSection('javascript'); ?>

<script src="<?php echo e(asset('/')); ?>js/app/funciones.js"></script>
<script>

	function grabarCambios(){
			var avisoDespacho=0;
			var avisoNovedades=0;

			if(despacho.checked){
				avisoDespacho=1;
			}
			if(novedades.checked){
				avisoNovedades=1;
			}

            $.ajax({
                url: urlApp + "usuarioAvisosCorreo",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        despacho: avisoDespacho,
                        novedades: avisoNovedades
                      },
                success:function(dato){
                    swal(
                        {
                            title: 'Los cambios han sido grabados!',
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