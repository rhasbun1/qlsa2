      

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
                        Creación
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->fechahora_creacion); ?>">
                    </div> 
                    <div class="col-lg-1 col-md-1 col-sm-1">
                        N.Venta 
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <input class="form-control input-sm" readonly value="<?php echo e($pedido[0]->idNotaVenta); ?>">
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
                        <div class="input-group date" id="divFechaEntrega">
                            <input type="text" class="form-control input-sm" id="txtFechaEntrega" value="<?php echo e($pedido[0]->fechaEntrega); ?>">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>                         
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-1">
                        <select id="horario" class="form-control input-sm">
                            <?php if( $pedido[0]->horarioEntrega=='PM'): ?>
                                <option >AM</option>
                                <option selected>PM</option>
                            <?php else: ?>
                                <option selected>AM</option>
                                <option>PM</option>                           
                            <?php endif; ?>    
                        </select> 
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
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        Observaciones (máx.150 carac.)
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7">
                        <textarea id="txtObservaciones" maxlength="150" class="form-control input-sm" rows="2"><?php echo e($pedido[0]->observaciones); ?></textarea>
                    </div>                                                      
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-lg-1 col-sm-2 col-md-1">
                        O.Compra
                    </div>
                    <div class="col-lg-3 col-sm-4 col-md-3">
                        <div class="input-group">                           
                            <input id="txtOrdenCompra" class="form-control input-sm" value="<?php echo e($pedido[0]->ordenCompraCliente); ?>" data-ocarchivo="<?php echo e($pedido[0]->nombreArchivoOC); ?>" >
                            <span class="input-group-addon glyphicon glyphicon-cloud-download" title="Bajar Orden de Compra" onclick="bajarOCpedido();"></span>
                            <?php if(Session::get('grupoUsuario')=='C'): ?>
                                <span id="btnCargarArchivo" class="input-group-addon glyphicon glyphicon-cloud-upload" onclick="subirArchivoOCPedido();" title="Subir Orden de Compra" style="background-color: #FFFFFF"></span>
                            <?php endif; ?>
                        </div>                            
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
                    <th style="width: 60px">Cantidad</th>
                    <th>Unidad</th>
                    <?php if( Session::get('grupoUsuario')=='C' ): ?>   
                        <th>Precio ($)</th>
                        <th>Total</th>
                    <?php endif; ?>
                    <th>Planta de Origen</th>
                    <th>Entrega</th>
                    <th>Transporte</th>
                    <th>Camion</th>
                    <th>Conductor</th>
                    <th>Fecha Carga</th>
                    <th>Hora Carga</th>
                </thead>
            
                <tbody>
                    <?php $__currentLoopData = $listaDetallePedido; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="display: none"> <?php echo e($item->prod_codigo); ?> </td>
                        <td> <?php echo e($item->prod_nombre); ?> </td>
                        <td style="width: 60px">
                            <?php if( $item->numeroGuia==0 ): ?>
                                <input class="form-control input-sm" value="<?php echo e($item->cantidad); ?>">
                            <?php else: ?>
                                <?php echo e($item->cantidad); ?>

                            <?php endif; ?>    
                        </td>   
                        <td> <?php echo e($item->u_nombre); ?> </td>
                        <?php if( Session::get('grupoUsuario')=='C' ): ?>   
                            <td align="right"><?php echo e(number_format( $item->cp_precio, 0, ',', '.' )); ?></td>
                            <td align="right"><?php echo e(number_format( $item->cp_precio * $item->cantidad , 0, ',', '.' )); ?></td>
                        <?php endif; ?>
                        <td> 
                            <?php if( $item->numeroGuia==0 ): ?>
                                <select id="listaPlantas" class="form-control input-sm">
                                    <?php $__currentLoopData = $plantas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($planta->nombre==$item->nombrePlanta ): ?>
                                            <option value="<?php echo e($planta->idPlanta); ?>" selected> <?php echo e($planta->nombre); ?> </option>
                                        <?php else: ?>
                                            <option value="<?php echo e($planta->idPlanta); ?>"> <?php echo e($planta->nombre); ?> </option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <?php else: ?>
                                <?php echo e($item->nombrePlanta); ?>

                            <?php endif; ?>    
                        </td>
                        <td>
                            <?php if( $item->numeroGuia==0 ): ?>
                                <?php if($item->idFormaEntrega==2): ?>
                                    <select class="form-control input-sm">
                                        <?php $__currentLoopData = $formasdeentrega; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formaEntrega): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if( $item->idFormaEntrega==$formaEntrega->idFormaEntrega ): ?>
                                                <option value="<?php echo e($formaEntrega->idFormaEntrega); ?>" selected><?php echo e($formaEntrega->nombre); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                    </select>                                            
                                <?php else: ?>
                                    <select class="form-control input-sm">
                                        <?php $__currentLoopData = $formasdeentrega; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formaEntrega): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if( $item->idFormaEntrega==$formaEntrega->idFormaEntrega ): ?>
                                                <option value="<?php echo e($formaEntrega->idFormaEntrega); ?>" selected><?php echo e($formaEntrega->nombre); ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo e($formaEntrega->idFormaEntrega); ?>"><?php echo e($formaEntrega->nombre); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                    </select>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php echo e($item->nombreFormaEntrega); ?>

                            <?php endif; ?>                                 
                        </td>

                        <td> <?php echo e($item->nombreEmpresaTransporte); ?> </td>
                        <td> <?php echo e($item->patente); ?> </td>
                        <td> <?php echo e($item->nombreConductor); ?> </td>
                        <td> <?php echo e($item->fechaCarga); ?> </td>
                        <td> <?php echo e($item->horaCarga); ?> </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot> 
                    <?php if( Session::get('grupoUsuario')=='C' ): ?>   
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
            Indique el motivo de la modificación de este pedido (máx.150 letras):
            <input id="motivo" class="form-control input-sm" maxlength="150" style="width: 80%">
            <div style="padding-top:18px; padding-bottom: 20px">
                <button class="btn btn-sm btn-success" style="width:80px" onclick="guardarCambios();">Guardar</button>         
                <a href="<?php echo e(asset('/')); ?>listarPedidos" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>                                                  
            </div>
        </div>        

        <div style="width: 850px;padding-left: 20px">
            <b>Registro de acciones sobre este Pedido</b>
            <table id="tablaLog" class="table table-hover table-condensed table-responsive">
                <thead>
                    <th style="width:200px">Fecha/Hora</th>
                    <th style="width:200px">Usuario</th>
                    <th style="width:100px">Acción</th>
                    <th style="width:350px">Motivo</th>
                </thead>
                <tbody>
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

        function guardarCambios(){

            if($("#motivo").val().trim()=='' ){
                swal(
                    {
                        title: 'Debe indicar el motivo por el cual modificó este pedido!!' ,
                        text: '',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                        cancelButtonText: '',
                        closeOnConfirm: true,
                        closeOnCancel: false
                    }
                )
                return;             
            }


            var tabla=document.getElementById('tablaDetalle');

            if($("#txtFechaEntrega").val().trim()=='' ){
                swal(
                    {
                        title: 'Debe ingresar la Fecha de Entrega (*).',
                        text: '',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'Cerrar',
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
                return
            }
            var cont=0;
            var total=0;
            var toneladas=0;
            var productos=0;

            for(var x=1; x<(tabla.rows.length-3); x++){
                if(tabla.rows[x].cells[2].getElementsByTagName('input')[0].value.trim()=="" ){
                    cont++
                }
            }

            if(cont>0){
                swal(
                    {
                        title: 'No es permitido dejar una cantidad vacía.' ,
                        text: '',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                        cancelButtonText: '',
                        closeOnConfirm: true,
                        closeOnCancel: false
                    }
                )
                return;             
            }

            var cont=0;
            var cadena='[';

            for (var i = 1; i <(tabla.rows.length-3); i++){
                if(tabla.rows[i].cells[2].getElementsByTagName('input')[0].value!=""){
                    cadena+='{';
                    cadena+='"prod_codigo":"'+  tabla.rows[i].cells[0].innerHTML  + '", ';
                    cadena+='"cantidad":"'+  tabla.rows[i].cells[2].getElementsByTagName('input')[0].value + '", ';
                    cadena+='"idPlanta":"'+  tabla.rows[i].cells[6].getElementsByTagName('select')[0].value  + '",';
                    cadena+='"idFormaEntrega":"'+  tabla.rows[i].cells[7].getElementsByTagName('select')[0].value  + '"';                    
                    cadena+='}, ';   
                    total+= ( parseInt(tabla.rows[i].cells[4].innerHTML.replace('.','')) * parseInt( tabla.rows[i].cells[2].getElementsByTagName('input')[0].value ) );             
                }
            }

            cadena=cadena.slice(0,-2);
            cadena+=']';

            var ruta= urlApp + "actualizarPedido";

            $.ajax({
                url: ruta,
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        idPedido: $("#idPedido").val(),
                        fechaEntrega: fechaAtexto( $("#txtFechaEntrega").val() ),
                        observaciones: $("#txtObservaciones").val(),
                        horarioEntrega: $("#horario option:selected").html() ,
                        totalNeto: total,
                        ordenCompraCliente: $("#txtOrdenCompra").val(),
                        detalle: cadena,
                        motivo: $("#motivo").val()
                      },
                success:function(dato){
                        swal(
                            {
                                title: 'Se han guardado los cambios realizados al pedido!!',
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
                                    location.href=urlApp + "listarPedidos";
                                    return;
                                }
                            }
                        )
                        
                                        
                }
            })


        }

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

        $('#datos').on('submit', function(e) {
            // evito que propague el submit
            e.preventDefault();
            // agrego la data del form a formData
            var formData = new FormData( $("#datos")[0] );

            formData.append("idPedido", $("#idPedido").val());

            var ruta= urlApp + "subirOCpedido";
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
                                    $("#modSubirArchivo").modal('hide');
                                    return;                            
                                }
                            }
                        )                   
                }
            })
        });

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

        function subirArchivoOCPedido(){
            $("#modSubirArchivo").modal('show'); 
        }

        function cerrarModalSubirArchivo(){
            $("#modSubirArchivo").modal('hide'); 
        }


    </script>
       
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>