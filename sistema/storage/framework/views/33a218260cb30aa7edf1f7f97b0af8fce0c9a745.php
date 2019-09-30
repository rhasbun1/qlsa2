<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>QL now!</title>
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	
    <!-- Bootstrap core CSS -->
    <link href="<?php echo e(asset('/')); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Font Awesome -->
	<link href="<?php echo e(asset('/')); ?>css/font-awesome.min.css" rel="stylesheet">
	
	<!-- Pace -->
	<link href="<?php echo e(asset('/')); ?>css/pace.css" rel="stylesheet">
	
	<!-- Color box -->
	<link href="<?php echo e(asset('/')); ?>css/colorbox/colorbox.css" rel="stylesheet">
	
	<!-- Morris -->
	<link href="<?php echo e(asset('/')); ?>css/morris.css" rel="stylesheet"/>	
	<!-- Perfect -->
	<link href="<?php echo e(asset('/')); ?>css/app.min.css" rel="stylesheet">
	<link href="<?php echo e(asset('/')); ?>css/app-skin.css" rel="stylesheet">

	<!-- Datepicker -->
	<link href="<?php echo e(asset('/')); ?>css/datepicker.css" rel="stylesheet"/>
	
	<!-- Timepicker -->
	<link href="<?php echo e(asset('/')); ?>css/bootstrap-timepicker.css" rel="stylesheet"/>

	
    <script type="text/javascript" src="<?php echo e(asset('/')); ?>js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/')); ?>css/sweetalert.css"> 
  
	<!-- Datatable -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<link href="<?php echo e(asset('/')); ?>css/datatables.min.css" rel="stylesheet">    
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
	<link rel="shortcut icon" href="<?php echo e(asset('/')); ?>favicon.ico">
  </head>

  <body>

	<?php echo $__env->yieldContent('contenedorprincipal', ''); ?>

	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

	<!-- Bootstrap -->
    <script src="<?php echo e(asset('/')); ?>bootstrap/js/bootstrap.js"></script>
   
	<!-- Flot -->
	<script src="<?php echo e(asset('/')); ?>js/jquery.flot.min.js"></script>
   
	<!-- Morris -->
	<script src="<?php echo e(asset('/')); ?>js/rapheal.min.js"></script>	
	<script src="<?php echo e(asset('/')); ?>js/morris.min.js"></script>	
	
	<!-- Colorbox -->
	<script src="<?php echo e(asset('/')); ?>js/jquery.colorbox.min.js"></script>	

	<!-- Sparkline -->
	<script src="<?php echo e(asset('/')); ?>js/jquery.sparkline.min.js"></script>
	
	<!-- Pace -->
	<script src="<?php echo e(asset('/')); ?>js/uncompressed/pace.js"></script>
	
	<!-- Popup Overlay -->
	<script src="<?php echo e(asset('/')); ?>js/jquery.popupoverlay.min.js"></script>
	
	<!-- Slimscroll -->
	<script src="<?php echo e(asset('/')); ?>js/jquery.slimscroll.min.js"></script>
	
	<!-- Modernizr -->
	<script src="<?php echo e(asset('/')); ?>js/modernizr.min.js"></script>
	
	<!-- Cookie -->
	<script src="<?php echo e(asset('/')); ?>js/jquery.cookie.min.js"></script>
	<script src="<?php echo e(asset('/')); ?>js/dataTables.buttons.min.js"></script>
	<script src="<?php echo e(asset('/')); ?>js/buttons.html5.min.js"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
	<section>
	    <?php echo $__env->yieldContent('javascript'); ?>
	</section>    	
  </body>
</html>
