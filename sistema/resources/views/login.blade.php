
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Font Awesome -->
	<link href="css/font-awesome.min.css" rel="stylesheet">
	
	<!-- Perfect -->
	<link href="css/app.min.css" rel="stylesheet">

  </head>

  <script>
  	  	function validarIngreso(){
	        $.ajax({
	            url: urlApp + "verificarusuario",
	            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
	            type: 'POST',
	            dataType: 'json',
	            data: { email: $("#email").val(),
	            	    password: $("#password").val()
	                  },
	            success:function(dato){
	            	    if(dato[0].usu_codigo){
	            	    	document.getElementById('divErrorAcceso').innerHTML="<strong>Advertencia!</strong> Los datos ingresados no son correctos.</strong>";
	            	    	document.getElementById('divErrorAcceso').style.display="block";
	            	    	$("#email").val('');
	            	    	$("#password").val('');
	            	    	return;
	            	    }
	            	    if(dato[0].emp_codigo!="0"){
	            	     	location.href= urlApp + "dashboard";
	            	    }else{
	            	    	if(dato.length==1){
						        $.ajax({
						            url: urlApp + "cargarPerfil",
						            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
						            type: 'POST',
						            dataType: 'json',
						            data: { idPerfil:  dato[0].per_codigo,
						            		nombrePerfil: dato[0].per_nombre,
						            		grupo: dato[0].grupo
						                  },
						            success:function(info){
						            	if(dato[0].per_codigo=='13'){
						            		location.href= urlApp + "registroSalida"; 
						            	}else{
						            		location.href= urlApp + "dashboard"; 
						            	}
										       		 
						            }
						        })
	            	    	}else{
				            	$(dato).each(function (idx, esp) {
				            	 	$("#idPerfil").append("<option value='" + esp.per_codigo +"' data-grupo='" + esp.grupo + "'>" + esp.per_nombre + "</option>");
				            	})
					  	  		document.getElementById('datosUsuario').style.display="none";
					  	  		document.getElementById('selPerfil').style.display="block";	 	            	     	
					  	  		document.getElementById('divLogout').style.display="block";	            	    		
	            	    	}

	            	    };
           		},
		        error: function(xhr, ajaxOptions, thrownError) {
        	    	document.getElementById('divErrorAcceso').innerHTML="<strong>Error!</strong> No hay acceso al servidor, pruebe más tarde.</strong>";
        	    	document.getElementById('divErrorAcceso').style.display="block";
		        }
	        })

  	  	} 


  	  	function ingresar(){
	        $.ajax({
	            url: urlApp + "cargarPerfil",
	            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
	            type: 'POST',
	            dataType: 'json',
	            data: { idPerfil: $("#idPerfil").val(),
	            		nombrePerfil: $("#idPerfil option:selected").html().trim(),
	            		grupo: $("#idPerfil option:selected").attr("data-grupo")
	                  },
	            success:function(dato){
		            	if($("#idPerfil").val()=='13'){
		            		location.href= urlApp + "registroSalida"; 
		            	}else{
		            		location.href= urlApp + "dashboard"; 
		            	} 
	            }
	        })  	  		
  	  	}

  </script>
  <body>
	<div class="login-wrapper">
		<div class="text-center">
			<img src="{{ asset('/') }}img/logo01.png" border="0">
		</div>
		<div class="login-widget">	
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<div class="pull-left">
						<i class="fa fa-lock fa-lg"></i> Login

					</div>
					<div id="divLogout" class="pull-right" style="display: none">
						<a class="btn btn-sm pull-right logoutConfirm_open"  href="{{ asset('/') }}terminarSesion">
							<i class="fa fa-power-off"></i>
						</a>
					</div>
				</div>
				<div class="panel-body">
					<div id="datosUsuario" style="display:block">
						<div class="alert alert-warning" id="divErrorAcceso" style="display: none">
							
						</div>
						<input type="hidden" id="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label>Email</label>
							<input type="text" placeholder="Email" class="form-control input-sm" id="email" name="email">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" placeholder="Password" class="form-control input-sm" id="password" name="password">
						</div>
	
						<div class="seperator"></div>
						<div class="form-group">
						</div>

						<hr/>
							
						<button class="btn btn-success btn-sm pull-right" onclick="validarIngreso()"><i class="fa fa-sign-in"></i> Ingresar</button>
					</div>
					<div id="selPerfil" style="display:none">
						<div class="form-group">
							<label>Seleccione un perfil...</label>
							<select class="form-control input-sm bounceIn animation-delay2" id="idPerfil" name="idPerfil">
							</select>
						</div>						
						<button class="btn btn-success btn-sm pull-right" onclick="ingresar();"><i class="fa fa-sign-in"></i> Continuar</button>

					</div>
				</div>
			</div><!-- /panel -->
		</div><!-- /login-widget -->
	</div><!-- /login-wrapper -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <!-- Jquery -->
	<script src="js/jquery-1.10.2.min.js"></script>
    
    <!-- Bootstrap -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
   
	<!-- Modernizr -->
	<script src='js/modernizr.min.js'></script>
   
    <!-- Pace -->
	<script src='js/pace.min.js'></script>
   
	<!-- Popup Overlay -->
	<script src='js/jquery.popupoverlay.min.js'></script>
   
    <!-- Slimscroll -->
	<script src='js/jquery.slimscroll.min.js'></script>
   
	<!-- Cookie -->
	<script src='js/jquery.cookie.min.js'></script>
	<script src="{{ asset('/') }}js/app/funciones.js"></script>
	<!-- Perfect -->
	<script src="js/app/app.js"></script>
  </body>
</html>
