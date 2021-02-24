@extends('plantilla')      

@section('contenedorprincipal')
<div style="padding: 20px">
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b>Consultar Registro de Acciones</b>
        </div>
        <div class="padding-md clearfix"  style="width:900px">
	        <div>
	        	<div class="row">
	        		<div class="col-md-1">
						Ítem
	        		</div>
	        		<div class="col-md-3">
	        			<select id="item" class="form-control input-sm" onchange="limpiarBusqueda();">
                            @foreach($itemAcciones as $item)
                               <option value="{{ $item->item }}">{{ $item->descripcion }} </option>
                            @endforeach    
	        			</select>
	        		</div>
	        		<div class="col-md-1" id="etiqueta">
	        			Número
	        		</div>
	        		<div class="col-md-3">
	        			<input id="cadenaBusqueda" class="form-control input-sm" maxlength="30">
	        		</div>
	        		<div class="col-md-1">
	        			<button class="btn btn-sm btn-warning" onclick="consultarRegistroAcciones();">Buscar</button>
	        		</div>
	        	</div>
	        </div>
	        <br>           
            <table id="tabla" class="table table-hover table-condensed table-responsive">
                <thead>
                    <th style="width: 80px">Tipo</th>
                    <th style="width: 500px">Motivo</th>
                    <th style="width: 120px">Fecha</th>
                    <th style="width: 200px">Usuario</th>
                </thead>
                <tbody>
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
    <script src="{{ asset('/') }}js/app/funciones.js"></script>
    <script>

		$(document).ready(function() {

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

			var table=$('#tabla').DataTable({
                    orderCellsTop: true,
                    fixedHeader: true,
                    "scrollX": true,
                    lengthMenu: [[6, 12, 20, -1], ["6", "12", "20", "Todos"]],                
                    dom: 'Bfrtip',
                    buttons: [
           
					'pageLength'
				],
                      
                language:{url: "{{ asset('/') }}locales/datatables_ES.json"}              
            });
        } );

		function limpiarBusqueda(){
			var valor=document.getElementById('item').value;

			if(valor=='NV' || valor=='GD' || valor == 'Ped'){
				document.getElementById('etiqueta').innerHTML='Número'
			}else{
				document.getElementById('etiqueta').innerHTML='Descripción'
			}
			document.getElementById('cadenaBusqueda').value='';

		}

    	function consultarRegistroAcciones(){
        	var tabla=$('#tabla').DataTable();
        	tabla.rows().remove().draw();

        	if(document.getElementById('item').value=='PROD'){
	            $.ajax({
	                url: urlApp +'consultarProductoAcciones',
	                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
	                type: 'POST',
	                dataType: 'json',
	                data: { 
	                		cadena: document.getElementById('cadenaBusqueda').value
	                      },
	                success:function(dato){
	                    for(var x=0;x<dato.length;x++){
	                        var fila=tabla.row.add( [
	                                dato[x].tipo,
	                                dato[x].motivo,
	                                dato[x].fechaHora,
	                                dato[x].nombreUsuario
	                            ] );
	                    }
	                    tabla.draw();
	                }
	            })         		
        	}else{
	            $.ajax({
	                url: urlApp +'consultarRegistroAcciones',
	                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
	                type: 'POST',
	                dataType: 'json',
	                data: { 
	                		item: document.getElementById('item').value,
	                		numero: document.getElementById('cadenaBusqueda').value
	                      },
	                success:function(dato){
	                    for(var x=0;x<dato.length;x++){
	                        var fila=tabla.row.add( [
	                                dato[x].tipo,
	                                dato[x].motivo,
	                                formato(dato[x].fechaHora),
	                                dato[x].nombreUsuario
	                            ] );
	                    }
	                    tabla.draw();
	                }
	            })           		
        	}
   		
    	}
		function formato(texto){
			return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
		}

    </script>
   
@endsection
