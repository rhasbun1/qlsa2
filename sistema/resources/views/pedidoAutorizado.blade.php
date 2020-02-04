<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Logística QLSA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/') }}bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Font Awesome -->
	<link href="{{ asset('/') }}css/font-awesome.min.css" rel="stylesheet">
	
	<!-- Pace -->
	<link href="{{ asset('/') }}css/pace.css" rel="stylesheet">
	
	<!-- Color box -->
	<link href="{{ asset('/') }}css/colorbox/colorbox.css" rel="stylesheet">
	
	<!-- Morris -->
	<link href="{{ asset('/') }}css/morris.css" rel="stylesheet"/>	
	<!-- Perfect -->
	<link href="{{ asset('/') }}css/app.min.css" rel="stylesheet">
	<link href="{{ asset('/') }}css/app-skin.css" rel="stylesheet">

	<!-- Datepicker -->
	<link href="{{ asset('/') }}css/datepicker.css" rel="stylesheet"/>
	
	<!-- Timepicker -->
	<link href="{{ asset('/') }}css/bootstrap-timepicker.css" rel="stylesheet"/>
    <script type="text/javascript" src="{{ asset('/') }}js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}css/sweetalert.css">
   
	<!-- Datatable -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<link href="{{ asset('/') }}css/dataTables.min.css" rel="stylesheet">    
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css">
	<style>
		.dt-button.red {
	        color: red;
	    }
	 
	    .dt-button.orange {
	        color: orange;
	    }
	 
	    .dt-button.green {
	        color: green;
	    }   
	</style>	
	
  </head>
  <body>
		<div id="top-nav" class="fixed skin-6">
			<a href="#" class="brand">
				<span><img src="{{ asset('/') }}img/logo02.png" border="0" width="70%" height="70%"></span>
				<span class="text-toggle"></span>
			</a><!-- /brand -->					
		</div><!-- /top-nav-->  	
  		<div style="padding: 40px">
  			<br><br>
	  		<h4>El pedido fue autorizado y se ha enviado un correo a los usuarios para iniciar su proceso.</h4>
		  	<br><br>
		  	<button class="btn btn-success btn-sm" onclick="Cerrar();">Cerrar</button>
	  	</div>
  </body>
  <script >
  	function Cerrar(){
  		window.close();
  	}
  </script>
  </html>
