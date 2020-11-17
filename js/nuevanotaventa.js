    function datosCotizacion(){
        limpiarTabla('tablaDetalle');
        $.get( appUrl + 'cotizacion/'+$("#txtNumeroCotizacion").val()+'/'+$("#txtAno").val()+'/datosCotizacion/', function (data) {
            $("#txtNombreCliente").val(data[0].emp_nombre);
            $("#txtFechaCotizacion").val(data[0].cot_fecha_creacion);
            $("#txtAno").val(data[0].cot_ano);
            $("#txtObra").val(data[0].cot_obra);
            $("#idCliente").val( data[0].emp_codigo );
            $("#txtUsuarioCrea").val( data[0].usuario_creacion );
            $("#txtUsuarioValida").val( data[0].usuario_validacion );
        });

        listarObras();

        $.get( appUrl + 'cotizacion/'+$("#txtNumeroCotizacion").val()+'/'+$("#txtAno").val()+'/cotizacionProductos/', function (data) {
            for(var x=0;x<data.length;x++){
                cadena="<tr>";
                cadena+="<td>"+data[x].prod_codigo+"</td>";
                cadena+="<td>" + "<input class='form-control input-sm' type='text' maxlength='20' style='width: 150px'></td>" 
                cadena+="<td>"+data[x].prod_nombre+"</td>";
                cadena+="<td align='right'>"+data[x].cp_cantidad+"</td>";
                cadena+="<td>"+data[x].u_nombre+"</td>";
                cadena+="<td align='right'>"+number_format(data[x].cp_precio,0)+"</td>";
                cadena+="<td>"+data[x].cp_glosa_reajuste+"</td>";                 
                cadena+="</tr>";
                $("#tablaDetalle").append(cadena);
            }
        });        
    }

    function nuevaObra(){
        $("#txtDescripcionObra").val( $("#txtObra").val() );
        $("#txtCliente").val( $("#txtNombreCliente").val() );
        $("#txtNombreContacto").val('');
        $("#txtCorreoContactoObra").val('');
        $("#txtTelefonoObra").val('');
        $("#mdNuevaObra").modal("show"); 
        $("#txtNombreObra").focus();
    }

    function cerrarNuevaObra(){
        $("#mdNuevaObra").modal("hide");
    }

    function agregarNuevaObra(){
        var ruta="agregarObra";

        $.ajax({
            url: ruta,
            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
            type: 'POST',
            dataType: 'json',
            data: { nombre: $("#txtNombreObra").val(), 
                    emp_codigo: $("#idCliente").val(),
                    nombreContacto: $("#txtNombreContactoObra").val(),
                    correoContacto: $("#txtCorreoContactoObra").val(),
                    telefonoContacto: $("#txtTelefonoObra").val(),
                    descripcion: $("#txtDescripcionObra").val()
                  },
            success:function(dato){
                $("#txtNombreContacto").val( $("#txtNombreContactoObra").val() );
                $("#txtCorreoContacto").val( $("#txtCorreoContactoObra").val() );
                $("#txtTelefono").val( $("#txtTelefonoObra").val() );
                cerrarNuevaObra();
            }
        })
    }

    function listarObras(){
        $("#idObra").empty();
        var ruta="listarObras";
        $.ajax({
            url: ruta,
            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
            type: 'POST',
            dataType: 'json',
            data: { 
                    emp_codigo: $("#idCliente").val()
                  },
            success:function(dato){
                for(var x=0;x<dato.length;x++){
                    $("#idObra").append( "<option value=" + dato[x].idObra + ">" + dato[x].nombre +"</option>" );
                }
            }
        })        
    }

    function datosObra(){

        var ruta="datosObra";
        $.ajax({
            url: ruta,
            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
            type: 'POST',
            dataType: 'json',
            data: { 
                    idObra: $("#idObra").val()
                  },
            success:function(dato){

                    $("#txtNombreContacto").val( dato[0].nombreContacto );
                    $("#txtCorreoContacto").val( dato[0].correoContacto );
                    $("#txtTelefono").val( dato[0].telefonoContacto );

            }
        })        
    }  


    function crearNotaVenta(){

        var tabla=document.getElementById('tablaDetalle');
        var cont=0;
        for(var x=1; x<tabla.rows.length; x++){
            if(tabla.rows[x].cells[1].getElementsByTagName('input')[0].value==""){
                cont++
            }
        }

        if(cont>0){
            alert('Debe ingresar todas las Fórmulas');
            return;
        }

        var tabla = document.getElementById('tablaDetalle');
        var cadena='[';

        for (var i = 1; i < tabla.rows.length; i++){

            cadena+='{';
            cadena+="'prod_codigo':'"+  tabla.rows[i].cells[0].innerHTML  + "', ";
            cadena+="'cantidad':'"+  tabla.rows[i].cells[3].innerHTML  + "', ";
            cadena+="'formula':'"+  tabla.rows[i].cells[1].innerHTML  + "', ";
            cadena+="'u_codigo':'"+  tabla.rows[i].cells[4].innerHTML  + "'";
            cadena+='}, ';

        }

        cadena=cadena.slice(0,-2);
        cadena+=']';

        var ruta="grabarNuevaNotaVenta";
        
        alert("llega aqui");

        $.ajax({
            url: ruta,
            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
            type: 'POST',
            dataType: 'json',
            data: { cot_numero: $("#txtNumeroCotizacion").val(),
                    idObra: $("#idObra").val()
                  },
            success:function(dato){

            }
        })
    }
