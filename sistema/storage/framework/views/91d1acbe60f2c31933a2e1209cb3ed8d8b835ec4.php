      

<?php $__env->startSection('contenedorprincipal'); ?>

<div style="padding: 5px">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b>Nuevo Pedido</b>
        </div>
        <div> 
            <div style="padding: 10px" class="panel panel-default panel-stat2"> 
                <input type="hidden" id="idCliente" data-idperfil="<?php echo e(Session::get('idPerfil')); ?>">
                <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
                <div class="row">
                    <div class="col-sm-1 col-lg-1">
                        Nota de Venta
                    </div>
                    <div class="col-sm-1 col-lg-1">
                        <input type="hidden" id="txtNumeroNotaVenta" value="<?php echo e($NotadeVenta[0]->idNotaVenta); ?>">
                        <button class="btn btn-success btn-sm" style="width: 100%" onclick="verNotaVenta();"><?php echo e($NotadeVenta[0]->idNotaVenta); ?></button>
                    </div>
                 
                    <div class="col-sm-1 col-lg-1">
                        Cliente
                    </div>
                    <div class="col-sm-3 col-lg-3">
                        <input class="form-control input-sm" id="txtNombreCliente" readonly  value="<?php echo e($NotadeVenta[0]->emp_nombre); ?>">
                    </div>
                    <div class="col-sm-1 col-lg-1">
                        Fecha
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <input class="form-control input-sm" id="txtFechaCotizacion" readonly value="<?php echo e($NotadeVenta[0]->fechahora_creacion); ?>">
                    </div>
                    <div class="col-sm-1 col-lg-1">
                        Cotización
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <input class="form-control input-sm" id="txtAno" readonly value="<?php echo e($NotadeVenta[0]->cot_numero); ?> / <?php echo e($NotadeVenta[0]->cot_año); ?>">
                    </div>
                </div>
                <div class="row" style="padding-top: 10px">
                    <div class="col-sm-1 col-lg-1">
                        Obra
                    </div>
                    <div class="col-sm-3 col-lg-3">
                        <input class="form-control input-sm" id="txtUsuarioValida" readonly value="<?php echo e($NotadeVenta[0]->Obra); ?>">
                    </div>                 
                    <div class="col-sm-1 col-lg-1">
                        Ejecutivo QL
                    </div>
                    <div class="col-sm-3 col-lg-3">
                        <input class="form-control input-sm" id="txtUsuarioCrea" readonly value="<?php echo e($NotadeVenta[0]->usuario_encargado); ?>">
                    </div>
                    <div class="col-sm-1 col-lg-1">
                        Aprueba
                    </div>
                    <div class="col-sm-3 col-lg-3">
                        <input class="form-control input-sm" id="txtUsuarioValida" readonly value="<?php echo e($NotadeVenta[0]->usuario_validacion); ?>">
                    </div> 
                </div>
                <div class="row" style="padding-top: 20px; padding-bottom: 20px">
                    <div class="col-lg-1 col-sm-2 col-md-1">
                        O.Compra
                    </div>

                    <div class="col-lg-3 col-sm-4 col-md-3">
                        <div class="input-group">                           
                            <input id="txtOrdenCompra" class="form-control input-sm" value="<?php echo e($NotadeVenta[0]->ordenCompraCliente); ?>" data-ocarchivo="<?php echo e($NotadeVenta[0]->nombreArchivoOC); ?>" >
                            <span class="input-group-addon glyphicon glyphicon-cloud-download" title="Bajar Orden de Compra" onclick="bajarOC();">

                            </span>
                            <span id="btnCargarArchivo" class="input-group-addon glyphicon glyphicon-cloud-upload" onclick="subirArchivoOc();" title="Subir Orden de Compra" style="background-color: #FFFFFF"></span>
                        </div> 
                        <div id="divNombreArchivo" style="display: none;"></div>                           
                    </div>                     
                    <div class="col-md-1">
                        Formato 
                    </div>
                     <div class="col-md-2">
                        <select id="tipoCarga" class="form-control input-sm" onchange="selTipoCarga();">
                            <option selected value="1">Granel</option>
                            <option value="2">Otros</option>
                        </select>
                    </div> 
                 
                    <div id="opciones" style="display: none">
                        <div class="col-md-1">
                            Tipo&nbsp;Transporte
                        </div>
                        <div class="col-md-2">
                            <select id="tipoTransporte" class="form-control input-sm" onchange="selTipoTransporte();">
                                <option selected value="1">Normal</option>
                                <option value="2">Mixto</option>
                            </select>
                        </div>                                    
                    </div>
                   
                </div>                   
            </div>
            <div id="notificaciones" style="padding-right: 5px; padding-left: 5px">
            </div>
            <div style="padding-top: 5px; display: none" id="divPedidoProductosporUnidad">
                <table id="tablaDetallePedidoNormal" class="table table-condensed table-hover table-responsive">
                    <thead>
                        <th style="display: none">Codigo</th>
                        <th width="15%">Producto</th>
                        <th width="5%">Diseño</th>
                        <th style="width:10%;text-align: right;">Precio<br>Reajustado($)</th>
                        <th style="width:5%;text-align: right;">Cantidad</th>
                        <th width="5%">Unidad</th>
                        <th width="5%">Saldo</th>
                        <th width="5%">Cantidad<br>Solicitada</th>
                        <th width="15%">Planta de Origen</th>
                        <th width="20%">Forma de Entrega</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $NotadeVentaDetalle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($item->u_nombre !='tonelada'): ?>
                                <tr>
                                    <td style="display: none"><?php echo e($item->prod_codigo); ?></td>
                                    <td><?php echo e($item->prod_nombre); ?></td>
                                    <td><?php echo e($item->formula); ?></td>
                                    <?php if($item->cp_tipo_reajuste=='Con reajuste'): ?>
                                        <td align="right"><?php echo e(number_format( $item->precioActual, 0, ',', '.' )); ?></td>
                                    <?php else: ?>
                                        <td align="right"><?php echo e(number_format( $item->precio, 0, ',', '.' )); ?></td>
                                    <?php endif; ?>    

                                    <td align="right"><?php echo e(number_format($item->cantidad, 0, ',', '.')); ?></td>
                                    <td><?php echo e($item->u_nombre); ?></td>
                                    <td align="right"><?php echo e(number_format($item->saldo, 0, ',', '.')); ?></td>
                                    <td aling="right"><input class="form-control input-sm" onblur="verificarCantidad(this);" onkeypress="return isIntegerKey(event)" maxlength="6" ></td>
                                    <td>
                                        <select class="form-control input-sm">
                                            <?php $__currentLoopData = $Plantas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if( $item->idPlanta==$planta->idPlanta ): ?>
                                                    <option value="<?php echo e($planta->idPlanta); ?>" selected><?php echo e($planta->nombre); ?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($planta->idPlanta); ?>"><?php echo e($planta->nombre); ?></option>
                                                <?php endif; ?>    
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                        </select>                                    
                                    </td>
                                    <td>
                                        <select class="form-control input-sm">
                                            <?php $__currentLoopData = $FormasdeEntrega; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formaEntrega): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if( $item->idFormaEntrega==$formaEntrega->idFormaEntrega ): ?>
                                                    <option value="<?php echo e($formaEntrega->idFormaEntrega); ?>" selected><?php echo e($formaEntrega->nombre); ?></option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($formaEntrega->idFormaEntrega); ?>"><?php echo e($formaEntrega->nombre); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                        </select>                                    
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            
                    </tbody>
                </table>
            </div> 

            <div style="padding-top: 5px; display: none" id="divPedidoProductosaGranel">
                <div class="row" style="padding-left: 10px">
                    <div class="col-md-1">
                        Producto
                    </div>
                    <div class="col-md-3">
                        <select id="listaProductos" class="form-control input-sm">
                            <option value="">Seleccione un producto...</option>
                            <?php $__currentLoopData = $NotadeVentaDetalle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($item->u_nombre =='tonelada'): ?>
                                    <option value="<?php echo e($item->prod_codigo); ?>"> <?php echo e($item->prod_nombre); ?> </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select> 
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-success btn-sm" onclick="agregarProducto();">Agregar</button>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div id="notaMaxProducto" class="col-md-5">
                        <b><u>Consideraciones para pedidos a granel</u></b>
                    </div>
                </div>
                <div style="padding-top: 5px; padding-left: 10px; padding-right: 10px; padding-bottom: 5px">
                    <table id="tablaDetallePedidoGranel" class="table table-hover table-condensed  table-responsive" style="width: 100%">
                        <thead>
                            <th style="display: none">Codigo</th>
                            <th style="width:150px">Producto</th>
                            <th style="width:80">Diseño</th>
                            <th style="width:10%;text-align: right;">Precio<br>Reajustado($)</th>
                            <th style="width:5%;text-align: right;">Cantidad</th>
                            <th style="width:80px">Unidad</th>
                            <th style="width:40px;text-align: right;">Saldo</th>
                            <th style="width:40px;text-align: right;">Cantidad<br>Solicitada</th>
                            <th style="width:80px">Planta de Origen</th>
                            <th style="width:80px">Forma de Entrega</th>                            
                            <th style="width:80px"></th>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $NotadeVentaDetalle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($item->u_nombre =='tonelada'): ?>
                                    <tr>
                                        <td style="display: none"><?php echo e($item->prod_codigo); ?></td>
                                        <td style="width:150px"><?php echo e($item->prod_nombre); ?></td>
                                        <td style="width:80px"><?php echo e($item->formula); ?></td>
                                        <?php if($item->cp_tipo_reajuste=='Con reajuste'): ?>
                                            <td align="right" style="width:80px"><?php echo e(number_format( $item->precioActual, 0, ',', '.' )); ?></td>
                                        <?php else: ?>
                                            <td align="right" style="width:80px"><?php echo e(number_format( $item->precio, 0, ',', '.' )); ?></td>
                                        <?php endif; ?>    

                                        <td align="right" style="width:40px"><?php echo e(number_format( $item->cantidad, 0, ',', '.')); ?></td>
                                        <td style="width:80px"><?php echo e($item->u_nombre); ?></td>
                                        <td align="right" style="width:40px"><b><?php echo e(number_format($item->saldo, 0, ',', '.')); ?></b></td>
                                        <td aling="right" style="width:40px">
                                            <input class="form-control input-sm" onblur="verificarCantidad(this);" maxlength="6" onkeypress="return isIntegerKey(event)" >
                                        </td>
                                        <td style="width:80px">
                                            <select class="form-control input-sm">
                                                <?php $__currentLoopData = $Plantas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if( $item->idPlanta==$planta->idPlanta ): ?>
                                                        <option value="<?php echo e($planta->idPlanta); ?>" selected><?php echo e($planta->nombre); ?></option>
                                                    <?php else: ?>
                                                        <option value="<?php echo e($planta->idPlanta); ?>"><?php echo e($planta->nombre); ?></option>
                                                    <?php endif; ?>    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                            </select>                                    
                                        </td>
                                        <td style="width:80px">
                                            <?php if($item->idFormaEntrega==2): ?>
                                                <select class="form-control input-sm">
                                                    <?php $__currentLoopData = $FormasdeEntrega; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formaEntrega): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if( $item->idFormaEntrega==$formaEntrega->idFormaEntrega ): ?>
                                                            <option value="<?php echo e($formaEntrega->idFormaEntrega); ?>" selected><?php echo e($formaEntrega->nombre); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                </select>                                            
                                            <?php else: ?>
                                                <select class="form-control input-sm">
                                                    <?php $__currentLoopData = $FormasdeEntrega; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formaEntrega): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if( $item->idFormaEntrega==$formaEntrega->idFormaEntrega ): ?>
                                                            <option value="<?php echo e($formaEntrega->idFormaEntrega); ?>" selected><?php echo e($formaEntrega->nombre); ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($formaEntrega->idFormaEntrega); ?>"><?php echo e($formaEntrega->nombre); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                                </select>
                                            <?php endif; ?>
                                        </td>                                        
                                        <td style="width:80px">
                                            <button class="btn btn-warning btn-sm" onclick="ocultarFila(this.parentNode.parentNode.rowIndex);">
                                                <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            
                        </tbody>
                    </table>
                </div>
            </div> 

            <div id="divPiePedido" style="display: none" class="panel panel-default panel-stat2">
                <div style="padding: 10px">
                    <div class="row">
                        <div class="col-sm-2 col-md-2">
                            Contacto
                            <input id="txtNombreContacto" class="form-control input-sm" value="<?php echo e($NotadeVenta[0]->nombreContacto); ?>">
                        </div> 
                        <div class="col-sm-2 col-md-2">
                            Correo
                            <input id="txtCorreoContacto" class="form-control input-sm" value="<?php echo e($NotadeVenta[0]->correoContacto); ?>">
                        </div>
                        <div class="col-sm-2 col-md-2">
                            Telefono/Móvil
                            <input id="txtTelefono" class="form-control input-sm" value="<?php echo e($NotadeVenta[0]->telefonoContacto); ?>">
                        </div>
                        <div class="col-sm-2 col-md-2">
                            Fecha de Entrega (*)
                            <div class="input-group date" id="divFechaEntrega">
                                <input type="text" class="form-control input-sm" id="txtFechaEntrega">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>                        
                        </div>
                        <div class="col-sm-2 col-md-2 col-lg-1">
                            Horario
                            <select id="horario" class="form-control input-sm">
                                <option>AM</option>
                                <option>PM</option>
                            </select> 
                        </div>            
                     
                    </div>
                    <div class="row" style="padding-top: 10px">
                        <div class="col-sm-4 col-md-8">
                            Observaciones (máx.150 carac.)
                            <input id="txtObservaciones" class="form-control input-sm" maxlength="150">
                        </div>
                        <div class="col-sm-4 col-md-3" style="padding-top: 20px">  
                            <label class="label-checkbox"><input type="checkbox" id="noExcederCantidad"><span class="custom-checkbox"></span>No exceder la cantidad solicitada</label>                 
                        </div>                     
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-md-3" style="padding-top: 20px"> 
                            <h5><b> (*) Dato Obligatorio</b></h5>
                        </div>                          
                    </div>                    

                </div>
                <div id="divFleteFalso" style="display: none">
                    <div class="row" style="padding: 15px">
                        <div class="col-sm-3 col-md-2">
                            Valor Flete Falso
                        </div>
                        <div class="col-sm-2 col-md-2">
                            <input id="valorFleteFalso" class="form-control input-sm" readonly style="text-align: right;">
                        </div>
                        <div class="col-sm-1 col-md-1">
                            Cantidad
                        </div>
                        <div class="col-sm-1 col-md-1">
                            <input id="cantidadFleteFalso" class="form-control input-sm" readonly style="text-align: right;">
                        </div>
                        <div class="col-sm-1 col-md-1">
                            Total
                        </div>
                        <div class="col-sm-1 col-md-1">
                            <input id="totalFleteFalso" class="form-control input-sm" readonly style="text-align: right;">
                        </div>                     
                    </div>                   
                </div>
                <div style="padding:18px">
                    <button id="btnCrearPedido" class="btn btn-success btn-sm" onclick="crearPedido('QL');">Crear Pedido</button>
                    <a href="<?php echo e(URL::previous()); ?>" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
                </div>
            </div>       
        </div>
    </div>
