<?php $__env->startSection('contenedorprincipal'); ?>

<div style="padding: 5px">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <h5><b>Pedido Nº <?php echo e($pedido[0]->idPedido); ?></b></h5>
        </div>
        <div class="padding-md clearfix">
        	<div>
                <input type="hidden" id="idPedido" value="<?php echo e($pedido[0]->idPedido); ?>">
                <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
                <div class="row" style="padding-top: 5px">
                    <div class="col-lg-1 col-md-1 col-sm-1">
                        Cliente
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-5">
                        <input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->emp_nombre); ?>">
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-2">
                        Rut
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-3">
                        <input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->emp_rut); ?>">
                    </div>  
                    <div class="col-lg-1 col-md-1 col-sm-2">
                        Creación
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->fechahora_creacion); ?>">
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
                       <b><input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->estado); ?>"></b>
                    </div> 
                    <div class="col-lg-1 col-sm-2 col-md-1">
                        O.Compra
                    </div>
                    <div class="col-lg-2 col-sm-3 col-md-2">
                        <div class="input-group">                           
                            <input id="txtOrdenCompra" class="form-control input-sm" readonly value="<?php echo e($pedido[0]->ordenCompraCliente); ?>" data-ocarchivo="<?php echo e($pedido[0]->nombreArchivoOC); ?>" >
                            <?php if( Session::get('grupoUsuario')=='C' ): ?> 
                                <span class="input-group-addon glyphicon glyphicon-cloud-download" title="Bajar Orden de Compra" onclick="bajarOCpedido();"></span>
                            <?php endif; ?>    
                        </div>                            
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1">
                        N.Venta 
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-2">
                        <?php if( Session::get('grupoUsuario')=='P' or Session::get('grupoUsuario')=='C' ): ?> 
                            <a class="btn btn-success btn-sm" style="width: 100%" href="<?php echo e(asset('/')); ?>vernotaventa/<?php echo e($pedido[0]->idNotaVenta); ?>/2/"><?php echo e($pedido[0]->idNotaVenta); ?></a>
                        <?php else: ?>
                            <input class="form-control input-sm" value="<?php echo e($pedido[0]->idNotaVenta); ?>" readonly>
                        <?php endif; ?>
                    </div>
                    <?php if( Session::get('grupoUsuario')=='C' ): ?> 
                        <div class="col-lg-1 col-md-1 col-sm-1">
                            Cond.Pago
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <textarea class="form-control input-sm" readonly rows="1"><?php echo e($pedido[0]->condiciondePago); ?></textarea>
                        </div>
                    <?php endif; ?>                                    
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-lg-1 col-md-2 col-sm-2">
                        Observaciones
                    </div>
                    <div class="col-lg-8 col-md-7 col-sm-6">
                        <textarea class="form-control input-sm" readonly rows="2"><?php echo e($pedido[0]->observaciones); ?></textarea>
                    </div>                                                      
                </div>
                <?php if($pedido[0]->noExcederCantidadSolicitada==1): ?>
        		    <div class="row" style="padding-top: 5px">
                        <div class="col-md-12" style="text-align: right;">
                            <h4><span class="label label-danger">NO EXCEDER LA CANTIDAD SOLICITADA</span></h4>
                        </div>          
                    </div>
                <?php endif; ?>                      		  		
        	</div>

        </div>
        <div style="padding: 10px">
            <table id="tablaDetalle" class="table table-hover table-condensed table-responsive">
                <thead>
                    <th style="display: none">Codigo</th>
                    <th>Producto</th>
                    <th style="width: 80px">Diseño</th>
                    <th style="width: 50px">Cant.</th>
                    <th>Unidad</th>
                    <?php if( Session::get('grupoUsuario')=='C' ): ?>   
                        <th>Precio ($) <b>*</b></th>
                        <th>Total ($)</th>
                    <?php endif; ?>
                    <th>Planta de Origen</th>
                    <th>Entrega</th>
                    <th>Transporte</th>
                    <th>Camion</th>
                    <th>Conductor</th>
                    <th style="text-align: center;">Fecha Hora Carga<br>Programada</th>
                    <th style="text-align: center;">Fecha Hora Carga<br>Real</th>
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
                        <td> <?php echo e($item->fechaCargaReal); ?> </td>
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
                            <td></td>                
                        </tr>
                    <?php endif; ?>                   
                    <?php if( Session::get('grupoUsuario')=='C' or Session::get('grupoUsuario')=='CL' ): ?>   
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
                            <td></td>                        
                        </tr> 
                    <?php endif; ?>                     
                </tfoot>
            </table>
            <br>
            <b>*</b> Precio reajustado a la fecha de despacho del pedido. Pueden existir diferencias a inicios de cada mes hasta que se actualicen los parámetros de reajuste.
        </div> 

        
        <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
            <?php if( ( Session::get('idPerfil')=='2' or Session::get('idPerfil')=='11')  and $pedido[0]->idEstadoPedido==1 ): ?>
                <button class="btn btn-sm btn-primary" style="width:100px" onclick="aprobarPedido(<?php echo e($pedido[0]->idPedido); ?>);">Aprobar</button>
            <?php endif; ?>    

            <?php if( (Session::get('idPerfil')=='2' or Session::get('idPerfil')=='3') and $pedido[0]->idEstadoPedido >0 ): ?>
                <a href="<?php echo e(asset('/')); ?>editarPedido/<?php echo e($pedido[0]->idPedido); ?>/" class="btn btn-sm btn-success" style="width:100px">Modificar</a>
            <?php endif; ?>
            <?php if($accion=='1'): ?>
                <?php if(Session::get('grupoUsuario')=='C' and (Session::get('idPerfil')=='2' or Session::get('idPerfil')=='11') ): ?>
                    <?php if($pedido[0]->idEstadoPedido==2 and $pedido[0]->idTransporte==0 ): ?>
                        <a href="<?php echo e(asset('/')); ?>desaprobarPedido/<?php echo e($pedido[0]->idPedido); ?>/" class="btn btn-sm btn-primary" style="width:100px">Desaprobar</a>
                    <?php endif; ?>
                <?php endif; ?>    
                <?php if( ($pedido[0]->idEstadoPedido>0 and $pedido[0]->idEstadoPedido < 5) and (Session::get('idPerfil')=='2' or Session::get('idPerfil')=='3') ): ?>
                    <button class="btn btn-sm btn-danger" onclick="abrirCajaSuspender();">Suspender</button>
                <?php endif; ?>
            <?php elseif($accion=='3'): ?>
                <?php if( ($pedido[0]->idEstadoPedido=='0' or $pedido[0]->idEstadoPedido=='1') and (Session::get('idPerfil')=='5' or Session::get('idPerfil')=='6' or Session::get('idPerfil')=='7') ): ?>
                    <button class="btn btn-sm btn-danger" onclick="pasarHistorico();">Pasar a Histórico</button>
                <?php endif; ?>
            <?php elseif($accion=='6'): ?>
                <button class="btn btn-sm btn-primary" style="width:100px" onclick="aprobarPedidoCliente();">Aprobar</button>                                      
            <?php endif; ?>
            <?php if($plantilla=='plantilla'): ?>
                <a href="<?php echo e(URL::previous()); ?>" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
            <?php endif; ?>

        </div>
        
        <?php if(Session::get('grupoUsuario')!='CL'): ?>
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
                                <th style="width:200px">Fecha/Hora</th>
                                <th style="width:250px">Usuario</th>
                                <th style="width:350px">Acción</th>
                                <th style="width:350px">Motivo</th>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="width:200px"> <?php echo e($item->fechaHora); ?> </td>
                                    <td style="width:250px"> <?php echo e($item->nombreUsuario); ?> </td>
                                    <td style="width:350px"> <?php echo e($item->accion); ?> </td>
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
        <?php endif; ?>


    </div>
