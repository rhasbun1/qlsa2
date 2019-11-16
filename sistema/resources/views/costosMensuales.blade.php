@extends('plantilla')      

@section('contenedorprincipal')

<div style="padding: 20px">
    <div class="panel panel-default table-responsive">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="periodoActual" value='{{ $periodoActual }}'
        <div class="panel-heading">
            <b>Costos Mensuales</b>
        </div>

        <div class="padding-md clearfix" id="cuadro1">
	        <div class="row" style="padding-bottom: 15px">
	        	<div class="col-md-1">
	        		Año
	        	</div>
	        	<div class="col-md-1">
	        		<input id="ano" class="form-control input-sm" maxlength="4">
	        	</div>
	        	<div class="col-md-1">
	        		Mes
	        	</div>
	        	<div class="col-md-2">
	        		<select id="mes" class="form-control input-sm">
	        			<option value="1">Enero</option>
	        			<option value="2">Febrero</option>
	        			<option value="3">Marzo</option>
	        			<option value="4">Abril</option>
	        			<option value="5">Mayo</option>
	        			<option value="6">Junio</option>
	        			<option value="7">Julio</option>
	        			<option value="8">Agosto</option>
	        			<option value="9">Septiembre</option>
	        			<option value="10">Octubre</option>
	        			<option value="11">Noviembre</option>
	        			<option value="12">Diciembre</option>
	        		</select>
	        	</div>
	        	<div class="col-md-1">
	        		<button class="btn btn-success btn-sm" onclick="agregarMes()">Agregar</button>
	        	</div>        	
	        </div>
	        <div style="width: 50%">        
	            <table id="tabla" class="table table-hover table-condensed table-responsive" style="width: 100%">
	                <thead>
	                    <th style="width:80px">Año</th>
	                    <th style="width:100px">Mes</th>
	                    <th style="width:40px"></th>
	                </thead>
	                <tbody>
	                    @foreach($costosMensuales as $item)
	                        <tr data-nummes="{{ $item->mes }}">
	                            <td>{{ $item->ano }}</td>
	                            <td>{{ $item->nombreMes}}</td>
	                            <td style="width:40px">
	                            	<button class="btn btn-xs btn btn-warning btnEditar" title="Ver Costos" onclick="listarCostosProductos(this.parentNode.parentNode);"><i class="fa fa-edit fa-lg"></i></button>
                                    <button class="btn btn-xs btn btn-success btnEditar" title="Subir Archivo de Costos" onclick="subirArchivoCostos(this.parentNode.parentNode);"><i class="fa fa-edit fa-lg"></i></button>                                    
	                            </td>
	                        </tr>
	                    @endforeach
	                </tbody>
	            </table>
	        </div>
		    <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
		        <a href="{{ asset('/') }}dashboard" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
		    </div>        
        </div>
		<div class="padding-md clearfix" id="cuadro2" style="display: none">

    </div>
 
</div>

<div id="mdCostos" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      	<div class="modal-body">
				<div class="row">
					<div class="col-md-1">
						Año
					</div>
					<div class="col-md-2">
						<input id="anoSel" class="form-control input-sm" readonly>
					</div>
					<div class="col-md-1">
						Mes
					</div>
					<div class="col-md-2">
						<input id="mesSel" class="form-control input-sm" readonly data-numeromes="0">
					</div>				
				</div>
				<br>
		        <div style="width: 80%">        
		            <table id="tablaProductos" class="table table-hover table-condensed table-responsive" style="width: 100%">
		                <thead>
		                    <th style="width:120px">Producto</th>
		                    <th style="width:60px">Unidad</th>
		                    <th style="width:80px">Planta</th>
		                    <th style="width:80px">Costo ($)</th>
		                </thead>
		                <tbody>
		                </tbody>
		            </table>
		        </div>
			    <div style="text-align: right;">
			    	<button id="btnGuardarCambios" class="btn btn-sm btn-success" style="width:120px" onclick="abrirCuadroEspera();">Guardar Cambios</button>
			        <button class="btn btn-sm btn-warning" style="width:100px" onclick="cerrarListaProductos();">Cerrar</button>
			    </div>  	        		
			</div>
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

<div id="mdProcesandoArchivoCostos" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" style="text-align: center">
          <img src="{{ asset('/') }}img/procesando.gif" alt="User Avatar">
      </div>
    </div>
  </div>
</div>

