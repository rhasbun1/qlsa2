@extends('plantilla')      

@section('contenedorprincipal')

<div style="padding: 5px">
    <div class="panel panel-default">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="idPerfil" value="{{ Session::get('idPerfil') }}">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-3">
                    <b>Registro de Salidas</b>
                </div>
                <div class="col-md-3">
                    <button id="btnRefresh" class="btn btn-sm btn-success" onclick="reFresh();" style="display: none;">Actualizar</button>
                </div>
            </div>

        </div>
        <div class="panel-body" style="width: 100%; max-height: 1320px">
            <div class="padding-md clearfix">
                <table id="tablaDetalle" class="table table-hover table-condensed"  style="width: 100%">
                    <thead>
                        <th style="width: 50px">Nº Guía</th>
                        <th style="width: 120px">Fecha Creación</th>
                        <th style="width: 50px">Nº Pedido</th>
                        <th style="width: 100px">Planta</th>
                        <th style="width: 250px">Cliente</th>
                        <th style="width: 70px">Patente</th>
                        <th style="width: 150px">Nombre Conductor</th>
                        <th style="width: 150px">Empresa de Transportes</th>
                    </thead>
                    <tbody>
                        @foreach($guias as $item)
                            <tr>
                                <td style="width:50px"><button class="btn btn-success btn-sm" style="width: 80px" onclick="registrarSalida({{ $item->tipoGuia }}, {{ $item->numeroGuia }}, this.parentNode.parentNode.rowIndex)">{{ $item->folioDTE }}</button></td>
                                <td style="width: 120px">{{ $item->fechaHoraCreacion }}</td>
                                <td style="width: 50px">{{ $item->idPedido }}</td>
                                <td style="width: 100px">{{ $item->nombrePlanta }}</td>
                                <td style="width: 250px">{{ $item->nombreCliente }}</td>
                                <td style="width: 70px">{{ $item->patente }}</td>
                                <td style="width: 150px">{{ $item->nombreConductor }}</td>
                                <td style="width: 150px">{{ $item->nombreEmpresaTransportes }}</td>                               
                            </tr>
                        @endforeach
                    </tbody>            
                </table>   

            </div>
        </div>
    </div>
 
</div>


@endsection

@section('javascript')
    <!-- Datepicker -->
    <script src="{{ asset('/') }}js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('/') }}locales/bootstrap-datepicker.es.min.js"></script>

    <!-- Timepicker -->
    <script src="{{ asset('/') }}js/bootstrap-timepicker.min.js"></script>  

    <script src="{{ asset('/') }}js/app/funciones.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.2.5/js/dataTables.fixedColumns.min.js"></script>


    <!-- Timepicker -->

    
    <script>
        function reFresh(){ 
            location.reload(true)
            $("#btnRefresh").attr("disabled", true);
        }

        function registrarSalida(tipo, numero, fila){
            swal(
                {
                    title: "¿Desea confirmar la salida del pedido con guía Nº " + numero + " ?" ,
                    text: '',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm)
                {
                    if(isConfirm){
                        $.ajax({
                            url: urlApp + "registrarSalidaDespacho",
                            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                            type: 'POST',
                            dataType: 'json',
                            data: { tipoGuia: tipo,
                                    numeroGuia: numero
                                  },
                            success:function(dato){
                                document.getElementById('tablaDetalle').deleteRow(fila);
                            }
                        })                
                        return;                        
                    }

                }
            )              
          
        }        

        $(document).ready(function() {
            // Setup - add a text input to each footer cell

            $('#tablaDetalle thead tr').clone(true).appendTo( '#tablaDetalle thead' );
            $('#tablaDetalle thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                if(title.trim()!='' && title.trim()=='Planta' ){
                    $(this).html( '<select id="selPlanta" class="form-control input-sm"></select>' );                    
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


            // DataTable
            var titulo="Pedidos en Proceso";

            var table=$('#tablaDetalle').DataTable({
                 orderCellsTop: true,
                 fixedHeader: true, 
                 dom: 'Bfrtip',        
                "scrollX": true,
                "order": [[ 0, "desc" ]],
                "paging": false,  
                buttons: [
                    {
                        text: 'Atras',
                        action: function ( e, dt, node, config ) {
                            location.href=("{{ asset('/') }}dashboard");
                        }
                    },
            
                    {
                        extend: 'excelHtml5',
                        title: "Registro de Salidas",
                        exportOptions: {
                            columns: [ 0, 2, 3, 4, 5 , 6, 7 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title:  "Registro de Salidas",
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5,6,7 ]
                        }
                    }

                ],                   
                // "order": [[ 0, "asc" ]],              
                // language:{url: "{{ asset('/') }}locales/datatables_ES.json"},
                // preDrawCallback: function( settings ) {
                //     document.getElementById('panelBody').style.display="block";
                //   },  
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

            document.getElementById('btnRefresh').style.display="block";

        } );

    </script>
    
@endsection
