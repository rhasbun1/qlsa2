@extends('plantilla')      

@section('contenedorprincipal')

<div style="padding: 20px">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b>Empresas de Transporte</b>
            <span class="badge badge-info pull-right">{{ $listaEmpresas->count() }} Clientes</span>
        </div>
        <div class="padding-md clearfix">
            <table id="tabla" class="table table-hover table-condensed table-responsive" style="width: 100%">
                <thead>
                    <th>Identificador</th>
                    <th>Nombre</th>
                    <th>Rut</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Nombre Contacto</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($listaEmpresas as $item)
                        <tr>
                            <td>{{ $item->idEmpresaTransporte }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->rut }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->telefono }}</td>
                            <td>{{ $item->nombreContacto }}</td>
                            <td>
                                @if ( Session::get('idPerfil')=='1' or 
                                    Session::get('idPerfil')=='10' or 
                                    Session::get('idPerfil')=='5' or 
                                    Session::get('idPerfil')=='7')
                                    <a href="{{ asset('/') }}datosEmpresaTransporte/{{ $item->idEmpresaTransporte }}/" class="btn btn-xs btn btn-warning" title="Editar"><i class="fa fa-edit fa-lg"></i></a>
                                @else
                                    <a href="{{ asset('/') }}datosEmpresaTransporte/{{ $item->idEmpresaTransporte }}/" class="btn btn-xs btn btn-warning" title="Ver"><i class="fa fa-search fa-lg"></i></a>
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

@endsection

@section('javascript')
    <!-- Datepicker -->
    <script src="{{ asset('/') }}js/bootstrap-datepicker.min.js"></script>  

    <!-- Timepicker -->
    <script src="{{ asset('/') }}js/bootstrap-timepicker.min.js"></script>  

    <script src="{{ asset('/') }}js/app/funciones.js"></script>
    <script>

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
                        text: 'Nueva Empresa',
                        action: function ( e, dt, node, config ) {
                           location.href="{{ asset('/') }}datosEmpresaTransporte/0/";
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
                language:{url: "{{ asset('/') }}locales/datatables_ES.json"}
            });

        } );

    </script>
    
@endsection
