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
                        <th style="width:250px">Obra</th>
                        <th style="width:120px">Planta</th>
                        <th style="width:80px">Flete</th>
                        <th style="width:80px">Distancia</th>
                        <th style="width:80px">Tiempo Traslado</th>
	                    <th style="width:40px"></th>
	                </thead>
	                <tbody>
	                    @foreach($cargos as $item)
	                        <tr>
	                            <td>{{ $item->idNotaVenta }}</td>
	                            <td>{{ $item->nombreCliente}}</td>
                                <td>{{ $item->nombreObra}}</td>
                                <td data-idplanta="{{ $item->idPlanta}}">{{ $item->nombrePlanta}}</td>
                                <td>
                                    <input class="form-control input-sm" value="{{ $item->flete}}" onkeypress='return isIntegerKey(event)'>
                                </td>
                                <td>
                                    <input class="form-control input-sm" value="{{ $item->distancia}}" onkeypress='return isIntegerKey(event)'>
                                </td>
                                <td>
                                    <input class="form-control input-sm" value="{{ $item->tiempoTraslado}}" onkeypress='return isIntegerKey(event)'>
                                </td>
	                            <td style="width:40px">
	                            	<button class="btn btn-xs btn btn-warning btnEditar" title="Ver Costos" onclick="listarCostosProductos(this.parentNode.parentNode);"><i class="fa fa-edit fa-lg"></i></button>
	                            </td>
	                        </tr>
	                    @endforeach
	                </tbody>
	            </table>
	        </div>
		    <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
                <button class="btn btn-sm btn-success" style="width:120px" onclick="abrirCuadroEspera();">Guardar Cambios</button>
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

            var tabla=$('#tablaNotas').DataTable({
                orderCellsTop: true,
                fixedHeader: true,      
                language:{url: "{{ asset('/') }}locales/datatables_ES.json"},
                initComplete: function () {
                    actualizarFiltros(this.api());
                }                
            });             

        } );

        function actualizarFiltros(tabla){
            tabla.columns(0).every( function () {
                var column = this;
                var select = $("#selProducto" ).empty().append( '<option value=""></option>' )
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
            tabla.columns(1).every( function () {
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
            tabla.columns(2).every( function () {
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
			var tabla= $("#tablaNotas").DataTable();
		    var cadena='[';
		    var costo="0";
		    for (var i = 0; i < tabla.rows().count(); i++){
		    	if(tabla.cell(i,4).data()==''){
		    		flete="0";
		    	}else{
		    		flete=tabla.cell(i,4).node().getElementsByTagName('input')[0].value;
		    	}
                if(tabla.cell(i,5).data()==''){
                    distancia="0";
                }else{
                    distancia=tabla.cell(i,5).node().getElementsByTagName('input')[0].value;
                }
                if(tabla.cell(i,6).data()==''){
                    tiempoTraslado="0";
                }else{
                    tiempoTraslado=tabla.cell(i,6).node().getElementsByTagName('input')[0].value;
                }                

                cadena+='{';
                cadena+='"idNotaVenta":"'+ tabla.cell(i,0).data() + '", ';
                cadena+='"idPlanta":"'+ tabla.cell(i,3).node().dataset.idplanta + '", ';
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
