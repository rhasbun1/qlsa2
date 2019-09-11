@extends('plantilla')      

@section('contenedorprincipal')

<div style="padding: 5px">

    <div class="panel panel-default" id="contenedor3">
        <div class="panel-heading">
            <div class="panel-tab clearfix">
                <ul class="tab-bar">
                    <li class="active"><a href="#tabAprobados" data-toggle="tab"><b>Pedidos Ingresados Aprobados</b></a></li> 
                </ul>
            </div>
        </div> 
        <div class="panel-body">
            <div class="tab-content clearfix">
                <div class="tab-pane active" id="tabAprobados" style="padding-top: 5px">
                    <table id="tablaAprobados" class="pedidos table table-hover table-condensed" style="width:100%">
                        <thead>
                            <th style="width:150px">Pedido</th>
                            <th style="width:80px">Estado</th>
                            <th>Fecha Creación</th>
                            <th>Cliente</th>
                            <th>Obra/Planta</th>
                            <th>Producto</th>
                            <th style="text-align: right">Cantidad</th>
                            <th>Planta Origen</th>
                            <th>Forma Entrega</th>
                            <th>Fecha Entrega</th>
                            <th>Transporte</th>
                            <th>Fecha Carga</th>
                        </thead>
                        <tbody>
                            @foreach($pedidos as $item)
                                <tr>
                                    <td style="width:150px">
                                        <a href="{{ asset('/') }}clienteVerPedido/{{ $item->idPedido }}/7/" class="btn btn-xs btn-success">{{ $item->idPedido }}</a>
                                        @if ( $item->cantidadReal>0 )
                                            <span><img src="{{ asset('/') }}img/iconos/cargacompleta.png" border="0"></span>
                                        @endif
                                        @if ( $item->numeroGuia>0 )
                                            <span><img src="{{ asset('/') }}img/iconos/guiaDespacho2.png" border="0" onclick="abrirModalGuia('{{ $item->numeroGuia }}');" style="cursor:pointer; cursor: hand"></span>
                                        @endif    
                                        @if ( $item->certificado==1 )  
                                            <span><img src="{{ asset('/') }}img/iconos/certificado.png" border="0"></span>
                                        @endif
                                        @if ( $item->salida==1 )
                                        <span><img src="{{ asset('/') }}img/iconos/enTransporte.png" border="0" onclick="verUbicacionGmaps('{{ $item->Patente }}');" style="cursor:pointer; cursor: hand"></span>                                      
                                        @endif                                         
                                    </td>                                        
                                    <td style="width:80px">{{ $item->estadoPedido }}</td>
                                    <td>{{ $item->fechahora_creacion }}</td>
                                    <td>{{ $item->nombreCliente }}</td>
                                    <td>{{ $item->nombreObra }}</td>
                                    <td>{{ $item->prod_nombre }}</td>
                                    <td style="text-align: right">{{ $item->cantidad }}</td>
                                    <td>{{ $item->nombrePlanta }}</td>
                                    <td>{{ $item->formaEntrega }}</td>
                                    <td>{{ $item->fechaEntrega }} {{ $item->horarioEntrega }}</td>
                                    <td>{{ $item->apellidoConductor }} / {{ $item->empresaTransporte }}</td>
                                    <td>{{ $item->fechaCarga }} {{ $item->horaCarga }} </td>
                                </tr>
                            @endforeach
                        </tbody>            
                    </table>
                </div>
            </div>
        </div>
    </div>
   
</div>

@endsection

@section('javascript')

    
    
    <script src="https://cdn.datatables.net/fixedcolumns/3.2.5/js/dataTables.fixedColumns.min.js"></script>

    <script>
        
        $(document).ready(function() {
            // Setup - add a text input to each footer cell

            // DataTable

            // Setup - add a text input to each footer cell
            $('#tablaAprobados thead tr').clone(true).appendTo( '#tablaAprobados thead' );
            $('#tablaAprobados thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();

                if(title.trim()!='' && title.trim()!='Estado' ){
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

                        
            var table=$('#tablaAprobados').DataTable({
                 orderCellsTop: true,
                 fixedHeader: true,         
                "lengthMenu": [[6, 12, 20, -1], ["6", "12", "20", "Todos"]],
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: 'Nuevo Pedido',
                        className: 'orange',
                        attr:  {
                                    id: 'btnNuevoPedido'
                                },
                        action: function ( e, dt, node, config ) {
                                location.href="{{ asset('/') }}clienteNotasdeVenta";
                            }
                    },
                    'pageLength',
                    {
                        extend: 'excelHtml5',
                        title: 'Notas de Venta Vigentes',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'Notas de Venta Vigentes',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Notas de Venta Vigentes',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    }
                ],                       
                "order": [[ 0, "desc" ]],                        
                language:{url: "{{ asset('/') }}locales/datatables_ES.json"},
                initComplete: function () {
                    this.api().columns(1).every( function () {
                        var column = this;

                        var select = $('<select class="form-control input-sm"><option value=""></option></select>')
                            .appendTo( $( '#tablaAprobados thead tr:eq(1) th:eq(1)' ).empty() )
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

                        var select = $('<select class="form-control input-sm"><option value=""></option></select>')
                            .appendTo( $( '#tablaAprobados thead tr:eq(1) th:eq(4)' ).empty() )
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

                        var select = $('<select class="form-control input-sm"><option value=""></option></select>')
                            .appendTo( $( '#tablaAprobados thead tr:eq(1) th:eq(7)' ).empty() )
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
                    this.api().columns(8).every( function () {
                        var column = this;

                        var select = $('<select class="form-control input-sm"><option value=""></option></select>')
                            .appendTo( $( '#tablaAprobados thead tr:eq(1) th:eq(8)' ).empty() )
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

@endsection