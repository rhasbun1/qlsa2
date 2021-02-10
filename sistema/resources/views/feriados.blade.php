@extends('plantilla')      

@section('contenedorprincipal')

<div style="padding: 5px">
    <div class="panel panel-default table-responsive">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
        <div class="panel-heading">
            <b>Feriados</b>
        </div>
        <div class="panel-body" id="panelBody">

                <div> 
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row" style="padding-top: 5px">
                                <div class="col-md-1">
                                    Año
                                </div>
                                <div class="col-md-3">
                                    <input type="number" class="form-control input-sm" id="txtAno">
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-success btn-sm" onclick="filtroFeriados();">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </div>                                                                             
                </div>
                <hr style="color: #0056b2;" />
                <table id="tabla" class="table table-hover table-condensed table-responsive"  style="width: 100%">
                <thead>
                    <th style="display: none">ID</th>
                    <th style="width:70px">Fecha</th>
                    <th style="width:150px">Descripción</th>
                    <th style="width:40px"></th>
                </thead>
                <tbody>
                    @foreach($listaFeriados as $item)
                        <tr>
                            <td style="display: none">{{ $item->idferiados }}</td>
                            <td style="width:70">{{ $item->fecha }}</td>
                            <td style="width:70px">{{ $item->descripcion }}</td>                       
                            <td style="width:40px">                            
                                <button class="btn btn-xs btn btn-warning btnEditar" title="Editar"><i class="fa fa-edit fa-lg"></i></button>
                                <button class="btn btn-xs btn btn-danger btnEliminar" title="Eliminar"><i class="fa fa-trash-o fa-lg"></i></button>
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


<div id="modFeriado" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header" id="tituloFormFeriado">
            <h5><b>Datos Feriado</b></h5>
        </div>
        <div id="bodyFeriado" class="modal-body">
            <input class="hidden" id="fila">
            <div class="row" style="padding-top: 5px">
                <div class="col-md-3">
                    Fecha (*)
                </div>
                <div class="col-md-5">
                    <div class="input-group date" id="divFecha">
                        <input type="text" class="form-control input-sm" id="txtFecha">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="padding-top: 5px">
                <div class="col-md-3">
                    Descripción
                </div>
                <div class="col-md-7">
                    <input class="form-control input-sm" id="txtdescripcion" maxlength="100">
                </div>    
            </div>  
        </div>
        <div class="col-md-offset-8" style="padding-top: 20px; padding-bottom: 20px">
           <button type="button" class="btn btn-success btn-sm" onclick="guardarDatosFeriado();" style="width: 80px">Guardar</button>
           <button type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarModFeriado()" style="width: 80px">Salir</button>
        </div>        
    </div>
</div>

@endsection

