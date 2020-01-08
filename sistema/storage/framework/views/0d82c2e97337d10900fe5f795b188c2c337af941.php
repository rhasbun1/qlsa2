      

<?php $__env->startSection('contenedorprincipal'); ?>

<div style="padding: 10px">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b>Nota de Venta Nº <?php echo e($notaventa[0]->idNotaVenta); ?></b>
        </div>
        <div class="padding-md clearfix"> 

                <input type="hidden" id="idNotaVenta" value="<?php echo e($notaventa[0]->idNotaVenta); ?>">
                <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
                <div class="row">        
                    <div class="col-lg-1 col-md-1 col-sm-2" >
                        Cliente
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <input class="form-control input-sm" id="txtNombreCliente" readonly value="<?php echo e($notaventa[0]->emp_nombre); ?>">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <input class="form-control input-sm" id="txtRutCliente" readonly value="<?php echo e($notaventa[0]->emp_rut); ?>" title="Rut del Cliente">
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1">
                        Cód.Softland
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <?php if($notaventa[0]->SolicitaCodigoSoftland=='1'): ?>
                            <input class="form-control input-sm" id="txtCodigoSoftland" value="<?php echo e($notaventa[0]->codigoSoftland); ?>" title="Código Softland" maxlength="9" onkeypress="return isNumberKey(event)" <?php if(Session::get('grupoUsuario')!='C'): ?> readonly <?php endif; ?>>
                        <?php else: ?>
                            <input class="form-control input-sm" id="txtCodigoSoftland" value="<?php echo e($notaventa[0]->codigoSoftland); ?>" title="Código Softland" readonly>
                        <?php endif; ?>    
                    </div>                                     
                    <div class="col-lg-1 col-md-1 col-sm-2" style="text-align: right;">
                        Fecha
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4">
                        <input class="form-control input-sm" id="txtFechaCotizacion" readonly value="<?php echo e($notaventa[0]->fechahora_creacion); ?>">
                    </div>                  
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-lg-1 col-md-1 col-sm-2">
                        Crea
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <input class="form-control input-sm" id="txtUsuarioCrea" readonly value="<?php echo e($notaventa[0]->usuario_creacion); ?>">
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-2" >
                        Aprueba
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <input class="form-control input-sm" id="txtUsuarioValida" readonly value="<?php echo e($notaventa[0]->usuario_validacion); ?>">
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-2">
                       Ejecutivo&nbspQL
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <select id="idUsuarioEncargado" name="idUsuarioEncargado" class="selectpicker" data-live-search="true" title="Seleccione..." data-width="100%" <?php if(Session::get('grupoUsuario')!='C'): ?> disabled <?php endif; ?>>
                            <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <?php if($notaventa[0]->usuario_encargado==$item->usu_nombre.' '.$item->usu_apellido ): ?>
                                    <option value="<?php echo e($item->usu_codigo); ?>" selected><?php echo e($item->usu_nombre); ?> <?php echo e($item->usu_apellido); ?></option>
                               <?php else: ?>
                                    <option value="<?php echo e($item->usu_codigo); ?>"><?php echo e($item->usu_nombre); ?> <?php echo e($item->usu_apellido); ?></option>
                               <?php endif; ?> 
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                             
                        </select>                        
                    </div>                     
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-lg-1 col-sm-2 col-md-1">
                        Obra/Planta
                    </div>
                    <div class="col-lg-3 col-sm-4 col-md-3">
                            <input id="idObra" class="form-control input-sm" readonly value="<?php echo e($notaventa[0]->Obra); ?>">
                    </div>
                    <div class="col-lg-1 col-sm-2 col-md-1">
                        O.Compra
                    </div>
                    <div class="col-lg-2 col-sm-4 col-md-3">
                        <div class="input-group">                           
                            <input id="txtOrdenCompra" class="form-control input-sm" value="<?php echo e($notaventa[0]->ordenCompraCliente); ?>" data-ocarchivo="<?php echo e($notaventa[0]->nombreArchivoOC); ?>" <?php if(Session::get('grupoUsuario')!='C'): ?> readonly <?php endif; ?>>
                            <?php if(Session::get('grupoUsuario')=='C'): ?>
                                <span class="input-group-addon glyphicon glyphicon-cloud-download" title="Bajar Orden de Compra" onclick="bajarOC();"></span>
                            <?php endif; ?>
                            <?php if(Session::get('grupoUsuario')=='C'): ?>
                                <span class="input-group-addon glyphicon glyphicon-cloud-upload" onclick="subirArchivoOc();" title="Subir Orden de Compra"></span>
                            <?php endif; ?>
                        </div>                            
                    </div>
                    <?php if( Session::get('grupoUsuario')=='C'): ?>
                        <div class="col-lg-1 col-sm-2 col-md-1">
                            Cond.Pago
                        </div>
                        <div class="col-lg-3 col-sm-2 col-md-3">                    
                            <select id="idCondicionPago" name="idCondicionPago" class="selectpicker" data-live-search="true" title="Seleccione..." data-width="100%" <?php if(Session::get('grupoUsuario')!='C'): ?> disabled <?php endif; ?>>
                                <?php $__currentLoopData = $condicionesPago; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <?php if( $notaventa[0]->idCondiciondePago==$item->idCondiciondePago  ): ?>
                                        <option value="<?php echo e($item->idCondiciondePago); ?>" selected><?php echo e($item->nombre); ?> </option>
                                   <?php else: ?>
                                        <option value="<?php echo e($item->idCondiciondePago); ?>"><?php echo e($item->nombre); ?> </option>
                                   <?php endif; ?> 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                             
                            </select>
                        </div>
                    <?php endif; ?>                      
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-lg-1 col-sm-2 col-md-1">
                        Contacto
                    </div>
                    <div class="col-lg-3 col-sm-4 col-md-3">                        
                        <input id="txtNombreContacto" class="form-control input-sm" value="<?php echo e($notaventa[0]->nombreContacto); ?>" <?php if(Session::get('grupoUsuario')!='C'): ?> readonly <?php endif; ?>>
                    </div> 
                    <div class="col-lg-1 col-sm-2 col-md-1">
                        Teléfono
                    </div>
                    <div class="col-lg-3 col-sm-4 col-md-5">                        
                        <input id="txtTelefonoContacto" class="form-control input-sm" value="<?php echo e($notaventa[0]->telefonoContacto); ?>" <?php if(Session::get('grupoUsuario')!='C'): ?> readonly <?php endif; ?>>
                    </div>                    
                    <div class="col-lg-1 col-sm-2 col-md-1">
                        Email
                    </div>
                    <div class="col-lg-3 col-sm-4 col-md-3">                        
                        <input id="txtCorreoContacto" class="form-control input-sm" value="<?php echo e($notaventa[0]->correoContacto); ?>" <?php if(Session::get('grupoUsuario')!='C'): ?> readonly <?php endif; ?>>
                    </div>         
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-lg-1 col-md-2 col-sm-2">
                        Observaciones <font size="1px">(máx.255 carac)</font>
                    </div>
                    <div class="col-lg-7 col-md-10 col-sm-10">                            
                        <textarea id="txtObservaciones" maxlength="255" rows="3" class="form-control input-sm" <?php if(Session::get('grupoUsuario')!='C'): ?> readonly <?php endif; ?>><?php echo e($notaventa[0]->observaciones); ?></textarea>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-2">
                        <b>Cotización</b>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4">
                        <input class="form-control input-sm" id="txtAno" maxlength="4" value="<?php echo e($notaventa[0]->cot_numero); ?> / <?php echo e($notaventa[0]->cot_año); ?>" readonly>
                    </div>                     
                </div>
             
            </div>            
            <div style="padding-left: 20px;padding-right: 20px">
                <table id="tablaDetalle" class="table table-hover table-condensed" style="width:100%">
                    <thead>
                        <th style="display:none">Codigo</th>
                        <th style="width: 150px">Producto</th>
                        <th style="width: 80px">Diseño</th>
                        <th style="width: 50px;text-align:right;">Cantidad</th>
                        <th style="width: 50px">Unidad</th>
                        <?php if( Session::get('grupoUsuario')=='C' or Session::get('grupoUsuario')=='CL'): ?>
                            <th style="width: 50px;text-align:right;">Precio Base ($)</th>
                            <th style="width: 50px;text-align:right;">Precio Reajustado ($)</th>
                            <th style="width: 50px;text-align:right;">% var</th>
                        <?php endif; ?>
                        <th style="width: 50px;text-align:right;">Por entregar</th>
                        <th style="width: 50px;text-align:right;">Total retirado</th>
                        <th style="width: 50px;text-align:right;">Saldo</th>
                        <?php if( Session::get('grupoUsuario')=='C' or Session::get('grupoUsuario')=='CL'): ?>
                            <th style="width: 250px">Glosa de Reajuste</th>
                        <?php endif; ?>
                        <th style="width: 120px">Planta</th>
                        <th style="width: 120px">Entrega</th>
                    </thead>
                
                    <tbody>
                        <?php $__currentLoopData = $notaventadetalle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="display:none"> <?php echo e($item->idNotaVentaDetalle); ?> </td>
                            <td style="width: 150px"> <?php echo e($item->prod_nombre); ?> </td>
                            <td style="width: 80px">
                                <?php if( $item->requiere_diseno==1 ): ?>
                                    <?php if( Session::get('grupoUsuario')=='C' and Session::get('idPerfil')!='12'): ?>
                                        <input class="form-control input-sm" value="<?php echo e($item->formula); ?>" maxlength="20"> 
                                    <?php else: ?>
                                        <?php echo e($item->formula); ?>

                                    <?php endif; ?>    
                                <?php endif; ?>    
                            </td>
                            <td style="width: 50px;text-align:right;"> <?php echo e(number_format( $item->cantidad, 0, ',', '.' )); ?> </td>
                            <td style="width: 50px"> <?php echo e($item->u_nombre); ?> </td>
                            <?php if( Session::get('grupoUsuario')=='C' or Session::get('grupoUsuario')=='CL'): ?>
                                <td style="width: 50px;text-align:right;"><?php echo e(number_format( $item->precio, 0, ',', '.' )); ?></td>
                                <td style="text-align: right;"><?php echo e(number_format( $item->precioActual, 0, ',', '.' )); ?></td>
                                <td style="text-align: center;"><?php echo e(number_format( $item->porcentajeVariacion, 1, ',', '.' )); ?></td>
                            <?php endif; ?>
                            <td style="text-align: right;"><?php echo e(number_format( $item->porEntregar, 0, ',', '.' )); ?></td>
                            <td style="text-align: right;"><?php echo e(number_format( $item->totalRetirado, 0, ',', '.' )); ?></td>
                            <td style="width: 50px;text-align:right;"> <?php echo e(number_format( $item->saldo, 0, ',', '.' )); ?> </td>
                            <?php if( Session::get('grupoUsuario')=='C' or Session::get('grupoUsuario')=='CL'): ?>
                                <td style="width: 250px"> <?php echo e($item->cp_glosa_reajuste); ?> </td>
                            <?php endif; ?>
                            <td style="width: 120px"> <?php echo e($item->nombrePlanta); ?> </td>
                            <td style="width: 120px"> <?php echo e($item->nombreFormaEntrega); ?> </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div> 

            <div style="padding-top: 20px; padding-left: 20px">
                <?php if(count($pedidos)>0): ?>
                    <div class="row" style="padding: 5px">
                        <b>Pedidos Asociados a esta Nota de Venta. ( * = pendiente de aprobación )</b>
                    </div>
                    <div class="row" style="padding-top: 5px; padding-left: 5px"">
                        <?php $__currentLoopData = $pedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if( $item->idEstadoPedido==1 ): ?>
                                <a href="<?php echo e(asset('/')); ?>verpedido/<?php echo e($item->idPedido); ?>/4/" class="btn btn-xs btn-info"> <?php echo e($item->idPedido); ?> *</a>
                            <?php elseif( $item->idEstadoPedido==0 ): ?>
                                <a href="<?php echo e(asset('/')); ?>verpedido/<?php echo e($item->idPedido); ?>/4/" class="btn btn-xs btn-danger" title="Pedido Suspendido"> <?php echo e($item->idPedido); ?> *</a>                              
                            <?php else: ?>
                                <a href="<?php echo e(asset('/')); ?>verpedido/<?php echo e($item->idPedido); ?>/4/" class="btn btn-xs btn-primary"> <?php echo e($item->idPedido); ?> </a>
                            <?php endif; ?>    
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    </div>                      
                <?php else: ?>
                    <b>Esta Nota de Venta no tiene pedidos asociados.</b>    
                <?php endif; ?>

            </div>

            <div style="padding-top:18px; padding-bottom: 20px;padding-left: 15px">
                <?php if( ( Session::get('idPerfil')=='2' or Session::get('idPerfil')=='4' ) and $notaventa[0]->aprobada==0 and $accion!='3' ): ?>
                    <a href="<?php echo e(asset('/')); ?>aprobarnota/<?php echo e($notaventa[0]->idNotaVenta); ?>/" class="btn btn-sm btn-primary" style="width:80px">Aprobar</a>
                <?php endif; ?>
                <?php if( Session::get('grupoUsuario')=='C' and $notaventa[0]->aprobada==1 and $notaventa[0]->TienePedidos==0 and $accion!='3' ): ?> 
                    <a href="<?php echo e(asset('/')); ?>Desaprobarnota/<?php echo e($notaventa[0]->idNotaVenta); ?>/" class="btn btn-sm btn-primary" style="width:90px">Desaprobar</a>
                <?php endif; ?>
                <?php if( Session::get('grupoUsuario')=='C'): ?>
                    <button class="btn btn-sm btn-success" onclick="guardarCambiosNV();">Guardar Cambios</button>
                    <?php if( $notaventa[0]->cerrada==0 and $notaventa[0]->aprobada==1 and Session::get('grupoUsuario')=='C' and Session::get("idPerfil")!=11 ): ?>
                        <a href="<?php echo e(asset('/')); ?>gestionarpedido/<?php echo e($notaventa[0]->idNotaVenta); ?>/" class="btn btn-sm btn-primary">Crear Pedido</a>
                    <?php endif; ?>
                <?php elseif( Session::get('grupoUsuario')=='CL'): ?>
                    <?php if( $notaventa[0]->cerrada==0 and $notaventa[0]->aprobada==1 ): ?>
                        <a href="<?php echo e(asset('/')); ?>gestionarpedido/<?php echo e($notaventa[0]->idNotaVenta); ?>/" class="btn btn-sm btn-primary">Crear Pedido</a>
                    <?php endif; ?>                    
                <?php endif; ?>

                <?php if(   $notaventa[0]->cerrada==0 and
                        (Session::get('idPerfil')=='2' or 
                        Session::get('idPerfil')=='3' or 
                        Session::get('idPerfil')=='4') ): ?>
                    <button class="btn btn-sm btn-danger" onclick="cerrarNotaVenta();">Pasar a Histórico</button>                    
                    <a href="<?php echo e(URL::previous()); ?>" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
                <?php else: ?>
                    <a href="<?php echo e(URL::previous()); ?>" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>                    
                <?php endif; ?>
                <a target="_blank" href="<?php echo e(asset('/')); ?>imprimirNotaVenta/<?php echo e($notaventa[0]->idNotaVenta); ?>/" class="btn btn-warning btn-sm">Imprimir</a>
            </div>              
        </body>
    </div>
    <div class="tab-pane active" id="tabLogAcciones" style="padding-top: 5px">
        <table id="tablaLog" class="table table-hover table-condensed table-responsive" style="width: 850px">
            <thead>
                <th style="width:200px">Fecha/Hora</th>
                <th style="width:200px">Usuario</th>
                <th style="width:100px">Acción</th>
                <th style="width:350px">Motivo</th>
            </thead>
            <tbody>
                <?php if($notaventa[0]->fechaCierreSistema!='' ): ?>
                <tr>
                    <td style="width:200px"> <?php echo e($notaventa[0]->fechaCierreSistema); ?> </td>
                    <td style="width:200px">QL Now</td>
                    <td style="width:100px">Cierre</td>
                    <td style="width:350px">Cerrada automáticamente por no haber movimientos.</td>
                </tr>                
                <?php endif; ?>
                <?php $__currentLoopData = $log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td style="width:200px"> <?php echo e($item->fechaHora); ?> </td>
                    <td style="width:200px"> <?php echo e($item->nombreUsuario); ?> </td>
                    <td style="width:100px"> <?php echo e($item->accion); ?> </td>
                    <td style="width:350px"> <?php echo e($item->motivo); ?> </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
            </tbody>
        </table>
    </div>
