@extends('plantilla')      
@section('contenedorprincipal')


<div style="padding: 20px">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b>Datos Empresa de Transporte</b>
        </div>
		<div style="padding: 20px">
        	<div class="row" style="padding-top: 5px">
                <input id="idEmpresaTransporte" type="hidden" value="{{ $idEmpresaTransporte}}">
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                @if ( Session::get('idPerfil')=='1' or 
                    Session::get('idPerfil')=='10' or 
                    Session::get('idPerfil')=='5' or 
                    Session::get('idPerfil')=='7')                   
            		<div class="col-sm-2">
            			Nombre Empresa
            		</div>
            		<div class="col-sm-3">
            			<input id="nombre" class="form-control input-sm" value="@isset( $empresa[0]->nombre ) {{ $empresa[0]->nombre }} @endisset">
            		</div>
            		<div class="col-sm-2">
            			Rut
            		</div>
            		<div class="col-sm-2">
            			<input id="rut" class="form-control input-sm" value="@isset( $empresa[0]->rut ) {{ $empresa[0]->rut }} @endisset">
            		</div>        		 		
            	</div>
            	<div class="row" style="padding-top: 5px">
            		<div class="col-sm-2">
            			Email
            		</div>
            		<div class="col-sm-3">
            			<input id="email" class="form-control input-sm" value="@isset( $empresa[0]->email ) {{ $empresa[0]->email }} @endisset">
            		</div>
            		<div class="col-sm-2">
            			Telefono
            		</div>
            		<div class="col-sm-3">
            			<input id="telefono" class="form-control  input-sm" value="@isset( $empresa[0]->telefono ) {{ $empresa[0]->telefono }} @endisset">
            		</div>        		
            	</div>
            	<div class="row" style="padding-top: 5px">
            		<div class="col-sm-2">
            			Nombre Contacto
            		</div>
            		<div class="col-sm-3">
            			<input id="nombreContacto" class="form-control input-sm" value="@isset( $empresa[0]->nombreContacto ) {{ $empresa[0]->nombreContacto }} @endisset">
            		</div>
            	</div>
            @else
                    <div class="col-sm-2">
                        Nombre Empresa
                    </div>
                    <div class="col-sm-3">
                        <input id="nombre" class="form-control input-sm" value="@isset( $empresa[0]->nombre ) {{ $empresa[0]->nombre }} @endisset" readonly>
                    </div>
                    <div class="col-sm-2">
                        Rut
                    </div>
                    <div class="col-sm-2">
                        <input id="rut" class="form-control input-sm" value="@isset( $empresa[0]->rut ) {{ $empresa[0]->rut }} @endisset" readonly>
                    </div>                      
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-sm-2">
                        Email
                    </div>
                    <div class="col-sm-3">
                        <input id="email" class="form-control input-sm" value="@isset( $empresa[0]->email ) {{ $empresa[0]->email }} @endisset" readonly>
                    </div>
                    <div class="col-sm-2">
                        Telefono
                    </div>
                    <div class="col-sm-3">
                        <input id="telefono" class="form-control  input-sm" value="@isset( $empresa[0]->telefono ) {{ $empresa[0]->telefono }} @endisset" readonly>
                    </div>              
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-sm-2">
                        Nombre Contacto
                    </div>
                    <div class="col-sm-3">
                        <input id="nombreContacto" class="form-control input-sm" value="@isset( $empresa[0]->nombreContacto ) {{ $empresa[0]->nombreContacto }} @endisset" readonly>
                    </div>
                </div>            
            @endif           	
        </div>          	        	
        <div style="padding-bottom: 15px; padding-left: 15px">
            @if ( Session::get('idPerfil')=='1' or 
                Session::get('idPerfil')=='10' or 
                Session::get('idPerfil')=='5' or 
                Session::get('idPerfil')=='7')          
                <button class="btn btn-sm btn-success" onclick="guardarDatos();">Guardar</button>
            @endif
        </div>        	
    </div>

    <div id="divCamiones" class="panel panel-default table-responsive" style="display: @if( $idEmpresaTransporte=="0") none @else block @endif">
        <div class="panel-heading">
            <b>Camiones</b>
        </div>
        <div style="padding: 20px">
            <div style="padding-bottom: 15px">
                @if ( Session::get('idPerfil')=='1' or 
                    Session::get('idPerfil')=='10' or 
                    Session::get('idPerfil')=='5' or 
                    Session::get('idPerfil')=='7')             
                    <a href="#" class="btn btn-sm btn-primary" onclick="formCamion();">Nuevo Camión</a>
                @endif
            </div>        	
            <table id="tablaCamiones" class="table table-hover table-condensed" style="width: 600px">
                <thead>
                    <th style='display:none'>Identificador</th>
                    <th>Patente Camión</th>
                    <th>Patente Rampla</th>
                    <th>Disponible</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($camiones as $item)
                       <tr>
                           <td style='display:none'> {{ $item->idCamion }} </td>
                           <td> {{ $item->patente }} </td>
                           <td> {{ $item->patenteRampla }} </td>
                           <td> 
                               @if ($item->disponible==1)
                                    SI
                               @else
                                    NO
                               @endif 
                           </td>
                           <td>
                                @if ( Session::get('idPerfil')=='1' or 
                                    Session::get('idPerfil')=='10' or 
                                    Session::get('idPerfil')=='5' or 
                                    Session::get('idPerfil')=='7')                            
                               <button onclick="editarCamion({{ $item->idCamion }}, this.parentNode.parentNode.rowIndex);" class="btn btn-warning btn-xs" title="Editar"><i class="fa fa-edit fa-lg"></i></button>
                               <button class="btn btn-xs btn btn-danger" title="Eliminar" onclick="eliminarCamion({{ $item->idCamion }}, this.parentNode.parentNode.rowIndex)"><i class="fa fa-trash-o fa-lg"></i></button>
                               @endif
                           </td>
                       </tr>
                    @endforeach                    
                </tbody>
            </table>
        </div>
    </div>
    <div id="divConductores" class="panel panel-default table-responsive" style="display: @if( $idEmpresaTransporte=="0") none @else block @endif">
        <div class="panel-heading">
            <b>Conductores</b>
        </div>
        <div style="padding: 20px">
            <div style="padding-bottom: 15px">
                @if ( Session::get('idPerfil')=='1' or 
                    Session::get('idPerfil')=='10' or 
                    Session::get('idPerfil')=='5' or 
                    Session::get('idPerfil')=='7')                
                    <a href="#" class="btn btn-sm btn-primary" onclick="formConductor();">Nuevo Conductor</a>
                @endif
            </div>        	
            <table id="tablaConductores" class="table table-hover table-condensed table-responsive">
                <thead>
                    <th style='display:none'>Identificador</th>
                    <th>Nombre</th>
                    <th>Ap.Paterno</th>
                    <th>Ap.Materno</th>
                    <th>Rut</th>
                    <th>Teléfono</th>
                    <th>email</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($conductores as $item)
                       <tr>
                           <td style='display:none'> {{ $item->idConductor }} </td>
                           <td> {{ $item->nombre }} </td>
                           <td> {{ $item->apellidoPaterno }} </td>
                           <td> {{ $item->apellidoMaterno }} </td>
                           <td> {{ $item->rut }} </td>
                           <td> {{ $item->telefono }} </td>
                           <td> {{ $item->email }} </td>
                           <td>
                                @if ( Session::get('idPerfil')=='1' or 
                                    Session::get('idPerfil')=='10' or 
                                    Session::get('idPerfil')=='5' or 
                                    Session::get('idPerfil')=='7')                            
                               <button onclick="editarConductor({{ $item->idConductor }}, this.parentNode.parentNode.rowIndex);" class="btn btn-warning btn-xs" title="Editar"><i class="fa fa-edit fa-lg"></i></button>
                               <button class="btn btn-xs btn btn-danger" title="Eliminar" onclick="eliminarConductor({{ $item->idConductor }}, this.parentNode.parentNode.rowIndex)"><i class="fa fa-trash-o fa-lg"></i></button>
                               @endif
                           </td>
                       </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>

    </div> 
    <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
        <a href="{{ asset('/') }}listaEmpresasTransporte" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
    </div>   
