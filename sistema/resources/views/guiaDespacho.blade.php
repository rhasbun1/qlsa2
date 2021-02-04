<div id="mdGuia" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="height: 45px">
                <h5><b>Guía de Despacho</b></h5>
                <input id="rowTabla" type="hidden">
            </div>
            <div id="bodyGuia" class="modal-body">
                <input type="hidden" id="numeroFila">
                <div id="mensajeProceso" class="alert alert-danger" style="display:block;">
                    <strong>Advertencia!</strong> Change a few things up and try submitting again.
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-md-2">
                        <b>Número Guía</b>
                    </div>
                    <div class="col-md-2">
                        <input class="form-control input-sm" id="folioDTE" data-numeropedido="0" data-numeroguia="0" readonly>
                    </div>
                    <div class="col-md-1">
                        Cód.Vend.
                    </div>
                    <div class="col-md-2">
                        <input class="form-control input-sm" id="codigoVendedor" readonly>
                    </div>
                    <div class="col-md-1">
                        Nº Pedido
                    </div>
                    <div class="col-md-2">
                        <input class="form-control input-sm" id="txtNumeroPedido" readonly>
                    </div>                                     
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-md-2">
                        Cliente
                    </div>
                    <div class="col-md-5">
                        <input class="form-control input-sm" id="razonSocial" readonly="">
                    </div>
                    <div class="col-md-1">
                        RUT
                    </div>
                    <div class="col-md-2">
                        <input class="form-control input-sm" id="rutCliente" readonly>
                    </div>
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-md-2">
                        Dirección
                    </div>
                    <div class="col-md-8">
                        <input class="form-control input-sm" id="direccionCliente" readonly>
                    </div>
                </div>  
                <div class="row" style="padding-top: 5px">
                    <div class="col-md-2">
                        Comuna
                    </div>
                    <div class="col-md-3">
                        <input class="form-control input-sm" id="comuna" readonly>
                    </div>
                    <div class="col-md-2">
                        Ciudad
                    </div>
                    <div class="col-md-3">
                        <input class="form-control input-sm" id="ciudad" readonly>
                    </div>                    
                </div>

                <div class="row" style="padding-top: 5px">   
                    <div class="col-md-2">
                        Observaciones (máx.130 carac.)
                    </div>
                    <div class="col-md-10">
                        <textarea class="form-control input-sm" id="observacionDespacho" rows="2" readonly maxlength="130"></textarea> 
                    </div>
                </div> 
                <div style="padding-top:15px">
                    <table id="tablaDetalleGuia" class="table table-hover table-condensed" style="width: 100%">
                        <thead>
                            <th style="width: 100px">Cod.Producto</th>
                            <th style="width: 350px">Nombre</th>
                            <th style="width: 100px">Unidad</th>
                            <th style="width: 100px; text-align:right;">Cant.Solicitada</th>
                            <th style="width: 100px; text-align:right;">Cant./Pesaje</th>
                            <th style="width: 100px">Precio Unit.</th>
                            <th style="width: 100px">Subtotal</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-md-2">
                        Fecha Hora Salida
                    </div>
                    <div class="col-md-3">
                        <input class="form-control input-sm" id="fechaHoraSalida" readonly>
                    </div>                
                    <div class="col-md-2">
                        Emp.Transportes (máx.30 carac.)
                    </div>
                    <div class="col-md-3">
                        <input class="form-control input-sm" id="nombreEmpresaTransportes" readonly maxlength="30">
                    </div>
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-md-2">
                        Patente (máx.9 carac.)
                    </div>
                    <div class="col-md-2">
                        <input class="form-control input-sm" id="guiaPatente" readonly maxlength="9">
                    </div>
                    <div class="col-md-1">
                        Rampla
                    </div>
                    <div class="col-md-1">
                            <input class="form-control input-sm" id="guiaRampla" readonly maxlength="3">
                        </div>
                    
                    <div class="col-md-2">
                        Retira (máx.30 carac.)
                    </div>
                    <div class="col-md-4">
                        <input class="form-control input-sm" id="guiaNombreConductor" readonly maxlength="30">
                    </div>
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-md-2">
                        Sellos (máx.30 carac.)
                    </div>
                    <div class="col-md-3">
                        <input class="form-control input-sm" id="sellos" readonly maxlength="30">
                    </div>
                    <div class="col-md-2">
                        Temperatura
                    </div>
                    <div class="col-md-2">
                        <input class="form-control input-sm" id="temperatura" readonly>
                    </div>
                </div>
                <div class="row" style="padding-top: 5px">
                    <div class="col-md-2">
                        Nombre Archivo
                    </div>
                    <div class="col-md-3">
                        <input class="form-control input-sm" id="nombreArchivo" readonly>
                    </div>
                    <div class="col-md-2">
                        Obs.Proceso DTE
                    </div>
                    <div class="col-md-5">
                        <input class="form-control input-sm" id="obsProcesoDTE" readonly>
                    </div>
                </div>                                       
            </div>
            <div style="padding-top: 20px; padding-bottom: 20px; padding-right: 20px; text-align: right;">
               <button id="btnGuardarDatosGuia" type="button" class="btn btn-success btn-sm" onclick="actualizarDatosGuiaDespacho(true)">Actualizar Datos</button>
               <button id="btnEmitirGuia" type="button" class="btn btn-warning btn-sm" onclick="emitirGuiaDespacho()" data-idperfil="{{ Session::get('idPerfil') }}">Emitir Guía</button>
               <button id="btnSubirPdf" type="button" class="btn btn-info btn-sm" onclick="abrirSubirGuiaPdf()">Subir PDF</button>  
               <button id="btnBajar" type="button" class="btn btn-primary btn-sm" onclick="bajarGuiaPdf();">Ver Guia PDF</button> 
               <button id="btnRegistrarSalida" type="button" class="btn btn-default btn-sm" onclick="registrarSalida();">Registrar Salida</button>
               <button id="btnCerrarCajaGuia" type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarCajaGuia()" style="width: 80px">Salir</button>
               <button id="btnAnularGuiaTemporal" type="button" class="btn btn-default btn-sm" onclick="abrirModalAnularGuia();" title="Anula la guía">Deshacer datos</button>
            </div>
        </div>
    </div>
