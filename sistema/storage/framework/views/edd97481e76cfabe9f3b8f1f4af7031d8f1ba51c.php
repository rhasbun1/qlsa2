      

<?php $__env->startSection('contenedorprincipal'); ?>


<div style="padding: 5px">
    <div class="panel panel-default table-responsive">
        <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
        <div class="panel-heading">
            <b>Histórico de Pedidos Despachados</b>
        </div>
        <div class="panel-body" id="panelBody" style="display: none">
            <div class="padding-md clearfix">
                <div style="padding-bottom:5px"> 
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-4" style="padding-top: 5px">
                                    Filtrar por Horario Salida
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group date" id="divFechaMin">
                                        <input type="text" class="form-control input-sm" id="min">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group date" id="divFechaMax">
                                        <input type="text" class="form-control input-sm" id="max">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding-top: 5px">
                                <div class="col-md-4">
                                    Cliente
                                </div>
                                <div class="col-md-8">
                                    <?php if( Session::get('empresaUsuario')!='0' ): ?>
                                        <select id="idCliente" class="form-control input-sm" readonly>
                                            <option value="<?php echo e($clientes[0]->emp_codigo); ?>"><?php echo e($clientes[0]->emp_nombre); ?></option>
                                    <?php else: ?>
                                        <select id="idCliente" class="form-control input-sm">
                                            <option value="0">Todos los clientes</option>
                                            <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($item->emp_codigo); ?>"><?php echo e($item->emp_nombre); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     <?php endif; ?>    
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="padding-top: 5px">
                                <div class="col-md-4">
                                    Planta QLSA
                                </div>
                                <div class="col-md-8">
                                    <select id="idPlanta" class="form-control input-sm">
                                        <?php if( Session::get('idPlanta')=='0' ): ?>
                                            <option value="0">Todas las plantas</option>
                                            <?php $__currentLoopData = $plantas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($item->idPlanta); ?>"><?php echo e($item->nombre); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>    
                                            <?php $__currentLoopData = $plantas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if( Session::get('idPlanta')==$item->idPlanta): ?>
                                                    <option value="<?php echo e($item->idPlanta); ?>"><?php echo e($item->nombre); ?></option>
                                                <?php endif; ?>    
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>                                            
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-5">
                                    Rango por Nº de Pedido
                                </div>
                                <div class="col-md-3">
                                    <input id="txtPedidoDesde" class="form-control input-sm" id="min" maxlength="9" onkeypress="return isIntegerKey(event)">
                                </div>
                                <div class="col-md-3">
                                    <input id="txtPedidoHasta" class="form-control input-sm" id="max" maxlength="9" onkeypress="return isIntegerKey(event)">
                                </div>
                            </div>
                            <div class="row" style="padding-top: 5px">
                                <div class="col-md-5">
                                    Rango por Nº Guía Despacho
                                </div>
                                <div class="col-md-3">
                                    <input id="txtGuiaDesde" class="form-control input-sm" id="min" maxlength="9" onkeypress="return isIntegerKey(event)">
                                </div>
                                <div class="col-md-3">
                                    <input id="txtGuiaHasta" class="form-control input-sm" id="max" maxlength="9" onkeypress="return isIntegerKey(event)">
                                </div>
                            </div>
                            <div class="row" style="padding-top:10px; text-align: right;">
                                <div class="col-md-11">
                                    <button class="btn btn-success btn-sm" onclick="obtenerHistorico();">Buscar Selección</button>
                                </div>
                            </div>
                        </div>
                    </div>                                                                             
                </div>
                <hr style="color: #0056b2;" />
                <table id="tablaDetalle" class="table table-hover table-condensed"  style="width: 100%">
                    <thead>
                        <th style="width: 60px">Pedido</th>
                        <th style="width: 120px"></th>
                        <th style="width: 150px">Cliente</th>
                        <th style="width: 150px">Obra/Planta</th>
                        <th style="width: 120px">Producto</th>
                        <th style="width: 60px; text-align: right;">Cantidad<br>Real</th>
                        <th style="width: 60px">Unidad</th>
                        <th>Fecha Entrega Solicitada</th>
                        <th style="width: 150px">Horario de Salida</th>
                        <th>Forma de Entrega</th>
                        <th style="width: 80px">Planta de Origen</th>
                        <th style="width: 100px">Estado</th>
                        <th style="width: 60px; text-align: right;">Nota de Venta</th>
                        <th style="width: 60px; text-align: right;">Nº de guía</th>
                        <th style="width: 80px; text-align: right;">Nº Aux.</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $pedidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="width: 60px">
                                    <a target="_blank" href="<?php echo e(asset('/')); ?>verpedidoNuevaVentana/<?php echo e($item->idPedido); ?>/1/" class="btn btn-xs btn-success"><?php echo e($item->idPedido); ?></a>
                                </td>
                                <td style="width: 120px">
                                    <?php if($item->modificado>0): ?>
                                        <span class="badge badge-primary"><?php echo e($item->modificado); ?></span>
                                    <?php endif; ?>                                        
                                    <?php if($item->tipoTransporte==2): ?>
                                        <span class="badge badge-danger">M</span>
                                    <?php endif; ?>
                                    <?php if( $item->formula!='' ): ?>
                                        <span><img src="<?php echo e(asset('/')); ?>img/iconos/matraz.png" border="0" title="<?php echo e($item->formula); ?>" width="15px" height="15pxs"></span>
                                    <?php endif; ?>   
                                    <?php if( $item->numeroGuia>0 ): ?>
                                        <span onclick='abrirGuia(1, <?php echo e($item->numeroGuia); ?>, this.parentNode.parentNode);' style="cursor:pointer; cursor: hand"><img src="<?php echo e(asset('/')); ?>img/iconos/guiaDespacho2.png" border="0"></span>
                                    <?php endif; ?>
                                    <?php if( $item->certificado!='' ): ?>  
                                        <a target="_blank" href="<?php echo e(asset('/')); ?>bajarCertificado/<?php echo e($item->certificado); ?>/">    
                                            <img src="<?php echo e(asset('/')); ?>img/iconos/certificado.png" border="0">
                                        </a>
                                    <?php endif; ?>
                                    <?php if( $item->salida==1 ): ?>
                                    <span><img src="<?php echo e(asset('/')); ?>img/iconos/enTransporte.png" border="0" onclick="verUbicacionGmaps('<?php echo e($item->Patente); ?>');" style="cursor:pointer; cursor: hand"></span>                                      
                                    <?php endif; ?>                              
                                </td>
                                <td style="width: 150px"><?php echo e($item->emp_nombre); ?></td>
                                <td style="width: 150px"><?php echo e($item->nombreObra); ?></td>
                                <td style="width: 120px"><?php echo e($item->prod_nombre); ?></td>
                                <td style="width: 60px; text-align: right;"><?php echo e($item->cantidadReal); ?></td>
                                <td style="width: 60px"><?php echo e($item->unidad); ?></td>
                                <td><?php echo e($item->fechaEntrega); ?></td>
                                <td style="width: 150px"><?php echo e($item->fechaHoraSalida); ?></td>
                                <td><?php echo e($item->formaEntrega); ?></td>
                                <td style="width: 80px"><?php echo e($item->nombrePlanta); ?></td>
                                <td style="width: 100px"><?php echo e($item->estadoPedido); ?></td>
                                <td style="width: 60px; text-align: right;"><?php echo e($item->idNotaVenta); ?></td>
                                <td style="width: 60px; text-align: right;"><?php echo e($item->numeroGuia); ?></td>
                                <td style="width: 80px; text-align: right;">
                                    <?php if( Session::get('idPerfil')>='5' and Session::get('idPerfil')<='7' ): ?>
                                        <a class="btn btn-xs btn-default" style="height: 25px;width:100px" onclick="ingresarNumeroAuxiliar(this.parentNode.parentNode );"><?php echo e($item->numeroAuxiliar); ?></a>
                                    <?php else: ?>
                                        <?php echo e($item->numeroAuxiliar); ?>

                                    <?php endif; ?>
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>            
                </table>      
            </div>
        </div>
    </div>
    <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
        <a href="<?php echo e(asset('/')); ?>dashboard" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
    </div>    