<div id="modSubirArchivo" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <input type="hidden" id="filaTabla" name="filaTabla">
                <h5><b>Subir archivo de Costos</b></h5>
            </div>
            <div id="bodyProducto" class="modal-body">
                <form id="datos" name="datos" enctype="multipart/form-data">                       
                    <div class="row" style="padding: 15px">
                        <div class="upload-file">
                            <input type="file" id="upload-demo" name="upload-demo" class="upload-demo" style="width: 300px" accept=".csv" >
                            <label data-title="Buscar" for="upload-demo" id="labelUpload" style="width: 400px">
                                <span id="mensajeUpload" data-title="No ha seleccionado un archivo..." style="width: 300px"></span>
                            </label>
                        </div>
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

        var anoSel=0;
        var mesSel=0;

        $('#datos').on('submit', function(e) {
          // evito que propague el submit
          e.preventDefault();
          // agrego la data del form a formData
          if( $("#upload-demo").val().trim()=='' ){
            swal(
                {
                    title: 'No ha seleccionado un archivo para subir!!' ,
                    text: '',
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    cancelButtonText: '',
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function(isConfirm)
                {
                    if(isConfirm){
                        return;                         
                    }
                }
            );
            return;
          }

          var nombreArchivo=$("#upload-demo").val().trim();
          var extension = nombreArchivo.slice(-3).toUpperCase();
          if( extension!='CSV'){
            swal(            
                {
                    title: 'Solo se permite subir achivos CSV!' ,
                    text: '',
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'OK',
                    cancelButtonText: '',
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function(isConfirm)
                {
                    if(isConfirm){
                        return;                         
                    }
                }
            );
            return;
          }

          var formData = new FormData( $("#datos")[0]);
          formData.append("observaciones", "" );
          formData.append("ano", anoSel);
          formData.append("mes", mesSel );

          $("#mdProcesandoArchivoCostos").modal('show');       
          $.ajax({
              url: urlApp + "subirArchivoCostos",
              headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
              type:'POST',
              timeout: 0,
              data:formData,
              cache:false,
              contentType: false,
              processData: false,
              success:function(data){
                $("#mdProcesandoArchivoCostos").modal('hide');
                if(data.length>0){
                  var cadena="";
                  for(var x=0;x<data.length;x++){
                      cadena+= data[x] + "<br>";
                  }
                  document.getElementById('bodyErrores').innerHTML=cadena;
                  $("#mdErrores").modal("show");
                }else{
                  swal(
                      {
                          title: 'El archivo ha sido Procesado!!' ,
                          text: '',
                          type: 'warning',
                          showCancelButton: false,
                          confirmButtonText: 'OK',
                          cancelButtonText: '',
                          closeOnConfirm: true,
                          closeOnCancel: false
                      },
                      function(isConfirm)
                      {
                          if(isConfirm){
                            $("#modSubirArchivo").modal('hide');
                            return;                         
                          }
                      }
                  );
                }     
              },
              error: function(jqXHR, text, error){
                $("#mdProcesandoArchivoCostos").modal('hide');
                  alert('Error!, No se pudo Añadir los datos');
              }
          });
        });

        $('#mdProcesando').on('shown.bs.modal', function (e) {
          guardarCostos();
        })  

        function abrirCuadroEspera(){
            $("#mdProcesando").modal('show');
        }


        function subirArchivoCostos(row){
            var tabla=$("#tabla").DataTable();
            var datos=tabla.row( row ).data();
            var node=tabla.row(row).node();

            anoSel=datos[0];
            mesSel=node.dataset.nummes;

            document.getElementById('mensajeUpload').dataset.title="No ha seleccionado un archivo...";
            $("#modSubirArchivo").modal('show');
        }

        function cerrarModalSubirArchivo(){
            $("#modSubirArchivo").modal('hide');
        }  

		$(document).ready(function() {

            // Setup - add a text input to each footer cell
            $('#tablaProductos thead tr').clone(true).appendTo( '#tablaProductos thead' );
            $('#tablaProductos thead tr:eq(1) th').each( function (i) {
                if(i==0 ){
                    $(this).html( '<select id="selProducto" class="form-control input-sm"></select>' );
                }else if(i==1 ){
                    $(this).html( '<select id="selUnidad" class="form-control input-sm"></select>' );
                }else if(i==2 ){
                    $(this).html( '<select id="selPlanta" class="form-control input-sm"></select>' );
                }else if(i==3 ){
                    $(this).html( '' );                                   
                }
            } );
                     

            // DataTable
            var table=$('#tabla').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                columnDefs: [ {
                                "targets": [2],
                                "orderable": false
                                } ],                         
                language:{url: "{{ asset('/') }}locales/datatables_ES.json"}              
            });

            var productos=$('#tablaProductos').DataTable({
                orderCellsTop: true,
                fixedHeader: true,    
                columnDefs: [ {
                                "targets": [3],
                                "orderable": false
                                } ],                  
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
            } ).search( '', true, false ).draw();

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
            } ).search( '', true, false ).draw();

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
            } ).search( '', true, false ).draw();
               
        }


        function listarCostosProductos(row){
        	var table=$('#tabla').DataTable();
        	var fila=table.row(row).index();
        	var ano=table.cell(fila,0).data();
        	var mes=table.row(row).node().dataset.nummes;

        	$("#anoSel").val(ano);
        	$("#mesSel").val(table.cell(fila,1).data());

            if(parseInt(mes)<10){ 
                 mm='0'+mes.toString();
            }else{
                mm=mes.toString();
            }

            periodoSeleccionado=parseInt(ano.toString()+mm.toString());
        	document.getElementById('mesSel').dataset.numeromes=mes;

        	var productos=$("#tablaProductos").DataTable();

        	productos.rows().remove().draw();

            $.ajax({
                url: urlApp +'costosMensualesProductos',
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        ano: ano,
                        mes: mes
                      },
                success:function(dato){
                    for(var x=0;x<dato.length;x++){
                        if( (periodoSeleccionado<parseInt(document.getElementById('periodoActual').value)) && 
                            ( document.getElementById('idPerfilSession').value=='5' || document.getElementById('idPerfilSession').value=='18')    ){
                            elemCosto="<input class='form-control input-sm' value='" + dato[x].costo +"' style='width: 100px' readonly>";
                        }else{
                            elemCosto="<input class='form-control input-sm' value='" + dato[x].costo +"' style='width: 100px' onkeypress='return isIntegerKey(event)'>";
                        }

                        var fila=productos.row.add( [
                                dato[x].prod_nombre,
                                dato[x].u_nombre,
                                dato[x].nombrePlanta,
                                elemCosto, 
                            ] ).index();

                        productos.cell(fila,0).node().dataset.idproductolistaprecio=dato[x].idProductoListaPrecio;

                    }

                    productos.draw();
                    actualizarFiltros(productos);

                    $("#mdCostos").modal('show');
            
                }
            })

        }

        function cerrarListaProductos(){
        	$("#mdCostos").modal('hide');
        }


		function agregarMes(){
			var table=$('#tabla').DataTable();
            var ano=$("#ano").val();

            if(ano.toString().trim().length <4 ){
                swal(
                    {
                        title: '¡El año ingresado es incorrecto!',
                        text: 'Debe ingresar 4 dígitos',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'OK',
                        cancelButtonText: 'NO',
                        closeOnConfirm: true,
                        closeOnCancel: false
                    });
                return;
            }

			for (var i = 0; i < table.rows().count(); i++){

				var m = table.row(i).node().dataset.nummes;
				if(table.cell(i,0).data()==$("#ano").val() && m==$("#mes").val() ){
                    swal(
                        {
                            title: '¡Mes ya existe!',
                            text: 'El año y mes ingresados ya existen en la lista',
                            type: 'warning',
                            showCancelButton: false,
                            confirmButtonText: 'OK',
                            cancelButtonText: 'NO',
                            closeOnConfirm: true,
                            closeOnCancel: false
                        });
                    return;
				}
			}

            $.ajax({
                url: urlApp + "crearCostosMensuales",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: {                      
                        ano: $("#ano").val(),
                        mes: $("#mes").val()
                      },
                success:function(dato){
		            var nodo=table.row.add( [
		                    $("#ano").val(),
		                    $("#mes option:selected").html(),
		                    '<button class="btn btn-xs btn btn-warning btnEditar" title="Ver Costos" onclick="listarCostosProductos(this.parentNode.parentNode);"><i class="fa fa-edit fa-lg"></i></button>'
		                    ] ).draw().node();

		            nodo.dataset.nummes=$("#mes").val();
                }

            })			
                      
		}


		function guardarCostos(){
            document.getElementById('btnGuardarCambios').disabled=true;
			var tabla= $("#tablaProductos").DataTable();
		    var cadena='[';
		    var costo="0";
		    for (var i = 0; i < tabla.rows().count(); i++){
		    	if(tabla.cell(i,3).node().getElementsByTagName('input')[0].value==''){
		    		costo="0";
		    	}else{
		    		costo=tabla.cell(i,3).node().getElementsByTagName('input')[0].value;
		    	}

                if( isNaN(costo) ){
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
                cadena+='"idProductoListaPrecio":"'+ tabla.cell(i,0).node().dataset.idproductolistaprecio  + '", ';
                cadena+='"costo":"' + costo + '"';
                cadena+='}, ';

		    }
		    cadena=cadena.slice(0,-2);
		    cadena+=']';

            $.ajax({
                url: urlApp + "actualizarCostos",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: {                      
                        ano: $("#anoSel").val(),
                        mes: document.getElementById('mesSel').dataset.numeromes,
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
                	cerrarListaProductos();
                }

            })	

		}

	</script>

@endsection        	
