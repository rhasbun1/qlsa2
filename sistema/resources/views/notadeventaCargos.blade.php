@extends('plantilla')      

@section('contenedorprincipal')

<div style="padding: 20px">
    <div class="panel panel-default table-responsive">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
        <div class="panel-heading">
            <b>Fletes, Distancias y Tiempos {{ $subtitulo }}</b>
        </div>
        <div class="padding-md clearfix" id="cuadro1">
	        <div style="width: 80%">        
	            <table id="tablaNotas" class="table table-hover table-condensed table-responsive" style="width: 100%">
	                <thead>
	                    <th style="width:80px">Nº Nota Venta</th>
	                    <th style="width:300px">Cliente</th>
                        <th style="width:250px">Obra/Planta</th>
                        <th style="width:120px">Planta QLSA</th>
                        <th style="width:120px">Unidad</th>
                        <th style="width:80px">Costo Flete ($/Unidad)</th>
                        <th style="width:80px">Distancia (km)</th>
                        <th style="width:80px">Tiempo Traslado (horas)</th>
	                </thead>
	                <tbody>
	                    @foreach($cargos as $item)
	                        <tr>
	                            <td>{{ $item->idNotaVenta }}</td>
	                            <td>{{ $item->nombreCliente}}</td>
                                <td>{{ $item->nombreObra}}</td>
                                <td data-idplanta="{{ $item->idPlanta}}">{{ $item->nombrePlanta}}</td>
                                <td data-ucodigo="{{ $item->u_codigo}}">{{ $item->nombreUnidad}}</td>
                                @if(Session::get('idPerfil')=='5' or Session::get('idPerfil')=='10' or Session::get('idPerfil')=='18')
                                <td>
                                    <input class="form-control input-sm" value="{{ $item->flete}}" maxlength="7" onkeypress='return isIntegerKey(event)'>
                                </td>
                                <td>
                                    <input class="form-control input-sm" value="{{ $item->distancia}}" maxlength="5" onkeypress='return isIntegerKey(event)'>
                                </td>
                                <td>
                                    <input class="form-control input-sm" value="{{ $item->tiempoTraslado}}" maxlength="3" onkeypress='return isIntegerKey(event)'>
                                </td>
                                @else
                                <td style="text-align: right;">
                                    {{number_format( $item->flete, 0, ',', '.' )}} 
                                </td>
                                <td style="text-align: right;">
                                    {{number_format( $item->distancia, 0, ',', '.' )}}
                                </td>
                                <td style="text-align: right;">
                                    {{number_format( $item->tiempoTraslado, 0, ',', '.' )}}
                                </td>                                
                                @endif
	                        </tr>
	                    @endforeach
	                </tbody>
	            </table>
	        </div>
		    <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
                @if(Session::get('idPerfil')=='5' or Session::get('idPerfil')=='10' or Session::get('idPerfil')=='18')
                    <button id="btnGuardarCambios" class="btn btn-sm btn-success" style="width:120px" onclick="abrirCuadroEspera();">Guardar Cambios</button>
                @endif
		        <a href="{{ asset('/') }}dashboard" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
		    </div>        
        </div>
		<div class="padding-md clearfix" id="cuadro2" style="display: none">

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

    <!-- Timepicker -->
    <script src="{{ asset('/') }}js/bootstrap-timepicker.min.js"></script>  
    <script src="{{ asset('/') }}js/app/funciones.js"></script>
    <script src="js/syncfusion/ej.web.all.min.js"> </script>
    <script src="{{ asset('/') }}js/syncfusion/lang/ej.culture.de-DE.min.js"></script>

	<script>
        $('#mdProcesando').on('shown.bs.modal', function (e) {
          guardarCambios();
        })  

        function abrirCuadroEspera(){
            $("#mdProcesando").modal('show');
        }      
		$(document).ready(function() {

            $('#tablaNotas thead tr').clone(true).appendTo( '#tablaNotas thead' );
            $('#tablaNotas thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                if(title.trim()!='' && title.trim()=='Unidad' ){
                    $(this).html( '<select id="selUnidad" class="form-control input-sm"></select>' );
                }else if(title.trim()!='' && title.trim()=='Planta QLSA' ){
                    $(this).html( '<select id="selPlanta" class="form-control input-sm"></select>' );                    
                }else{
                    if(i<5){
                        $(this).html( '<input type="text" class="form-control input-sm" placeholder="Buscar..." />' );
                        $( 'input', this ).on( 'keyup change', function () {
                            if ( tabla.column(i).search() !== this.value ) {
                                tabla
                                    .column(i)
                                    .search( this.value )
                                    .draw();
                            }
                        } ); 
                    }else{
                        $(this).html( '' );
                    }                  
                }
            
            } );

            var tabla=$('#tablaNotas').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                columnDefs: [ {
                                "targets": [4,5,6],
                                "orderable": false
                                } ],                    
                language:{url: "{{ asset('/') }}locales/datatables_ES.json"},
                initComplete: function () {
                    actualizarFiltros(this.api());
                }                
            });             

        } );

        function actualizarFiltros(tabla){
            tabla.columns(4).every( function () {
                var column = this;
                var select = $("#selUnidad" ).empty().append( '<option value=""></option>' )
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
            tabla.columns(3).every( function () {
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



		function guardarCambios(){
            document.getElementById('btnGuardarCambios').disabled=true;
			var tabla= $("#tablaNotas").DataTable();
		    var cadena='[';
		    var costo="0";
		    for (var i = 0; i < tabla.rows().count(); i++){
		    	if(tabla.cell(i,5).node().getElementsByTagName('input')[0].value==''){
		    		flete="0";
		    	}else{
		    		flete=tabla.cell(i,5).node().getElementsByTagName('input')[0].value;
		    	}

                if(tabla.cell(i,6).node().getElementsByTagName('input')[0].value==''){
                    distancia="0";
                }else{
                    distancia=tabla.cell(i,6).node().getElementsByTagName('input')[0].value;
                }
                if(tabla.cell(i,7).node().getElementsByTagName('input')[0].value==''){
                    tiempoTraslado="0";
                }else{
                    tiempoTraslado=tabla.cell(i,7).node().getElementsByTagName('input')[0].value;
                }                

                if( isNaN(flete) || isNaN(distancia) || isNaN(tiempoTraslado) ){
                    $("#mdProcesando").modal('hide');
                    document.getElementById('btnGuardarCambios').disabled=false;
                    swal(
                        {
                            title: '¡Los valores ingresados deben ser solo números!' ,
                            text: '',
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonText: 'OK',
                            cancelButtonText: '',
                            closeOnConfirm: true,
                            closeOnCancel: false
                        }
                    )
                    return;                   
                }


                cadena+='{';
                cadena+='"idNotaVenta":"'+ tabla.cell(i,0).data() + '", ';
                cadena+='"idPlanta":"'+ tabla.cell(i,3).node().dataset.idplanta + '", ';
                cadena+='"u_codigo":"'+ tabla.cell(i,4).node().dataset.ucodigo + '", ';
                cadena+='"flete":"'+ flete  + '", ';
                cadena+='"distancia":"'+ distancia  + '", ';
                cadena+='"tiempoTraslado":"' + tiempoTraslado + '"';
                cadena+='}, ';
		    }

		    cadena=cadena.slice(0,-2);
		    cadena+=']';

            $.ajax({
                url: urlApp + "actualizarNotaVentaCargos",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: {                      
                        detalle: cadena
                      },
                success:function(dato){
                    $("#mdProcesando").modal('hide');
                    document.getElementById('btnGuardarCambios').disabled=false;
                    swal(
                        {
                            title: '¡Los cambios han sido guardados!' ,
                            text: '',
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonText: 'OK',
                            cancelButtonText: '',
                            closeOnConfirm: true,
                            closeOnCancel: false
                        }
                    )  

                }
            })	

		}

	</script>

@endsection        	
