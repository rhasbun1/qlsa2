@extends('plantilla')      

@section('contenedorprincipal')

<div style="padding: 20px">
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b>Condiciones de Pago</b>
            <span class="badge badge-info pull-right">{{ count($condiciones) }} Condiciones</span>
        </div>
        <div class="padding-md clearfix" style="width:450px"> 
            <table id="tabla" class="table table-hover table-condensed" style="width:450px">
                <thead>
                    <th style="width:80px">ID</th>
                    <th style="width:300px">Nombre</th>
                    <th style="width:50px"></th>
                </thead> 
                <tbody>
                    @foreach($condiciones as $item)
                        <tr>
                            <td style="width:80px">{{ $item->idCondiciondePago }}</td>
                            <td style="width:300px">{{ $item->nombre }}</td>
                            <td style="width:50px">
                                @if (Session::get('idPerfil')=='1' or Session::get('idPerfil')=='2' or Session::get('idPerfil')=='18' or
                                    Session::get('idPerfil')=='4')                                
                                <button class="btn btn-xs btn btn-warning" onclick="editarCondiciondePago( {{ $item->idCondiciondePago }}, this.parentNode.parentNode.rowIndex )" title="Editar" ><i class="fa fa-edit fa-lg"></i></button>
                                <button class="btn btn-xs btn btn-danger" title="Eliminar" onclick="eliminarCondiciondePago(this.parentNode.parentNode.rowIndex)"><i class="fa fa-trash-o fa-lg"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>            
            </table>      
        </div>
    </div>
    <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
        <a href="{{ asset('/') }}dashboard" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
    </div>    
</div>


        <div id="mdNuevaCondicion" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" id="tituloModCondicion">
                    <h5><b>Nueva Condicion</b></h5>
                </div>
                <div id="bodyArea" class="modal-body">
                    <input type="hidden" id="idCondicion">
                    <input type="hidden" id="filaCondicion">         
                    <div class="row" style="padding-top: 5px">

                        <div class="col-sm-3">
                            Nombre (*)
                        </div>
                        <div class="col-sm-6">
                            <input type="text" id="txtNombre" class="form-control input-sm" maxlength="50">
                        </div>
                    </div>
                </div>        
                <div style="padding-left: 15px; padding-top: 5px">
                    <h5><b> (*) Dato Obligatorio</b></h5>
                </div>              
                <div class="col-md-offset-8" style="padding-top: 20px; padding-bottom: 20px">
                   <button id="btnGrabarCondicion" type="button" class="btn btn-success btn-sm" onclick="grabarCondicion();" style="width: 80px">Guardar</button>
                   <button  type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarModCondicion()" style="width: 80px">Salir</button>
                </div>
            </div>
        </div>
@endsection

@section('javascript')
    <!-- Datepicker -->
    <script src="{{ asset('/') }}js/bootstrap-datepicker.min.js"></script>  

    <!-- Timepicker -->
    <script src="{{ asset('/') }}js/bootstrap-timepicker.min.js"></script>  

    <script src="{{ asset('/') }}js/app/funciones.js"></script>

    <script>

        function abrirModCondicion(){
            $("#idCondicion").val('0');
            $("#filaCondicion").val('0');
            $("#txtNombre").val('');
            document.getElementById('tituloModCondicion').innerHTML='<h5><b>Nueva Condición</b></h5>';
            $("#mdNuevaCondicion").modal('show');
        }

        function cerrarModCondicion(){
            $("#mdNuevaCondicion").modal('hide');
        }

        function editarCondiciondePago(idCondicion, fila){
            document.getElementById('tituloModCondicion').innerHTML='<h5><b>Editar Condición</b></h5>';
            var tabla=document.getElementById('tabla');
            $('#txtNombre').val(tabla.rows[fila].cells[1].innerHTML.trim() ) ;
            $("#filaCondicion").val(fila);
            $("#idCondicion").val(tabla.rows[fila].cells[0].innerHTML.trim() );
            $("#mdNuevaCondicion").modal('show');
        }

        function eliminarCondiciondePago(fila){
            var tabla=document.getElementById('tabla');
            var idCondicion=tabla.rows[fila].cells[0].innerHTML.trim();
            swal(
                {
                    title: 'Elimina la Condición seleccionada?',
                    text: '',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No',
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm)
                {
                    if(isConfirm){            
                        $.ajax({
                            url: urlApp +'eliminarCondiciondePago',
                            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                            type: 'POST',
                            dataType: 'json',
                            data: { 
                                    idCondiciondePago: idCondicion
                                  },
                            success:function(dato){
                                tabla.deleteRow(fila);
                                if(dato.idCondiciondePago>0){
                                    swal(
                                        {
                                            title: 'La condición ha sido eliminada!!',
                                            text: '',
                                            type: 'warning',
                                            showCancelButton: false,
                                            confirmButtonText: 'OK',
                                            cancelButtonText: 'No',
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
                            }
                        })
                    }
                }
            )        
        }

        function grabarCondicion(){
            $("#btnGrabarCondicion").prop("disabled", true);
            $.ajax({
                url: urlApp +'guardarDatosCondicionPago',
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        idCondiciondePago: $("#idCondicion").val(),
                        nombre: $("#txtNombre").val()
                      },
                success:function(dato){
                    if(dato.idCentro==-1){
                        swal(
                            {
                                title: 'La condición que desea crear ya Existe!!',
                                text: '',
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'OK',
                                cancelButtonText: 'No',
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

                        if($("#idCondicion").val()=='0'){
                            var cadena="<tr>";
                            cadena+="<td>" + dato.idCondiciondePago + "</td>";
                            cadena+="<td>" + $("#txtNombre").val() + "</td>";
                            cadena+='<td style="width: 40px">';
                            cadena+='<button class="btn btn-xs btn btn-warning" onclick="editarCondiciondePago(' + dato.idCondiciondePago +', this.parentNode.parentNode.rowIndex )" title="Editar" ><i class="fa fa-edit fa-lg"></i></button>';
                            cadena+='<button class="btn btn-xs btn btn-danger" title="Eliminar" onclick="eliminarCondiciondePago(this.parentNode.parentNode.rowIndex)"><i class="fa fa-trash-o fa-lg"></i></button>';
                            cadena+='</td>';

                            cadena+="</tr>";
                            $("#tabla").append(cadena);                            
                        }else{
                            tabla.rows[ $("#filaCondicion").val() ].cells[0].innerHTML=dato.idCondiciondePago;
                            tabla.rows[ $("#filaCondicion").val() ].cells[1].innerHTML=$("#txtNombre").val();
                        }

                        $("#txtNombre").val('');
                        cerrarModCondicion();
                        $("#btnGrabarCondicion").prop("disabled", false);     
                    }


                },
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
                buttons: [
                    {
                        text: 'Nueva Condición',
                        action: function ( e, dt, node, config ) {
                            abrirModCondicion(1);
                        }
                    },                 
                    {
                        extend: 'excelHtml5',
                        title: 'Listado de Condiciones de Pago',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'Listado de Condiciones de Pago',
                        text:      '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Listado de Condiciones de Pago',
                        text:      '<i class="fa fa-file-pdf-o"></i>',
                        titleAttr: 'PDF',                         
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }
                    }
                ],                  
                language:{url: "{{ asset('/') }}locales/datatables_ES.json"}
            });

        } );

    </script>
    
@endsection