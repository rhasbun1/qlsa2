@extends('plantilla')  

@section('contenedorprincipal')

<div style="padding: 5px">
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b>Clientes</b>
            <span class="badge badge-info pull-right">{{ count( $listaEmpresas ) }} Clientes</span>
        </div>
        <div class="padding-md clearfix">           
            <table id="tabla" class="table table-hover table-condensed table-responsive" style="width: 100%">
                <thead>
                    <th style="display: none">Codigo</th>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Razón Social</th>
                    <th>Dirección</th>
                    <th>Comuna</th>
                    <th>Ciudad</th>
                    <th style="text-align: center">Solicita OC</th>
                    <th style="text-align: center">Cód. Softland</th>
                    <th style="text-align: center">Ingresar Cód.Soft.<br>al crear la NV</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($listaEmpresas as $item)
                        <tr>
                            <td style="display: none">{{ $item->emp_codigo }}</td>
                            <td>{{$item->emp_rut}}</td>
                            <td>{{ $item->emp_nombre }}</td>
                            <td>{{ $item->emp_razon_social }}</td>
                            <td>{{ $item->emp_direccion }}</td>
                            <td>{{ $item->emp_comuna }}</td>
                            <td>{{ $item->emp_ciudad }}</td>
                            <td style="text-align: center">
                                @if ( $item->emp_solicitaOC==1)
                                    SI
                                @else
                                    NO
                                @endif    
                            </td>
                            <td style="text-align: center">{{ $item->emp_codigoSoftland }}</td>
                            <td style="text-align: center">
                                @if ( $item->notaVentaSolicitaCodigo==1)
                                    SI
                                @else
                                    NO
                                @endif                                  
                            </td>
                            <td>
                                @if (Session::get('idPerfil')=='1' or Session::get('idPerfil')=='2' or
                                    Session::get('idPerfil')=='3' or Session::get('idPerfil')=='4' or 
                                    Session::get('idPerfil')=='12' or Session::get('idPerfil')=='18')
                                <button class="btn btn-xs btn btn-warning" onclick="verDatosCliente( this.parentNode.parentNode );" title="Editar"><i class="fa fa-edit fa-lg"></i></button>
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

