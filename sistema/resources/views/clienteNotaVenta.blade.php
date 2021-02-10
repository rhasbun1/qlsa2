@extends('plantilla')      

@section('contenedorprincipal')


<div style="padding: 20px">
    <div class="panel panel-default table-responsive">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
        <div class="panel-heading">
            <b>Clientes / Notas de Venta</b>
            <span class="badge badge-info pull-right">{{ count($listaUsuarios) }} Usuarios</span>
        </div>
        <div class="padding-md clearfix" style="width: 1000px">           
            <table id="tabla" class="table table-hover table-condensed table-responsive">
                <thead>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Perfil</th>
                    <th>Empresa</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($listaUsuarios as $item)
                        <tr>
                            <td data-idusuario="{{ $item->usu_codigo }}">{{ $item->usu_nombre }}</td>
                            <td>{{ $item->usu_apellido }}</td>
                            <td>{{ $item->nombrePerfil }}</td>
                            <td>{{ $item->nombreEmpresa }}</td>
                            <td>
                                <button class="btn btn-xs btn btn-warning"title="Editar" onclick="editarUsuario(this.parentNode.parentNode)"><i class="fa fa-edit fa-lg"></i></button>
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


<div id="mdUsuario" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="height: 45px">
                <h5><b>Asignar Notas de Venta al Usuario</b></h5>
            </div>
            <div id="bodyPlanta" class="modal-body">
                <div class="row" style="padding: 5px">
                    <div class="col-md-2">
                        Nombre
                    </div>
                    <div class="col-md-9">
                        <input id="nombreUsuario" class="form-control input-sm" maxlength="100" readonly>
                    </div>
                </div>
                <div class="row" style="padding: 5px">
                    <div class="col-md-2">
                        Empresa
                    </div>
                    <div class="col-md-9">
                        <select id="empresa" class="form-control input-sm">
                            @foreach($listaEmpresas as $item)
                                <option value="{{ $item->emp_codigo }}">{{ $item->emp_nombre }}</option>
                            @endforeach                        	
                        </select>
                    </div>
                </div>
                <div class="row" style="padding: 5px">
                    <div class="col-md-2">
                        Nota de Venta
                    </div>
                    <div class="col-md-2">
                        <input id="notaVenta" class="form-control input-sm" maxlength="6" onkeypress="return isNumberKey(event)">
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-success btn-sm" onclick="agregarNota();">Agregar</button>
                    </div>                    
                </div>
                <div id="notasDeVenta" style="padding-top: 10px">

                </div>

            </div>
            <div style="padding-top: 20px; padding-bottom: 20px; padding-right: 20px; text-align: right;">            
               <button id="btnCerrarMdUsuario" type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarModUsuario()" style="width: 80px">Salir</button>
            </div>            
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script src="{{ asset('/') }}js/app/funciones.js"></script>
<script>
	var idUsuario=0;
	var filaSeleccionada=0;

	function editarUsuario(row){
		var tabla=$("#tabla").DataTable();

		var fila=tabla.row( row ).index();
		nombreUsuario.value=tabla.cell(fila,0).data()+" "+tabla.cell(fila, 1).data();
		idUsuario=tabla.cell(fila, 0).node().dataset.idusuario;
		filaSeleccionada=fila;

        var lista=document.getElementById('empresa');
        lista.selectedIndex=-1;

        for (var i = 0; i < lista.length; i++){
            var opt=lista.options[i];
            if( opt.text.trim()==tabla.cell(fila,3).data() ){
                lista.selectedIndex=i;
                break;
            }
        }

        $.ajax({
            url: urlApp + "usuarioNotasdeVenta",
            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
            type: 'POST',
            dataType: 'json',
            data: { 
                    usu_codigo: idUsuario
                  },
            success:function(dato){
            	notasDeVenta.innerHTML="";
            	for(var x=0;x<dato.length;x++){
					notasDeVenta.innerHTML+="&nbsp&nbsp<button id='NV" + dato[x].idNotaVenta + "'' class='btn btn-sm btn-warning' onclick='eliminarNota(" + dato[x].idNotaVenta  + ")'>"+dato[x].idNotaVenta +"</button>";
            	}
            	$("#mdUsuario").modal('show');
            }
        });
		
	}

	function cerrarModUsuario(){
		$("#mdUsuario").modal('hide');
	}

	function agregarNota(){

        if( notaVenta.value.trim()==''){

            swal(
                {
                    title: 'Ingrese un número de nota de venta' ,
                    text: '',
                    type: 'warning',
                    showCancelButton: false,
                    closeOnConfirm: true,
                    confirmButtonText: 'Cerrar',
                    cancelButtonText: '',
                })
            return;       
        }

        $.ajax({
            url: urlApp + "agregarUsuarioNotaVenta",
            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
            type: 'POST',
            dataType: 'json',
            data: { 
                    usu_codigo: idUsuario,
                    emp_codigo: empresa.value,
                    idNotaVenta: notaVenta.value.trim()
                  },
            success:function(dato){
            	if(dato[0].creado==-1){
					notaVenta.value='';
					notaVenta.focus;    

                    swal(
                        {
                            title: 'La nota de venta ya existe' ,
                            text: '',
                            type: 'warning',
                            showCancelButton: false,
                            closeOnConfirm: true,
                            confirmButtonText: 'Cerrar',
                            cancelButtonText: '',
                        })
            	}else if(dato[0].creado==-2){
					notaVenta.value='';
					notaVenta.focus;    

                    swal(
                        {
                            title: 'La nota de venta no existe para la empresa seleccionada' ,
                            text: '',
                            type: 'warning',
                            showCancelButton: false,
                            closeOnConfirm: true,
                            confirmButtonText: 'Cerrar',
                            cancelButtonText: '',
                        })
            	}else{

            		var tabla=$("#tabla").DataTable();
            		tabla.cell(filaSeleccionada,3).data( empresa.options[ empresa.selectedIndex].text.trim() );
					notasDeVenta.innerHTML+="&nbsp&nbsp<button id='NV" + notaVenta.value + "'' class='btn btn-sm btn-warning' onclick='eliminarNota(" + notaVenta.value.trim() + ")'>"+notaVenta.value.trim()+"</button>";
					notaVenta.value='';
					notaVenta.focus;            		
            	}

            }
        }) 




	}

	function eliminarNota(idNotaVenta){

        swal(
            {
                title: 'Elimina la nota de venta Nº ' + idNotaVenta + ' para el usuario?',
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
                        url: urlApp + "eliminarUsuarioNotaVenta",
                        headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                        type: 'POST',
                        dataType: 'json',
                        data: { 
                                usu_codigo: idUsuario,
                                idNotaVenta: idNotaVenta
                              },
                        success:function(dato){
                            var contenedor=document.getElementById('notasDeVenta');
                            var elemento=document.getElementById('NV' + idNotaVenta );
                            contenedor.removeChild(elemento);                            

                        }

                    })
                    
                }
            }                

        )
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
            buttons: [              
                {
                    extend: 'excelHtml5',
                    title: 'Clientes / Notas de Venta',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'Excel',                         
                    exportOptions: {
                        columns: [ 0, 1, 2, 3]
                    }
                },
                    {
                        extend: 'pdfHtml5',
                        title: 'Clientes / Notas de Venta',
                        text:      '<i class="fa fa-file-pdf-o"></i>',
                        titleAttr: 'PDF',                         
                        exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                    } 
            ],                  
            language:{url: "{{ asset('/') }}locales/datatables_ES.json"}
        });

    } );


</script>




@endsection