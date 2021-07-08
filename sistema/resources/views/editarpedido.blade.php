@extends('plantilla')      

@section('contenedorprincipal')

<div style="padding: 5px">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <h5><b>Pedido Nº {{ $pedido[0]->idPedido }}</b></h5>
        </div>
        <div class="padding-md clearfix">
            <div>
            <input type="hidden" id="idCliente" value="{{Session::get('idPerfil')}}">
            <input type="hidden" id="tipoCarga" value="{{ $pedido[0]->tipoCarga }}">
            <input type="hidden" id="tipoTransporte" value="{{ $pedido[0]->tipoTransporte }}">


                <input type="hidden" id="idPedido" value="{{ $pedido[0]->idPedido }}">
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                <div class="row" style="padding-top: 5px">
                    <div class="col-lg-1 col-md-1 col-sm-1">
                        Cliente
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-5">
                        <input class="form-control input-sm" readonly value="{{ $pedido[0]->emp_nombre }}">
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-2">
                        Creación
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <input class="form-control input-sm" readonly value="{{ $pedido[0]->fechahora_creacion }}">
                    </div> 
                    <div class="col-lg-1 col-md-1 col-sm-1">
                        N.Venta 
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <input class="form-control input-sm" readonly value="{{ $pedido[0]->idNotaVenta }}">
                    </div>                                      
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-lg-1 col-md-1 col-sm-1">
                        Obra
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-5">
                        <input class="form-control input-sm" readonly value="{{ $pedido[0]->Obra }}">
                    </div>                      
                    <div class="col-lg-1 col-md-1 col-sm-2">
                        Fecha&nbspEntrega
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4">
                        <div class="input-group date" id="divFechaEntrega">
                            <input type="text" class="form-control input-sm" id="txtFechaEntrega" value="{{ $pedido[0]->fechaEntrega }}">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>                         
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-1">
                        <select id="horario" class="form-control input-sm">
                            @if ( $pedido[0]->horarioEntrega=='PM')
                                <option >AM</option>
                                <option selected>PM</option>
                            @else
                                <option selected>AM</option>
                                <option>PM</option>                           
                            @endif    
                        </select> 
                    </div>                     
                    <div class="col-lg-1 col-md-1 col-sm-2">
                        Ejecutivo&nbspQL
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4">
                        <input class="form-control input-sm" readonly value="{{ $pedido[0]->usuario_encargado }}">
                    </div>                       
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-lg-1 col-md-1 col-sm-1">
                        Estado
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-3">
                        <input class="form-control input-sm" readonly value="{{ $pedido[0]->estado }}">
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        Observaciones (máx.100 carac.)
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7">
                        <textarea id="txtObservaciones" maxlength="100" class="form-control input-sm" rows="2">{{ $pedido[0]->observaciones }}</textarea>
                    </div>                                                      
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-lg-1 col-sm-2 col-md-1">
                        O.Compra
                    </div>
                    <div class="col-lg-3 col-sm-4 col-md-3">
                        <div class="input-group">                           
                            <input id="txtOrdenCompra" class="form-control input-sm" value="{{ $pedido[0]->ordenCompraCliente }}" data-ocarchivo="{{ $pedido[0]->nombreArchivoOC }}" >
                            <span class="input-group-addon glyphicon glyphicon-cloud-download" title="Bajar Orden de Compra" onclick="bajarOCpedido();"></span>
                            @if (Session::get('grupoUsuario')=='C')
                                <span id="btnCargarArchivo" class="input-group-addon glyphicon glyphicon-cloud-upload" onclick="subirArchivoOCPedido();" title="Subir Orden de Compra" style="background-color: #FFFFFF"></span>
                            @endif
                        </div>                            
                    </div> 
                </div>
                @if ($pedido[0]->noExcederCantidadSolicitada==1)
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-12" style="text-align: right;">
                            <h4><span class="label label-danger">NO EXCEDER LA CANTIDAD SOLICITADA</span></h4>
                        </div>          
                    </div>
                @endif                                      
            </div>

        </div>
        <div style="padding: 10px">
            <table id="tablaDetalle" class="table table-hover table-condensed table-responsive">
                <thead>
                    <th style="display: none">Código</th>
                    <th>Producto</th>
                    <th style="width: 60px">Cantidad</th>
                    <th>Unidad</th>
                        <th id="precio">Precio ($)</th>
                        <th id="totalt">Total</th>
                    <th>Planta de Origen</th>
                    <th>Entrega</th>
                    <th>Transporte</th>
                    <th>Camion</th>
                    <th>Conductor</th>
                    <th>Fecha Carga</th>
                    <th>Hora Carga</th>
                    <th style="display: none;">Total</th>

                </thead>
        
                <tbody>
                    @foreach($listaDetallePedido as $item)
                    <tr>
                        <td style="display: none"> {{ $item->prod_codigo }} </td>
                        <td> {{ $item->prod_nombre }} </td>
                        <td style="width: 60px">
                            @if( $item->numeroGuia==0 )
                                <input class="form-control input-sm" value="{{ $item->cantidad }}">
                            @else
                                {{ $item->cantidad }}
                            @endif    
                        </td>   
                        <td> {{ $item->u_nombre }} </td>
                            <td id="preciot"  align="right">{{ number_format( $item->cp_precio, 0, ',', '.' ) }}</td>
                            <td id="totalta"  align="right">{{ number_format( $item->cp_precio * $item->cantidad , 0, ',', '.' ) }}</td>
                        <td> 
                            @if( $item->numeroGuia==0 )
                                <select id="listaPlantas" class="form-control input-sm">
                                    @foreach($plantas as $planta)
                                        @if($planta->nombre==$item->nombrePlanta )
                                            <option value="{{ $planta->idPlanta }}" selected> {{ $planta->nombre }} </option>
                                        @else
                                            <option value="{{ $planta->idPlanta }}"> {{ $planta->nombre }} </option>
                                        @endif
                                    @endforeach
                                </select>
                            @else
                                {{ $item->nombrePlanta }}
                            @endif    
                        </td>
                        <td>
                            @if( $item->numeroGuia==0 )
                                @if($item->idFormaEntrega==2)
                                    <select class="form-control input-sm">
                                        @foreach($formasdeentrega as $formaEntrega)
                                            @if( $item->idFormaEntrega==$formaEntrega->idFormaEntrega )
                                                <option value="{{ $formaEntrega->idFormaEntrega }}" selected>{{ $formaEntrega->nombre }}</option>
                                            @endif
                                        @endforeach 
                                    </select>                                            
                                @else
                                    <select class="form-control input-sm">
                                        @foreach($formasdeentrega as $formaEntrega)
                                            @if( $item->idFormaEntrega==$formaEntrega->idFormaEntrega )
                                                <option value="{{ $formaEntrega->idFormaEntrega }}" selected>{{ $formaEntrega->nombre }}</option>
                                            @else
                                                <option value="{{ $formaEntrega->idFormaEntrega }}">{{ $formaEntrega->nombre }}</option>
                                            @endif
                                        @endforeach 
                                    </select>
                                @endif
                            @else
                                {{ $item->nombreFormaEntrega }}
                            @endif                                 
                        </td>

                        <td> {{ $item->nombreEmpresaTransporte }} </td>
                        <td> {{ $item->patente }} </td>
                        <td> {{ $item->nombreConductor }} </td>
                        <td> {{ $item->fechaCarga }} </td>
                        <td> {{ $item->horaCarga }} </td>
                        <td style="display: none;">{{ number_format( $item->cp_precio * $item->cantidad , 0, ',', '.' ) }}</td>

                    </tr>
                    @endforeach
                </tbody>
                <tfoot id="tfootp"> 
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="right"><b>Neto $</b></td>
                            <td align="right"><b>{{ number_format( $pedido[0]->totalNeto, 0, ',', '.' ) }} </b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>                     
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="right"><b>Iva $</b></td>
                            <td align="right"><b>{{ number_format( $pedido[0]->montoIva, 0, ',', '.' ) }} </b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>                          
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="right"><b>Total $</b></td>
                            <td align="right"><b>{{ number_format( $pedido[0]->totalNeto + $pedido[0]->montoIva, 0, ',', '.' ) }} </b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>                        
                        </tr> 
                </tfoot>
            </table>
        </div> 
        <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
            Indique el motivo de la modificación de este pedido (máx.150 letras):
            <input id="motivo" class="form-control input-sm" maxlength="150" style="width: 80%">

            <div id="cliocul" style="padding-top:18px; padding-bottom: 20px">
                <button class="btn btn-sm btn-success" style="width:80px" onclick="verSiExistePlanta();">Guardar</button>         
                <a href="{{ asset('/') }}listarPedidos" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>                                                  
            </div>
            <div id="clienteocultar" style="padding-top:18px; padding-bottom: 20px">
                <button class="btn btn-sm btn-success" style="width:80px" onclick="verSiExistePlanta();">Guardar</button>        
                <a href="{{ asset('/') }}clientePedidos" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>                                                  
            </div>
        </div>        

        <div style="width: 850px;padding-left: 20px">
            <b>Registro de acciones sobre este Pedido</b>
            <table id="tablaLog" class="table table-hover table-condensed table-responsive">
                <thead>
                    <th style="width:200px">Fecha</th>
                    <th style="width:200px">Usuario</th>
                    <th style="width:100px">Acción</th>
                    <th style="width:350px">Motivo</th>
                </thead>
                <tbody>
                    @foreach($log as $item)
                    <tr>
                        <td style="width:200px"> {{date('d/m/Y', strtotime($item->fechaHora))  }} </td>
                        <td style="width:200px"> {{ $item->nombreUsuario }} </td>
                        <td style="width:100px"> {{ $item->accion }} </td>
                        <td style="width:500px"> {{ $item->motivo }} </td>
                    </tr>
                    @endforeach  
                </tbody>
            </table>
        </div>

    </div>
