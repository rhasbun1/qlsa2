      

<?php $__env->startSection('contenedorprincipal'); ?>


<div style="padding: 5px">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-2">
                    <h5><b>Pedido Nº <?php echo e($pedido[0]->idPedido); ?></b></h5>
                </div>
                <input type="hidden" id="tipoTransporte" value="<?php echo e($pedido[0]->tipoTransporte); ?>">
                <input type="hidden" id="tipoCarga" value="<?php echo e($pedido[0]->tipoCarga); ?>">
            </div>             
        </div>
        <div class="padding-md clearfix">
        	<div>
                <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
                <input type="hidden" id="idPedido" name="_token" value="<?php echo e($pedido[0]->idPedido); ?>">
        		<div class="row" style="padding-top: 5px">
        			<div class="col-lg-1 col-md-1 col-sm-1">
        				Cliente
        			</div>
         			<div class="col-lg-3 col-md-3 col-sm-5">
        				<input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->emp_nombre); ?>">
        			</div>
                    <div class="col-lg-1 col-md-1 col-sm-2">
                        Creación
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->fechahora_creacion); ?>">
                    </div> 
                    <div class="col-lg-1 col-md-1 col-sm-1">
                        N.Venta 
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-3">
                        <?php if( Session::get('grupoUsuario')!='CL' or Session::get('idPerfil')=='6' ): ?> 
                            <a class="btn btn-success btn-sm" style="width: 100%" href="<?php echo e(asset('/')); ?>vernotaventa/<?php echo e($pedido[0]->idNotaVenta); ?>/2/"><?php echo e($pedido[0]->idNotaVenta); ?></a>
                        <?php else: ?>
                            <input class="form-control input-sm" value="<?php echo e($pedido[0]->idNotaVenta); ?>" readonly style="text-align: center;">
                        <?php endif; ?>    
                    </div>                          			
        		</div>
        		<div class="row" style="padding-top: 5px">
                    <div class="col-lg-1 col-md-1 col-sm-1">
                        Obra
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-5">
                        <input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->Obra); ?>">
                    </div>                      
                    <div class="col-lg-1 col-md-1 col-sm-2">
                        Fecha&nbspEntrega
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4">
                        <input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->fechaEntrega); ?> <?php echo e($pedido[0]->horarioEntrega); ?>">
   			        </div>
                    <div class="col-lg-1 col-md-1 col-sm-2">
                        Ejecutivo&nbspQL
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->usuario_encargado); ?>">
                    </div>                       
        		</div>
        		<div class="row" style="padding-top: 5px">
        			<div class="col-lg-1 col-md-1 col-sm-1">
        				Estado
        			</div>
         			<div class="col-lg-2 col-md-2 col-sm-3">
        				<input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->estado); ?>">
        			</div>
                    <div class="col-lg-1 col-md-2 col-sm-2">
                        Observaciones
                    </div>
                    <div class="col-lg-8 col-md-7 col-sm-6">
                        <input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->observaciones); ?>">
                    </div>                          			     			
        		</div>
                                  		  		
        	</div>
            <div style="text-align: right;">
                    <?php if($pedido[0]->noExcederCantidadSolicitada==1): ?>
                            <h4><span class="label label-danger">NO EXCEDER LA CANTIDAD SOLICITADA</span></h4>
                    <?php endif; ?>
            </div>
        </div>

        <div style="padding-top: 0px; padding-left: 20px; padding-bottom: 5px; padding-right: 10px">
            <table id="tablaDetalle" class="table table-hover table-condensed" style="width: 100%">
                <thead>
                    <th style="display: none">Codigo</th>
                    <th style="width:100px">Producto</th>
                    <th style="width:30px; text-align: right;">Cantidad<br>Solicitada</th>
                    <th style="width:40px">Unidad</th>
                    <th style="width:100px">Planta de Origen</th>
                    <th style="width:70px">Entrega</th>
                    <th style="width:70px">Transporte</th>
                    <th style="width:70px">Camion</th>
                    <th style="width:70px">Conductor</th>
                    <th style="width:70px">Fecha prog. Carga</th>
                    <th style="width:70px">Hora prog. Carga</th>
                    <th style="width:70px">Select./<br>Guia</th> 
                </thead>
            
                <tbody>
                    <?php $productosSinGuia = 0; ?>
                    <?php $ln = 1; ?>
                    <?php $__currentLoopData = $listaDetallePedido; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="display: none">
                            <?php echo e($item->prod_codigo); ?>

                        </td>
                        <td style="width:100px" data-guia="<?php echo e($item->numeroGuia); ?>" dato-existelistaprecios="<?php echo e($item->existeEnListaPrecios); ?>">
                            <?php echo e($item->prod_nombre); ?>

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
                            <?php if( $item->certificado==1 ): ?>  
                                <a target="_blank" href="<?php echo e(asset('/')); ?>bajarCertificado/<?php echo e($item->certificado); ?>">
                                    <img src="<?php echo e(asset('/')); ?>img/iconos/certificado.png" border="0">
                                </a>                                
                            <?php endif; ?>
                             <?php if( $item->numeroGuia>0 ): ?>
                                <span onclick='abrirGuia(1, <?php echo e($item->numeroGuia); ?>, this.parentNode.parentNode);' style="cursor:pointer; cursor: hand">
                                    <img src="<?php echo e(asset('/')); ?>img/iconos/guiaDespacho2.png" border="0">
                                </span>                                
                            <?php endif; ?> 
                            <?php if( $item->salida==1 ): ?>
                            <span><img src="<?php echo e(asset('/')); ?>img/iconos/enTransporte.png" border="0" onclick="verUbicacionGmaps('<?php echo e($item->patente); ?>');" style="cursor:pointer; cursor: hand"></span>                                      
                            <?php endif; ?>                              
                        </td>
                        <td style="width:30px; text-align: right;"> <?php echo e($item->cantidad); ?> </td>
                        <td style="width:40px"> <?php echo e($item->u_nombre); ?> </td>
                        <td style="width:100px">
                            <select id="idPlanta" class="form-control input-sm">  
                                <?php $__currentLoopData = $plantas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if( $item->nombrePlanta==$planta->nombre ): ?>
                                        <option value="<?php echo e($planta->idPlanta); ?>" selected><?php echo e($planta->nombre); ?></option>
                                    <?php else: ?>
                                        <option value="<?php echo e($planta->idPlanta); ?>"><?php echo e($planta->nombre); ?></option>
                                    <?php endif; ?>    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </td>
                        <td style="width:70px"> <?php echo e($item->nombreFormaEntrega); ?> </td>
                        <?php if(  $item->numeroGuia==0 ): ?>
                            <?php $productosSinGuia+=1; ?>
                            <td style="width:70px">
                                <?php if( $item->nombreFormaEntrega !='Retira' ): ?>
                                    <?php if(($pedido[0]->tipoTransporte==2 and $ln==1) or $pedido[0]->tipoTransporte==1): ?>
                                        <select id="idEmpresaTransporte" class="form-control input-sm" onchange="cargarListas(this.value, this.parentNode.parentNode.rowIndex);" <?php if(Session::get('idPerfil')=='7' or Session::get('idPerfil')=='8'): ?> disabled <?php endif; ?> >
                                          <option value="0"></option>  
                                          <?php $__currentLoopData = $emptransporte; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empresa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if( $empresa->idEmpresaTransporte == $item->idEmpresaTransporte): ?> then
                                                <option value="<?php echo e($empresa->idEmpresaTransporte); ?>" selected><?php echo e($empresa->nombre); ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo e($empresa->idEmpresaTransporte); ?>"><?php echo e($empresa->nombre); ?></option>
                                            <?php endif; ?>    
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
                                        </select>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <input class="form-control input-sm" maxlength="100" value="<?php echo e($item->nombreEmpresaTransporte); ?>">        
                                <?php endif; ?>                              
                            </td>
                            <td style="width:70px">
                                <?php if( $item->nombreFormaEntrega !='Retira' ): ?>
                                    <?php if(($pedido[0]->tipoTransporte==2 and $ln==1) or $pedido[0]->tipoTransporte==1): ?>
                                        <select id="idCamion" class="form-control input-sm" <?php if(Session::get('idPerfil')=='7' or Session::get('idPerfil')=='8'): ?> disabled <?php endif; ?> >
                                            <option value="<?php echo e($item->idCamion); ?>" selected><?php echo e($item->patente); ?></option>
                                        </select>
                                    <?php endif; ?>
                                <?php else: ?>
                                     <input class="form-control input-sm" maxlength="20" value="<?php echo e($item->patente); ?>">       
                                <?php endif; ?>                                 
                            </td>

                            <td style="width:70px">
                                <?php if( $item->nombreFormaEntrega !='Retira' ): ?>
                                    <?php if(($pedido[0]->tipoTransporte==2 and $ln==1) or $pedido[0]->tipoTransporte==1): ?>
                                        <select id="idConductor" class="form-control input-sm" <?php if(Session::get('idPerfil')=='7' or Session::get('idPerfil')=='8'): ?> disabled <?php endif; ?>>
                                            <option value="<?php echo e($item->idConductor); ?>" selected><?php echo e($item->nombreConductor); ?></option>
                                        </select>
                                    <?php endif; ?>
                                <?php else: ?>
                                   <input class="form-control input-sm" maxlength="100"  value="<?php echo e($item->nombreConductor); ?>">      
                                <?php endif; ?>                               
                            </td>

                            <?php if( Session::get('idPerfil')=='5' or Session::get('idPerfil')=='6'  ): ?>

                                <td style="width:70px">
                                    <?php if(($pedido[0]->tipoTransporte==2 and $ln==1) or $pedido[0]->tipoTransporte==1): ?>
                                        <input type="text" class="form-control input-sm date" id="fechaEntrega" value="<?php echo e($item->fechaCarga); ?>">
                                    <?php endif; ?>    
                                </td>
                                <td style="width:70px">
                                    <?php if(($pedido[0]->tipoTransporte==2 and $ln==1) or $pedido[0]->tipoTransporte==1): ?>
                                        <input id="horaEntrega" type="text" class="form-control input-sm bootstrap-timepicker" value="<?php echo e($item->horaCarga); ?>">
                                    <?php endif; ?>
                                </td>
                            <?php elseif( Session::get('idPerfil')=='7' or Session::get('idPerfil')=='8' or Session::get('idPerfil')=='10'  ): ?>
                                <td style="width:70px">
                                    <?php if(($pedido[0]->tipoTransporte==2 and $ln==1) or $pedido[0]->tipoTransporte==1): ?>
                                        <input type="text" class="form-control input-sm" id="fechaEntrega" value="<?php echo e($item->fechaCarga); ?>" readonly>
                                    <?php endif; ?>
                                </td>
                                <td style="width:70px">
                                    <?php if(($pedido[0]->tipoTransporte==2 and $ln==1) or $pedido[0]->tipoTransporte==1): ?>
                                        <input id="horaEntrega" type="text" class="form-control input-sm" value="<?php echo e($item->horaCarga); ?>" readonly>
                                    <?php endif; ?>
                                </td>                            
                            <?php else: ?>
                                <td style="display: none;">
                                    <?php if(($pedido[0]->tipoTransporte==2 and $ln==1) or $pedido[0]->tipoTransporte==1): ?>
                                        <input type="text" class="form-control input-sm date" id="fechaEntrega" value="<?php echo e($item->fechaCarga); ?>">
                                    <?php endif; ?>

                                </td>
                                <td style="display: none;">
                                    <?php if(($pedido[0]->tipoTransporte==2 and $ln==1) or $pedido[0]->tipoTransporte==1): ?>
                                        <input id="horaEntrega" type="text" class="form-control input-sm bootstrap-timepicker" value="<?php echo e($item->horaCarga); ?>">
                                    <?php endif; ?>
                                </td>                        
                            <?php endif; ?>    

                            <td>
                                <?php if( $item->numeroGuia==0 ): ?>
                                    <?php if( $item->existeEnListaPrecios ): ?>
                                        <?php if( (Session::get('idPerfil')=='5' or Session::get('idPerfil')=='6' or Session::get('idPerfil')=='7') and
                                            (($pedido[0]->tipoTransporte==2 and $ln==1) or $pedido[0]->tipoTransporte==1) ): ?>
                                            <label class="label-checkbox" style="display: inline;"><input type="checkbox"><span class="custom-checkbox"></span></label>
                                        <?php else: ?>
                                            <label class="label-checkbox" style="display: none;"><input type="checkbox"><span class="custom-checkbox"></span></label>    
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <p style="color:#FF0000";><b>No existe en lista de precios</b></p>
                                    <?php endif; ?>    
                                <?php endif; ?>                                
                            </td>

                        <?php else: ?>    

                            <td style="width:70px"><?php echo e($item->nombreEmpresaTransporte); ?></td>
                            <td style="width:70px"><?php echo e($item->patente); ?></td>
                            <td style="width:70px"><?php echo e($item->nombreConductor); ?></td>
                             <?php if( Session::get('idPerfil')=='5' or Session::get('idPerfil')=='6'  ): ?>
                                <td style="width:70px"><?php echo e($item->fechaCarga); ?></td>
                                <td style="width:70px"><?php echo e($item->horaCarga); ?></td>
                            <?php elseif( Session::get('idPerfil')=='7' or Session::get('idPerfil')=='8' or Session::get('idPerfil')=='10'  ): ?>
                                <td style="width:70px"><?php echo e($item->fechaCarga); ?></td>
                                <td style="width:70px"><?php echo e($item->horaCarga); ?></td>                           
                            <?php else: ?>
                                <td style="display: none;"><?php echo e($item->fechaCarga); ?></td>
                                <td style="display: none;"><?php echo e($item->horaCarga); ?></td>                     
                            <?php endif; ?>    
                            <td></td>
                        <?php endif; ?>    

                    </tr>
                    <?php $ln+=1; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div> 

        <div style="padding-top:10px; padding-bottom: 20px;padding-left: 20px">
            <?php if( Session::get('idPerfil')!='8' and $productosSinGuia>0 ): ?>
            <button class="btn btn-sm btn-primary" style="width:80px" onclick="guardarDatosProgramacion( <?php echo e($pedido[0]->idPedido); ?> , 1);">Guardar</button>
            <?php endif; ?>
            <a href="<?php echo e(asset('/')); ?>programacion" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
            <?php if( (Session::get('idPerfil')=='5' or Session::get('idPerfil')=='6' or Session::get('idPerfil')=='7') and $productosSinGuia>0 ): ?>
            <button id="btnAsignarGuia" class="btn btn-sm btn-success" onclick="asignarFolio();">Asignar Guía a elementos seleccionados</button>
            <?php endif; ?>
        </div> 


        <div class="panel panel-default" id="contenedor3">
            <div class="panel-heading">
                <div class="panel-tab clearfix">
                    <ul class="tab-bar">
                        <li class="active"><a href="#tabLogAcciones" data-toggle="tab"><b>Registro de acciones sobre este Pedido</b></a></li>
                        <li><a href="#tabNotas" data-toggle="tab"><b>Notas</b>
                            <?php if(count($notas)>0): ?>  
                                &nbsp&nbsp<span class="label label-danger" id="contNotas"><?php echo e(count($notas)); ?></span>
                            <?php endif; ?>    
                        </a></li>                        
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <div class="tab-content clearfix">
                    <div class="tab-pane active" id="tabLogAcciones" style="padding-top: 5px">
                        <table id="tablaLog" class="table table-hover table-condensed table-responsive" style="width: 850px">
                            <thead>
                                <th style="width:170px">Fecha/Hora</th>
                                <th style="width:200px">Usuario</th>
                                <th style="width:250px">Acción</th>
                                <th style="width:350px">Motivo</th>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="width:170px"> <?php echo e($item->fechaHora); ?> </td>
                                    <td style="width:200px"> <?php echo e($item->nombreUsuario); ?> </td>
                                    <td style="width:250px"> <?php echo e($item->accion); ?> </td>
                                    <td style="width:350px"> <?php echo e($item->motivo); ?> </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tabNotas" style="padding-top: 5px">
                        <div style="padding: 10px">
                            <div class="col-md-1">
                                Nota
                            </div>
                            <div class="col-md-6">
                                <input id="txtNota" class="form-control input-sm" maxlength="255">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success btn-sm" onclick="agregarNota();">Agregar</button>
                            </div>                                                         
                        </div>
                        <div style="padding-left: 20px;padding-top: 40px;">
                            <table id="tablaNotas" class="table table-hover table-condensed table-responsive" style="width: 900px">
                                <thead>
                                    <th style="width:150px">Fecha/Hora</th>
                                    <th style="width:150px">Usuario</th>
                                    <th style="width:600px">Nota</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $notas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="width:200px"> <?php echo e($item->fechaHora); ?> </td>
                                    <td style="width:200px" data-idUsuario="<?php echo e($item->idUsuario); ?>"> <?php echo e($item->nombreUsuario); ?> </td>
                                    <td style="width:100px"> <?php echo e($item->nota); ?> </td>
                                    <td>
                                        <?php if( Session::get('idUsuario')==$item->idUsuario ): ?>
                                        <button class="btn btn-warning btn-sm" onclick="eliminarNota(<?php echo e($item->idNota); ?>, this.parentNode.parentNode.rowIndex)">Eliminar</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                      
                                </tbody>
                            </table>
                        </div>
                    </div>                
                </div>
            </div>                 
        </div>

    </div>
