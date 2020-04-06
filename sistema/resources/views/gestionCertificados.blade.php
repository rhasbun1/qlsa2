@extends('plantilla')      

@section('contenedorprincipal')

<div style="padding: 5px">

    <div class="panel panel-default" id="contenedor3">
        
        <div class="panel-body">
                <h5><b>{{$titulo}}</b> ( <b>Importante</b>: Para los certificados sólo se permiten subir archivos de tipo PDF. )</h5><br>
                <div class="row" style="padding-top: 5px">                               
                    <div class="col-md-2">
                        Rango por Nº de Pedido
                    </div>
                    <div class="col-md-2">
                        <input id="txtPedidoDesde" class="form-control input-sm" id="min" maxlength="9" onkeypress="return isIntegerKey(event)">
                    </div>
                    <div class="col-md-2">
                        <input id="txtPedidoHasta" class="form-control input-sm" id="max" maxlength="9" onkeypress="return isIntegerKey(event)">
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-success btn-sm" onclick="obtenerCertificados(1);">Buscar</button>
                    </div>                                   
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-md-2">
                        Rango por Nº Guía Despacho
                    </div>
                    <div class="col-md-2">
                        <input id="txtGuiaDesde" class="form-control input-sm" id="min" maxlength="9" onkeypress="return isIntegerKey(event)">
                    </div>
                    <div class="col-md-2">
                        <input id="txtGuiaHasta" class="form-control input-sm" id="max" maxlength="9" onkeypress="return isIntegerKey(event)">
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-success btn-sm" onclick="obtenerCertificados(2);">Buscar</button>
                    </div>                                   
                </div>
                <br>
            
            <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
        
            <b>NOTA: Los productos en los cuales aparezca la sigla S/C, significa que fueron informados como productos despachados Sin Certificado</b>
            <br><br>
            <div class="table-responsive">
                <table id="tablaAprobados" class="table table-condensed">
                    <thead>                      
                        <th style="width:50px"></th>
                        <th style="width:50px">Pedido</th>
                        <th style="width:50px">Guía</th>
                        <th style="width:70px">Planta Origen</th>
                        <th style="width:200px">Cliente</th>
                        <th style="width:200px">Obra</th>
                        <th style="width:80px">Producto</th>
                        <th style="width:50px;text-align: right;">Cantidad</th>
                        <th style="width:50px">Unidad</th>
                        <th style="width:100px">Diseño</th>
                        <th style="width:80px">Conductor</th>                        
                        <th style="width:50px">Patente</th>
                        <th style="width:100px">Fecha/Hora Carga</th>
                    </thead>
                    <tbody>
                        @if(1==3)
                            @foreach($guias as $item)
                                <tr>                                    
                                    <td style="width:50px" data-numguia="{{ $item->numeroGuia }}" data-prodcodigo="{{ $item->prod_codigo }}">
                                        @if( $item->certificado=='' || $item->certificado=='S/C' )
                                            S/C
                                            <button class="btn btn-warning btn-xs" onclick="abrirModalSubirArchivo(this.parentNode.parentNode.rowIndex, 1, {{ $item->prod_codigo }} );" title="Subir Certificado"><span class="glyphicon glyphicon-arrow-up"></span></button>
                                        @else
                                            <a target="_blank" href="{{ asset('/') }}bajarCertificado/{{ $item->certificado }}">
                                                <img src="{{ asset('/') }}img/iconos/certificado.png" border="0">
                                            </a>
                                            <button type="button" class="btn btn-danger btn-xs" onclick="eliminarCertificado(this);" data-archivo="{{$item->certificado}}">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button> 
                                        @endif                                    
                                    </td>
                                    <td style="width:50px">
                                        <a href="{{ asset('/') }}verpedido/{{ $item->idPedido }}/8/" class="btn btn-xs btn-success">{{ $item->idPedido }}</a>
                                        <span name="{{$item->numeroGuia}}" onclick='abrirGuia(1, {{ $item->numeroGuia }}, this.parentNode.parentNode);' style="cursor:pointer; cursor: hand" title="Ver guía"><img src="{{ asset('/') }}img/iconos/guiaDespacho2.png" border="0"></span>
                                    </td>
                                    <td style="width:70px;text-align: right;">
                                        @if( $item->folioDTE>0)
                                            {{ $item->folioDTE }}
                                        @endif
                                    </td>
                                    <td style="width:70px">{{ $item->plantaOrigen }}</td>
                                    <td style="width:200px">{{ $item->emp_nombre }}</td>
                                    <td style="width:200px">{{ $item->obra }}</td>
                                    <td style="width:80px">{{ $item->prod_nombre }}</td>
                                    <td style="width:50px; text-align: right;">{{ number_format( $item->cantidadDespachada, 0, ',', '.' )}}</td>
                                    <td style="width:50px">{{ $item->unidad }}</td>
                                    <td style="width:100px">{{ $item->formula }}</td>
                                    <td style="width:80px">{{ $item->retiradoPor }}</td>
                                    <td style="width:50px">{{ $item->patenteCamionDespacho }}</td>
                                    <th style="width:100px">{{ $item->fechaHoraCarga }}</th>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>            
                </table>
            </div>
        </div>
    </div>
   
