@extends('plantilla')      

@section('contenedorprincipal')

<div style="padding: 20px">
    <div class="panel panel-default table-responsive">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
        <div class="panel-heading">
            <b>Usuarios</b>
            <span class="badge badge-info pull-right">{{ count($listaUsuarios) }} Usuarios</span>
        </div>
        <div class="padding-md clearfix" style="width: 1000px">           
            <table id="tabla" class="table table-hover table-condensed table-responsive">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Planta</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($listaUsuarios as $item)
                        <tr>
                            <td>{{ $item->usu_codigo }}</td>
                            <td>{{ $item->usu_nombre }}</td>
                            <td>{{ $item->usu_apellido }}</td>
                            <td>{{ $item->usu_correo }}</td>
                            <td>{{ $item->planta }}</td>
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
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="height: 45px">
                <h5><b>Datos del Usuario</b></h5>
            </div>
            <div id="bodyPlanta" class="modal-body">
                <div class="row" style="padding: 5px">
                    <div class="col-md-3">
                        Nombre
                    </div>
                    <div class="col-md-9">
                        <input id="nombreUsuario" class="form-control input-sm" maxlength="100" readonly>
                    </div>
                </div>
                <div class="row" style="padding: 5px">
                    <div class="col-md-12">
                        Plantas
                    </div>
                    <div id="divPlantas" style="padding: 5px" class="col-md-12">
                        <div class="list-group">
                            <?php
                                $cont=1;
                            ?>
                            @foreach($plantas as $item)
                                <input type="checkbox" name="CheckBoxInputName" value="{{ $item->idPlanta}}" id="CheckBox{{$cont}}" />
                                <label class="list-group-item" for="CheckBox{{$cont}}">{{ $item->nombre}}</label>
                                <?php
                                    $cont=$cont+1;
                                ?>                                                        
                            @endforeach
                        </div>
                    </div>
                </div>                
            </div>
            <div style="padding-top: 20px; padding-bottom: 20px; padding-right: 20px; text-align: right;">
               <button id="btnGuardarUsuario" type="button" class="btn btn-success data-dismiss=modal btn-sm" onclick="guardarUsuario()" style="width: 80px">Grabar</button>                
               <button id="btnCerrarMdUsuario" type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarModUsuario()" style="width: 80px">Salir</button>
            </div>            
        </div>
    </div>
</div>

@endsection

@section('javascript')
    <!-- Datepicker -->
    <style>
        .list-group-item {
          user-select: none;
        }

        .list-group input[type="checkbox"] {
          display: none;
        }

        .list-group input[type="checkbox"] + .list-group-item {
          cursor: pointer;
        }

        .list-group input[type="checkbox"] + .list-group-item:before {
          content: "\2713";
          color: transparent;
          font-weight: bold;
          margin-right: 1em;
        }

        .list-group input[type="checkbox"]:checked + .list-group-item {
          background-color: #0275D8;
          color: #FFF;
        }

        .list-group input[type="checkbox"]:checked + .list-group-item:before {
          color: inherit;
        }
      
    </style>
    <script src="{{ asset('/') }}js/bootstrap-datepicker.min.js"></script>  

    <!-- Timepicker -->
    <script src="{{ asset('/') }}js/bootstrap-timepicker.min.js"></script>  

    <script src="{{ asset('/') }}js/app/funciones.js"></script>
    <script>


        function editarUsuario(row){
            var tabla=$("#tabla").DataTable();
            var datos=tabla.row(row).data();
            document.getElementById("nombreUsuario").dataset.idusuario=datos[0];
            document.getElementById("nombreUsuario").dataset.fila= tabla.row(row).index();
            $("#nombreUsuario").val(datos[1] + ' ' + datos[2]);

            var plantas = document.getElementById("divPlantas");
            var elementos=plantas.getElementsByTagName("input").length;
            for (var i = 0; i < elementos; i++){
                plantas.getElementsByTagName("input")[i].checked=false;
            }            

            $.ajax({
                url: urlApp + "usuarioPlantas",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        idUsuario: datos[0]
                      },
                success:function(dato){
                    for(var x=0; x<dato.length; x++){
                        for (var i = 0; i < elementos; i++){
                            if(plantas.getElementsByTagName("input")[i].value==dato[x].idPlanta){
                               plantas.getElementsByTagName("input")[i].checked=true; 
                            }
                        }
                    }
                }
            })

            $("#mdUsuario").modal('show');
        }

        function cerrarModUsuario(){
            $("#mdUsuario").modal('hide');
        }

        function guardarUsuario(){
            var fila=document.getElementById('nombreUsuario').dataset.fila;
            var idUsuario=document.getElementById('nombreUsuario').dataset.idusuario;

            var plantas = document.getElementById("divPlantas");
            var elementos=plantas.getElementsByTagName("input").length;

            var cadena='[';
            var accion="1";

            for (var i = 0; i < elementos; i++){

                    if(plantas.getElementsByTagName("input")[i].checked ){
                        accion="1";
                    }else{
                        accion="0";
                    }
                    cadena+='{';
                    cadena+='"idPlanta":"'+  plantas.getElementsByTagName("input")[i].value + '", ';
                    cadena+='"accion":"'+  accion  + '"';
                    cadena+='}, ';              

            }

            cadena=cadena.slice(0,-2);
            cadena+=']';

            var tabla=$("#tabla").DataTable();

            $.ajax({
                url: urlApp + "grabarUsuario",
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        idUsuario: idUsuario,
                        plantas: cadena
                      },
                success:function(dato){
                    tabla.cell(fila, 4).data( dato.plantas );
                    cerrarModUsuario();
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
                        title: 'Listado de Clientes',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                         
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Listado de Clientes',
                        text:      '<i class="fa fa-file-pdf-o"></i>',
                        titleAttr: 'PDF',                         
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }
                    }
                ],                  
                language:{url: "{{ asset('/') }}locales/datatables_ES.json"}
            });

        } );

    </script>
    
@endsection