</div>

<div id="modSubirGuiaPdf" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <input type="hidden" id="filaTabla" name="filaTabla">
                <h5><b>Subir Documento PDF</b></h5>
            </div>
            <div id="bodySubirGuia" class="modal-body">
                <form id="datosGuia" name="datos" enctype="multipart/form-data">
                    <div class="row" style="padding: 5px">
                        <input id="numGuia" type="hidden" name="numGuia"> 
                        <div class="col-md-3">
                            Número de Guía
                        </div>
                        <div class="col-md-3">    
                            <input id="nuevoFolioDTE" name="nuevoFolioDTE" maxlength="10" onkeypress="return isIntegerKey(event)" class="form-control input-sm">
                        </div>
                    </div>
                    <div class="row" style="padding: 5px">
                        <div class="col-md-12"> 
                            <div class="upload-file">
                                <input type="file" id="upload-demo" name="upload-demo" class="upload-demo">
                                <label data-title="Buscar" for="upload-demo">
                                    <span id="mensajeUpload" data-title="No ha seleccionado un archivo..."></span>
                                </label>
                            </div>
                        </div>                
                    </div>

                    <div style="text-align: right; padding-top: 20px; padding-bottom: 5px">
                       <button id="btnSubirGuia" type="submit" class="btn btn-success btn-sm" style="width: 80px">Subir</button>
                       <button type="button" class="btn btn-danger  btn-sm" onclick="cerrarModalSubirGuiaPdf()" style="width: 80px">Salir</button>
                    </div>                   
                </form>     
            </div>
        </div>
    </div>
</div>

<div id="modEmitirGuia" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div id="bodySubirGuia" class="modal-body">
                <div id="mensajeModEmitirGuia" class="row" style="text-align: center;" style="display: inline">
                    <p><h3>Al emitir la guía ya no podrá realizar cambios sobre esta, ¿desea continuar?</h3></p>
                </div>
                <img id="imagenProcesando" src="{{ asset('/') }}img/procesando.gif" style="display: none">
            </div>
            <div class="modal-footer">
                <button id="btnProcesarGuia" class="btn btn-sm btn-success" onclick="procesarGuia();" style="width: 80px">Si</button>
                <button id="btnCerrarModEmitirGuia" class="btn btn-sm btn-danger"  onclick="cerrarModEmitirGuia();" style="width: 80px">No</button>
            </div>            
        </div>
    </div>
</div>

<div id="mdAnularGuiaTemporal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="height: 45px">
                <h5><b>Deshacer Guía</b></h5>
            </div>
            <div id="bodyGuia" class="modal-body">
                Indique el motivo (máx.200 caract.)
                <div class="row">
                    <div class="col-md-12">
                        <input class="form-control input-sm" id="obsAnulacion" maxlength="200">
                    </div> 
                </div>
                <b>Al deshacer la guía temporal, se liberarán los productos del pedido para poder modificar sus datos, y luego podrá volver a asignarle una guía.</b>
            </div>
            <div style="padding-top: 20px; padding-bottom: 20px; padding-right: 20px; text-align: right;">
               <button type="button" class="btn btn-success btn-sm" onclick="anularGuiaTemporal()" style="width: 80px">Aceptar</button>                
               <button id="btnCerrarCajaSuspender" type="button" class="btn btn-danger btn-sm" onclick="cerrarAnularGuia()" style="width: 80px">Cancelar</button>
            </div>

        </div>
    </div>
</div>