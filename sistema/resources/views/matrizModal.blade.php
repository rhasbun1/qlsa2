        <div id="modalNombre" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5><b>Titulo</b></h5>
                </div>
                <div id="bodyModal" class="modal-body">
                    <div class="row">
                        <div class="col-sm-3">
                            Etiqueta
                        </div>
                        <div class="col-sm-9">
                            <input type="text" id="Dato" class="form-control input-sm" readonly>
                        </div>
                    </div> 
                </div>        
                <div style="padding-left: 15px; padding-top: 5px">
                    <h5><b> (*) Dato Obligatorio</b></h5>
                </div>
                <div class="col-md-offset-8" style="padding-top: 20px; padding-bottom: 20px">
                   <button id="btnCrear" type="button" class="btn btn-success btn-sm" onclick="funcion();" style="width: 80px">Crear</button>
                   <button id="btnCerrar" type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="funcion()" style="width: 80px">Salir</button>
                </div>
            </div>
        </div>