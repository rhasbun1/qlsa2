@extends('plantilla')      

@section('contenedorprincipal')

<div style="padding: 10px">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b>Nueva Nota de Venta</b>
        </div>
        <div class="padding-md clearfix"> 
                <input type="hidden" id="idCliente">
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-lg-1 col-sm-2 col-md-1">
                        Cotización (*)
                    </div>
                    <div class="col-lg-1 col-sm-2">
                        <input class="form-control input-sm" id="txtNumeroCotizacion" style="width:80px" maxlength="9" onkeypress="return isNumberKey(event)">
                    </div>
                    <div class="col-lg-1 col-sm-1">
                        Año (*)
                    </div>
                    <div class="col-lg-1 col-sm-2">
                        <input class="form-control input-sm" id="txtAno" maxlength="4" onkeypress="return isNumberKey(event)">
                    </div>            
                    <div class="col-lg-1 col-sm-2">
                        <button id="btnDatosCotizacion" class="btn btn-sm btn-success" onclick="datosCotizacion();">Traer</button>
                    </div> 
                    <div class="col-lg-1 col-sm-1">
                        Fecha
                    </div>
                    <div class="col-lg-2 col-sm-2">
                        <input class="form-control input-sm" id="txtFechaCotizacion" readonly value="">
                    </div>                   
                </div>

                <div class="row" style="padding-top: 10px">
                    <div class="col-lg-1 col-sm-2 col-md-1" >
                        Cliente
                    </div>
                    <div class="col-lg-3 col-sm-4">
                        <input class="form-control input-sm" id="txtNombreCliente" readonly>
                    </div>
                    <div class="col-lg-1 col-sm-2 col-md-1">
                       Cód.Softland
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2">
                        <input class="form-control input-sm" id="txtCodClienteSoftland" maxlength="9" onkeypress="return isNumberKey(event)">
                    </div>

                    <div class="col-lg-1 col-sm-1 col-md-1" id="divOcCliente" >
                        O.Compra
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-3">
                        <div class="input-group"> 
                            <input class="form-control input-sm" id="txtOrdenCompra" maxlength="20" data-solicitaOC="0">
                            <span id="btnCargarArchivo" class="input-group-addon glyphicon glyphicon-cloud-upload" style="background-color: #FFFFFF" onclick="subirArchivoOc();" title="Subir Orden de Compra"></span>
                        </div>
                    </div>

                </div>
                <div class="row" style="padding-top: 10px">
                    <div class="col-lg-1 col-sm-2 col-md-1">
                        Creada por
                    </div>
                    <div class="col-lg-3 col-sm-4">
                        <input class="form-control input-sm" id="txtUsuarioCrea" readonly>
                    </div>
                    <div class="col-lg-1 col-sm-2 col-md-1">
                        Validada&nbsp;por
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2">
                        <input class="form-control input-sm" id="txtUsuarioValida" readonly>
                    </div>
                    <div class="col-lg-1 col-sm-2 col-1md-1">
                        Cond.&nbsp;Pago&nbsp;(*)
                    </div>
                    <div class="col-lg-3 col-sm-3 col-md-3">
                        <select id="idCondicionPago" name="idCondicionPago" class="selectpicker" data-live-search="true" title="Seleccione..." data-width="100%">
                            @foreach($condicionesPago as $item)
                               <option value="{{ $item->idCondiciondePago }}">{{ $item->nombre }} </option>
                            @endforeach                             
                        </select>
                    </div>                  
                </div>
                <div class="row" style="padding-top: 10px">
                    <div class="col-sm-2 col-lg-1 col-md-1">
                        Obra/Planta
                    </div>
                    <div class="col-lg-8 col-sm-8">                
                        <textarea id="txtObra" class="form-control input-sm" rows="2" readonly></textarea>
                    </div>
                </div>
            </div>
            <div id="notificaciones" style="padding-right: 20px; padding-left: 20px">
            </div>
            <div style="padding-right: 20px; padding-left: 20px">
                <table id="tablaDetalle" class="table table-hover table-condensed table-responsive">
                    <thead>
                        <th style="display: none">Código</th>
                        <th style="width:80px">Nº de Diseño</th>
                        <th style="width:150px">Producto</th>
                        <th style="width:50px">Cantidad</th>
                        <th style="width:50px">Unidad</th>
                        <th style="width:50px;text-align: right;">Precio Base ($)</th>
                        <th style="width:250px">Glosa de Reajuste</th>
                        <th style="width:150px">Planta de Origen</th>
                        <th style="width:120px">Entrega</th>                        
                    </thead>
                </table>
                <tbody></tbody>
            </div>
            <form id="datosNotaVenta" name="datosNotaVenta" enctype="multipart/form-data"> 
                <div style="padding: 20px">
                    <div class="row" style="padding-top: 5px">
                        <div class="col-lg-3 col-sm-4">
                            Nombre corto de Obra/Planta
                            <select id="idObra" name="idObra" class="form-control input-sm" onchange="datosObra();"></select>
                        </div>
                        <div class="col-lg-1 col-sm-1" style="padding-top:18px">
                            <button id="btnNuevaObra" type="button" class="btn btn-warning btn-sm" onclick="datosNuevaObra();">Nueva</button>
                        </div>
                        <div class="col-lg-2 col-sm-3">
                            Contacto
                            <input id="txtNombreContacto" name="txtNombreContacto" class="form-control input-sm" maxlength="50" readonly>
                        </div> 
                        <div class="col-lg-2 col-sm-3">
                            Email
                            <input id="txtCorreoContacto" name="txtCorreoContacto" class="form-control input-sm" maxlength="50" readonly>
                        </div>
                        <div class="col-lg-2 col-sm-3">
                            Teléfono/Móvil
                            <input id="txtTelefono" name="txtTelefono" class="form-control input-sm" maxlength="50" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            Observaciones
                            <textarea id="txtObservaciones" name="txtObservaciones" maxlength="255" rows="3" class="form-control input-sm"></textarea>  
                        </div>
                        <div class="col-lg-3 col-sm-4">
                            Ejecutivo QL (*)
                            <select id="idUsuarioEncargado" name="idUsuarioEncargado" class="selectpicker" data-live-search="true" title="Seleccione..." data-width="100%" data-size="7">
                                @foreach($usuarios as $item)
                                   <option value="{{ $item->usu_codigo }}">{{ $item->usu_nombre }} {{ $item->usu_apellido }}</option>
                                @endforeach                             
                            </select>
                        </div>                    
                    </div>
                </div>
                <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
                    <button class="btn btn-success btn-sm" type="submit">Crear Nota de Venta</button>
                    <a href="{{ asset('/') }}listarNotasdeVenta" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
                </div>
            </form>             
        </body>

        @include('formularioObra')

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
                            <input type="file" id="upload-demo" name="upload-demo" class="upload-demo">
                            <label data-title="Buscar" for="upload-demo">
                                <span id="mensajeUpload" data-title="No ha seleccionado un archivo..."></span>
                            </label>
                        </div>
                        <br>
                        <b>Nota: Este archivo se subirá cuando presione el boton "Crear Nota de Venta".</b>
                    </div>
                    <div style="padding-top: 20px; padding-bottom: 20px; text-align: right;">
                       <button type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarModalSubirArchivo()" style="width: 80px">Cerrar</button>
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

    <!-- bootstrap-select -->
    <link rel="stylesheet" href="{{ asset('/') }}css/bootstrap-select/bootstrap-select.min.css">
    <script src="{{ asset('/') }}js/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="{{ asset('/') }}js/bootstrap-select/i18n/defaults-es_ES.min.js"></script>    

    <script src="{{ asset('/') }}js/app/funciones.js"></script>
    <script src="{{ asset('/') }}js/app/nuevanotaventa.js"></script>
    <script src="{{ asset('/') }}js/app/formularioObra.js"></script>
    <!-- Datatable -->
    <script src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
 
    <script>
        function subirArchivoOc(){
            $("#modSubirArchivo").modal('show'); 
        }

        function cerrarModalSubirArchivo(){
            if($("#upload-demo").val()!=''){
                document.getElementById('btnCargarArchivo').style.backgroundColor ="#f89406";
            }else{
                document.getElementById('btnCargarArchivo').style.backgroundColor ="#FFFFFF";
            }
                   
            $("#modSubirArchivo").modal('hide'); 
        }

        function datosNuevaObra(){
            $("#txtDescripcionObra").val( $("#txtObra").val() );
            $("#txtCliente").val( $("#txtNombreCliente").val() );
            $("#txtNombreContacto").val('');
            $("#txtCorreoContactoObra").val('');
            $("#txtTelefonoObra").val('');

            $("#mdNuevaObra").modal("show"); 
            $("#txtNombreObra").focus();

            $("#mdNuevaObra").modal('show');


        }             
        
    </script>   
@endsection