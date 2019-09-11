      

<?php $__env->startSection('contenedorprincipal'); ?>

<div style="padding: 5px">

    <div class="panel panel-default" id="contenedor3">

        <div class="panel-body">
            <h5><b><?php echo e($titulo); ?></b> ( <b>Importante</b>: Para los certificados sólo se permiten subir archivos de tipo PDF. )</h5>
            <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
            <div class="table-responsive">
                <table id="tablaAprobados" class="table table-condensed">
                    <thead>                      
                        <th style="width:50px"></th>
                        <th style="width:50px">Pedido</th>
                        <th style="width:50px">Guía</th>
                        <th style="width:70px">Planta Origen</th>
                        <th style="width:200px">Cliente</th>
                        <th style="width:200px">Obra</th>
                        <th style="width:80px">Producto</th>
                        <th style="width:50px;text-align: right;">Cantidad</th>
                        <th style="width:50px">Unidad</th>
                        <th style="width:100px">Diseño</th>
                        <th style="width:80px">Conductor</th>                        
                        <th style="width:50px">Patente</th>
                        <th style="width:100px">Fecha/Hora Carga</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $guias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>                                    
                                <td style="width:50px" data-numguia="<?php echo e($item->numeroGuia); ?>" data-prodcodigo="<?php echo e($item->prod_codigo); ?>">
                                    <?php if( $item->certificado=='' ): ?>
                                        <button class="btn btn-warning btn-xs" onclick="abrirModalSubirArchivo(this.parentNode.parentNode.rowIndex, 1, <?php echo e($item->prod_codigo); ?> );" title="Subir Certificado"><span class="glyphicon glyphicon-arrow-up"></span></button>
                                    <?php else: ?>
                                        <a target="_blank" href="<?php echo e(asset('/')); ?>bajarCertificado/<?php echo e($item->certificado); ?>">
                                            <img src="<?php echo e(asset('/')); ?>img/iconos/certificado.png" border="0">
                                        </a>
                                        <button type="button" class="btn btn-danger btn-xs" onclick="eliminarCertificado(this);" data-archivo="<?php echo e($item->certificado); ?>">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button> 
                                    <?php endif; ?>                                    
                                </td>
                                <td style="width:50px">
                                    <a href="<?php echo e(asset('/')); ?>verpedido/<?php echo e($item->idPedido); ?>/8/" class="btn btn-xs btn-success"><?php echo e($item->idPedido); ?></a>
                                    <span name="<?php echo e($item->numeroGuia); ?>" onclick='abrirGuia(1, <?php echo e($item->numeroGuia); ?>, this.parentNode.parentNode);' style="cursor:pointer; cursor: hand" title="Ver guía"><img src="<?php echo e(asset('/')); ?>img/iconos/guiaDespacho2.png" border="0"></span>
                                </td>
                                <td style="width:70px;text-align: right;">
                                    <?php if( $item->folioDTE>0): ?>
                                        <?php echo e($item->folioDTE); ?>

                                    <?php endif; ?>
                                </td>
                                <td style="width:70px"><?php echo e($item->plantaOrigen); ?></td>
                                <td style="width:200px"><?php echo e($item->emp_nombre); ?></td>
                                <td style="width:200px"><?php echo e($item->obra); ?></td>
                                <td style="width:80px"><?php echo e($item->prod_nombre); ?></td>
                                <td style="width:50px; text-align: right;"><?php echo e(number_format( $item->cantidadDespachada, 0, ',', '.' )); ?></td>
                                <td style="width:50px"><?php echo e($item->unidad); ?></td>
                                <td style="width:100px"><?php echo e($item->formula); ?></td>
                                <td style="width:80px"><?php echo e($item->retiradoPor); ?></td>
                                <td style="width:50px"><?php echo e($item->patenteCamionDespacho); ?></td>
                                <th style="width:100px"><?php echo e($item->fechaHoraCarga); ?></th>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>            
                </table>
            </div>
        </div>
    </div>
   
</div>