</div>
<div class="modal fade" id="modCamion">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5>Datos del Camión</h5>
            </div>
            <div class="modal-body">
                <div class="row" style="padding:10px">
                    <input id="idCamion" type="hidden">
                    <input id="idFilaCamion" type="hidden">
                    <div class="col-sm-2">
                        Patente (*)
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" maxlength="50" id="patente">
                    </div>    
                </div>
                <div class="row" style="padding:10px">
                    <div class="col-sm-2">
                        Patente Rampla
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" maxlength="50" id="patenteRampla">
                    </div>
                <div class="row" style="padding:10px">
                    <div class="col-sm-2">
                        Disponible
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control input-sm" maxlength="50" id="disponible">
                    </div>    
                </div>                     
                </div>

            </div>
            <div style="text-align: right;padding: 15px">
                <button class="btn btn-success btn-sm" style="width: 80px" onclick="grabarCamion();" style="width:70px">Guardar</a>
                <button class="btn btn-warning btn-sm" style="width: 80px" onclick="cerrar_formCamion();" style="width:70px">Salir</a>
            </div>  
        </div>
    </div>
</div>
<div class="modal fade" id="modConductor">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5>Datos del Conductor</h5>
            </div>
            <div class="modal-body">
                <div class="row" style="padding:5px">
                    <input id="idConductor" type="hidden">
                    <input id="idFilaConductor" type="hidden">                    
                    <div class="col-sm-3">
                        Nombre (*)
                    </div>
                    <div class="col-sm-8 col-md-5">
                        <input type="text" class="form-control input-sm" maxlength="50" id="nombreConductor">
                    </div>
                </div>
                <div class="row" style="padding:5px">
                    <div class="col-sm-3">
                        Apellido Paterno (*)
                    </div>
                    <div class="col-sm-5 col-md-5">
                        <input type="text" class="form-control input-sm" maxlength="50" id="apellidoPaterno">
                    </div>
                </div>
                <div class="row" style="padding:5px">
                    <div class="col-sm-3">
                        Apellido Materno
                    </div>
                    <div class="col-sm-5 col-md-5">
                        <input type="text" class="form-control input-sm" maxlength="50" id="apellidoMaterno">
                    </div>
                </div>                               
                <div class="row" style="padding:5px">
                    <div class="col-sm-3">
                        Rut
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <input type="text" class="form-control input-sm" maxlength="50" id="rutConductor">
                    </div>
                </div>
                <div class="row" style="padding:5px">
                    <div class="col-sm-3">
                        Telefono
                    </div>
                    <div class="col-sm-3 col-md-3">
                        <input type="text" class="form-control input-sm" maxlength="50" id="telefonoConductor">
                    </div>                            
                </div>
                <div class="row" style="padding:5px">                     
                    <div class="col-sm-3">
                        Email
                    </div>
                    <div class="col-sm-8 col-md-5">
                        <input type="text" class="form-control input-sm" maxlength="50" id="emailConductor">
                    </div>                    
                </div>

            </div>
            <div style="text-align: right;padding: 15px">
                <button class="btn btn-success btn-sm" style="width: 80px" onclick="grabarConductor();" style="width:70px">Guardar</a>
                <button class="btn btn-warning btn-sm" style="width: 80px" onclick="cerrar_formConductor();" style="width:70px">Salir</a>
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
    <!-- Datatable -->
    <script src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
	<script>
		function formCamion(){
            $("#idCamion").val("0");
            $("#patente").val('');
            $("#patenteRampla").val('');
            $("#idFilaCamion").val('0');
			$("#modCamion").modal("show");
		}

        function editarCamion(idCamion, fila){
            var tabla=document.getElementById("tablaCamiones");

            $("#idCamion").val(idCamion);
            $("#patente").val( tabla.rows[fila].cells[1].innerHTML.trim() );
            $("#patenteRampla").val(tabla.rows[fila].cells[2].innerHTML.trim());
            $("#idFilaCamion").val(fila);
            $("#modCamion").modal("show");
        }        

		function cerrar_formCamion(){
			$("#modCamion").modal("hide");
		}

		function formConductor(){
            $("#idConductor").val("0");
            $("#idFilaConductor").val('0');
            $("#nombreConductor").val('');
            $("#apellidoPaterno").val('');
            $("#apellidoMaterno").val('');
            $("#emailConductor").val('');
            $("#telefonoConductor").val('');
            $("#rutConductor").val('');
            
            $("#modConductor").modal("show");
		}

        function editarConductor(idConductor, fila){
            var tabla=document.getElementById("tablaConductores");

            $("#idConductor").val(idConductor);
            $("#idFilaConductor").val(fila);
            $("#nombreConductor").val( tabla.rows[fila].cells[1].innerHTML.trim() );
            $("#apellidoPaterno").val( tabla.rows[fila].cells[2].innerHTML.trim() );
            $("#apellidoMaterno").val( tabla.rows[fila].cells[3].innerHTML.trim() );
            $("#rutConductor").val( tabla.rows[fila].cells[4].innerHTML.trim() );
            $("#telefonoConductor").val( tabla.rows[fila].cells[5].innerHTML.trim() );
            $("#emailConductor").val( tabla.rows[fila].cells[6].innerHTML.trim()  );
         
            $("#modConductor").modal("show");
        }

		function cerrar_formConductor(){
			$("#modConductor").modal("hide");
		}	

        function guardarDatos(){

            if( $("#nombre").val().trim()==""){
                swal(
                    {
                        title: 'El nombre de la empresa es obligatorio!',
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


            $.ajax({
                url: urlApp + "agregarEmpresaTransporte",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        idEmpresaTransporte: $("#idEmpresaTransporte").val(),
                        nombre: $("#nombre").val(),
                        rut: $("#rut").val(),
                        email: $("#email").val(),
                        telefono: $("#telefono").val(),
                        nombreContacto: $("#nombreContacto").val()
                      },
                success:function(dato){
                    edicion=false;
                    if( $("#idEmpresaTransporte").val() != "0" ){
                        edicion=true;
                    }

                    $("#idEmpresaTransporte").val( dato.identificador );
                    document.getElementById('divCamiones').style.display="block";
                    document.getElementById('divConductores').style.display="block";
                    if(edicion){
                        swal(
                            {
                                title: 'Los datos han sido actualizados!',
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
                }
            })              

        }

        function grabarCamion(){

            if( $("#patente").val().trim()==""){
                swal(
                    {
                        title: 'La Patente es obligatoria!',
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

            var id=$("#idCamion").val();
            $.ajax({
                url: urlApp + "grabarCamion",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        idCamion: $("#idCamion").val(),
                        idEmpresaTransporte: $("#idEmpresaTransporte").val(),
                        patente: $("#patente").val(),
                        patenteRampla: $("#patenteRampla").val(),
                        disponible: 1
                      },
                success:function(dato){
                    var tabla=document.getElementById("tablaCamiones");

                    if(id=='0'){
                        cadena="<tr>";
                        cadena+="<td style='display:none'>" + dato.idCamion+ "</td>";
                        cadena+="<td>" + $("#patente").val() + "</td>";
                        cadena+="<td>" + $("#patenteRampla").val() + "</td>";
                        cadena+="<td>SI</td>";
                        cadena+='<td><button onclick="editarCamion('+ dato.idCamion + ', this.parentNode.parentNode.rowIndex);" class="btn btn-warning btn-xs" title="Editar"><i class="fa fa-edit fa-lg"></i></button>';
                        cadena+='<button class="btn btn-xs btn btn-danger" title="Eliminar" onclick="eliminarCamion(' + dato.idCamion + ', this.parentNode.parentNode.rowIndex)"><i class="fa fa-trash-o fa-lg"></i></button><td>';
                        cadena+="</tr>";
                        $("#tablaCamiones").append(cadena);
                    }else{
                        var fila=$("#idFilaCamion").val();
                        tabla.rows[fila].cells[1].innerHTML=$("#patente").val();
                        tabla.rows[fila].cells[2].innerHTML=$("#patenteRampla").val();

                    }

                    $("#patenteRampla").val('');
                    $("#patente").val('');

                    cerrar_formCamion();
                    swal(
                        {
                            title: 'Los datos han sido grabados!',
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

        function grabarConductor(){

            if( $("#nombreConductor").val().trim()=="" || $("#apellidoPaterno").val().trim()==""   ){
                swal(
                    {
                        title: 'El nombre y apellido paterno es obligatorio!',
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
            var id=$("#idConductor").val();

            $.ajax({
                url: urlApp + "grabarConductor",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        idConductor: $("#idConductor").val(),
                        idEmpresaTransporte: $("#idEmpresaTransporte").val(),
                        nombre: $("#nombreConductor").val(),
                        apellidoPaterno: $("#apellidoPaterno").val(),
                        apellidoMaterno: $("#apellidoMaterno").val(),
                        rut: $("#rutConductor").val(),
                        telefono: $("#telefonoConductor").val(),
                        email: $("#emailConductor").val()
                      },
                success:function(dato){
                    var tabla=document.getElementById("tablaConductores");

                    if(id=='0'){
                        cadena="<tr>";
                        cadena+="<td style='display:none'>" + dato.idConductor+ "</td>";
                        cadena+="<td>" + $("#nombreConductor").val() + "</td>";
                        cadena+="<td>" + $("#apellidoPaterno").val() + "</td>";
                        cadena+="<td>" + $("#apellidoMaterno").val() + "</td>";
                        cadena+="<td>" + $("#rutConductor").val() + "</td>";
                        cadena+="<td>" + $("#telefonoConductor").val() + "</td>";
                        cadena+="<td>" + $("#emailConductor").val() + "</td>";
                        cadena+='<td><button onclick="editarConductor('+ dato.idConductor + ', this.parentNode.parentNode.rowIndex);" class="btn btn-warning btn-xs" title="Editar"><i class="fa fa-edit fa-lg"></i></button>';
                        cadena+='<button class="btn btn-xs btn btn-danger" title="Eliminar" onclick="eliminarConductor(' + dato.idConductor + ', this.parentNode.parentNode.rowIndex)"><i class="fa fa-trash-o fa-lg"></i></button><td>';
                        cadena+="</tr>";
                        $("#tablaConductores").append(cadena);
                    }else{
                        var fila=$("#idFilaConductor").val();
                        tabla.rows[fila].cells[1].innerHTML=$("#nombreConductor").val();
                        tabla.rows[fila].cells[2].innerHTML=$("#apellidoPaterno").val();
                        tabla.rows[fila].cells[3].innerHTML=$("#apellidoMaterno").val();
                        tabla.rows[fila].cells[4].innerHTML=$("#rutConductor").val();
                        tabla.rows[fila].cells[5].innerHTML=$("#telefonoConductor").val();
                        tabla.rows[fila].cells[6].innerHTML=$("#emailConductor").val();
                    }

                    $("#nombreConductor").val('');
                    $("#apellidoPaterno").val('');
                    $("#apellidoMaterno").val('');
                    $("#rutConductor").val('');
                    $("#telefonoConductor").val('');
                    $("#emailConductor").val('');
                    cerrar_formConductor();
                    swal(
                        {
                            title: 'Los datos han sido grabados!',
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

        function eliminarCamion(idCamion, fila){
            var tabla=document.getElementById('tablaCamiones');

            swal(
                {
                    title: 'Elimina el camión patente ' + tabla.rows[fila].cells[1].innerHTML.trim() +'?',
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
                            url: urlApp + "eliminarCamion",
                            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                            type: 'POST',
                            dataType: 'json',
                            data: { 
                                    idCamion: idCamion
                                  },
                            success:function(dato){
                               tabla.deleteRow(fila);
                            }

                        })
                        
                    }
                }                

            )     

        }

        function eliminarConductor(idConductor, fila){
            var tabla=document.getElementById('tablaConductores');
            var nombre=tabla.rows[fila].cells[1].innerHTML.trim()+" "+tabla.rows[fila].cells[2].innerHTML.trim();
            swal(
                {
                    title: 'Elimina el conductor ' + nombre + ' ?',
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
                            url: urlApp + "eliminarConductor",
                            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                            type: 'POST',
                            dataType: 'json',
                            data: { 
                                    idConductor: idConductor
                                  },
                            success:function(dato){
                               tabla.deleteRow(fila);
                            }

                        })
                        
                    }
                }                

            )     

        }        
	</script>    
@endsection