</div>

<div id="mdSuspender" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="height: 45px">
                <h5><b>Suspender pedido</b></h5>
            </div>
            <div id="bodyGuia" class="modal-body">
                Indique el motivo (máx.200 caract.)
                <div class="row">
                    <div class="col-md-12">
                        <input class="form-control input-sm" id="obsSuspension" maxlength="200">
                    </div> 

                </div>
            </div>
            <div style="padding-top: 20px; padding-bottom: 20px; padding-right: 20px; text-align: right;">
               <button type="button" class="btn btn-success btn-sm" onclick="SuspenderPedido(<?php echo e($pedido[0]->idPedido); ?>)" style="width: 80px">Suspender</button>                
               <button id="btnCerrarCajaSuspender" type="button" class="btn btn-danger btn-sm" onclick="cerrarCajaSuspender()" style="width: 80px">Cancelar</button>
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
    <script src="<?php echo e(asset('/')); ?>js/app/verpedido.js"></script>
    <script src="<?php echo e(asset('/')); ?>js/app/guiaDespacho.js?<?php echo e($parametros[0]->version); ?>"></script>
    <!-- Datatable -->
    <script src="<?php echo e(asset('/')); ?>js/jquery.dataTables.min.js"></script>
    <script>

        function pasarHistorico(){
            swal(
                {
                    title: 'Este pedido va a pasar al listado histórico. ¿Desea continuar?' ,
                    text: '',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'SI',
                    cancelButtonText: 'NO',
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm)
                {
                    if(isConfirm){
                        location.href= urlApp + "cerrarPedido/" + $("#idPedido").val() + "/";                  
                    }
                }
            );            
        }

        $('#datosGuia').on('submit', function(e) {
          // evito que propague el submit
          e.preventDefault();
          // agrego la data del form a formData
          document.getElementById('btnSubirGuia').disabled=true;

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
                        document.getElementById('btnSubirGuia').disabled=false;
                        return;                         
                    }
                }
            );
            document.getElementById('btnSubirGuia').disabled=false;
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
                        document.getElementById('btnSubirGuia').disabled=false;
                        return;                         
                    }
                }
            );
            document.getElementById('btnSubirGuia').disabled=false;
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
                                    document.getElementById('btnSubirGuia').disabled=false;
                                    return;
                                }
                            }
                        );
                        document.getElementById('btnSubirGuia').disabled=false;
                        return;            
                    }
                }
            }

            // Se recorre el DataTable para modificar la funcion abrirGuia con el nuevo número ingresado por el usuario

            var numeroGuiaOrigen="abrirGuia(1, " + document.getElementById('folioDTE').dataset.numeroguia + ", this.parentNode.parentNode)";
            var nuevoNumeroGuia ="abrirGuia(1, " + $('#nuevoFolioDTE').val() + ", this.parentNode.parentNode)";
            var table = $('#tablaDetalle').DataTable();
            var cadena = "";
            var numGuia=document.getElementById('folioDTE').dataset.numeroguia;
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
                if(data=="0"){
                    swal(
                        {
                            title: 'El número de guía ya existe!!' ,
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
                                document.getElementById('btnSubirGuia').disabled=false;
                                return;                         
                            }
                        }
                    );
                    document.getElementById('btnSubirGuia').disabled=false;
                    return;
                }
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

        function abrirCajaSuspender(){
            $("#mdSuspender").modal('show');
            $("#obsSuspension").val('');
            $("#obsSuspension").focus();
        }

        function cerrarCajaSuspender(){
            $("#obsSuspension").val('');
            $("#mdSuspender").modal('hide');
        }

        function SuspenderPedido(idPedido){
            if($("#obsSuspension").val().trim()=='' ){
                swal(
                    {
                        title: 'Es obligatorio ingresar el motivo!!' ,
                        text: '',
                        type: 'warning',
                        showCancelButton: false,
                        closeOnConfirm: true,
                        confirmButtonText: '',
                        cancelButtonText: '',
                    });
            }else{
                $.ajax({
                    url: urlApp + "suspenderPedido",
                    headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                    type: 'POST',
                    dataType: 'json',
                    data: { 
                            idPedido: idPedido,
                            motivo: $("#obsSuspension").val().trim()
                          },
                    success:function(dato){
                        location.href=dato.url;
                    }
                })                
            }
        }

        function bajarOCpedido(){
            $.ajax({
                url: urlApp + "existeArchivo",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        carpeta: 'ocpedido',
                        nombreArchivo: document.getElementById('txtOrdenCompra').dataset.ocarchivo
                      },
                success:function(dato){
                       if(!dato.existe){
                            swal(
                                {
                                    title: 'Archivo no encontrado!!' ,
                                    text: 'Nombre de archivo: ' + document.getElementById('txtOrdenCompra').dataset.ocarchivo,
                                    type: 'warning',
                                    showCancelButton: false,
                                    closeOnConfirm: true,
                                    confirmButtonText: 'Cerrar',
                                    cancelButtonText: '',
                                })                        
                       }else{
                            location.href= urlApp + "bajarOCpedido/"+  document.getElementById('txtOrdenCompra').dataset.ocarchivo +"/";
                       };
                }
            })            
        }


    </script>
       
<?php $__env->stopSection(); ?>
<?php echo $__env->make($plantilla, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>