<?php echo $__env->make('guiaDespacho', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div id="modSubirArchivo" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <input type="hidden" id="filaTabla" name="filaTabla">
                <h5><b>Subir Certificado</b></h5>
            </div>
            <div id="bodyProducto" class="modal-body">
                <form id="datos" name="datos" enctype="multipart/form-data">
                    <input type="hidden" id="codigoTipoGuia" name="codigoTipoGuia">
                    <input type="hidden" id="codigoProducto" name="codigoProducto">
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Guia Nº
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm" id="numeroGuiaCertificado" name="numeroGuiaCertificado" readonly>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Cliente
                        </div>
                        <div class="col-md-8">
                            <input class="form-control input-sm" id="nombreCliente" readonly>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Obra
                        </div>
                        <div class="col-md-8">
                            <input class="form-control input-sm" id="nombreObra" readonly>
                        </div>
                    </div>                                           
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Producto
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm" id="nombreProducto" data-codigo="0" readonly>
                        </div>
                        <div class="col-md-2">
                            Diseño
                        </div>
                        <div class="col-md-3">
                            <input class="form-control input-sm" id="diseno" data-codigo="0" readonly>
                        </div>                    
                    </div>
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Cantidad
                        </div>
                        <div class="col-md-5">
                            <input class="form-control input-sm" id="cantidad" data-codigo="0" readonly>
                        </div>
                    </div>                
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Conductor
                        </div>
                        <div class="col-md-8">
                            <input class="form-control input-sm" id="nombreConductor" readonly>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Patente
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm" id="patente" readonly>
                        </div>
                    </div>                                
                    <div class="row" style="padding: 15px">
                        <input type="file" class="form-control input-sm" id="miArchivo" name="miArchivo" accept=".pdf" required>
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

    <script src="<?php echo e(asset('/')); ?>js/app/funciones.js"></script>
    <script src="<?php echo e(asset('/')); ?>js/app/guiaDespacho.js"></script>
    
    <script src="https://cdn.datatables.net/fixedcolumns/3.2.5/js/dataTables.fixedColumns.min.js"></script>

    <script>

        function abrirModalSubirArchivo(fila, tipoGuia, codProducto){
            var tabla=document.getElementById('tablaAprobados');
            $("#filaTabla").val(fila);
            $("#numeroGuiaCertificado").val( tabla.rows[fila].cells[0].dataset.numguia);
            $("#codigoTipoGuia").val(tipoGuia);
            $("#nombreCliente").val(tabla.rows[fila].cells[3].innerHTML.trim() );
            $("#nombreObra").val(tabla.rows[fila].cells[4].innerHTML.trim() );
            $("#nombreProducto").val(tabla.rows[fila].cells[5].innerHTML.trim() );
            $("#cantidad").val( tabla.rows[fila].cells[6].innerHTML.trim() + " " + tabla.rows[fila].cells[7].innerHTML.trim() );
            $("#diseno").val(tabla.rows[fila].cells[8].innerHTML.trim() );
            $("#codigoProducto").val(codProducto);
            $("#nombreConductor").val(tabla.rows[fila].cells[9].innerHTML.trim());
            $("#patente").val(tabla.rows[fila].cells[10].innerHTML.trim() );
            $("#miArchivo").val('');
            $("#modSubirArchivo").modal('show');
        }


        function cerrarModalSubirArchivo(){
            $("#modSubirArchivo").modal("hide");
        }

        function eliminarCertificado(btn){
            swal(
                {
                    title: '¿Elimina el certificado de este producto?' ,
                    text: '',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm)
                {
                    if(isConfirm){
                        $.ajax({
                            async: false,
                            url: urlApp + "eliminarCertificado",
                            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                    nombreCertificado: btn.dataset.archivo 
                                  },                    
                            success:function(dato){
                                btn.parentNode.innerHTML='<button class="btn btn-warning btn-xs" onclick="abrirModalSubirArchivo(this.parentNode.parentNode.rowIndex, 1,' + btn.parentNode.dataset.prodcodigo + ');"><span class="glyphicon glyphicon-arrow-up"></span></button>';
                            },
                            error: function(result) {
                               // cerrarModProcesando();
                               alert("Ha ocurrido un error y el documento no pudo ser procesado");
                            }
                        })                                    
                      
                    }
                }
            )            
        }
        
        $('#datos').on('submit', function(e) {
          // evito que propague el submit
          e.preventDefault();
          // agrego la data del form a formData
          var formData = new FormData( $("#datos")[0]);
          $.ajax({
              url: urlApp + "subirCertificado",
              headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
              type:'POST',
              data:formData,
              cache:false,
              contentType: false,
              processData: false,
              success:function(data){
                  var tabla=document.getElementById('tablaAprobados');
                  var fila= $("#filaTabla").val();
                  cerrarModalSubirArchivo();
                  tabla.rows[fila].cells[0].innerHTML="<a target='_blank' href='"+ urlApp + "bajarCertificado/" + data + "'><img src='<?php echo e(asset('/')); ?>img/iconos/certificado.png' border='0'></a><button class='btn btn-danger btn-xs' onclick='eliminarCertificado(this)' data-archivo='"+ data + "'><span class='glyphicon glyphicon-remove'></span></button>";  
              },
              error: function(jqXHR, text, error){
                  alert('Error!, No se pudo Añadir los datos');
              }
          });
        });


        $(document).ready(function() {
            // Setup - add a text input to each footer cell

            // DataTable

            // Setup - add a text input to each footer cell
            $('#tablaAprobados thead tr').clone(true).appendTo( '#tablaAprobados thead' );
            $('#tablaAprobados thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                if(title.trim()!='' && title.trim()=='Planta Origen' ){
                    $(this).html( '<select id="selPlanta" class="form-control input-sm"></select>' );
                }else{
                    if(i>0){
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
                }
            
            } );

                        
            var table=$('#tablaAprobados').DataTable({
                 orderCellsTop: true,
                 fixedHeader: true,         
                "lengthMenu": [[6, 12, 20, -1], ["6", "12", "20", "Todos"]],
                dom: 'Bfrtip',
                "scrollX": true,
                buttons: [
                    {
                        text: 'Actualizar',
                        action: function ( e, dt, node, config ) {
                            this.disable();    
                            location.reload(true);                        
                        }
                    },                
                    'pageLength'
                ],                  
                "order": [[ 1, "desc" ]],                        
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"},
                initComplete: function () {
                    this.api().columns(3).every( function () {
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

            });         

        } );



    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>