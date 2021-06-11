@extends('plantilla')      

@section('contenedorprincipal')

<div style="padding: 20px">
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b>Ramplas</b>
        </div>
        <div class="padding-md clearfix" style="width:450px"> 
            <table id="tabla" class="table table-hover table-condensed" style="width:450px">
                <thead>
                    <th style="width:80px">Número</th>
                    <th style="width:300px">Patente</th>
                    <th style="width:50px"></th>
                </thead> 
                <tbody>
                    @foreach($ramplas as $item)
                        <tr>
                            <td style="width:80px">{{ $item->numero }}</td>
                            <td style="width:300px">{{ $item->patente }}</td>
                            <td style="width:50px">                           
                                <button class="btn btn-xs btn btn-warning" onclick="editarRampla( {{ $item->numero }}, this.parentNode.parentNode.rowIndex )" title="Editar" ><i class="fa fa-edit fa-lg"></i></button>
                                <button class="btn btn-xs btn btn-danger" title="Eliminar" onclick="eliminarRampla(this.parentNode.parentNode.rowIndex)"><i class="fa fa-trash-o fa-lg"></i></button>
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


        <div id="mdRampla" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" id="tituloModCondicion">
                    <h5><b>Datos Rampla</b></h5>
                </div>
                <div id="bodyArea" class="modal-body">
                    <input type="hidden" id="numero">
                    <input type="hidden" id="filaRampla">         
                    <div class="row" style="padding-top: 5px">
                        <div style="display:none"  class="col-sm-3">
                            Número (*)
                        </div>
                        <div style="display:none"  class="col-sm-3">
                            <input  type="number" onkeypress='return validaNumericos(event)'  min="0"  oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)" id="numeroRampla" class="form-control input-sm" maxlength="3">
                        </div>
                        <div class="col-sm-3">
                            Patente (*)
                        </div>
                        <div class="col-sm-3">
                            <input type="text" id="patenteRampla" class="form-control input-sm" maxlength="15">
                        </div>
                    </div>
                </div>        
                <div style="padding-left: 15px; padding-top: 0px">
                    <h6><b> (*) Dato Obligatorio</b></h6>
                </div>              
                <div class="col-md-offset-8" style="padding-top: 0px; padding-bottom: 20px">
                   <input id="btnGrabarCondicion" type="button" class="btn btn-success btn-sm" onclick="grabarRampla();" style="width: 80px" value="Guardar">
                   <input value="Guardar" id="editar"  type="button" class="btn btn-success btn-sm" onclick="editarRampla1();" style="width: 80px">

                   <button  type="button" class="btn btn-danger data-dismiss=modal btn-sm" onclick="cerrarMdRampla()" style="width: 80px">Salir</button>
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

    <script>

        function abrirMdRampla(){
            $("#numero").val('0');
            $("#filaRampla").val('0');
            $("#numeroRampla").val('');
            $("#patenteRampla").val('');
            $("#mdRampla").modal('show');
        }

        function cerrarMdRampla(){
            $("#mdRampla").modal('hide');
        }

        function editarRampla(numero, fila){
            var tabla=document.getElementById('tabla');
            $('#patenteRampla').val(tabla.rows[fila].cells[1].innerHTML.trim() ) ;
            $("#filaRampla").val(fila);
            $("#numero").val(tabla.rows[fila].cells[0].innerHTML.trim() );
            $("#numeroRampla").val(tabla.rows[fila].cells[0].innerHTML.trim() );
            $("#btnGrabarCondicion").hide();

            $("#editar").show();
            $("#mdRampla").modal('show');
        }

        function eliminarRampla(fila){
            var tabla=document.getElementById('tabla');
            var numeroRampla=tabla.rows[fila].cells[0].innerHTML.trim();
            swal(
                {
                    title: '¿Elimina la rampla seleccionada?',
                    text: '',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No',
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm)
                {
                    if(isConfirm){            
                        $.ajax({
                            url: urlApp +'eliminarRampla',
                            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                            type: 'POST',
                            dataType: 'json',
                            data: { 
                                    numeroRampla: numeroRampla
                                  },
                            success:function(dato){
                                tabla.deleteRow(fila);
                                if(dato.respuesta>0){
                                    swal(
                                        {
                                            title: 'La rampla ha sido eliminada!!',
                                            text: '',
                                            type: 'warning',
                                            showCancelButton: false,
                                            confirmButtonText: 'OK',
                                            cancelButtonText: 'No',
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
                                }
                            }
                        })
                    }
                }
            )        
        }
        function editarRampla1(){
            $("#btnGrabarCondicion").prop("disabled", true);
            $.ajax({
                url: urlApp +'editarRampla',
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        numeroRampla: $("#numeroRampla").val(),
                        patenteRampla: $("#patenteRampla").val()
                      },
                success:function(dato){
                    

                        if(dato.respuesta==0){
                            var cadena="<tr>";
                            cadena+="<td>" + $("#numeroRampla").val() + "</td>";
                            cadena+="<td>" + $("#patenteRampla").val() + "</td>";
                            cadena+='<td style="width: 40px">';
                            cadena+='<button class="btn btn-xs btn btn-warning" onclick="editarRampla(' + $("#numeroRampla").val() +', this.parentNode.parentNode.rowIndex )" title="Editar" ><i class="fa fa-edit fa-lg"></i></button>';
                            cadena+='<button class="btn btn-xs btn btn-danger" title="Eliminar" onclick="eliminarRampla(this.parentNode.parentNode.rowIndex)"><i class="fa fa-trash-o fa-lg"></i></button>';
                            cadena+='</td>';

                            cadena+="</tr>";
                            $("#tabla").append(cadena);                            
                        }else{
                            tabla.rows[ $("#filaRampla").val() ].cells[0].innerHTML=$("#numeroRampla").val();
                            tabla.rows[ $("#filaRampla").val() ].cells[1].innerHTML=$("#patenteRampla").val();
                        }
                        $("#numeroRampla").val('');
                        $("#patenteRampla").val('');
                        cerrarMdRampla();
                        $("#btnGrabarCondicion").prop("disabled", false);     
                    }


                ,
            })
        }

        function grabarRampla(){
            if($("#numeroRampla").val()=='' || $("#patenteRampla").val()==''){
                swal(
                            {
                                title: 'Los campos no pueden estar vacios',
                                text: '',
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'OK',
                                cancelButtonText: 'No',
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
                        return;
            }
            $("#btnGrabarCondicion").prop("disabled", true);
            $.ajax({
                url: urlApp +'guardarRampla',
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        numeroRampla: $("#numeroRampla").val(),
                        patenteRampla: $("#patenteRampla").val()
                      },
                success:function(dato){
                    if(dato.respuesta==-1){
                        swal(
                            {
                                title: 'La patente de la rampla que desea crear ya Existe!!',
                                text: '',
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'OK',
                                cancelButtonText: 'No',
                                closeOnConfirm: true,
                                closeOnCancel: false
                            },
                            function(isConfirm)
                            {
                                if(isConfirm){ 
                                    $("#btnGrabarCondicion").prop("disabled", false);              
                                    return;
                                }
                            }
                        )

                    }else if(dato.respuesta==1){
                        swal(
                            {
                                title: 'El numero de la rampla que desea crear ya Existe!!',
                                text: '',
                                type: 'warning',
                                showCancelButton: false,
                                confirmButtonText: 'OK',
                                cancelButtonText: 'No',
                                closeOnConfirm: true,
                                closeOnCancel: false
                            },
                            function(isConfirm)
                            {
                                if(isConfirm){ 
                                    $("#btnGrabarCondicion").prop("disabled", false);              
                                    return;
                                }
                            }
                        )

                    }else{

                        if(dato.respuesta==0){
                            var cadena="<tr>";
                            cadena+="<td>" + $("#numeroRampla").val() + "</td>";
                            cadena+="<td>" + $("#patenteRampla").val() + "</td>";
                            cadena+='<td style="width: 40px">';
                            cadena+='<button class="btn btn-xs btn btn-warning" onclick="editarRampla(' + $("#numeroRampla").val() +', this.parentNode.parentNode.rowIndex )" title="Editar" ><i class="fa fa-edit fa-lg"></i></button>';
                            cadena+='<button class="btn btn-xs btn btn-danger" title="Eliminar" onclick="eliminarRampla(this.parentNode.parentNode.rowIndex)"><i class="fa fa-trash-o fa-lg"></i></button>';
                            cadena+='</td>';

                            cadena+="</tr>";
                            $("#tabla").append(cadena);                            
                        }else{
                            tabla.rows[ $("#filaRampla").val() ].cells[0].innerHTML=$("#numeroRampla").val();
                            tabla.rows[ $("#filaRampla").val() ].cells[1].innerHTML=$("#patenteRampla").val();
                        }
                        $("#numeroRampla").val('');
                        $("#patenteRampla").val('');
                        cerrarMdRampla();
                        $("#btnGrabarCondicion").prop("disabled", false);     
                    }


                },
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
                        text: 'Nueva Rampla',
                        action: function ( e, dt, node, config ) {
                            $("#btnGrabarCondicion").show();
                            $("#editar").hide();
                            abrirMdRampla(1);
                        }
                    },                 
                    {
                        extend: 'excelHtml5',
                        title: 'Listado de Ramplas',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1]
                        }
                    }
                ],                  
                language:{url: "{{ asset('/') }}locales/datatables_ES.json"}
            });

        } );

        function validaNumericos(event) {
            if(event.charCode >= 48 && event.charCode <= 57){
                return true;
            }
            return false;        
        }
    </script>
    
@endsection