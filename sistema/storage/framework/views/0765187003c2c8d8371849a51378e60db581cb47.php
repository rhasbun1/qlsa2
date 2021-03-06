      

<?php $__env->startSection('contenedorprincipal'); ?>

<div style="padding: 20px">
    <div class="panel panel-default table-responsive">
        <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
        <div class="panel-heading">
            <b>Productos</b>
        </div>
        <div class="padding-md clearfix">           
            <table id="tabla" class="table table-hover table-condensed table-responsive"  style="width: 100%">
                <thead>
                    <th style="display: none">ID</th>
                    <th style="width:150px">Producto</th>
                    <th style="width:70px">Unidad</th>
                    <th style="width:70px">Planta</th>
                    <th style="text-align: right;">Costo ($)</th>
                    <th style="text-align: right;">Fecha Costo</th>
                    <th style="text-align: right;">Precio Ref. ($)</th>
                    <th>Cód.Softland</th>
                    <th style="text-align: center;">Requiere Diseño</th>
                    <th style="text-align: center;">Granel</th>
                    <th style="text-align: center;">Certificado</th>
                    <th style="width:40px"></th>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $listaProductos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="display: none"><?php echo e($item->idProductoListaPrecios); ?></td>
                            <td style="width:150px"><?php echo e($item->prod_nombre); ?></td>
                            <td style="width:70px"><?php echo e($item->u_nombre); ?></td>
                            <td style="width:70px"><?php echo e($item->nombrePlanta); ?></td>
                            <td style="text-align: right;"><?php echo e(number_format( $item->costo, 0, ',', '.' )); ?></td>
                            <td style="text-align: right;"><?php echo e($item->fechaCosto); ?></td>
                            <td style="text-align: right;"><?php echo e(number_format( $item->precioReferencia, 0, ',', '.' )); ?></td>
                            <td><?php echo e($item->codigoSoftland); ?></td>
                            <td style="text-align: center;">
                                <?php if($item->requiereDiseno==1): ?> SI <?php else: ?> NO <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if($item->granel==1): ?> SI <?php else: ?> NO <?php endif; ?>
                            </td>    
                            <td style="text-align: center;"><?php if($item->solicitaCertificado==1): ?> SI <?php else: ?> NO <?php endif; ?></td>                       
                            <td style="width:40px">
                                <?php if( Session::get('idPerfil')=='1' or
                                    Session::get('idPerfil')=='2' or
                                    Session::get('idPerfil')=='4' or
                                    Session::get('idPerfil')=='18' or
                                    Session::get('idPerfil')=='5' ): ?>                                
                                <button class="btn btn-xs btn btn-warning btnEditar" title="Editar"><i class="fa fa-edit fa-lg"></i></button>
                                <button class="btn btn-xs btn btn-danger btnEliminar" title="Eliminar"><i class="fa fa-trash-o fa-lg"></i></button>
                                <?php endif; ?>
                            </td>                            
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>              
            </table>      
        </div>
    </div>
    <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
        <a href="<?php echo e(asset('/')); ?>dashboard" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
    </div>    
</div>

