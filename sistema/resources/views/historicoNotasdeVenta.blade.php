@extends('plantilla')      

@section('contenedorprincipal')

<div style="padding: 5px">
    <div class="panel panel-default table-responsive">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
        <div class="panel-heading">
            <b>HISTORICO NOTAS DE VENTA</b>
        </div>
        <div class="padding-md clearfix"> 
            <div> 
                <div class="row">
                    <div class="col-md-4">
                        @if( Session::get('idPerfil')=='14' or Session::get('idPerfil')=='15')
                            <div class="row" style="padding-top: 5px;display: none">
                        @else
                            <div class="row" style="padding-top: 5px">
                        @endif    
                            <div class="col-md-4">
                                Cliente
                            </div>
                            <div class="col-md-8">
                                <select id="idCliente" class="form-control input-sm">
                                    <option value="0">Todos los clientes</option>
                                    @foreach($clientes as $item)
                                        <option value="{{ $item->emp_codigo }}">{{ $item->emp_nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-4" style="padding-top: 5px">
                                Filtrar por Fecha Creación
                            </div>
                            <div class="col-md-3">
                                <div class="input-group date" id="divFechaMin">
                                    <input type="text" class="form-control input-sm" id="min">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group date" id="divFechaMax">
                                    <input type="text" class="form-control input-sm" id="max">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-success btn-sm" onclick="obtenerHistorico(1);">Buscar</button>
                            </div>                                
                        </div>
                                                       
                        <div class="row" style="padding-top: 5px">                               
                            <div class="col-md-4">
                                Rango por Nº Nota de Venta
                            </div>
                            <div class="col-md-3">
                                <input id="txtNotaVentaDesde" class="form-control input-sm" id="min" maxlength="9" onkeypress="return isIntegerKey(event)">
                            </div>
                            <div class="col-md-3">
                                <input id="txtNotaVentaHasta" class="form-control input-sm" id="max" maxlength="9" onkeypress="return isIntegerKey(event)">
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-success btn-sm" onclick="obtenerHistorico(2);">Buscar</button>
                            </div>                                   
                        </div>
                    </div>
                </div>                                                                             
            </div>
            <hr style="color: #0056b2;" />
            <table id="tablaDetalle" class="table table-hover table-condensed table-responsive">
                <thead>
                    <th style="width: 60px">Nota Venta</th>
                    <th>Fecha Creación</th>
                    <th>Cliente</th>
                    <th>Obra/Planta</th>
                    <th>Estado</th>
                </thead>
                <tbody>
                    @foreach($listaNotasdeVenta as $item)
                        <tr>
                            <!--MATIAS-->
                            <td style="width: 60px"><a href="vernotaventa/{{ $item->idNotaVenta }}-0/3/" class="btn btn-xs btn-info" title="Ver Nota Venta" style="width:100%">{{ $item->idNotaVenta }}</a></td>                            
                            <td>{{ $item->fecha_hora_creacion }}</td>
                            <td>{{ $item->emp_nombre }}</td>
                            <td>{{ $item->Obra }}</td>
                            @if($item->aprobada==1)
                                <td>Aprobado</td>
                            @else
                                <td>Pendiente de Aprobación</td>
                            @endif
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

<div id="mdProcesando" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" style="text-align: center">
          <img src="{{ asset('/') }}img/procesando.gif" alt="User Avatar">
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

    <script>

        $(document).ready(function() {


            var hoy = new Date();
            var dd = hoy.getDate();
            var mm = hoy.getMonth()+1;
            var yyyy = hoy.getFullYear();

            if (dd < 10) {dd = '0' + dd; }
            if (mm < 10) {mm = '0' + mm; }
            $("#max").val(dd + '/' + mm + '/' + yyyy);

            hoy.setMonth(hoy.getMonth() - 12);
            var dd = hoy.getDate();
            var mm = hoy.getMonth()+1;
            var yyyy = hoy.getFullYear()+1;
            if (dd < 10) {dd = '0' + dd; }
            if (mm < 10) {mm = '0' + mm; }
            $("#min").val(dd + '/' + mm + '/' + yyyy);

            // Setup - add a text input to each footer cell
            $('#tablaDetalle thead tr').clone(true).appendTo( '#tablaDetalle thead' );
            $('#tablaDetalle thead tr:eq(1) th').each( function (i) {
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


            var tituloArchivo='Histórico de Notas de Venta';
            // DataTable
            var table=$('#tablaDetalle').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                lengthMenu: [[6, 12, 20, -1], ["6", "12", "20", "Todos"]],
                dom: 'Bfrtip',
                buttons: [
                    'pageLength',
                    {
                        text: 'Actualizar',
                        action: function ( e, dt, node, config ) {
                            this.disable();    
                            location.reload(true);                        
                        }
                    },                       
                    {
                        extend: 'excelHtml5',
                        title: tituloArchivo,
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    }
                ],                  
                "order": [[ 0, "desc" ]],
                language:{url: "{{ asset('/') }}locales/datatables_ES.json"},
                initComplete: function () {
                    actualizarFiltros(this.api());
                }                
            });

            $('.date').datepicker({
                todayHighlight: true,
                format: "dd/mm/yyyy",
                weekStart: 1,
                language: "es",
                autoclose: true
            })            

        } );

        function actualizarFiltros(tabla){

            tabla.columns(4).every( function () {
                var column = this;

                var select = $('<select class="form-control input-sm"><option value=""></option></select>')
                    .appendTo( $( '#tablaDetalle thead tr:eq(1) th:eq(4)' ).empty() )
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

        function obtenerHistorico(opcion){


            $("#mdProcesando").modal('show');    

            var tabla=$("#tablaDetalle").DataTable();

            tabla.rows().remove();


            var fechaCreacionDesde=$("#min").val().trim();
            var fechaCreacionHasta=$("#max").val().trim();                


            if(fechaCreacionDesde==''){
                fechaCreacionDesde='01/01/1900';
            }
            
            if(fechaCreacionHasta==''){   
                var hoy = new Date();
                var dd = hoy.getDate();
                var mm = hoy.getMonth()+1;
                var yyyy = hoy.getFullYear();

                if (dd < 10) {dd = '0' + dd; }
                if (mm < 10) {mm = '0' + mm; }
            
                fechaCreacionHasta=dd + '/' + mm + '/' + yyyy;
            }

            var nvDesde="0";
            if( $("#txtNotaVentaDesde").val()!=''){
                nvDesde=$("#txtNotaVentaDesde").val();
            }

            var nvHasta="0";
            if( $("#txtNotaVentaHasta").val()!=''){
                nvHasta=$("#txtNotaVentaHasta").val();
            }

            $.ajax({
                url: urlApp +'obtenerHistoricoNotaVentas',
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        fechaCreacionDesde: fechaCreacionDesde,
                        fechaCreacionHasta: fechaCreacionHasta,
                        emp_codigo: $("#idCliente").val(),
                        nvDesde: nvDesde,
                        nvHasta: nvHasta,
                        opcion: opcion 
                      },
                success:function(dato){
                    for(var x=0;x<dato.length;x++){
                        cadena="";
                        if(dato[x].aprobada==1){
                            cadena="Aprobado";
                        }else{
                            cadena="Pendiente de Aprobación";
                        }
                        //MATIAS
                        nv='<a href="vernotaventa/' + dato[x].idNotaVenta + '-0/3/" class="btn btn-xs btn-info" title="Ver Nota Venta" style="width:100%">' + dato[x].idNotaVenta + '</a>';
                                          
                        var fila=tabla.row.add( [
                                nv,
                                dato[x].fecha_hora_creacion,
                                dato[x].emp_nombre,
                                dato[x].Obra,
                                cadena
                            ] ).index();
                    }
                    tabla.draw();
                    actualizarFiltros(tabla);
                    $("#mdProcesando").modal('hide');
                },
                error: function(jqXHR, text, error){
                    $("#mdProcesando").modal('hide');
                    alert('Ha ocurrido un error!, vuelva a presionar el botón Buscar Selección');
                }                
            })
        }        

    </script>
    
@endsection