<div id="modCliente" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <h5><b>Datos Cliente</b></h5>
        </div>
        <div id="bodyCliente" class="modal-body">
            <input class="hidden" id="fila">
            <div class="row" style="padding-top: 5px">
                <div class="col-md-3">
                    Rut
                </div>
                <div class="col-md-4">
                    <input class="form-control input-sm" id="rutCliente">
                </div>
            </div>                
            <div class="row" style="padding-top: 5px">
                <div class="col-md-3">
                    Nombre
                </div>
                <div class="col-md-4">
                    <input class="form-control input-sm" id="nombre">
                </div>
            </div>            
            <div class="row" style="padding-top: 5px">
                <div class="col-md-3">
                    Razón Social
                </div>
                <div class="col-md-7">
                    <input class="form-control input-sm" id="razonSocial">
                </div>
            </div>
            <div class="row" style="padding-top: 5px">
                <div class="col-md-3">
                    Dirección
                </div>
                <div class="col-md-7">
                    <input class="form-control input-sm" id="direccion">
                </div>
            </div>
            <div class="row" style="padding-top: 5px">
                <div class="col-md-3">
                    Comuna
                </div>
                <div class="col-md-7">
                    <input class="form-control input-sm" id="comuna" maxlength="30">
                </div>
            </div>
            <div class="row" style="padding-top: 5px">
                <div class="col-md-3">
                    Ciudad
                </div>
                <div class="col-md-7">
                    <input class="form-control input-sm" id="ciudad" maxlength="30">
                </div>
            </div>                        
            <div class="row" style="padding-top: 5px">
                <div class="col-md-3">
                    Solicita OC
                </div>
                <div class="col-md-3">
                    <select class="form-control input-sm" id="solicitaOC">
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                    </select>
                </div>
            </div>
            <div class="row" style="padding-top: 5px">
                <div class="col-md-3">
                    Cód.Softland (CS)
                </div>
                <div class="col-md-3">
                    <input class="form-control input-sm" id="codigoSoftland" maxlength="10">
                </div>
            </div>
            <div class="row" style="padding-top: 5px">
                <div class="col-md-3">
                    Ingresar CS al crear nota de venta
                </div>
                <div class="col-md-3">
                    <select class="form-control input-sm" id="crearEnNotaVenta">
                        <option value="1">SI</option>
                        <option value="0">NO</option>
                    </select>
                </div>
            </div>                  
        </div>
        <div class="col-md-offset-8" style="padding-top: 20px; padding-bottom: 20px">
           <button id="btnEliminarBodega" type="button" class="btn btn-success btn-sm" onclick="guardarDatosCliente();" style="width: 80px">Guardar</button>
           <button id="btnCerrarCajaBodega" type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarModCliente()" style="width: 80px">Salir</button>
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

        function verDatosCliente(fila){
            var tabla=$('#tabla').DataTable();
            var data = tabla.row( fila ).data();;

            $("#fila").val(tabla.row( fila ).index() );
            $("#rutCliente").val( data[1].trim() );
            $("#nombre").val( data[2].trim() );
            $("#razonSocial").val( data[3].trim() );
            $("#direccion").val( data[4].trim() );
            $("#comuna").val( data[5].trim() );
            $("#ciudad").val( data[6].trim() );
            if( data[7].trim()=='SI' ){
                document.getElementById('solicitaOC').selectedIndex=0;
            }else{
                document.getElementById('solicitaOC').selectedIndex=1;
            }

            if (data[8].trim() ==''){
                var codsoft=rutCliente.value.split(".").join("");
                codsoft=codsoft.slice(0, -2);
                $("#codigoSoftland").val(codsoft);
            }else{
              $("#codigoSoftland").val( data[8].trim() );  
            }

            if( data[9].trim()=='SI' ){
                document.getElementById('crearEnNotaVenta').selectedIndex=0;
            }else{
                document.getElementById('crearEnNotaVenta').selectedIndex=1;
            }            
            
            $("#modCliente").modal("show");
        }

        function cerrarModCliente(){
           $("#modCliente").modal("hide"); 
        }

        function guardarDatosCliente(){
            var tabla=$('#tabla').DataTable();
            var fila=$("#fila").val();

            var codsoft=rutCliente.value.split(".").join("");
            codsoft=codsoft.slice(0, -2);

            if ($("#crearEnNotaVenta").val()==0 && codsoft!=codigoSoftland.value){
                swal(
                    {
                        title: 'El código softland no cumple con el formato esperado (se esperaba '+codsoft+'), ¿Continúa grabando los datos?',
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
                                url: urlApp + "guardarDatosCliente",
                                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                                type: 'POST',
                                dataType: 'json',
                                data: { 
                                        emp_codigo: tabla.cell(fila,0).data().trim(),
                                        rutEmpresa: $("#rutCliente").val(),
                                        razonSocial: $("#razonSocial").val(),
                                        nombre: $("#nombre").val(),
                                        direccion: $("#direccion").val(),
                                        comuna: $("#comuna").val(),
                                        ciudad: $("#ciudad").val(),
                                        solicitaOC: $("#solicitaOC").val(),
                                        codigoSoftland: $("#codigoSoftland").val(),
                                        crearEnNotaVenta: $("#crearEnNotaVenta").val()
                                      },
                                success:function(dato){
                                    tabla.cell(fila,1).data( $("#rutCliente").val() );
                                    tabla.cell(fila,2).data( $("#nombre").val() );
                                    tabla.cell(fila,3).data( $("#razonSocial").val() );
                                    tabla.cell(fila,4).data( $("#direccion").val() );
                                    tabla.cell(fila,5).data( $("#comuna").val() );
                                    tabla.cell(fila,6).data( $("#ciudad").val() );
                                    tabla.cell(fila,7).data( $("#solicitaOC option:selected").html() );
                                    tabla.cell(fila,8).data( $("#codigoSoftland").val() );
                                    tabla.cell(fila,9).data( $("#crearEnNotaVenta option:selected").html() );
                                    tabla.row(fila).draw();
                                    cerrarModCliente();

                                }
                            })                                

                        }else{

                            return;

                        }
                    }
                )
            }else{
                $.ajax({
                    url: urlApp + "guardarDatosCliente",
                    headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                    type: 'POST',
                    dataType: 'json',
                    data: { 
                            emp_codigo: tabla.cell(fila,0).data().trim(),
                            rutEmpresa: $("#rutCliente").val(),
                            razonSocial: $("#razonSocial").val(),
                            nombre: $("#nombre").val(),
                            direccion: $("#direccion").val(),
                            comuna: $("#comuna").val(),
                            ciudad: $("#ciudad").val(),
                            solicitaOC: $("#solicitaOC").val(),
                            codigoSoftland: $("#codigoSoftland").val(),
                            crearEnNotaVenta: $("#crearEnNotaVenta").val()
                          },
                    success:function(dato){
                        tabla.cell(fila,1).data( $("#rutCliente").val() );
                        tabla.cell(fila,2).data( $("#nombre").val() );
                        tabla.cell(fila,3).data( $("#razonSocial").val() );
                        tabla.cell(fila,4).data( $("#direccion").val() );
                        tabla.cell(fila,5).data( $("#comuna").val() );
                        tabla.cell(fila,6).data( $("#ciudad").val() );
                        tabla.cell(fila,7).data( $("#solicitaOC option:selected").html() );
                        tabla.cell(fila,8).data( $("#codigoSoftland").val() );
                        tabla.cell(fila,9).data( $("#crearEnNotaVenta option:selected").html() );
                        tabla.row(fila).draw();
                        cerrarModCliente();

                    }
                })                
            }         

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
                "order": [[ 2, "asc" ]],
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Listado de Clientes',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'Listado de Clientes',
                        text:      '<i class="fa fa-file-text-o"></i>',
                        titleAttr: 'CSV',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Listado de Clientes',
                        text:      '<i class="fa fa-file-pdf-o"></i>',
                        titleAttr: 'PDF',                         
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                        }
                    }
                ],                  
                language:{url: "{{ asset('/') }}locales/datatables_ES.json"}
            });

        } );

    </script>
    
@endsection