</div>

<div id="modSubirArchivo" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <input type="hidden" id="filaTabla" name="filaTabla">
                <h5><b>Subir Archivo Orden de Compra</b></h5>
            </div>
            <div id="bodyProducto" class="modal-body">
                <form id="datos" name="datos" enctype="multipart/form-data">                             
                    <div class="row" style="padding: 15px">
                        Imagen o Pdf de la Orden de Compra
                        <div class="upload-file">
                            <input type="file" id="upload-demo" name="upload-demo" class="upload-demo" accept="image/jpeg,image/gif,image/png,application/pdf,image/x-eps">
                            <label data-title="Buscar" for="upload-demo">
                                <span id="mensajeUpload" data-title="No ha seleccionado un archivo..."></span>
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
    <script src="{{ asset('/') }}locales/bootstrap-datepicker.es.min.js"></script>  

    <!-- Timepicker -->
    <script src="{{ asset('/') }}js/bootstrap-timepicker.min.js"></script>  

    <script src="{{ asset('/') }}js/app/funciones.js"></script>
    <script src="{{ asset('/') }}js/app/verpedido.js"></script>
    <!-- Datatable -->
    <script src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
    <script>
        var tiempoProduccion_val =new Array();
        var arrFeriados =new Array();



        
    function verSiExistePlanta(){
        if($("#idCliente").val() == 14){
                        var fila = 4;
                    }else{
                        var fila = 6;
                    }
        var tabla = document.getElementById('tablaDetalle');
        var seguir = 1;
        console.log(tabla.rows.length);

        for (var i = 1; i < tabla.rows.length-3; i++){
                var codigoPlanta = tabla.rows[1].cells[fila].getElementsByTagName('select')[0].value
                var codigoUnidad = tabla.rows[i].cells[3].innerHTML;
                var codigoProducto =  tabla.rows[i].cells[0].innerHTML;
                console.log(codigoPlanta);
                console.log(codigoUnidad);
                console.log(codigoProducto);
            $.ajax({
                async: false,
                url: urlApp + 'selectPlantas',
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                    codigoProducto: codigoProducto,                
                    codigoUnidad: codigoUnidad,
                    codigoPlanta: codigoPlanta
                    },
            success:function(data){
                if(data.identificador==0){
                    seguir= 0;
                    swal(
                        {
                            title: 'El producto no esta en la planta seleccionada',
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
                            return;
                        }
                    )
                    return; 
                }

            },
            error: function(jqXHR, text, error){
                alert('Error!, No se pudo Añadir los datos');
            }
        });

        }
        if(seguir == 1){
            guardarCambios();
        }else{
            return;
        }
    }

        function guardarCambios(){
            var tabla=document.getElementById('tablaDetalle');
            var cantidadMod = 0; 
            var cantidadTabla;
            var tipoCarga = document.getElementById('tipoCarga').value;
            var tipoTransporte = document.getElementById('tipoTransporte').value;
            var cmtten=0;
            var cmttem1=0;
            var cmttem2=0;
            var valorFleteFalso;
            console.log(tipoCarga);

            $.ajax({
            async:false, 
            url: urlApp + 'obtenerParametros',
            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
            type: 'POST',
            dataType: 'json',
            data: {},
            success:function(dato){
                if(dato.length>0){
                    cmtten=dato[0].carga_max_granel_tte_normal;
                    cmttem1=dato[0].carga_max_granel_tte_mixto_1;
                    cmttem2=dato[0].carga_max_granel_tte_mixto_2;
                    valorFleteFalso=dato[0].valorFleteFalso;
                }
            }
            }); 

            for (var i = 1; i <(tabla.rows.length-3); i++){
                if(tabla.rows[i].cells[2].getElementsByTagName('input')[0].value!=""){
                    cantidadTabla=  tabla.rows[i].cells[2].getElementsByTagName('input')[0].value;     
                    cantidadMod= cantidadMod+parseFloat(cantidadTabla);
                }
            }

            
           
            

            
        
                  
                    var cantidad = tabla.rows.length;
                    if($("#idCliente").val() == 14){
                        var fila = 4;
                    }else{
                        var fila = 6;
                    }


                    if(cantidad > 5){
                        if(tabla.rows[1].cells[fila].getElementsByTagName('select')[0].value != tabla.rows[2].cells[fila].getElementsByTagName('select')[0].value){
                            swal(
                                {
                                    title: 'La Planta De Origen Tiene Que Ser La Misma Para Ambos Productos!!' ,
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
                     }
          

            

            if($("#motivo").val().trim()=='' ){
                swal(
                    {
                        title: 'Debe indicar el motivo por el cual modificó este pedido!!' ,
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


            var tabla=document.getElementById('tablaDetalle');

            if($("#txtFechaEntrega").val().trim()=='' ){
                swal(
                    {
                        title: 'Debe ingresar la Fecha de Entrega (*).',
                        text: '',
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonText: 'Cerrar',
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
                )  
                return
            }
            var cont=0;
            var total=0;
            var toneladas=0;
            var productos=0;

            for(var x=1; x<(tabla.rows.length-3); x++){
                if(tabla.rows[x].cells[2].getElementsByTagName('input')[0].value.trim()=="" ){
                    cont++
                }
            }

            if(cont>0){
                swal(
                    {
                        title: 'No es permitido dejar una cantidad vacía.' ,
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

            var cont=0;
            if($("#idCliente").val() == 14){
                var planta = 4;
                var entrega = 5;
                var tot = 11;
             }else{
                var planta = 6;
                var entrega = 7;
                var tot = 4;

            }
            var cadena='[';

            for (var i = 1; i <(tabla.rows.length-3); i++){
                if(tabla.rows[i].cells[2].getElementsByTagName('input')[0].value!=""){
                    cadena+='{';
                    cadena+='"prod_codigo":"'+  tabla.rows[i].cells[0].innerHTML  + '", ';
                    cadena+='"cantidad":"'+  tabla.rows[i].cells[2].getElementsByTagName('input')[0].value + '", ';
                    cadena+='"idPlanta":"'+  tabla.rows[i].cells[planta].getElementsByTagName('select')[0].value  + '",';
                    cadena+='"idFormaEntrega":"'+  tabla.rows[i].cells[entrega].getElementsByTagName('select')[0].value  + '"';                    
                    cadena+='}, ';   
                    total+= ( parseInt(tabla.rows[i].cells[tot].innerHTML.replace('.','')) * parseInt( tabla.rows[i].cells[2].getElementsByTagName('input')[0].value ) );             
                }
            }
           
            cadena=cadena.slice(0,-2);
            cadena+=']';

            //Validar la Fecha Entrega
            var fechaCreacionPedido = new Date();
            //console.log("fecha creacion al tiro: ", fechaCreacionPedido);
            var fechaEntrega = $("#txtFechaEntrega").val();
            var fechaEntregaMaxima;
            if ($("#horario option:selected").html() == "AM"){
                fechaEntregaMaxima = new Date(fechaEntrega.split('/')[2], fechaEntrega.split('/')[1]-1, fechaEntrega.split('/')[0], 11, 59, 0, 0);
            }
            else{
                fechaEntregaMaxima = new Date(fechaEntrega.split('/')[2], fechaEntrega.split('/')[1]-1, fechaEntrega.split('/')[0], 23, 59, 0, 0);   
            }
            //console.log("Fecha Creacion Pedido: ", fechaCreacionPedido);
            //console.log("Fecha Entrega Maximo: ", fechaEntregaMaxima);
            var listTiempoPlanta = [];

        
            for (var j=1; j<(tabla.rows.length-3); j++){
                $.ajax({
                    async:false,
                    url: urlApp + "buscarTiempoProduccion",
                    headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                    type: 'POST',
                    dataType: 'json',
                    data: { 
                            nombreProducto: tabla.rows[j].cells[1].innerHTML.trim(),
                            idPlanta: tabla.rows[j].cells[planta].getElementsByTagName('select')[0].value,
                            nombre: tabla.rows[j].cells[3].innerHTML.trim()
                    },
                    success:function(dato){
                        console.log(dato);
                        if (dato.length > 0){
                            if (dato[0].tiempoProduccion == null)
                            { 
                                dato[0].tiempoProduccion = 0;  
                                
                            }
                            tiempoProduccion_val.push(dato[0].tiempoProduccion);
                            listTiempoPlanta.push(dato);
                        }
                    }
                });
            }
            fechaCreacionPedido.setHours(fechaCreacionPedido.getHours() + Math.max.apply(Math, tiempoProduccion_val));
            //console.log("fecha que lleva despues del tiempo de produccion: ", fechaCreacionPedido);
            var mayorTiempoP = Math.max.apply(Math, tiempoProduccion_val);
            var auxTiempo = 0;
            var id_planta_val;
            for(var i=0; i<listTiempoPlanta.length; i++){
                if (listTiempoPlanta[i][0].tiempoProduccion > auxTiempo){
                    auxTiempo = listTiempoPlanta[i][0].tiempoProduccion;
                    id_planta_val = listTiempoPlanta[i][0].idPlanta;
                }
            }
            $.ajax({
                async:false,
                url: urlApp + "buscarFeriados",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                    ano: fechaCreacionPedido.getFullYear()
                },
                success:function(dato){
                    arrFeriados = dato;

                }
            });
            //console.log("Feriados: ", arrFeriados);
            if (fechaCreacionPedido.getHours() >= 17 && fechaCreacionPedido.getMinutes() >= 0){
                fechaCreacionPedido.setDate(fechaCreacionPedido.getDate() + 1);
                fechaCreacionPedido = new Date(fechaCreacionPedido.getFullYear(), fechaCreacionPedido.getMonth(), fechaCreacionPedido.getDate(), 8, 0, 0, 0);    
            }
            //console.log("fecha que lleva despues del primer: ", fechaCreacionPedido);
            var weekday = ["Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado"];
            if (weekday[fechaCreacionPedido.getDay()] == "Sabado"){
                fechaCreacionPedido.setDate(fechaCreacionPedido.getDate() + 2);
                fechaCreacionPedido = new Date(fechaCreacionPedido.getFullYear(), fechaCreacionPedido.getMonth(), fechaCreacionPedido.getDate(), 8, 0, 0, 0);
            }
            //console.log("fecha que lleva despues del segundo: ", fechaCreacionPedido);
            if (weekday[fechaCreacionPedido.getDay()] == "Domingo"){
                fechaCreacionPedido.setDate(fechaCreacionPedido.getDate() + 1);
                fechaCreacionPedido = new Date(fechaCreacionPedido.getFullYear(), fechaCreacionPedido.getMonth(), fechaCreacionPedido.getDate(), 8, 0, 0, 0);
            }
            //console.log("fecha que lleva despues del tercero: ", fechaCreacionPedido);
            var feriado_val;
            $.each(arrFeriados, function (i, item) {
                feriado_val = new Date(item.fecha.split('/')[2], item.fecha.split('/')[1]-1, item.fecha.split('/')[0], 0, 0, 0, 0);
                if (fechaCreacionPedido.getFullYear() == feriado_val.getFullYear() 
                    && fechaCreacionPedido.getMonth() == feriado_val.getMonth()
                    && fechaCreacionPedido.getDate() == feriado_val.getDate())
                {
                    fechaCreacionPedido.setDate(fechaCreacionPedido.getDate() + 1);
                    fechaCreacionPedido = new Date(fechaCreacionPedido.getFullYear(), fechaCreacionPedido.getMonth(), fechaCreacionPedido.getDate(), 8, 0, 0, 0);    
                }
            });
            //console.log("fecha que lleva despues de los feriados: ", fechaCreacionPedido);
            if (weekday[fechaCreacionPedido.getDay()] == "Sabado"){
                fechaCreacionPedido.setDate(fechaCreacionPedido.getDate() + 2);
                fechaCreacionPedido = new Date(fechaCreacionPedido.getFullYear(), fechaCreacionPedido.getMonth(), fechaCreacionPedido.getDate(), 8, 0, 0, 0);
            }
            //console.log("fecha que lleva despues del cuarto: ", fechaCreacionPedido);
            if (weekday[fechaCreacionPedido.getDay()] == "Domingo"){
                fechaCreacionPedido.setDate(fechaCreacionPedido.getDate() + 1);
                fechaCreacionPedido = new Date(fechaCreacionPedido.getFullYear(), fechaCreacionPedido.getMonth(), fechaCreacionPedido.getDate(), 8, 0, 0, 0);
            }
            //console.log("fecha que lleva despues del quinto: ", fechaCreacionPedido);
            $.each(arrFeriados, function (i, item) {
                feriado_val = new Date(item.fecha.split('/')[2], item.fecha.split('/')[1]-1, item.fecha.split('/')[0], 0, 0, 0, 0);
                if (fechaCreacionPedido.getFullYear() == feriado_val.getFullYear() 
                    && fechaCreacionPedido.getMonth() == feriado_val.getMonth()
                    && fechaCreacionPedido.getDate() == feriado_val.getDate())
                {
                    fechaCreacionPedido.setDate(fechaCreacionPedido.getDate() + 1);
                    fechaCreacionPedido = new Date(fechaCreacionPedido.getFullYear(), fechaCreacionPedido.getMonth(), fechaCreacionPedido.getDate(), 8, 0, 0, 0);    
                }
            });
            //console.log("fecha que lleva despues del feridos 2: ", fechaCreacionPedido);
            if (weekday[fechaCreacionPedido.getDay()] == "Sabado"){
                fechaCreacionPedido.setDate(fechaCreacionPedido.getDate() + 2);
                fechaCreacionPedido = new Date(fechaCreacionPedido.getFullYear(), fechaCreacionPedido.getMonth(), fechaCreacionPedido.getDate(), 8, 0, 0, 0);
            }
            //console.log("fecha que lleva despues del sexto: ", fechaCreacionPedido);
            if (weekday[fechaCreacionPedido.getDay()] == "Domingo"){
                fechaCreacionPedido.setDate(fechaCreacionPedido.getDate() + 1);
                fechaCreacionPedido = new Date(fechaCreacionPedido.getFullYear(), fechaCreacionPedido.getMonth(), fechaCreacionPedido.getDate(), 8, 0, 0, 0);
            }
            //console.log("fecha que lleva despues del septirmo: ", fechaCreacionPedido);
            $.each(arrFeriados, function (i, item) {
                feriado_val = new Date(item.fecha.split('/')[2], item.fecha.split('/')[1]-1, item.fecha.split('/')[0], 0, 0, 0, 0);
                if (fechaCreacionPedido.getFullYear() == feriado_val.getFullYear() 
                    && fechaCreacionPedido.getMonth() == feriado_val.getMonth()
                    && fechaCreacionPedido.getDate() == feriado_val.getDate())
                {
                    fechaCreacionPedido.setDate(fechaCreacionPedido.getDate() + 1);
                    fechaCreacionPedido = new Date(fechaCreacionPedido.getFullYear(), fechaCreacionPedido.getMonth(), fechaCreacionPedido.getDate(), 8, 0, 0, 0);    
                }
            });
            //console.log("fecha que lleva despues del feriados 3: ", fechaCreacionPedido);
            fechaCreacionPedido = new Date(fechaCreacionPedido.getFullYear(), fechaCreacionPedido.getMonth(), fechaCreacionPedido.getDate(), fechaCreacionPedido.getHours(), 0, 0, 0);    
            //console.log("fecha que lleva antes del traslado: ", fechaCreacionPedido);
            $.ajax({
                async:false,
                url: urlApp + "buscarTiempoTraslado",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                    notaVenta: $("#txtNumeroNotaVenta").val(),
                    idPlanta: id_planta_val
                },
                success:function(dato){
                    if (dato.length > 0){
                        if (dato[0].tiempoTraslado == null)
                        { 
                            dato[0].tiempoTraslado = 0;  
                        }
                        fechaCreacionPedido.setHours(fechaCreacionPedido.getHours() + dato[0].tiempoTraslado);
                        fechaCreacionPedido = new Date(fechaCreacionPedido.getFullYear(), fechaCreacionPedido.getMonth(), fechaCreacionPedido.getDate(), fechaCreacionPedido.getHours(), 0, 0, 0);
                    }
                }
            });
            var atrasado = 0;
            var grabar = true;
            if (new Date(fechaCreacionPedido) >= new Date(fechaEntregaMaxima)){
                if($("#idCliente").val() == 14){
                    swal(
                            {
                                title: 'no puede modificar la entrega fuera de plazo!!!',
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
                        if (isConfirm){
                          return;
                        }
                    });

                }else{
                    swal(
                    {
                        title: 'Está creando un pedido fuera de plazo, ¿Desea continuar con la creación del pedido?',
                        text: '',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'SI',
                        cancelButtonText: 'NO',
                        closeOnConfirm: true,
                        closeOnCancel: true
                    },
                    function(isConfirm)
                    {
                        if (isConfirm){
                            atrasado = 1;
                            actualizarPedido(total, cadena, atrasado);
                        }
                    });

                }
               
                    $("#btnCrearPedido").attr("disabled", false);
            }
            else{
                actualizarPedido(total, cadena, atrasado);
            }
            //Fin Validar la Fecha Entrega

            
        }

        function actualizarPedido(total, cadena, atrasado){
            var ruta= urlApp + "actualizarPedido";

            $.ajax({
                url: ruta,
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        idPedido: $("#idPedido").val(),
                        fechaEntrega: fechaAtexto( $("#txtFechaEntrega").val() ),
                        observaciones: $("#txtObservaciones").val(),
                        horarioEntrega: $("#horario option:selected").html() ,
                        totalNeto: total,
                        ordenCompraCliente: $("#txtOrdenCompra").val(),
                        detalle: cadena,
                        motivo: $("#motivo").val(),
                        atrasado: atrasado
                      },
                success:function(dato){
                        swal(
                            {
                                title: 'Se han guardado los cambios realizados al pedido!!',
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
                                    if($("#idCliente").val() == 14){
                                        location.href=urlApp + "clientePedidos";

                                    }else{

                                        location.href=urlApp + "listarPedidos";


                                        
                                    }
                                    
                                    return;
                                }
                            }
                        )
                        
                                        
                }
            })
        }


        $(document).ready(function() {
            var tabla=$("#tablaDetalle").DataTable({"bLengthChange" : false,searching: false, paging: false, info: false});

            $("#tfootp").hide();
            if($("#idCliente").val() == 14){
                $("#clienteocultar").show();
                $("#cliocul").hide();
                $("#tfootp").hide();
                $("#precio").hide();
                $("#totalt").hide();
                tabla.columns([4,5]).visible(false, false);

                
                
                
            }else{
                $("#precio").show();
                $("#totalt").show();
                $("#clienteocultar").hide();
                $("#cliocul").show();
                $("#tfootp").show();
               

                
            }
            
            // Datepicker      
            $('.date').datepicker({
                todayHighlight: true,
                format: "dd/mm/yyyy",
                weekStart: 1,
                language: "es",
                autoclose: true,
                startDate: '+0d'
            }) 
            cargarListas();
        });

        $('#datos').on('submit', function(e) {
            // evito que propague el submit
            e.preventDefault();
            // agrego la data del form a formData
            var formData = new FormData( $("#datos")[0] );

            formData.append("idPedido", $("#idPedido").val());

            var ruta= urlApp + "subirOCpedido";
            $.ajax({
                url: ruta,
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: formData,
                cache:false,
                contentType: false,
                processData: false,            
                success:function(dato){
                        document.getElementById('txtOrdenCompra').dataset.ocarchivo=dato.nombreArchivo;
                        swal(
                            {
                                title: 'Se ha subido la Orden de Compra' ,
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
                        )                   
                }
            })
        });

        function bajarOCpedido(){

            $.ajax({
                url: urlApp + "existeArchivo",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        carpeta: 'ocpedido',
                        nombreArchivo: document.getElementById('txtOrdenCompra').dataset.ocarchivo
                      },
                success:function(dato){
                       if(!dato.existe){
                            swal(
                                {
                                    title: 'Archivo no encontrado!!' ,
                                    text: 'Nombre de archivo: ' + document.getElementById('txtOrdenCompra').dataset.ocarchivo,
                                    type: 'warning',
                                    showCancelButton: false,
                                    closeOnConfirm: true,
                                    confirmButtonText: 'Cerrar',
                                    cancelButtonText: '',
                                })                        
                       }else{
                            location.href= urlApp + "bajarOCpedido/"+  document.getElementById('txtOrdenCompra').dataset.ocarchivo +"/";
                       };
                }
            })            
        }

        function subirArchivoOCPedido(){
            $("#modSubirArchivo").modal('show'); 
        }

        function cerrarModalSubirArchivo(){
            $("#modSubirArchivo").modal('hide'); 
        }


    </script>
       
@endsection