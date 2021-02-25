@extends('plantilla')      

@section('contenedorprincipal')

<div style="padding: 5px">

    <div class="panel panel-default" id="contenedor3">

        <div class="panel-body" id="panelBody" style="display: none">
            <h5><b>LISTADO DE GUIAS DE DESPACHO</b></h5>
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
            <div class="table-responsive">
                <table id="tablaAprobados" class="table table-condensed" style="width: 100%">
                    <thead>                      
                        <th style="width:100px">Guía º</th>
                        <th style="width:100px">Pedido/Nota Venta</th>
                        <th style="width:200px">Cliente</th>
                        <th style="width:200px">Obra</th>
                        <th style="width:150px">Producto</th>
                        <th style="width:80px">Cantidad</th>
                        <th style="width:50px">Unidad</th>
                        <th style="width:100px">Diseño</th>
                        <th style="width:80px">Conductor</th>                        
                        <th style="width:50px">Patente</th>
                    </thead>
                    <tbody>
                        @foreach($guias as $item)
                            <tr>                                    
                                <td style="width:100px">
                                    {{ $item->numeroGuia }}
                                    <span onclick='abrirGuia(1, {{ $item->numeroGuia }}, this.parentNode.parentNode.rowIndex);' style="cursor:pointer; cursor: hand" title="{{ $item->numeroGuia }}"><img src="{{ asset('/') }}img/iconos/guiaDespacho2.png" border="0"></span>
                                    @if ( $item->certificado!='' )  
                                    <a href="{{ asset('/') }}bajarCertificado/{{ $item->certificado }}">
                                        <img src="{{ asset('/') }}img/iconos/certificado.png" border="0">
                                    </a>
                                    @endif                                  
                                </td>
                                <td></td>
                                <td style="width:200px">{{ $item->emp_nombre }}</td>
                                <td style="width:200px">{{ $item->obra }}</td>
                                <td style="width:150px">{{ $item->prod_nombre }}</td>
                                <td style="width:80px">{{ $item->cantidadDespachada }}</td>
                                <td style="width:50px">{{ $item->unidad }}</td>
                                <td style="width:100px">{{ $item->formula }}</td>
                                <td style="width:80px">{{ $item->retiradoPor }}</td>
                                <td style="width:50px">{{ $item->patenteCamionDespacho }}</td>
                            </tr>
                        @endforeach
                    </tbody>            
                </table>
            </div>
        </div>
    </div>
</div>

@include('guiaDespacho')

@endsection

@section('javascript')

    <script src="{{ asset('/') }}js/app/funciones.js"></script>
    <script src="{{ asset('/') }}js/app/guiaDespacho.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.2.5/js/dataTables.fixedColumns.min.js"></script>

    <script>


        function abrirModalSubirArchivo(fila, tipoGuia, codProducto){
            var tabla=document.getElementById('tablaAprobados');
            $("#filaTabla").val(fila);
            $("#numeroGuia").val(tabla.rows[fila].cells[0].innerHTML.trim() );
            $("#codigoTipoGuia").val(tipoGuia);
            $("#nombreCliente").val(tabla.rows[fila].cells[1].innerHTML.trim() );
            $("#nombreObra").val(tabla.rows[fila].cells[2].innerHTML.trim() );
            $("#nombreProducto").val(tabla.rows[fila].cells[3].innerHTML.trim() );
            $("#cantidad").val( tabla.rows[fila].cells[4].innerHTML.trim() + " " + tabla.rows[fila].cells[5].innerHTML.trim() );
            $("#diseno").val(tabla.rows[fila].cells[6].innerHTML.trim() );
            $("#codigoProducto").val(codProducto);
            $("#nombreConductor").val(tabla.rows[fila].cells[7].innerHTML.trim());
            $("#patente").val(tabla.rows[fila].cells[8].innerHTML.trim() );
            $("#modSubirArchivo").modal('show');
        }


        function cerrarModalSubirArchivo(){
            $("#modSubirArchivo").modal("hide");
        }
        
        $('#datos').on('submit', function(e) {
          // evito que propague el submit
          e.preventDefault();
          // agrego la data del form a formData
          var formData = new FormData( $("#datos")[0]);
          $.ajax({
              url: urlApp + "subirCertificado",
              headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
              type:'POST',
              data:formData,
              cache:false,
              contentType: false,
              processData: false,
              success:function(data){
                  var tabla=document.getElementById('tablaAprobados');
                  var fila= $("#filaTabla").val();
                  cerrarModalSubirArchivo();
                  tabla.rows[fila].cells[7].innerHTML="<a href='"+ urlApp + "bajarCertificado/" + data + "'><img src='{{ asset('/') }}img/iconos/certificado.png' border='0'></a><button class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span></button>";  
              },
              error: function(jqXHR, text, error){
                  alert('Error!, No se pudo Añadir los datos');
              }
          });
        });


        $(document).ready(function() {
            // Setup - add a text input to each footer cell

            // DataTable

            // Setup - add a text input to each footer cell
            $('#tablaAprobados thead tr').clone(true).appendTo( '#tablaAprobados thead' );
            $('#tablaAprobados thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                if( title!=''){
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
                "scrollX": true,
                buttons: [
                    {
                        text: 'Actualizar',
                        action: function ( e, dt, node, config ) {
                            this.disable();    
                            location.reload(true);                        
                        }
                    },                
                    'pageLength'
                ],                  
                "order": [[ 0, "desc" ]],                        
                language:{url: "{{ asset('/') }}locales/datatables_ES.json"},
                preDrawCallback: function( settings ) {
                    document.getElementById('panelBody').style.display="block";
                  }
            });         

        } );



    </script>

@endsection