</div>

<?php echo $__env->make('guiaDespacho', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <!-- Datepicker -->
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo e(asset('/')); ?>locales/bootstrap-datepicker.es.min.js"></script>  

    <!-- Timepicker -->
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-timepicker.min.js"></script>  

    <script src="<?php echo e(asset('/')); ?>js/app/funciones.js?<?php echo e($parametros[0]->version); ?>"></script>
    <script src="<?php echo e(asset('/')); ?>js/app/programacionPedido.js?<?php echo e($parametros[0]->version); ?>"></script>
    <script src="<?php echo e(asset('/')); ?>js/app/guiaDespacho.js?<?php echo e($parametros[0]->version); ?>"></script>
    
    <script>

        $('#datosGuia').on('submit', function(e) {
          // evito que propague el submit
          e.preventDefault();
          // agrego la data del form a formData

          if( $("#nuevoFolioDTE").val().trim()=='' ){
            swal(
                {
                    title: 'Debe ingresar el numero Folio DTE!!' ,
                    text: '',
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    cancelButtonText: '',
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function(isConfirm)
                {
                    if(isConfirm){
                        return;                         
                    }
                }
            );
            return;
          }

          if( $("#upload-demo").val().trim()=='' ){
            swal(
                {
                    title: 'No ha seleccionado un archivo para subir!!' ,
                    text: '',
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    cancelButtonText: '',
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function(isConfirm)
                {
                    if(isConfirm){
                        return;                         
                    }
                }
            );
            return;
          }

            var tabla=document.getElementById('tablaDetalleGuia');
            for (var i = 1; i < tabla.rows.length; i++){
                if(tabla.rows[i].cells[4].getElementsByTagName('input')[0]){
                  cantidad=tabla.rows[i].cells[4].getElementsByTagName('input')[0].value.trim().replace(".", "").replace(",",".");
                  if(cantidad=='' || parseFloat(cantidad)<=0){
                    swal(
                        {
                            title: '¡Debe completar las cantidades y actualizar antes de subir el archivo!' ,
                            text: '',
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonText: 'OK',
                            cancelButtonText: '',
                            closeOnConfirm: true,
                            closeOnCancel: false
                        },
                        function(isConfirm)
                        {
                            if(isConfirm){
                              return;
                            }
                        }
                    );
                    return;            
                  }
                }
            }

            // Se recorre el DataTable para modificar la funcion abrirGuia con el nuevo número ingresado por el usuario

            var numeroGuiaOrigen="abrirGuia(1, " + document.getElementById('folioDTE').dataset.numeroguia + ", this.parentNode.parentNode)";
            var nuevoNumeroGuia ="abrirGuia(1, " + $('#nuevoFolioDTE').val() + ", this.parentNode.parentNode)";
            var table = $('#tablaDetalle').DataTable();
            var cadena = "";
            var filas=table.rows().count();
            for (var i = 0; i < filas; i++){
                cadena=table.cell(i,1).data();
                table.cell(i,1).data( cadena.replace(numeroGuiaOrigen, nuevoNumeroGuia) );
            }

            // Aqui se actualizan los cantidades ingresadas en la guía de despacho   

            actualizarDatosGuiaDespacho(false);

            // a continuación se envñia el formulario con el nuevo número de guía y el archivo pdf correspondiente a la guía

          var formData = new FormData( $("#datosGuia")[0]);
          $.ajax({
              url: urlApp + "subirGuiaDespachoPdf",
              headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
              type:'POST',
              data:formData,
              cache:false,
              contentType: false,
              processData: false,
              success:function(data){
                document.getElementById('folioDTE').dataset.numeroguia=$("#nuevoFolioDTE").val();
                $("#folioDTE").val( $("#nuevoFolioDTE").val() );
                document.getElementById('btnEmitirGuia').style.display='none';
                document.getElementById('btnBajar').style.display='inline';
                cerrarModalSubirGuiaPdf();
              },
              error: function(jqXHR, text, error){
                  alert('Error!, No se pudo Añadir los datos');
              }
          });
        });

        $(document).ready(function() {
            var tablaDetalle="#tablaDetalle";

            $('.date').datepicker({
                todayHighlight: true,
                format: "dd/mm/yyyy",
                weekStart: 1,
                language: "es",
                autoclose: true,
                startDate: '+0d'
            })

            $('.bootstrap-timepicker').timepicker({
                showMeridian: false,
                defaultTime: false
            });        

            $.ajax({
                async: true,
                url: urlApp + "listaCamiones",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: {},
                success:function(dato){
                    for(var x=0;x<dato.length;x++){
                        var camion = new Array(dato[x].idEmpresaTransporte, dato[x].idCamion, dato[x].patente);
                        arrCamiones.push(camion);
                    }

                    var tabla=document.getElementById('tablaDetalle');

                    for (var i = 1; i < tabla.rows.length; i++){
                        if(tabla.rows[i].cells[1].dataset.guia=='0'){

                            if(tabla.rows[i].cells[5].innerHTML.trim()!='Retira'  && !tabla.rows[i].cells[11].getElementsByTagName('button')[0] ){
                                if(idEmpresa=tabla.rows[i].cells[6].getElementsByTagName('select')[0]){
                                    idEmpresa=tabla.rows[i].cells[6].getElementsByTagName('select')[0].value;
                                    selCamion=tabla.rows[i].cells[7].getElementsByTagName('select')[0];
                                    idCamion=0;
                                    if(selCamion.selectedIndex>=0){
                                        idCamion=selCamion.value;
                                    }                        
                                    selCamion.length=0; 
                                    var opt = document.createElement('option');
                                    opt.value = "0";
                                    opt.innerHTML = "";
                                    selCamion.appendChild(opt);

                                    for(var x=0;x<arrCamiones.length;x++){
                                        if(arrCamiones[x][0]==idEmpresa){
                                            var opt = document.createElement('option');
                                            opt.value = arrCamiones[x][1];
                                            opt.innerHTML = arrCamiones[x][2];
                                            if(idCamion==arrCamiones[x][1]){
                                                opt.selected=true;
                                            }else{
                                                opt.selected=false;
                                            }                                
                                            selCamion.appendChild(opt);
                                        }
                                    }                                     
                                }
               
                            }
                        }    
                    }

                }
            })

            $.ajax({
                async: true,
                url: urlApp + "listaConductores",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: {},
                success:function(dato){
                    for(var x=0;x<dato.length;x++){
                        var conductor = new Array(dato[x].idEmpresaTransporte, dato[x].idConductor, dato[x].nombre, dato[x].apellidoPaterno, dato[x].apellidoMaterno);
                        arrConductores.push(conductor);
                    }

                    var tabla=document.getElementById('tablaDetalle');

                    for (var i = 1; i < tabla.rows.length; i++){
                        if(tabla.rows[i].cells[1].dataset.guia=='0'){
                            
                            if(tabla.rows[i].cells[5].innerHTML.trim()!='Retira' && !tabla.rows[i].cells[11].getElementsByTagName('button')[0] ){
                                if(tabla.rows[i].cells[6].getElementsByTagName('select')[0]){
                                    idEmpresa=tabla.rows[i].cells[6].getElementsByTagName('select')[0].value;
                                    selConductor=tabla.rows[i].cells[8].getElementsByTagName('select')[0];
                                    idConductor=0;
                                    if(selConductor.selectedIndex>=0){
                                        idConductor=selConductor.value;
                                    }
                                    selConductor.length=0; 
                                    var opt = document.createElement('option');
                                    opt.value = "0";
                                    opt.innerHTML = "";
                                    selConductor.appendChild(opt);

                                    for(var x=0;x<arrConductores.length;x++){
                                        if(arrConductores[x][0]==idEmpresa){
                                            var opt = document.createElement('option');
                                            opt.value = arrConductores[x][1];
                                            opt.innerHTML = arrConductores[x][2]+' '+arrConductores[x][3]+' ' +arrConductores[x][4];
                                            if(idConductor==arrConductores[x][1]){
                                                opt.selected=true;
                                            }else{
                                                opt.selected=false;
                                            }
                                            selConductor.appendChild(opt);
                                        }
                                    }                                    
                                }

                            }               
                        }
                    }                    
                }
            })


        });

    </script>
       
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>