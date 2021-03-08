@extends('plantilla')      

@section('contenedorprincipal')

<div style="padding: 20px">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b>Empresas de Transporte</b>
            <input type="text" value="{{Session::get('idPerfil')}} " id="perfil" hidden >
            <span class="badge badge-info pull-right">{{ $listaEmpresas->count() }} Clientes</span>
        </div>
        <div class="panel-body">
            <div class="panel-tab clearfix">
                <ul class="tab-bar">
                    <li class="active"><a href="#tabHabilitados" data-toggle="tab"><b>Empresas Habilitadas</b></a></li>
                    <li><a href="#tabDeshabilitados" data-toggle="tab"><b>Empresas Deshabilitadas</b></a></li>
                </ul>
            </div>         
            <div class="tab-content clearfix">
                <div class="tab-pane active" id="tabHabilitados" style="padding-top: 5px;">
                    <div style="padding-bottom: 15px">              
                        <table id="tabla" class="table table-hover table-condensed table-responsive" style="width: 100%">
                            <thead>
                                <th>Identificador</th>
                                <th>Nombre</th>
                                <th>Rut</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Nombre Contacto</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($listaEmpresas as $item)
                                    @if($item->habilitada==1)
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
                                    @endif
                                @endforeach
                            </tbody>             
                        </table>
                    </div>
                </div> 
                <div class="tab-pane" id="tabDeshabilitados" style="padding-top: 5px">
                    <div style="padding-bottom: 15px">  
                        <table id="tablaDeshabilitados" class="table table-hover table-condensed table-responsive" style="width: 100%">
                            <thead>
                                <th>Identificador</th>
                                <th>Nombre</th>
                                <th>Rut</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Nombre Contacto</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @foreach($listaEmpresas as $item)
                                    @if($item->habilitada==0)
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
                                    @endif
                                @endforeach
                            </tbody>             
                        </table>
                    </div>                 
                </div>

            </div>

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
            if($("#perfil").val() == 2 || $("#perfil").val() == 19 || $("#perfil").val() == 3 || $("#perfil").val() == 12 ||  $("#perfil").val() == 18 ||  $("#perfil").val() == 4 ||  $("#perfil").val() == 11){
                var table=$('#tabla').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                dom: 'Bfrtip',
                buttons: [
                                   
                    {
                        extend: 'excelHtml5',
                        title: 'Empresas de Transporte',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5 ]
                            }
                        } 
                    ],                  
                    language:{url: "{{ asset('/') }}locales/datatables_ES.json"}
                });
            }else{
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
                        title: 'Empresas de Transporte',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5 ]
                            }
                        }
                    ],                  
                    language:{url: "{{ asset('/') }}locales/datatables_ES.json"}
                });
                
            }
            

            $('#tablaDeshabilitados thead tr').clone(true).appendTo( '#tablaDeshabilitados thead' );
            $('#tablaDeshabilitados thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();

                if(title.trim()!='' ){
                    $(this).html( '<input type="text" class="form-control input-sm" placeholder="Buscar..." />' );
                    $( 'input', this ).on( 'keyup change', function () {
                        if ( table2.column(i).search() !== this.value ) {
                            table2
                                .column(i)
                                .search( this.value )
                                .draw();
                        }
                    } );
                }
             
            } );
            var table2=$('#tablaDeshabilitados').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                dom: 'Bfrtip',
                buttons: [             
                    {
                        extend: 'excelHtml5',
                        title: 'Empresas de Transporte',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
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
