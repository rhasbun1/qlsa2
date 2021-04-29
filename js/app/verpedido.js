function cargarListas(){
	empresaConductores();
	empresaCamiones();
}



function empresaConductores(){
    $.ajax({
    	async: true,
        url: urlApp + "EmpresaConductores",
        headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
        type: 'POST',
        dataType: 'json',
        data: { 
                idEmpresaTransporte: $("#idEmpresaTransporte").val()
              },
        success:function(dato){
        	$("#idConductor").empty();
            for(var x=0;x<dato.length;x++){
                $("#idConductor").append( "<option value=" + dato[x].idConductor + ">" + dato[x].nombre +"</option>" );
            }
        }
    })   	
}

function empresaCamiones(){
    $.ajax({
    	async: true,
        url: urlApp + "EmpresaCamiones",
        headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
        type: 'POST',
        dataType: 'json',
        data: { 
                idEmpresaTransporte: $("#idEmpresaTransporte").val()
              },
        success:function(dato){
        	$("#idCamion").empty();
            for(var x=0;x<dato.length;x++){
                $("#idCamion").append( "<option value=" + dato[x].idCamion + ">" + dato[x].patente +"</option>" );
            }
        }
    })   	
}

function aprobarPedidoCliente(){
    $.ajax({
        async: true,
        url: urlApp + "aprobarPedidoCliente",
        headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
        type: 'POST',
        dataType: 'json',
        data: { 
                idPedido: $("#idPedido").val()
              },
        success:function(dato){
            swal(
                {
                    title: 'El pedido del cliente ha sido Aprobado, ahora puede verlo en Pedidos en Proceso.',
                    text: '',
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'Ok',
                    cancelButtonText: '',
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function(isConfirm)
                {
                    if(isConfirm){
                        location.href = urlApp + "listaIngresosClienteporAprobar";
                        return;
                        
                    }
                }
            )             
           
        }
    })      
}

function agregarNota(){
    if($("#txtNota").val().trim()==''){
        swal(
            {
                title: 'La nota no puede estar en blanco!' ,
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
                return
            }
        )          
        return;
    }
    $.ajax({
        url: urlApp + "agregarNota",
        headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
        type: 'POST',
        dataType: 'json',
        data: { idPedido: $("#idPedido").val(),
                nota: $("#txtNota").val()
              },
        success:function(dato){
            cadena="<tr>";
            cadena+="<td>" + dato[0].fechaHora + "</td>";
            cadena+="<td>" + dato[0].nombreUsuario + "</td>";
            cadena+="<td>" + $("#txtNota").val() + "</td>";
            cadena+="<td>" + "<button class='btn btn-warning btn-sm' onclick='eliminarNota(" + dato[0].idNota + ", this.parentNode.parentNode.rowIndex)'>Eliminar</button></td>";
            cadena+="</tr>";
            $("#tablaNotas").append(cadena);
            $("#txtNota").val('');
            $("#contNotas").html(document.getElementById('tablaNotas').rows.length-1);
        }
    })
}

function eliminarNota(idNota, fila){
    $.ajax({
        url: urlApp + "eliminarNota",
        headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
        type: 'POST',
        dataType: 'json',
        data: { idNota: idNota
              },
        success:function(dato){
            document.getElementById('tablaNotas').deleteRow(fila);
            swal(
                {
                    title: 'La nota ha sido eliminada!' ,
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
                    return
                }
            )
        }
    })    
}

function aprobarPedido(idPedido){
    $.ajax({
        url: urlApp + "aprobarPedido",
        headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
        type: 'POST',
        dataType: 'json',
        data: { idPedido: idPedido
              },
        success:function(dato){
            console.log(dato.identificador);
            if(dato.identificador == 0){
                swal(
                    {
                        title: '¡¡El pedido ya fue aprobado!!' ,
                        text: 'por favor refresque la pagina',
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
                            return;                         
                        }
                    }
                );
            }else{
                swal(
                    {            
                        title: 'El pedido ha sido Aprobado!' ,
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
                        location.href= urlApp + "listarPedidos";
                        return;
                    }
                )               
            }
        }
    })
}
