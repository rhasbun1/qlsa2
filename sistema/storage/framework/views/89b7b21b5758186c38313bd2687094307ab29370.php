      

<?php $__env->startSection('contenedorprincipal'); ?>


<div style="padding: 5px">
    <div class="panel panel-default">
        <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
        <input type="hidden" id="idPerfil" value="<?php echo e(Session::get('idPerfil')); ?>">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-3">
                    <b>Pedidos en Proceso</b>
                </div>
                <div class="col-md-9" style="text-align: right;">
                    <?php if($cantidadIngresoCliente>0 and (Session::get('idPerfil')=='2' or Session::get('idPerfil')=='3' or Session::get('idPerfil')=='12')): ?>
                         <a href="<?php echo e(asset('/')); ?>listaIngresosClienteporAprobar" class="btn btn-danger btn-sm">EXISTEN <?php echo e($cantidadIngresoCliente); ?> PEDIDOS INGRESADOS POR CLIENTE EN ESPERA DE PRE-APROBACION</a>
                    <?php endif; ?>
                </div>
            </div>       
        </div>
        <div class="panel-body" id="panelBody" style="display: block">
            <div class="padding-md clearfix">
                <div style="padding-bottom: 15px">  
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-2">
                            Filtrar por Fecha de Entrega
                        </div>
                        <div class="col-md-2">
                            <div class="input-group date" id="divFechaMin">
                                <input type="text" class="form-control input-sm" id="min">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group date" id="divFechaMax">
                                <input type="text" class="form-control input-sm" id="max">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 

                <?php if( Session::get('idPerfil')=='11' ): ?> <!-- Ejecutivo de Crédito -->
                    <div style="width: 100%">
                        <div id="Grid"></div>
                        <table id="tablaDetalle" class="table table-hover table-condensed" style="width: 100%">
                            <thead>
                                <th style="width: 80px">Pedido Nº</th>
                                <th style="width: 100px">Fecha Creación</th>
                                <th style="width: 250px">Cliente</th>
                                <th style="width: 250px">Obra/Planta</th>
                                <th style="width: 100px"><b>Total c/IVA</b></th>
                                <th style="width: 100px">Fecha Entrega</th>
                                <th style="width: 70px">Estado</th>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $pedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td style="width: 80px" data-pedido='<?php echo e($item->idPedido); ?>'>
                                            <a href="<?php echo e(asset('/')); ?>verpedido/<?php echo e($item->idPedido); ?>/1/" class="btn btn-xs btn-success"><?php echo e($item->idPedido); ?></a>
                                            <?php if( Session::get('grupoUsuario')=='C' and $item->idEstadoPedido==1 ): ?>
                                                <button class="btn btn-sm btn-primary" title="Aprobar pedido" onclick="aprobarPedido(<?php echo e($item->idPedido); ?>, this)"><span class="glyphicon glyphicon-ok"></span></button>
                                            <?php endif; ?>                                          
                                        </td>
                                        <td style="width: 100px"><?php echo e($item->fechahora_creacion); ?></td>
                                        <td style="width: 250px"><?php echo e($item->nombreCliente); ?></td>
                                        <td style="width: 250px"><?php echo e($item->nombreObra); ?></td>
                                        <td style="width: 100px; text-align: right;"><b>$ <?php echo e(number_format( $item->totalNeto + $item->montoIva, 0, ',', '.' )); ?></b></td>
                                        <td style="width: 100px"><?php echo e($item->fechaEntrega); ?> <?php echo e($item->horarioEntrega); ?></td>
                                        <td style="width: 70px"><?php echo e($item->estado); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>            
                        </table>
                    <div>   
                <?php else: ?>

                    <table id="tablaDetalle" class="table table-hover" style="width:1320px">
                        <thead>
                            <th style="width:20px;text-align: center;">Pedido</th>
                            <th style="width: 60px;text-align: left;"></th>
                            <th style="width: 50px;text-align: center;">Estado</th>
                            <th style="width: 150px">Cliente</th>
                            <th style="width: 150px">Obra/Planta</th>
                            <th style="width: 70px">Producto</th>
                            <th style="width: 30px;text-align: right;">Cant.</th>
                            <th style="width: 30px;text-align: center">Unidad</th>
                            <th style="width: 100px">Fecha Entrega</th>
                            <th style="width: 70px">Forma Entrega</th>
                            <th style="width: 70px">Planta Origen</th>
                            <th style="width: 100px">Fecha Carga<br>Programada</th>
                            <th style="width: 150px">Transporte</th>
                            <th style="width: 50px;text-align: right;">Fecha Creación</th>
                            <th style="width: 80px">Nº Aux.</th>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $pedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if( $item->idEstadoPedido=='0' ): ?>
                                    <tr style="background-color: #A93226; color: #FDFEFE">
                                <?php else: ?>
                                    <?php if( $item->modificado>0): ?>
                                        <tr style="background-color: #F5CBA7">
                                    <?php else: ?>
                                        <tr>
                                    <?php endif; ?>
                                <?php endif; ?>    
                                    <td data-pedido='<?php echo e($item->idPedido); ?>' style="width:20px;">
                                        <a href="<?php echo e(asset('/')); ?>verpedido/<?php echo e($item->idPedido); ?>/1/" class="btn btn-xs btn-success" title="Ver Pedido"><?php echo e($item->idPedido); ?></a>
                                        <?php if( Session::get('grupoUsuario')=='C' and (Session::get('idPerfil')=='2' or Session::get('idPerfil')=='11') and $item->idEstadoPedido==1 ): ?>
                                            <button class="btn btn-xs btn-primary" title="Aprobar Pedido" onclick="aprobarPedido(<?php echo e($item->idPedido); ?>, this)"><span class="glyphicon glyphicon-ok"></span></button>
                                        <?php endif; ?>                                        
                                    </td>
                                    <td style="width: 60px;text-align: left;">
                                        <?php if($item->modificado>0): ?>
                                            <span class="badge badge-primary"><?php echo e($item->modificado); ?></span>
                                        <?php endif; ?>                                        
                                        <?php if($item->tipoTransporte==2): ?>
                                            <span class="badge badge-danger">M</span>
                                        <?php endif; ?>
                                        <?php if( $item->formula!='' ): ?>
                                            <span><img src="<?php echo e(asset('/')); ?>img/iconos/matraz.png" border="0" title="<?php echo e($item->formula); ?>" width="15px" height="15pxs"></span>
                                        <?php endif; ?>                                                                       
                                        <?php if( $item->cantidadReal>0 ): ?>
                                            <span><img src="<?php echo e(asset('/')); ?>img/iconos/cargacompleta.png" border="0"></span>
                                        <?php endif; ?>
                                        <?php if( $item->horaCarga!='' ): ?>
                                            <span><img src="<?php echo e(asset('/')); ?>img/iconos/time.png" border="0" title="<?php echo e($item->fechaCarga_dma); ?> <?php echo e($item->horaCarga); ?>"></span>
                                        <?php endif; ?>
                                        <?php if( $item->empresaTransporte!='' ): ?>
                                            <span><img src="<?php echo e(asset('/')); ?>img/iconos/user.png" border="0" title="<?php echo e($item->empresaTransporte); ?> / <?php echo e($item->apellidoConductor); ?>"></span>
                                        <?php endif; ?>                                    
                                        <?php if( $item->numeroGuia>0 ): ?>
                                            <span name="<?php echo e($item->numeroGuia); ?>" onclick='abrirGuia(<?php echo e($item->tipoGuia); ?>, <?php echo e($item->numeroGuia); ?>, this.parentNode.parentNode);' style="cursor:pointer; cursor: hand"><img src="<?php echo e(asset('/')); ?>img/iconos/guiaDespacho2.png" border="0"></span>
                                        <?php endif; ?>
                                        <?php if( $item->certificado!='' ): ?>  
                                            <a target="_blank" href="<?php echo e(asset('/')); ?>bajarCertificado/<?php echo e($item->certificado); ?>">
                                                <img src="<?php echo e(asset('/')); ?>img/iconos/certificado.png" border="0">
                                            </a>
                                        <?php endif; ?>
                                        <?php if( $item->salida==1 ): ?>
                                        <span><img src="<?php echo e(asset('/')); ?>img/iconos/enTransporte.png" border="0" onclick="verUbicacionGmaps('<?php echo e($item->Patente); ?>');" style="cursor:pointer; cursor: hand"></span>                                      
                                        <?php endif; ?>
                                    </td>                                        
                                    <td style="width: 50px"><?php echo e($item->estadoPedido); ?></td>
                                    <td style="width: 150px"><?php echo e($item->nombreCliente); ?></td>
                                    <td style="width: 150px"><?php echo e($item->nombreObra); ?></td>
                                    <td style="width: 70px">
                                        <?php echo e($item->prod_nombre); ?>                                   
                                    </td>
                                    <td style="width: 30px;text-align: right;"><?php echo e(number_format( $item->cantidad, 0, ',', '.' )); ?></td>
                                    <td style="width: 30px;text-align: center"><?php echo e($item->u_abre); ?></td>
                                    <td style="width: 100px"><?php echo e($item->fechaEntrega); ?> <?php echo e($item->horarioEntrega); ?></td>
                                    <td style="width: 70px"><?php echo e($item->formaEntrega); ?></td>
                                    <td style="width: 70px"><?php echo e($item->nombrePlanta); ?></td>
                                    <td style="width: 100px"><?php echo e($item->fechaCarga); ?> <?php echo e($item->horaCarga); ?> </td>
                                    <td style="width: 150px"><?php echo e($item->apellidoConductor); ?> / <?php echo e($item->empresaTransporte); ?></td>
                                    <td style="width: 50px;text-align: right;"><?php echo e($item->fechahora_creacion); ?></td>
                                    <td style="width: 80px;text-align: center;"><?php echo e($item->numeroAuxiliar); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>            
                    </table>            
 
               <?php endif; ?> 
            </div>
        </div>
    </div>
    <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
        <a href="<?php echo e(asset('/')); ?>dashboard" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
    </div>    