</div>


<div id="modSubirArchivo" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <input type="hidden" id="filaTabla" name="filaTabla">
                <h5><b>Subir Archivo Orden de Compra</b></h5>
            </div>
            <div id="bodyProducto" class="modal-body">
                <form id="datos" name="datos" enctype="multipart/form-data">                             
                    <div class="row" style="padding: 15px">
                        Imagen o Pdf de la Orden de Compra
                        <div class="upload-file">
                            <input type="file" id="upload-demo" name="upload-demo" class="upload-demo">
                            <label data-title="Buscar" for="upload-demo">
                                <span id="mensajeUpload" data-title="No ha seleccionado un archivo..."></span>
                            </label>
                        </div>                        
                    </div>
                    <div class="col-md-offset-8" style="padding-top: 20px; padding-bottom: 20px">
                       <button type="submit" class="btn btn-success btn-sm" style="width: 80px">Subir</button>
                       <button type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarModalSubirArchivo()" style="width: 80px">Salir</button>
                    </div>                   
                </form>     
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-datepicker.min.js"></script>  
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo e(asset('/')); ?>js/app/funciones.js"></script>
    <!-- bootstrap-select -->
    <link rel="stylesheet" href="<?php echo e(asset('/')); ?>css/bootstrap-select/bootstrap-select.min.css">
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-select/i18n/defaults-es_ES.min.js"></script>    

    <script>

        $('#datos').on('submit', function(e) {
            // evito que propague el submit
            e.preventDefault();
            // agrego la data del form a formData
            var formData = new FormData( $("#datos")[0] );

            formData.append("idNotaVenta", $("#idNotaVenta").val());

            var ruta= urlApp + "subirOCnotaventa";
            $.ajax({
                url: ruta,
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: formData,
                cache:false,
                contentType: false,
                processData: false,            
                success:function(dato){
                        document.getElementById('txtOrdenCompra').dataset.ocarchivo=dato.nombreArchivo;
                        swal(
                            {
                                title: 'Se ha subido la Orden de Compra' ,
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
                        )                   
                }
            })
        });


        function actualizarValores(){
            var tabla= document.getElementById('tablaDetalle');
            var cadena='[';
            for (var i = 1; i < tabla.rows.length; i++){
                cadena+='{';
                cadena+='"idNotaVenta":"'+  $("#idNotaVenta").val()  + '", ';
                cadena+='"prod_codigo":"'+  tabla.rows[i].cells[0].innerHTML  + '", ';
                cadena+='"formula":"'+  tabla.rows[i].cells[2].getElementsByTagName('input')[0].value.replace('.','')  + '"';
                cadena+='}, ';
            }
            cadena=cadena.slice(0,-2);
            cadena+=']';
            var ruta= urlApp + "actualizarValoresNotaVenta";
            $.ajax({
                url: ruta,
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        detalle: cadena
                      },
                success:function(dato){
                        swal(
                            {
                                title: 'Se han actualizado correctamente los valores' ,
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
                                    location.href="<?php echo e(asset('/')); ?>listarNotasdeVenta";                               
                                }
                            }
                        )                   
                }
            })

        }

        function subirArchivoOc(){
            $("#modSubirArchivo").modal('show'); 
        }

        function cerrarModalSubirArchivo(){
            $("#modSubirArchivo").modal('hide'); 
        }

        function cerrarNotaVenta(idNotaVenta){
            swal(
                {
                    title: 'Pasar la Nota ' + idNotaVenta + ' a historico' ,
                    text: 'Debe ingresar un motivo:',
                    type: 'input',
                    showCancelButton: true,
                    closeOnConfirm: false,
                    confirmButtonText: 'Continuar',
                    cancelButtonText: 'Cancelar',
                },
                function (inputValue) {
                    if (inputValue === false) return false;
                    if (inputValue === "") {
                        swal.showInputError("El motivo no puede estar vacío.");
                        return false
                    }else{
                        location.href="<?php echo e(asset('/')); ?>cerrarNotaVenta/<?php echo e($notaventa[0]->idNotaVenta); ?>/" + inputValue +"/";                  
                    }

                }
            ); 
        }

        function bajarOC(){
            $.ajax({
                url: urlApp + "existeArchivo",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        carpeta: 'ocnventa',
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
                            var url = urlApp + "bajarOCnventa/"+  document.getElementById('txtOrdenCompra').dataset.ocarchivo +"/";
                            window.open(url, "Ver PDF")
                       };
                }
            })            
        }

        function guardarCambiosNV(){
            var tabla= document.getElementById('tablaDetalle');
            var cadena='[';
            for (var i = 1; i < tabla.rows.length; i++){
                cadena+='{';
                cadena+='"idNotaVentaDetalle":"'+  tabla.rows[i].cells[0].innerHTML  + '", ';
                if(tabla.rows[i].cells[2].getElementsByTagName('input')[0]){
                    cadena+='"formula":"'+  tabla.rows[i].cells[2].getElementsByTagName('input')[0].value.replace('.','')  + '"';
                }else{
                    cadena+='"formula":""';
                }
                cadena+='}, ';
            }
            cadena=cadena.slice(0,-2);
            cadena+=']';

            $.ajax({
                url: urlApp + "actualizarDatosNV",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        idNotaVenta: $("#idNotaVenta").val(),
                        contacto: $("#txtNombreContacto").val(),
                        correo: $("#txtCorreoContacto").val(),
                        telefono: $("#txtTelefonoContacto").val(),
                        observaciones: $("#txtObservaciones").val(),
                        ordenCompraCliente: $("#txtOrdenCompra").val(),
                        idCondiciondePago: $("#idCondicionPago").val(),
                        codigoSoftland: $("#txtCodigoSoftland").val(),
                        idUsuarioEncargado: $("#idUsuarioEncargado").val(),
                        detalle: cadena
                      },
                success:function(dato){
                    swal(
                        {
                            title: 'Los datos han sido guardados!!' ,
                            text: '',
                            type: 'warning',
                            showCancelButton: false,
                            closeOnConfirm: true,
                            confirmButtonText: 'Cerrar',
                            cancelButtonText: '',
                        },
                            function(isConfirm)
                            {
                                if(isConfirm){
                                    location.href="<?php echo e(asset('/')); ?>listarNotasdeVenta";                               
                                }
                            }                        
                        )                        
                }
            }) 
        }
    </script>

    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>