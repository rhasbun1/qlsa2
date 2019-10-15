        <div id="mdNuevaObra" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5><b>Nueva Obra/Planta</b></h5>
                </div>
                <div id="bodyCajaEliminaBodega" class="modal-body">
                    <div class="row">
                        <div class="col-md-1">
                            Cliente
                        </div>
                        <div class="col-md-4">
                            <input type="text" id="txtCliente" class="form-control input-sm" readonly>
                        </div>
                        <div class="col-md-2">
                            Nombre Obra/Planta(*)
                        </div>
                        <div class="col-md-5">
                            <input type="text" id="txtNombreObra" class="form-control input-sm" maxlength="50">
                        </div>
                    </div>
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Nombre Contacto (*)
                        </div>
                        <div class="col-sm-5">
                            <input type="text" id="txtNombreContactoObra" class="form-control input-sm" maxlength="50">
                        </div>
                        <div class="col-sm-1">
                            Email
                        </div>
                        <div class="col-sm-4">
                            <input type="text" id="txtCorreoContactoObra" class="form-control input-sm" maxlength="80">
                        </div>
                    </div>
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Teléfono/Movil (*)
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="txtTelefonoObra" class="form-control input-sm" maxlength="30">
                        </div>
                    </div>               
                    <div class="row" style="padding-top: 5px">
                        <div class="col-md-2">
                            Descripción
                        </div>
                        <div class="col-md-10">
                            <textarea id="txtDescripcionObra" class="form-control input-sm" maxlength="255" rows="3"></textarea>
                        </div>
                    </div> 
                </div>        
                <div style="padding-left: 15px; padding-top: 5px">
                    <h5><b> (*) Dato Obligatorio</b></h5>
                </div>
                <div class="col-md-offset-8" style="padding-top: 20px; padding-bottom: 20px">
                   <button id="btnEliminarBodega" type="button" class="btn btn-success btn-sm" onclick="agregarNuevaObra();" style="width: 80px">Crear</button>
                   <button id="btnCerrarCajaBodega" type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarNuevaObra()" style="width: 80px">Salir</button>
                </div>
            </div>
        </div>
    </div>