</div>

@include('guiaDespacho')

<div id="modSubirArchivo" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <input type="hidden" id="filaTabla" name="filaTabla">
                <h5><b>Subir Certificado</b></h5>
            </div>
            <div id="bodyProducto" class="modal-body">
                <form id="datos" name="datos" enctype="multipart/form-data">
                    <input type="hidden" id="codigoTipoGuia" name="codigoTipoGuia">
                    <input type="hidden" id="codigoProducto" name="codigoProducto">
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Guia Nº
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm" id="numeroGuiaCertificado" name="numeroGuiaCertificado" readonly>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Cliente
                        </div>
                        <div class="col-md-8">
                            <input class="form-control input-sm" id="nombreCliente" readonly>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Obra
                        </div>
                        <div class="col-md-8">
                            <input class="form-control input-sm" id="nombreObra" readonly>
                        </div>
                    </div>                                           
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Producto
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm" id="nombreProducto" data-codigo="0" readonly>
                        </div>
                        <div class="col-md-2">
                            Diseño
                        </div>
                        <div class="col-md-3">
                            <input class="form-control input-sm" id="diseno" data-codigo="0" readonly>
                        </div>                    
                    </div>
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Cantidad
                        </div>
                        <div class="col-md-5">
                            <input class="form-control input-sm" id="cantidad" data-codigo="0" readonly>
                        </div>
                    </div>                
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Conductor
                        </div>
                        <div class="col-md-8">
                            <input class="form-control input-sm" id="nombreConductor" readonly>
                        </div>
                    </div>
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Patente
                        </div>
                        <div class="col-md-4">
                            <input class="form-control input-sm" id="patente" readonly>
                        </div>
                    </div>                                
                    <div class="row" style="padding: 15px">
                        <input type="file" class="form-control input-sm" id="miArchivo" name="miArchivo" accept=".pdf" required>
                    </div>
                    <div class="col-md-offset-8" style="padding-top: 20px; padding-bottom: 20px">
                       <button type="submit" class="btn btn-success btn-sm" style="width: 80px">Subir</button>
                       <button type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarModalSubirArchivo()" style="width: 80px">Salir</button>
                    </div>                   
                </form>     
            </div>
        </div>
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

    <script src="{{ asset('/') }}js/app/funciones.js"></script>
    <script src="{{ asset('/') }}js/app/guiaDespacho.js"></script>
    
    <script src="https://cdn.datatables.net/fixedcolumns/3.2.5/js/dataTables.fixedColumns.min.js"></script>

    <script>

        function abrirModalSubirArchivo(fila, tipoGuia, codProducto){
            var tabla=document.getElementById('tablaAprobados');
            $("#filaTabla").val(fila);
            $("#numeroGuiaCertificado").val( tabla.rows[fila].cells[0].dataset.numguia);
            $("#codigoTipoGuia").val(tipoGuia);
            $("#nombreCliente").val(tabla.rows[fila].cells[4].innerHTML.trim() );
            $("#nombreObra").val(tabla.rows[fila].cells[5].innerHTML.trim() );
            $("#nombreProducto").val(tabla.rows[fila].cells[6].innerHTML.trim() );
            $("#cantidad").val( tabla.rows[fila].cells[7].innerHTML.trim() + " " + tabla.rows[fila].cells[8].innerHTML.trim() );
            $("#diseno").val(tabla.rows[fila].cells[9].innerHTML.trim() );
            $("#codigoProducto").val(codProducto);
            $("#nombreConductor").val(tabla.rows[fila].cells[10].innerHTML.trim());
            $("#patente").val(tabla.rows[fila].cells[11].innerHTML.trim() );
            $("#miArchivo").val('');
            $("#modSubirArchivo").modal('show');
        }


        function cerrarModalSubirArchivo(){
            $("#modSubirArchivo").modal("hide");
        }

        function eliminarCertificado(btn){
            swal(
                {
                    title: '¿Elimina el certificado de este producto?' ,
                    text: '',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm)
                {
                    if(isConfirm){
                        $.ajax({
                            async: false,
                            url: urlApp + "eliminarCertificado",
                            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                    nombreCertificado: btn.dataset.archivo,
                                    opcion: 2 
                                  },                    
                            success:function(dato){
                                btn.parentNode.innerHTML='<button class="btn btn-warning btn-xs" onclick="abrirModalSubirArchivo(this.parentNode.parentNode.rowIndex, 1,' + btn.parentNode.dataset.prodcodigo + ');"><span class="glyphicon glyphicon-arrow-up"></span></button>';
                            },
                            error: function(result) {
                               // cerrarModProcesando();
                               alert("Ha ocurrido un error y el documento no pudo ser procesado");
                            }
                        })                                    
                      
                    }
                }
            )            
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
                  tabla.rows[fila].cells[0].innerHTML="<a target='_blank' href='"+ urlApp + "bajarCertificado/" + data + "'><img src='{{ asset('/') }}img/iconos/certificado.png' border='0'></a><button class='btn btn-danger btn-xs' onclick='eliminarCertificado(this)' data-archivo='"+ data + "'><span class='glyphicon glyphicon-remove'></span></button>";  
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
                if(title.trim()!='' && title.trim()=='Planta Origen' ){
                    $(this).html( '<select id="selPlanta" class="form-control input-sm"></select>' );
                }else{
                    if(i>0){
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
                "order": [[ 1, "desc" ]],                        
                language:{url: "{{ asset('/') }}locales/datatables_ES.json"},
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

        } );

        function obtenerCertificados(opcion){


            $("#mdProcesando").modal('show');    

            var tabla=$("#tablaAprobados").DataTable();

            tabla.rows().remove();


            var pedDesde="0";
            if( $("#txtPedidoDesde").val()!=''){
                pedDesde=$("#txtPedidoDesde").val();
            }

            var pedHasta="0";
            if( $("#txtPedidoHasta").val()!=''){
                pedHasta=$("#txtPedidoHasta").val();
            }

            var guiaDesde="0";
            if( $("#txtGuiaDesde").val()!=''){
                guiaDesde=$("#txtGuiaDesde").val();
            }

            var guiaHasta="0";
            if( $("#txtGuiaHasta").val()!=''){
                guiaHasta=$("#txtGuiaHasta").val();
            }
           
            $.ajax({
                url: urlApp +'obtenerCertificados',
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        pedidoDesde: pedDesde,
                        pedidoHasta: pedHasta,
                        guiaDesde: guiaDesde,
                        guiaHasta: guiaHasta,
                        opcion: opcion 
                      },
                success:function(dato){
                    for(var x=0;x<dato.length;x++){
                        var col0='';
                        if( dato[x].certificado=='S/C' ){
                            col0+='S/C';
                            col0+='<button type="button" class="btn btn-danger btn-xs" onclick="eliminarCertificado(this);" data-archivo="' + dato[x].certificado +'"><span class="glyphicon glyphicon-remove"></span></button>';                            
                        }else{
                            col0+='<a target="_blank" href="' + urlApp + 'bajarCertificado/' + dato[x].certificado + '">';
                            col0+='<img src="' + urlApp + 'img/iconos/certificado.png" border="0"></a>';

                            col0+='<button type="button" class="btn btn-danger btn-xs" onclick="eliminarCertificado(this);" data-archivo="' + dato[x].certificado +'"><span class="glyphicon glyphicon-remove"></span></button>';
                        }                                                          

                        var col1='';
                        col1+='<a href="' + urlApp + 'verpedido/' + dato[x].idPedido + '/8/" class="btn btn-xs btn-success">' + dato[x].idPedido + '</a>';
                        col1+='<span name="' + dato[x].numeroGuia + '" onclick="abrirGuia(1, ' + dato[x].numeroGuia + ', this.parentNode.parentNode);" style="cursor:pointer; cursor: hand" title="Ver guía"><img src="' + urlApp + 'img/iconos/guiaDespacho2.png" border="0"></span>';

                        var col2='';
                        if( dato[x].folioDTE>0){
                            col2=dato[x].folioDTE;
                        }

                        var fila=tabla.row.add( [
                                col0,
                                col1,
                                col2,
                                dato[x].plantaOrigen,
                                dato[x].emp_nombre,
                                dato[x].obra,
                                dato[x].prod_nombre,
                                dato[x].cantidadDespachada,
                                dato[x].unidad,
                                dato[x].formula,
                                dato[x].retiradoPor,
                                dato[x].patenteCamionDespacho,
                                dato[x].fechaHoraCarga
                            ] ).index();

                        tabla.cell(fila,0).node().dataset.numguia=dato[x].numeroGuia;
                        tabla.cell(fila,0).node().dataset.prodcodigo=dato[x].prod_codigo;

                     //   tabla.cell(fila,0).node().width=60;
                    }
                    tabla.draw();
                    //actualizarFiltros(tabla);
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