<div id="modProducto" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header" id="tituloFormProducto">
            <h5><b>Datos Producto</b></h5>
        </div>
        <div id="bodyProducto" class="modal-body">
            <input class="hidden" id="fila">
            <div class="row" style="padding-top: 5px">
                <div class="col-md-3">
                    Nombre (*)
                </div>
                <div class="col-md-7">
                    <input class="form-control input-sm" id="nombreProducto" data-idproducto="0">
                </div>
            </div>
            <div class="row" style="padding-top: 5px">
                <div class="col-md-3">
                    Unidad (*)
                </div>
                <div class="col-md-3">
                    <select class="form-control input-sm" id="selUnidades">
                        <?php $__currentLoopData = $unidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->u_codigo); ?>"><?php echo e($item->u_nombre); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    </select>  
                </div>
                <div class="col-md-3">
                    Código Softland
                </div>
                <div class="col-md-3">
                    <input class="form-control input-sm" id="codigoSoftland" maxlength="10">
                </div>            
            </div>                     
            <div class="row" style="padding-top: 5px">
                <div class="col-md-3">
                    Planta (*)
                </div>
                <div class="col-md-3">
                    <select class="form-control input-sm" id="selPlantas">
                        <?php $__currentLoopData = $plantas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->idPlanta); ?>"><?php echo e($item->nombre); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    </select>  
                </div>
                <div class="col-md-3">
                    Precio Referencia (*)
                </div>
                <div class="col-md-3">
                    <input class="form-control input-sm" id="precioReferencia" onkeypress='return isNumberKey(event)'>
                </div>                
            </div>
            <div class="row" style="padding-top: 5px">
                <div class="col-md-3">
                    Costo (*)
                </div>
                <div class="col-md-3">
                    <input class="form-control input-sm" id="precioCosto" onkeypress='return isNumberKey(event)'>
                </div>
                <div class="col-md-3">
                    Fecha
                </div>
                <div class="col-md-3">
                    <input class="form-control input-sm" id="fechaCosto" readonly>
                </div>                
            </div>
            <div class="row" style="padding-top: 20px">
                <div class="col-md-3">
                    Requiere Diseño
                </div>
                <div class="col-md-3">
                    <select class="form-control input-sm" id="requiereDiseno">
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                    </select>
                </div>
                <div class="col-md-3">
                    Granel
                </div>
                <div class="col-md-3">
                    <select class="form-control input-sm" id="granel">
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                    </select>
                </div>
            </div>
            <div class="row" style="padding-top: 5px">
                <div class="col-md-3">
                    Solicita Certificado
                </div>
                <div class="col-md-3">
                    <select class="form-control input-sm" id="solicitaCertificado">
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                    </select>
                </div>
            </div>                            
        </div>
        <div class="col-md-offset-8" style="padding-top: 20px; padding-bottom: 20px">
           <button type="button" class="btn btn-success btn-sm" onclick="guardarDatosProducto();" style="width: 80px">Guardar</button>
           <button type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarModProducto()" style="width: 80px">Salir</button>
        </div>        
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <!-- Datepicker -->
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-datepicker.min.js"></script>  

    <!-- Timepicker -->
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-timepicker.min.js"></script>  
    <script src="<?php echo e(asset('/')); ?>js/app/funciones.js"></script>
    <script src="js/syncfusion/ej.web.all.min.js"> </script>
    <script src="<?php echo e(asset('/')); ?>js/syncfusion/lang/ej.culture.de-DE.min.js"></script>

    <script>
        $("#precioCosto").ejNumericTextbox({
            decimalPlaces: 0,
           // watermarkText: "Ingrese valor",
            minValue: 0,
            locale: "de-DE",
            showSpinButton: false,
            width: 120
        });

        $("#precioReferencia").ejNumericTextbox({
            decimalPlaces: 0,
           // watermarkText: "Ingrese valor",
            minValue: 0,
            locale: "de-DE",
            showSpinButton: false,
            width: 120
        });

        function nuevoProducto(){
            $("#fila").val('0');
            document.getElementById('nombreProducto').dataset.idproducto="0";
            $("#tituloFormProducto").html('<h5><b>Nuevo Producto</b></h5>');
            var tabla=document.getElementById('tabla');
            $("#fila").val(0);
            $("#nombreProducto").val( '' );

            $("#fechaCosto").val('');
            $("#precioCosto").ejNumericTextbox({
                value: 0
            });

            $("#precioReferencia").ejNumericTextbox({
                value: 0
            });

            $("#codigoSoftland").val('' );
            document.getElementById('selPlantas').selectedIndex=0;
            document.getElementById('selUnidades').selectedIndex=0;            
            document.getElementById('requiereDiseno').selectedIndex=0;
            document.getElementById('granel').selectedIndex=0;
            document.getElementById('solicitaCertificado').selectedIndex=0;
            $("#modProducto").modal("show");
          
        }

        function cerrarModProducto(){
           $("#modProducto").modal("hide"); 
        }

        function guardarDatosProducto(){
            var fila=$("#fila").val();
            var idPrecio='0';
            var table=$('#tabla').DataTable();
            var buscar=$("#nombreProducto").val().trim()+$("#selUnidades option:selected").html().trim()+$("#selPlantas option:selected").html().trim();

            for (var i = 0; i < table.rows().count(); i++){
                if( (buscar==table.cell(i,1).data().trim()+table.cell(i,2).data().trim()+table.cell(i,3).data().trim()) && fila!=i ){
                    swal(
                        {
                            title: '¡Producto existente!',
                            text: 'El producto ya se encuentra en la lista',
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonText: 'OK',
                            cancelButtonText: 'NO',
                            closeOnConfirm: true,
                            closeOnCancel: false
                        });
                    return;
                }
            }


            $.ajax({
                url: urlApp + "guardarDatosProductoListaPrecio",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        idProductoListaPrecios: document.getElementById('nombreProducto').dataset.idproducto,                          
                        nombreProducto: $("#nombreProducto").val(),
                        unidad: $("#selUnidades option:selected").html(),
                        idPlanta: $("#selPlantas").val(),
                        costo: $("#precioCosto").val(),
                        precioReferencia: $("#precioReferencia").val(),
                        requiereDiseno: $("#requiereDiseno").val(),
                        granel: $("#granel").val(),
                        solicitaCertificado: $("#solicitaCertificado").val(),
                        codigoSoftland: $("#codigoSoftland").val()
                      },
                success:function(dato){
                    var table = $('#tabla').DataTable();
                    if(fila=='0'){
                        
                        table.row.add( [
                                dato[0].idProductoListaPrecios,
                                $("#nombreProducto").val(),
                                $("#selUnidades option:selected").html(),
                                $("#selPlantas option:selected").html() ,
                                $("#precioCosto").val(),
                                dato[0].fechaCosto,
                                $("#precioReferencia").val(),
                                $("#codigoSoftland").val(),
                                $("#requiereDiseno option:selected").html(),
                                $("#granel option:selected").html(),
                                $("#solicitaCertificado option:selected").html(),
                                '<td style="width:40px"><button class="btn btn-xs btn btn-warning btnEditar" title="Editar"><i class="fa fa-edit fa-lg"></i></button>' + 
                                '<button class="btn btn-xs btn btn-danger btnEliminar" title="Eliminar"><i class="fa fa-trash-o fa-lg"></i></button></td>'
                                ] ).draw();                                          
                    }else{

                        table.cell(fila,1).data( $("#nombreProducto").val() );
                        table.cell(fila,2).data( $("#selUnidades option:selected").html() );                 
                        table.cell(fila,3).data( $("#selPlantas option:selected").html() );

                        table.cell(fila,4).data(number_format($("#precioCosto").data("ejNumericTextbox").model.value,0) );
                        table.cell(fila,5).data( dato[0].fechaCosto );

                        table.cell(fila,6).data( number_format($("#precioReferencia").data("ejNumericTextbox").model.value) );

                        table.cell(fila,7).data( $("#codigoSoftland").val() );
                        table.cell(fila,8).data( $("#requiereDiseno option:selected").html() );
                        table.cell(fila,9).data( $("#granel option:selected").html() );
                        table.cell(fila,10).data( $("#solicitaCertificado option:selected").html() ); 
                        table.cell(fila,10).draw();                
                    }

                    cerrarModProducto();

                }

            })

        }

        function eliminarProductoPrecio(fila){
            var table= $("#tabla").DataTable();
            var data=table.row( fila ).data() ;
            swal(
                {
                    title: '¿Elimina el producto seleccionado de la lista de precios?',
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
                        $.ajax({
                            url: urlApp + "eliminarProductoListaPrecio",
                            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                            type: 'POST',
                            dataType: 'json',
                            data: { 
                                    idProductoListaPrecios: data[0]
                                  },
                            success:function(dato){
                                if( dato[0].idProductoListaPrecios==-1){
                                    swal(
                                        {
                                            title: 'El producto no puede ser eliminado, ya tiene información relacionada!',
                                            text: '',
                                            type: 'warning',
                                            showCancelButton: false,
                                            confirmButtonText: 'OK',
                                            cancelButtonText: 'NO',
                                            closeOnConfirm: true,
                                            closeOnCancel: false
                                        });
                                }else{
                                    table
                                        .row( fila )
                                        .remove()
                                        .draw();
                                }
                            }

                        })
                        
                    }
                }
            )              
        }

        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#tabla thead tr').clone(true).appendTo( '#tabla thead' );
            $('#tabla thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();

                if(title.trim()!='' ){
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

            $('#tabla tbody').on( 'click', '.btnEliminar', function () {
                eliminarProductoPrecio(table.row( $(this).parents('tr') ).index() );
            } );

            $('#tabla tbody').on( 'click', '.btnEditar', function () {
                var data=table.row( $(this).parents('tr') ).data();
                $("#fila").val(table.row( $(this).parents('tr') ).index() );
                document.getElementById('nombreProducto').dataset.idproducto=data[0].trim();
                $("#tituloFormProducto").html('<h5><b>Editar Datos del Producto</b></h5>');
                $("#nombreProducto").val( data[1].trim() );
                $("#precioCosto").ejNumericTextbox({
                    value: data[4].trim().replace('.','')
                });
                $("#fechaCosto").val( data[5].trim().replace('.','') );

                $("#precioReferencia").ejNumericTextbox({
                    value: data[6].trim().replace('.','')
                });                

                $("#codigoSoftland").val( data[7].trim() );
                if( data[8].trim()=='NO' ){
                    document.getElementById('requiereDiseno').selectedIndex=1;
                }else{
                    document.getElementById('requiereDiseno').selectedIndex=0;
                }
                if( data[9].trim()=='NO' ){
                    document.getElementById('granel').selectedIndex=1;
                }else{
                    document.getElementById('granel').selectedIndex=0;
                }

                if( data[10].trim()=='NO' ){
                    document.getElementById('solicitaCertificado').selectedIndex=1;
                }else{
                    document.getElementById('solicitaCertificado').selectedIndex=0;
                }

                var lista=document.getElementById('selPlantas');
                for (var i = 0; i < lista.length; i++){
                    var opt=lista.options[i];
                    if( opt.text==data[3].trim() ){
                        lista.selectedIndex=i;
                        break;
                    }
                }

                var lista=document.getElementById('selUnidades');
                for (var i = 0; i < lista.length; i++){
                    var opt=lista.options[i];
                    if( opt.text==data[2].trim() ){
                        lista.selectedIndex=i;
                        break;
                    }
                }


                $("#modProducto").modal("show");

            } );            

            // DataTable
            var table=$('#tabla').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                dom: 'Bfrtip',
                "order": [[ 1, "asc" ]],
                "columnDefs": [ {
                    "targets": 0,
                    "createdCell": function (td, cellData, rowData, row, col) {

                        $(td).css('display', 'none')

                    }
                } ],               
                buttons: [
                    {
                        text: 'Nuevo Producto',
                        className: 'orange',
                        action: function ( e, dt, node, config ) {
                            nuevoProducto();
                        }
                    },                
                    {
                        extend: 'excelHtml5',
                        title: 'Listado de Clientes',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'Listado de Clientes',
                        text:      '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Listado de Clientes',
                        text:      '<i class="fa fa-file-pdf-o"></i>',
                        titleAttr: 'PDF', 
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }
                    }
                ],                  
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
            });
             

        } );

    </script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>