</div>

<?php echo $__env->make('guiaDespacho', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <!-- Datepicker -->
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo e(asset('/')); ?>locales/bootstrap-datepicker.es.min.js"></script>

    <!-- Timepicker -->
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-timepicker.min.js"></script>  

    <script src="<?php echo e(asset('/')); ?>js/app/funciones.js?<?php echo e($parametros[0]->version); ?>"></script>
    <script src="<?php echo e(asset('/')); ?>js/app/guiaDespacho.js?<?php echo e($parametros[0]->version); ?>"></script>

    <script>

        function aprobarPedido(idPedido, btn){
            $.ajax({
                url: urlApp + "aprobarPedido",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { idPedido: idPedido
                      },
                success:function(dato){
                    btn.style.visibility = 'hidden';   
                }
            })
        }


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
                                return;                         
                            }
                        }
                    );
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

        $(document).ready(function(){
            var tablaDetalle="#tablaDetalle";
            // Setup - add a text input to each footer cell
            $('#tablaDetalle thead tr').clone(true).appendTo( '#tablaDetalle thead' );
            $('#tablaDetalle thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                if(title.trim()!='' && title.trim()=='Obra/Planta' ){
                    $(this).html( '<select id="selObra" class="form-control input-sm"></select>' );
                }else if(title.trim()!='' && title.trim()=='Cliente' ){
                    $(this).html( '<select id="selCliente" class="form-control input-sm"></select>' );
                }else if(title.trim()!='' && title.trim()=='Estado' ){
                    $(this).html( '<select id="selEstado" class="form-control input-sm"></select>' );
                }else if(title.trim()!='' && title.trim()=='Forma Entrega' ){
                    $(this).html( '<select id="selFormaEntrega" class="form-control input-sm"></select>' );
                }else if(title.trim()!='' && title.trim()=='Planta Origen' ){
                    $(this).html( '<select id="selPlanta" class="form-control input-sm"></select>' );
                }else if(title.trim()!='' && title.trim()=='Unidad' ){
                    $(this).html( '<select id="selFormato" class="form-control input-sm"></select>' );
                }else if(title.trim()!='' && title.trim()=='Producto' ){
                    $(this).html( '<select id="selProducto" class="form-control input-sm"></select>' );                                     
                }else if(title.trim()!='' ){
                    $(this).html( '<input type="text" class="form-control input-sm" placeholder="" />' );
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


            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = fechaIngles( $('#min').val().trim() );
                    var max = fechaIngles( $('#max').val().trim() );

                    if ( document.getElementById('tablaDetalle').rows[0].cells.length==7 ){
                        var startDate=fechaIngles(data[5].substr(0,10));
                    }else{
                        var startDate=fechaIngles(data[8].substr(0,10));
                    }   

                    if (min == '' && max == '') { return true; }
                    if (min == '' && startDate <= max) { return true;}
                    if(max == '' && startDate >= min) {return true;}
                    if (startDate <= max && startDate >= min) { return true; }
                    return false;
                }
            );

            // DataTable
            var uPerfil='<?php echo e(Session::get("idPerfil")); ?>';


            var table=$('#tablaDetalle').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                "scrollX": true,
                lengthMenu: [[6, 12, 20, -1], ["6", "12", "20", "Todos"]],                
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'Nuevo Pedido',
                        className: 'orange',
                        attr:  {
                                    id: 'btnNuevoPedido'
                                },
                        action: function ( e, dt, node, config ) {
                            if( uPerfil==11  ){
                                swal(
                                    {
                                        title: 'Este perfil no tiene acceso a Crear Pedidos' ,
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
                            }else{
                                location.href="<?php echo e(asset('/')); ?>listarNotasdeVenta";
                            }
                        }
                    },
                    {
                        text: 'Actualizar',
                        action: function ( e, dt, node, config ) {
                            this.disable();    
                            location.reload(true);                        
                        }
                    },                                 
                    'pageLength',  
                    {
                        extend: 'excelHtml5',
                        title: 'Pedidos en Proceso',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                           
                        exportOptions: {
                            columns: [ 0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'Pedidos en Proceso',
                        text:      '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',                           
                        exportOptions: {
                            columns: [ 0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Pedidos en Proceso',
                        text:      '<i class="fa fa-file-pdf-o"></i>',
                        titleAttr: 'PDF',                          
                        exportOptions: {
                            columns: [ 0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                        }
                    },
                    {
                        text: 'Próximos pedidos Granel',
                        action: function ( e, dt, node, config ) {
                            window.open(urlApp + 'verResumenGranel', "QL Now")                    
                        }
                    },
                    {
                        text: 'Pedidos despachados',
                        action: function ( e, dt, node, config ) {
                            window.open(urlApp + 'verPedidosDespachados', "QL Now")                    
                        }
                    }                                        
                ],                
                "order": [[ 0, "desc" ]],             
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"},
                preDrawCallback: function( settings ) {
                    document.getElementById('panelBody').style.display="block";
                  },                
                initComplete: function () {
                    if( $("#idPerfil").val() == '11' ){
                        this.api().columns(2).every( function () {
                            var column = this;
                            var select = $("#selCliente" ).empty().append( '<option value=""></option>' )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
             
                                    column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                                } );
             
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                            } );
                        } );
                        this.api().columns(3).every( function () {
                            var column = this;
                            var select = $("#selObra" ).empty().append( '<option value=""></option>' )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
             
                                    column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                                } );
             
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                            } );
                        } );
                      
                        this.api().columns(6).every( function () {
                            var column = this;
                            var select = $("#selEstado" ).empty().append( '<option value=""></option>' )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
             
                                    column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                                } );
             
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                            } );
                        } );                                              
                    }else{

                        this.api().columns(2).every( function () {
                            var column = this;
                            var select = $("#selEstado" ).empty().append( '<option value=""></option>' )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
             
                                    column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                                } );
             
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                            } );
                        } );

                        this.api().columns(3).every( function () {
                            var column = this;
                            var select = $("#selCliente" ).empty().append( '<option value=""></option>' )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
             
                                    column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                                } );
             
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                            } );
                        } );

                        this.api().columns(4).every( function () {
                            var column = this;
                            var select = $("#selObra" ).empty().append( '<option value=""></option>' )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
             
                                    column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                                } );
             
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                            } );
                        } );
                        this.api().columns(5).every( function () {
                            var column = this;
                            var select = $("#selProducto" ).empty().append( '<option value=""></option>' )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
             
                                    column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                                } );
             
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                            } );
                        } );                           

                        this.api().columns(7).every( function () {
                            var column = this;
                            var select = $("#selFormato" ).empty().append( '<option value=""></option>' )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
             
                                    column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                                } );
             
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                            } );
                        } );
                        this.api().columns(9).every( function () {
                            var column = this;
                            var select = $("#selFormaEntrega" ).empty().append( '<option value=""></option>' )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
             
                                    column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                                } );
             
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                            } );
                        } );

                        this.api().columns(10).every( function () {
                            var column = this;
                            var select = $("#selPlanta" ).empty().append( '<option value=""></option>' )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
             
                                    column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                                } );
             
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                            } );
                        } );
                    }
                                  

                }                  
            });
                 
            $('.date').datepicker({
                todayHighlight: true,
                format: "dd/mm/yyyy",
                weekStart: 1,
                language: "es",
                autoclose: true
            }) 

  //          $("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
  //          $("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });

            // Event listener to the two range filtering inputs to redraw on input
            $('#min, #max').change(function () {
                table.draw();
            }); 


        });

    </script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>