@section('javascript')
    <script src="{{ asset('/') }}js/bootstrap-datepicker.min.js"></script> 
    <script src="{{ asset('/') }}locales/bootstrap-datepicker.es.min.js"></script>
    <script src="{{ asset('/') }}js/app/funciones.js"></script>
    <script src="js/syncfusion/ej.web.all.min.js"> </script>
    <script src="{{ asset('/') }}js/syncfusion/lang/ej.culture.de-DE.min.js"></script>

    <script>
        var feriadoID;
        $(document).ready(function(){
            // Datepicker      
            $('.date').datepicker({
                todayHighlight: true,
                format: "dd/mm/yyyy",
                language: "es",
                autoclose: true
            });

            var formattedDate = new Date();
            $("#txtAno").val(formattedDate.getFullYear());
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
                eliminarFeriado(table.row( $(this).parents('tr') ).index() );
            } );

            $('#tabla tbody').on( 'click', '.btnEditar', function () {
                var data=table.row( $(this).parents('tr') ).data();
                $("#fila").val(table.row( $(this).parents('tr') ).index() );
                $("#tituloFormFeriado").html('<h5><b>Editar Datos del Feriado</b></h5>');
                feriadoID = data[0];
                $("#txtFecha").val(data[1]);
                $("#txtdescripcion").val(data[2]);

                $("#modFeriado").modal("show");

            } );            

            // DataTable
            var table=$('#tabla').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                dom: 'Bfrtip',
                "order": [[ 0, "asc" ]],
                "columnDefs": [ {
                    "targets": 0,
                    "createdCell": function (td, cellData, rowData, row, col) {

                        $(td).css('display', 'none')

                    }
                } ],               
                buttons: [
                    {
                        text: 'Nuevo Feriado',
                        className: 'orange',
                        action: function ( e, dt, node, config ) {
                            nuevoFeriado();
                        }
                    },                
                    {
                        extend: 'excelHtml5',
                        title: 'Listado de Feriados',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                   
                    {
                        extend: 'pdfHtml5',
                        title: 'Listado de Feriados',
                        text:      '<i class="fa fa-file-pdf-o"></i>',
                        titleAttr: 'PDF', 
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    }
                ],                  
                language:{url: "{{ asset('/') }}locales/datatables_ES.json"}
            });

            
        });

        function nuevoFeriado(){
            $("#fila").val('-1');
            $("#tituloFormFeriado").html('<h5><b>Nuevo Feriado</b></h5>');
            var tabla=document.getElementById('tabla');
            $("#fila").val(-1);
            $("#txtFecha").val('');
            $("#txtdescripcion").val('');
            feriadoID = 0;

            $("#modFeriado").modal("show");
          
        }

        function cerrarModFeriado(){
           $("#modFeriado").modal("hide"); 
        }

        function guardarDatosFeriado(){
            if ($("#txtFecha").val() == ''){
                swal(
                {
                    title: 'Debe ingresar la Fecha (*).',
                    text: '',
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    cancelButtonText: 'NO',
                    closeOnConfirm: true,
                    closeOnCancel: false
                });
                return;
            }
            var fila=$("#fila").val();
            var table=$('#tabla').DataTable();
            var buscar=$("#txtFecha").html().trim();

            for (var i = 0; i < table.rows().count(); i++){
                if( (buscar==table.cell(i,1).data().trim()) && fila!=i ){
                    swal(
                        {
                            title: '¡Feriado existente!',
                            text: 'El feriado ya se encuentra en la lista',
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
                url: urlApp + "guardarDatosFeriado",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        idFeriado: feriadoID,    
                        fecha: $("#txtFecha").val(),
                        descripcion: $("#txtdescripcion").val()
                      },
                success:function(dato){
                    console.log(dato);
                    var table = $('#tabla').DataTable();
                    if(fila=='-1'){
                       //ff=table.row.add( [ 
                       table.row.add( [
                                dato[0].idferiados,
                                $("#txtFecha").val(),
                                $("#txtdescripcion").val(),
                                '<td style="width:40px"><button class="btn btn-xs btn btn-warning btnEditar" title="Editar"><i class="fa fa-edit fa-lg"></i></button>' + 
                                '<button class="btn btn-xs btn btn-danger btnEliminar" title="Eliminar"><i class="fa fa-trash-o fa-lg"></i></button></td>'
                                ] ).draw();
                                //] ).draw().index();
                        //celda=table.cell(ff,4).node();
                        //ejemplo: listabodega de proyecto datamart
                        //celda.style.textalign="right";
                                                                          
                    }else{

                        table.cell(fila,1).data( $("#txtFecha").val() );
                        table.cell(fila,2).data( $("#txtdescripcion").val() );
                        table.cell(fila,2).draw();                
                    }
                    
                    cerrarModFeriado();

                }

            })
        }

        function eliminarFeriado(fila){
            var table= $("#tabla").DataTable();
            var data=table.row( fila ).data() ;
            swal(
                {
                    title: '¿Elimina el feriado seleccionado de la lista?',
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
                            url: urlApp + "eliminarFeriado",
                            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                            type: 'POST',
                            dataType: 'json',
                            data: { 
                                    idFeriado: data[0]
                                  },
                            success:function(dato){
                                if( dato[0].idferiados==-1){
                                    swal(
                                        {
                                            title: 'El feriado no puede ser eliminado, ya tiene información relacionada!',
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

        function filtroFeriados(){
            if ($("#txtAno").val() == '' || ($("#txtAno").val() <= 0)){
                swal(
                {
                    title: 'Debe ingresar un Año válido.',
                    text: '',
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    cancelButtonText: 'NO',
                    closeOnConfirm: true,
                    closeOnCancel: false
                });
                return;
            }
            $.ajax({
                url: urlApp + "filtrarFeriados",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        ano: $("#txtAno").val()
                      },
                success:function(dato){
                    var table = $('#tabla').DataTable();
                    table.clear().draw();
                    $.each(dato, function (i, item) {
                        table.row.add( [
                            item.idferiados,
                            item.fecha,
                            item.descripcion,
                            '<td style="width:40px"><button class="btn btn-xs btn btn-warning btnEditar" title="Editar"><i class="fa fa-edit fa-lg"></i></button>' + 
                            '<button class="btn btn-xs btn btn-danger btnEliminar" title="Eliminar"><i class="fa fa-trash-o fa-lg"></i></button></td>'
                        ] ).draw();
                    });
                }

            })
        }
    </script>
@endsection