</div>

<div id="mdNotaVenta" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5><b>Detalle Nota de Venta</b></h5>
            </div>
            <div id="bodyNotaVenta" class="modal-body">
                <table id="tablaDetalleNotaVenta" class="table table-hover table-condensed table-responsive">
                    <thead>
                        <th style="width:100px">Producto</th>
                        <th style="width:50px">Cantidad</th>
                        <th style="width:50px">Unidad</th>
                        <th style="text-align: right;width:80px">Precio Base ($)</th>
                        <th style="width:150px">Glosa de Reajuste</th>
                        <th style="width:50px">Valor Pitch</th>
                        <th style="width:50px">% Pitch</th>
                        <th style="width:50px">Valor IPC</th>
                        <th style="width:50px">% IPC</th>                                           
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $NotadeVentaDetalle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="width:100px"><?php echo e($item->prod_nombre); ?></td>
                            <td style="text-align: right;width:50px"><?php echo e($item->cantidad); ?></td>
                            <td style="width:50px"><?php echo e($item->u_nombre); ?></td>
                            <td style="text-align: right;width:80px"><?php echo e(number_format( $item->precio, 0, ',', '.' )); ?></td>
                            <td style="width:150px"><?php echo e($item->cp_glosa_reajuste); ?></td>
                            <td style="width:50px"><?php echo e($item->cp_valor_pitch); ?></td>
                            <td style="width:50px"><?php echo e($item->cp_pitch); ?></td>
                            <td style="width:50px"><?php echo e($item->cp_valor_ipc); ?></td>
                            <td style="width:50px"><?php echo e($item->cp_ipc); ?></td>                                
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                              
                    </tbody>
                </table>
            </div> 

            <div class="col-md-offset-11" style="padding-top: 20px; padding-bottom: 20px">
                <button class="btn btn-warning btn-sm" onclick="cerrarDetalleNotaVenta();">Cerrar</button>
            </div>
        </div>
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
                        <br>
                        <b>Nota: Este archivo se subirá cuando presione el boton "Crear Pedido".</b>
                    </div>
                    <div style="padding-top: 20px; padding-bottom: 20px; text-align: right;">
                       <button type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarModalSubirArchivo()" style="width: 80px">Cerrar</button>
                    </div>                   
                </form>     
            </div>
        </div>
    </div>