</div>

<div id="mdProcesando" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" style="text-align: center">
          <img src="<?php echo e(asset('/')); ?>img/procesando.gif" alt="User Avatar">
      </div>
    </div>
  </div>
</div>  
<div id="modNumeroAuxiliar" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5><b>Ingrese número auxiliar</b></h5>
            </div>
            <div id="bodyProducto" class="modal-body">
                <input id="numeroAuxiliar" class="form-control input-sm" maxlength="10" data-fila="0">
            </div>
            <div class="col-md-offset-4" style="padding-top: 20px; padding-bottom: 20px">
               <button id="btnNumAuxiliar" type="button" class="btn btn-warning btn-sm" style="width: 100px" onclick="guardarNumeroAuxiliar();">Guardar</button>
               <button id="btnCerrarMumAuxiliar" type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarModalNumeroAuxliar()" style="width: 80px">Salir</button>
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
    <script src="<?php echo e(asset('/')); ?>js/app/guiaDespacho.js?<?php echo e($parametros[0]->version); ?>"></script>
    <script>

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

            if(document.getElementById('upload-demo').value.trim()==''){
                swal(
                    {
                        title: 'Debe seleccionar un archivo!!' ,
                        text: '',
                        type: 'warning',
                        showCancelButton: false,
                        closeOnConfirm: true,
                        confirmButtonText: 'Cerrar',
                        cancelButtonText: '',
                    });
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
                if( table.cell(i,13).data()==numGuia ){
                    cadena=table.cell(i,1).data();
                    table.cell(i,1).data( cadena.replace(numeroGuiaOrigen, nuevoNumeroGuia) );
                    table.cell(i,13).data( $('#nuevoFolioDTE').val() );
                }
            }

            // Aqui se actualizan los cantidades ingresadas en la guía de despacho   

            actualizarDatosGuiaDespacho(false);

            // a continuación se envia el formulario con el nuevo número de guía y el archivo pdf correspondiente a la guía

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
            //    $("#numGuia").val( $("#nuevoFolioDTE").val() );
                document.getElementById('btnEmitirGuia').style.display='none';
                document.getElementById('btnBajar').style.display='inline';
                cerrarModalSubirGuiaPdf();                 
              },
              error: function(jqXHR, text, error){
                  alert('Error!, No se pudo Añadir los datos');
              }
          });
        });

        function obtenerHistorico(){


            $("#mdProcesando").modal('show');    

            var tabla=$("#tablaDetalle").DataTable();

            tabla.rows().remove();

            var fechaSalidaDesde=$("#min").val().trim();
            var fechaSalidaHasta=$("#max").val().trim();

            if(fechaSalidaDesde==''){
                fechaSalidaDesde='01/01/1900';
            }
            
            if(fechaSalidaHasta==''){   
                var hoy = new Date();
                var dd = hoy.getDate();
                var mm = hoy.getMonth()+1;
                var yyyy = hoy.getFullYear();

                if (dd < 10) {dd = '0' + dd; }
                if (mm < 10) {mm = '0' + mm; }
            
                fechaSalidaHasta=dd + '/' + mm + '/' + yyyy;
            }

            var pedDesde="0";
            if( $("#txtPedidoDesde").val()!=''){
                pedDesde=$("#txtPedidoDesde").val();
            }

            var pedHasta="0";
            if( $("#txtPedidoHasta").val()!=''){
                pedHasta=$("#txtPedidoHasta").val();
            }

            var guiaDesde="0";
            if( $("#txtGuiaDesde").val()!=''){
                guiaDesde=$("#txtGuiaDesde").val();
            }

            var guiaHasta="0";
            if( $("#txtGuiaHasta").val()!=''){
                guiaHasta=$("#txtGuiaHasta").val();
            }
           
            $.ajax({
                url: urlApp +'obtenerHistoricoPedidos',
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        salidaDesde: fechaSalidaDesde,
                        salidaHasta: fechaSalidaHasta,
                        emp_codigo: $("#idCliente").val(),
                        idPlanta: $("#idPlanta").val(),
                        pedidoDesde: pedDesde,
                        pedidoHasta: pedHasta,
                        guiaDesde: guiaDesde,
                        guiaHasta: guiaHasta 
                      },
                success:function(dato){
                    for(var x=0;x<dato.length;x++){
                        cadena="";
                        if(dato[x].modificado>0){
                            cadena+='<span class="badge badge-primary">' + dato[x].modificado + '</span>';
                        }    
                        if(dato[x].tipoTransporte==2){
                            cadena+='<span class="badge badge-danger">M</span>';
                        }
                        if( dato[x].formula!='' ){
                            cadena+='<span><img src="' + urlApp +'img/iconos/matraz.png" border="0" title="' + dato[x].formula +'" width="15px" height="15pxs"></span>';
                        }
                        if( dato[x].numeroGuia>0 ){
                            cadena+='<span onclick="abrirGuia(1, ' + dato[x].numeroGuia + ', this.parentNode.parentNode);" style="cursor:pointer; cursor: hand"><img src="'+ urlApp + 'img/iconos/guiaDespacho2.png" border="0"></span>';
                        }
                        if( dato[x].certificado!='' ){  
                            cadena+='<a target="_blank" href="'+ urlApp + 'bajarCertificado/'+ dato[x].certificado +'">';
                            cadena+='<img src="'+ urlApp + 'img/iconos/certificado.png" border="0"></a>';
                        }
                        if( dato[x].salida==1 ){
                            cadena+='<span><img src="' + urlApp + 'img/iconos/enTransporte.png" border="0" onclick="verUbicacionGmaps(' + dato[x].Patente + ');" style="cursor:pointer; cursor: hand"></span>';    
                        }

                        celdaPedido='<a target="_blank" href="'+urlApp+'verpedidoNuevaVentana/'+ dato[x].idPedido + '/1/" class="btn btn-xs btn-success">' + dato[x].idPedido +'</a>';


                        celdaNumAux="";
                        if(document.getElementById('idPerfilSession').value>=5 && document.getElementById('idPerfilSession').value<=7 ){
                            celdaNumAux='<a class="btn btn-xs btn-default" style="height: 25px;width:100px" onclick="ingresarNumeroAuxiliar(this.parentNode.parentNode );">' + dato[x].numeroAuxiliar + '</a>';                                   
                        }else{
                           celdaNumAux='<td style="width: 80px; text-align: center;">' + dato[x].numeroAuxiliar + '</td>';
                        }                        
                        tabla.row.add( [
                                celdaPedido,
                                cadena,
                                dato[x].emp_nombre,
                                dato[x].nombreObra,
                                dato[x].prod_nombre,
                                dato[x].cantidadReal,
                                dato[x].unidad,
                                dato[x].fechaEntrega,
                                dato[x].fechaHoraSalida,
                                dato[x].formaEntrega,
                                dato[x].nombrePlanta,
                                dato[x].estadoPedido,
                                dato[x].idNotaVenta,
                                dato[x].numeroGuia,
                                celdaNumAux
                            ] );
                    }
                    tabla.draw();
                    actualizarFiltros(tabla);
                    $("#mdProcesando").modal('hide');
                },
                error: function(jqXHR, text, error){
                    $("#mdProcesando").modal('hide');
                    alert('Ha ocurrido un error!, vuelva a presionar el botón Buscar Selección');
                }                
            })
        }

        function ingresarNumeroAuxiliar(row){
            var tabla=$("#tablaDetalle").DataTable();
            var fila=tabla.row(row).index();
            var celda=tabla.cell(fila,14).node();
            $("#numeroAuxiliar").val(celda.getElementsByTagName('a')[0].innerHTML);            
            document.getElementById("numeroAuxiliar").dataset.fila=tabla.row( row ).index();;
            $("#modNumeroAuxiliar").modal('show');
        } 

        function cerrarModalNumeroAuxliar(){
            $("#modNumeroAuxiliar").modal('hide');
        }
        
        function guardarNumeroAuxiliar(){
            var fila=document.getElementById('numeroAuxiliar').dataset.fila;
            var tabla=$("#tablaDetalle").DataTable();
            var celda=tabla.row(document.getElementById("numeroAuxiliar").dataset.fila,0).node();
            var pedido=celda.getElementsByTagName('a')[0].innerHTML;

            for(var x=0;x<tabla.rows().count();x++){
                celda=tabla.cell(x,0).node();
                if(celda.getElementsByTagName('a')[0].innerHTML==pedido){
                    celda=tabla.cell(x,14).node();
                    celda.getElementsByTagName('a')[0].innerHTML=$("#numeroAuxiliar").val();
                    tabla.cell(x,14).draw();
                }
            }

            //guardar Numero auxiliar en el pedido
            $.ajax({
                url: urlApp + "actualizarNumeroAuxiliar",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        idPedido: pedido,
                        numeroAuxiliar: $("#numeroAuxiliar").val()
                      },
                success:function(dato){
                }
            });
            cerrarModalNumeroAuxliar();      
        }        

        $(document).ready(function() {


            var hoy = new Date();
            var dd = hoy.getDate();
            var mm = hoy.getMonth()+1;
            var yyyy = hoy.getFullYear();

            if (dd < 10) {dd = '0' + dd; }
            if (mm < 10) {mm = '0' + mm; }
            $("#max").val(dd + '/' + mm + '/' + yyyy);


            hoy.setDate(hoy.getDate() - 60);
            var dd = hoy.getDate();
            var mm = hoy.getMonth()+1;
            var yyyy = hoy.getFullYear();
            if (dd < 10) {dd = '0' + dd; }
            if (mm < 10) {mm = '0' + mm; }
            $("#min").val(dd + '/' + mm + '/' + yyyy);


            var tablaDetalle="#tablaDetalle";
            
            // Setup - add a text input to each footer cell
            $('#tablaDetalle thead tr').clone(true).appendTo( '#tablaDetalle thead' );
            $('#tablaDetalle thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                if(title.trim()!='' && title.trim()=='Estado Pedido' ){
                    $(this).html( '<select id="selEstado" class="form-control input-sm"></select>' );
                }else if(title.trim()!='' && title.trim()=='Planta de Origen' ){
                    $(this).html( '<select id="selPlanta" class="form-control input-sm"></select>' );
                }else if(title.trim()!='' && title.trim()=='Producto' ){
                    $(this).html( '<select id="selProducto" class="form-control input-sm"></select>' );                    
                }else if(title.trim()!='' && title.trim()=='Forma de Entrega' ){
                    $(this).html( '<select id="selFormaEntrega" class="form-control input-sm"></select>' );
                }else if(title.trim()!='' && title.trim()=='Estado' ){
                    $(this).html( '<select id="selEstado" class="form-control input-sm"></select>' );                                                 
                }else if(title.trim()!='' ){
                    $(this).html( '<input type="text" class="form-control input-sm" placeholder="Buscar..." />' );
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


           var tituloArchivo='Histórico de Pedidos Despachados'

            // DataTable
            var table=$('#tablaDetalle').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                lengthMenu: [[6, 12, 20, -1], ["6", "12", "20", "Todos"]],
                "scrollX": true,                
                dom: 'Bfrtip',                
                buttons: [
                    'pageLength', 
                    {
                        extend: 'excelHtml5',
                        title: tituloArchivo,
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        title: tituloArchivo,
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: tituloArchivo,
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14 ]
                        }
                    }
                ],                
                "order": [[ 0, "desc" ]],
                columnDefs: [
                    { width: 75, targets: 0 },
                    { width: 100, targets: 1 },
                    { width: 200, targets: 2 },
                    { width: 100, targets: 4 },
                    { width: 100, targets: 5 }
                ],                          
                language:{ url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json",
                           "decimal": ","},
                preDrawCallback: function( settings ) {
                    document.getElementById('panelBody').style.display="block";
                  },
                initComplete: function () {
                    actualizarFiltros(this.api());
                }                  
            });

            $('.date').datepicker({
                todayHighlight: true,
                format: "dd/mm/yyyy",
                weekStart: 1,
                language: "es",
                autoclose: true
            }) 

            $('#wrapper').toggleClass('sidebar-hide');
            $('.main-menu').find('.openable').removeClass('open');
            $('.main-menu').find('.submenu').removeAttr('style'); 

        } );

        function actualizarFiltros(tabla){
            tabla.columns(10).every( function () {
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

            tabla.columns(4).every( function () {
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
            tabla.columns(6).every( function () {
                var column = this;
                var select = $("#selUnidad" ).empty().append( '<option value=""></option>' )
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
            tabla.columns(9).every( function () {
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
            tabla.columns(11).every( function () {
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

        }

    </script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>