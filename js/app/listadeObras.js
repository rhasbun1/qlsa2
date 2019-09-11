    function nuevaObra(){
        $("#idObra").val("0");
        $("#filaObra").val("0");
        $("#txtNombreObra").val('');
        $("#txtDescripcionObra").val('');
        $("#txtNombreContactoObra").val('');
        $("#txtCorreoContactoObra").val('');
        $("#txtTelefonoObra").val('');
        $("#txtDistancia").val('');
        $("#txtTiempo").val('');
        $("#txtCostoFlete").val('');
        $("#codigoSoftland").val('');
        $("#mdNuevaObra").modal("show"); 
        document.getElementById('idCliente').selectedIndex=-1;
        $("#txtNombreObra").focus();
    }

    function editarObra(idObra, row){
        $("#idObra").val(idObra);
        var tabla=$("#tabla").DataTable();

        $("#filaObra").val( tabla.row(row).index() );
        $.ajax({
            url: urlApp + "datosObra",
            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
            type: 'POST',
            dataType: 'json',
            data: { 
                    idObra: idObra
                  },
            success:function(dato){
                obra=dato['obra'];
                distancias=dato['distancias']
                $("#txtNombreObra").val(obra[0].nombre);
                $("#txtDescripcionObra").val(obra[0].descripcion);
                $("#txtNombreContactoObra").val(obra[0].nombreContacto);
                $("#txtCorreoContactoObra").val(obra[0].correoContacto);
                $("#txtTelefonoObra").val(obra[0].telefonoContacto);
                $("#txtDistancia").val(obra[0].distancia);
                $("#txtTiempo").val(obra[0].tiempo);
                $("#txtCostoFlete").val(obra[0].costoFlete);
                $("#codigoSoftland").val(obra[0].codigoSoftland)
                var sel=document.getElementById("idCliente");

                for(var x=0; x<sel.length; x++){
                    if(sel.options[x].value==obra[0].emp_codigo){
                        sel.selectedIndex=x;
                        break;
                    }
                }

                $("#tabDistancias tbody").remove();
                for(var x=0; x<distancias.length; x++){
                    cadena="<tr><td>"+ distancias[x].nombrePlanta + 
                    "</td><td><input class='form-control input-sm' maxlength='5' style='width: 80px' data-idplanta='" + distancias[x].idPlanta + 
                    "' onkeypress='return isNumberKey(event)' value='" + distancias[x].tiempoTraslado +"'></td></tr>";
                    $("#tabDistancias").append(cadena);
                }

                $("#mdNuevaObra").modal("show"); 
                $("#txtNombreObra").focus();
            }
        })         
    }


    function cerrarNuevaObra(){
        $("#mdNuevaObra").modal("hide");
    }

    function agregarNuevaObra(){

        if($("#txtNombreObra").val().trim()=='' || $("#txtNombreContactoObra").val().trim()=='' || $("#txtTelefonoObra").val().trim()=='' ){
            swal(
                {
                    title: 'Debe ingresar todos los datos exigidos (*).',
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


        var ruta= urlApp + "agregarObra";
        var cont=0;
        var cadena='[';
        var tabla=document.getElementById('tabDistancias');

        for (var i = 1; i < tabla.rows.length; i++){
            if(tabla.rows[i].cells[1].getElementsByTagName('input')[0].value!=""){
                cadena+='{';
                cadena+='"idPlanta":"'+  tabla.rows[i].cells[1].getElementsByTagName('input')[0].dataset.idplanta + '", ';
                cadena+='"tiempoTraslado":"'+  tabla.rows[i].cells[1].getElementsByTagName('input')[0].value + '"';
                cadena+='}, ';                
            }
        }

        cadena=cadena.slice(0,-2);
        cadena+=']';
        var fila = $("#filaObra").val();

        $.ajax({
            url: ruta,
            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
            type: 'POST',
            dataType: 'json',
            data: { 
                    idObra: $("#idObra").val(),
                    nombre: $("#txtNombreObra").val(), 
                    emp_codigo: $("#idCliente").val(),
                    nombreContacto: $("#txtNombreContactoObra").val(),
                    correoContacto: $("#txtCorreoContactoObra").val(),
                    telefonoContacto: $("#txtTelefonoObra").val(),
                    descripcion: $("#txtDescripcionObra").val(),
                    codigoSoftland: $("#codigoSoftland").val(),
                    distanciaplantas: cadena
                  },
            success:function(dato){
                    var tabla=$("#tabla").DataTable();
                    var cadena='';
                    if($("#idObra").val()=="0"){
                        cadena="<button class='btn btn-xs btn btn-warning' onclick='editarObra(" + dato.idObra +  ", this.parentNode.parentNode )' title='Editar'><i class='fa fa-edit fa-lg'></i></button>";
                        cadena+="<button class='btn btn-xs btn btn-danger'  onclick='eliminarObra(" + dato.idObra +  ", this.parentNode.parentNode )' title='Eliminar'><i class='fa fa-trash-o fa-lg'></i></button>";                        
                        tabla.row.add( [
                                $("#txtNombreObra").val(),
                                $("#idCliente option:selected").html(),
                                $("#txtNombreContactoObra").val(),
                                $("#codigoSoftland").val(),
                                cadena
                            ]).draw();
                    }else{
                        //obra editada

                        tabla.cell(fila,0).data( $("#txtNombreObra").val() );
                        tabla.cell(fila,1).data( $("#idCliente option:selected").html() );
                        tabla.cell(fila,2).data( $("#txtNombreContactoObra").val() );
                        tabla.cell(fila,3).data( $("#codigoSoftland").val() );

                    }


                    cerrarNuevaObra();
            }
        })
    }

    function eliminarObra(idObra, row){
        swal(
            {
                title: 'Elimina la obra seleccionada?',
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
                        url: urlApp + "eliminarObra",
                        headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                        type: 'POST',
                        dataType: 'json',
                        data: { 
                                idObra: idObra
                              },
                        success:function(dato){
                            if (dato[0].idObra==-1){
                                swal(
                                    {
                                        title: 'La obra no puede ser eliminada',
                                        text: 'Esta obra ya tiene información relacionada',
                                        type: 'warning',
                                        showCancelButton: false,
                                        confirmButtonText: 'Si',
                                        cancelButtonText: '',
                                        closeOnConfirm: true,
                                        closeOnCancel: true
                                    });                               

                            }else{
                                var tabla=$("#tabla").DataTable();
                                tabla.row(row).remove().draw();
                                return;                                
                            }

                        }
                    }) 
                }
            }
        )  


        
    }    