</div>

<div id="modNotasGranel" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <input type="hidden" id="filaTabla" name="filaTabla">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h5><b>Consideraciones para pedidos a granel</b></h5>              
            </div>
            <div id="bodyNotasGranel" class="modal-body">
                <div style="padding: 20px">
                  <b><?php echo nl2br(e($parametros[0]->consideracionesPedidosGranel)); ?></b>
                </div>
            </div>
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

    <script src="<?php echo e(asset('/')); ?>js/app/funciones.js?<?php echo e($parametros[0]->version); ?>"></script>
    
    <script src="<?php echo e(asset('/')); ?>js/app/gestionarpedido.js?<?php echo e($parametros[0]->version); ?>"></script>
    <!-- Datatable -->
    <script src="<?php echo e(asset('/')); ?>js/jquery.dataTables.min.js"></script>
    <script>
        function subirArchivoOc(){
            $("#modSubirArchivo").modal('show'); 
        }

        function cerrarModalSubirArchivo(){
            if($("#upload-demo").val()!=''){
                document.getElementById('btnCargarArchivo').style.backgroundColor ="#f89406";
            }else{
                document.getElementById('btnCargarArchivo').style.backgroundColor ="#FFFFFF";
            }
            document.getElementById('divNombreArchivo').innerHTML= $("#upload-demo").val();
            document.getElementById('divNombreArchivo').style.display='block';      
            $("#modSubirArchivo").modal('hide'); 
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
                            location.href= urlApp + "bajarOCnventa/"+  document.getElementById('txtOrdenCompra').dataset.ocarchivo +"/";
                       };
                }
            })            
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>