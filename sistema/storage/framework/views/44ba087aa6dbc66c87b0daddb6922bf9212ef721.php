      

<?php $__env->startSection('contenedorprincipal'); ?>

<div style="padding: 20px">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b>Plantas QLSA</b>
            <span class="badge badge-info pull-right"><?php echo e($listaPlantas->count()); ?> Plantas</span>
        </div>
        <div class="padding-md clearfix" style="width: 500px">
            <input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
            <table id="tabla" class="table table-hover table-condensed" style="width: 500px">
                <thead>
                    <th>Identificador</th>
                    <th>Nombre</th>
                    <th>Cód.Softland</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $listaPlantas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="width:80px"><?php echo e($item->idPlanta); ?></td>
                            <td style="width:250px"><?php echo e($item->nombre); ?></td>
                            <td style="width:80px"><?php echo e($item->codigoSoftland); ?></td>
                            <td style="width:80px">
                                <button class="btn btn-xs btn btn-warning" onclick="editarPlanta(this.parentNode.parentNode)" title="Editar"><i class="fa fa-edit fa-lg"></i></button>
                                <button class="btn btn-xs btn btn-danger" onclick="eliminarPlanta(this.parentNode.parentNode)" title="Eliminar"><i class="fa fa-trash-o fa-lg"></i></button>
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

<div id="mdPlanta" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="height: 45px">
                <h5><b>Datos de la Planta</b></h5>
            </div>
            <div id="bodyPlanta" class="modal-body">
                <div class="row" style="padding: 5px">
                    <div class="col-md-2">
                        Nombre
                    </div>
                    <div class="col-md-8">
                        <input id="nombrePlanta" class="form-control input-sm" maxlength="100">
                    </div>
                </div>
                <div class="row" style="padding: 5px">
                    <div class="col-md-2">
                        Cód.Softland
                    </div>
                    <div class="col-md-2">
                        <input id="codigoSoftland" class="form-control input-sm" maxlength="3">
                    </div>
                </div>                
            </div>
            <div style="padding-top: 20px; padding-bottom: 20px; padding-right: 20px; text-align: right;">
               <button id="btnGuardarPlanta" type="button" class="btn btn-success data-dismiss=modal btn-sm" onclick="guardarPlanta()" style="width: 80px">Grabar</button>                
               <button id="btnCerrarMdPlanta" type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarModPlanta()" style="width: 80px">Salir</button>
            </div>            
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
    <script>

        function nuevaPlanta(){
            document.getElementById("nombrePlanta").dataset.idplanta="0";
            document.getElementById("nombrePlanta").dataset.fila="0";
            $("#nombrePlanta").val('');
            $("#codigoSoftland").val('');
            $("#mdPlanta").modal('show');            
        }

        function editarPlanta(row){
            var tabla=$("#tabla").DataTable();
            var datos=tabla.row(row).data();
            document.getElementById("nombrePlanta").dataset.idplanta=datos[0];
            document.getElementById("nombrePlanta").dataset.fila= tabla.row(row).index();
            $("#nombrePlanta").val(datos[1]);
            $("#codigoSoftland").val(datos[2]);
            $("#mdPlanta").modal('show');
        }

        function cerrarModPlanta(){
            $("#mdPlanta").modal('hide');
        }

        function eliminarPlanta(row){
            var tabla=$("#tabla").DataTable();
            var datos=tabla.row(row).data();
            var idPlanta=datos[0];
            var fila=tabla.row(row).index();
            swal(
                {
                    title: '¿Elimina la planta seleccionada? ',
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
                            url: urlApp + "eliminarPlanta",
                            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                            type: 'POST',
                            dataType: 'json',
                            data: { 
                                    idPlanta: idPlanta
                                  },
                            success:function(dato){
                                if(dato.idPlanta==-1){
                                    swal(
                                        {
                                            title: 'No se puede eliminar esta planta',
                                            text: 'Ya tiene información relacionada!',
                                            type: 'warning',
                                            showCancelButton: false,
                                            confirmButtonText: 'OK',
                                            cancelButtonText: 'NO',
                                            closeOnConfirm: true,
                                            closeOnCancel: false
                                        })
                                }else{
                                    tabla.row(fila).remove().draw();
                                }
                            }
                        })
                    }
                }
            )
        }        

        function guardarPlanta(){
            var fila=document.getElementById('nombrePlanta').dataset.fila;
            var idPlanta=document.getElementById('nombrePlanta').dataset.idplanta;

            if( $("#nombrePlanta").val().trim()=="" || $("#codigoSoftland").val().trim()=="" ){
                swal(
                    {
                        title: 'Para grabar la planta debe completar todos los datos!',
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
            var tabla=$("#tabla").DataTable();

            $.ajax({
                url: urlApp + "grabarPlanta",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        idPlanta: idPlanta,
                        nombre: $("#nombrePlanta").val(),
                        codigoSoftland: $("#codigoSoftland").val()
                      },
                success:function(dato){
                    if(idPlanta=='0'){
                        var btn='<button class="btn btn-xs btn btn-warning" onclick="editarPlanta(this.parentNode.parentNode)" title="Editar"><i class="fa fa-edit fa-lg"></i></button><button class="btn btn-xs btn btn-danger" onclick="eliminarPlanta(this.parentNode.parentNode)" title="Eliminar"><i class="fa fa-trash-o fa-lg"></i></button>';
                        var rowNode= tabla.row.add([
                                                        dato.idPlanta,
                                                        $("#nombrePlanta").val(),
                                                        $("#codigoSoftland").val(),
                                                        btn
                                                   ]).draw();
                    }else{
                        tabla.cell(fila, 1).data( $("#nombrePlanta").val() );
                        tabla.cell(fila, 2).data( $("#codigoSoftland").val() );
                        tabla.draw();
                    }
                    cerrarModPlanta();
                    swal(
                        {
                            title: 'Los datos han sido grabados!',
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

            // DataTable
            var table=$('#tabla').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                dom: 'Bfrtip',
                "order": [[ 1, "asc" ]],
                buttons: [
                    {
                        text: 'Nueva Planta',
                        action: function ( e, dt, node, config ) {
                            nuevaPlanta();
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