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
 
    <script src="http://cdn.syncfusion.com/ej2/dist/ej2.min.js" type="text/javascript"></script>
    <link href="https://cdn.syncfusion.com/ej2/material.css" rel="stylesheet">
	<link href="<?php echo e(asset('/')); ?>js/syncfusion/bootstrap-theme/ej.web.all.min.css" rel="stylesheet" />
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>

   <!-- <script src="https://cdn.syncfusion.com/js/assets/external/jquery-1.10.2.min.js"></script>
    <script src="http://cdn.syncfusion.com/js/assets/external/jsrender.min.js"></script>
    <script src="http://cdn.syncfusion.com/17.3.0.9/js/web/ej.web.all.min.js"></script>
	<script src="<?php echo e(asset('/')); ?>js/es/i18n/ej.culture.es-CL.js"></script> 
	<script src="<?php echo e(asset('/')); ?>js/es/l10n/ej.localetexts.es-ES.js"></script>-->

	<!-- Datatable -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	
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

  <body class="overflow-hidden">
	<!-- Overlay Div -->
	<!--  <div id="overlay" class="transparent"></div> -->
	

	<div id="wrapper" class="preload">
		<div id="top-nav" class="fixed skin-6">
			<a href="#" class="brand">
				<span><img src="<?php echo e(asset('/')); ?>img/logo02.png" border="0" width="70%" height="70%"></span>
				<span class="text-toggle"></span>
			</a><!-- /brand -->					
			<button type="button" class="navbar-toggle pull-left" id="sidebarToggle">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<button type="button" class="navbar-toggle pull-left hide-menu" id="menuToggle">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<ul class="nav-notification clearfix">
				<li class="profile dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<strong><?php echo e(Session::get('nombreUsuario')); ?></strong>
						<span><i class="fa fa-chevron-down"></i></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a class="clearfix" href="#">
								<input type="hidden" id="idUsuarioSession" name="idUsuarioSession" value="<?php echo e(Session::get('idUsuario')); ?>" >
								<input type="hidden" id="idPerfilSession" value="<?php echo e(Session::get('idPerfil')); ?>" data-grupo="<?php echo e(Session::get('grupoUsuario')); ?>">
								<img src="<?php echo e(asset('/')); ?>img/user.jpg" alt="User Avatar">
								<div class="detail">
									<strong><?php echo e(Session::get('nombreUsuario')); ?></strong>
									<?php if( Session::get('empresaUsuario')!='0' ): ?>
										<p class="grey"><?php echo e(Session::get('empresaNombre')); ?></p> 
									<?php else: ?>
										<p class="grey"><?php echo e(Session::get('nombrePerfil')); ?><br><?php echo e(Session::get('correoUsuario')); ?></p> 
									<?php endif; ?>	
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li><a tabindex="-1" class="main-link logoutConfirm_open" href="<?php echo e(asset('/')); ?>terminarSesion"><i class="fa fa-lock fa-lg"></i> Cerrar Sesión</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /top-nav-->
		
		<aside class="fixed skin-6">
			<div class="sidebar-inner scrollable-sidebar">
				<div class="size-toggle">
					<a class="btn btn-sm" id="sizeToggle">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="btn btn-sm pull-right logoutConfirm_open"  href="<?php echo e(asset('/')); ?>terminarSesion">
						<i class="fa fa-power-off"></i>
					</a>
				</div><!-- /size-toggle -->	
				<div class="main-menu">
					<ul>
						<?php if( Session::get('idPerfil')!='13' ): ?>
							<?php if( Session::get('grupoUsuario')!='CL' and Session::get('idPerfil')!='6' ): ?>
								<li class="active">
									<a href="<?php echo e(asset('/')); ?>dashboard">
										<span class="menu-icon">
											<i class="fa fa-desktop fa-lg"></i> 
										</span>
										<span class="text">
											Inicio
										</span>
										<span class="menu-hover"></span>
									</a>
								</li>
							<?php endif; ?>
							<?php if( Session::get('grupoUsuario')=='C' ): ?>
								<li class="openable open">
									<a href="#">
										<span class="menu-icon">
											<i class="fa fa-clock-o fa-lg"></i> 
										</span>
										<span class="text">
											Comercial
										</span>
										<span class="menu-hover"></span>
									</a>
									<ul class="submenu">
										<li><a href="<?php echo e(asset('/')); ?>listarNotasdeVenta"><span class="submenu-label">Notas de Venta</span></a></li>
										<li><a href="<?php echo e(asset('/')); ?>listarPedidos"><span class="submenu-label">Pedidos</span></a></li>
									</ul>							
								</li>
							<?php endif; ?>
							<?php if( Session::get('grupoUsuario')=='P' ): ?>
							<li class="openable open">
								<a href="#">
									<span class="menu-icon">
										<i class="fa fa-clock-o fa-lg"></i> 
									</span>
									<span class="text">
										Operaciones
									</span>
									<span class="menu-hover"></span>
								</a>
								<ul class="submenu">
									<?php if( Session::get('idPerfil')=='13'): ?>
										<li><a href="<?php echo e(asset('/')); ?>registroSalida"><span class="submenu-label">Registro de Salida</span></a></li>
									<?php elseif( Session::get('idPerfil')=='7' or Session::get('idPerfil')=='6' or Session::get('idPerfil')=='5'): ?>
										<?php if( Session::get('idPerfil')!='6'): ?>
											<li><a href="<?php echo e(asset('/')); ?>listarNotasdeVenta"><span class="submenu-label">Notas de Venta</span></a></li>
										<?php endif; ?>
										<li><a href="<?php echo e(asset('/')); ?>programacion"><span class="submenu-label">Programación de Pedidos</span></a></li>
										<li><a href="<?php echo e(asset('/')); ?>registroSalida"><span class="submenu-label">Registro de Salidas</span></a></li>
									<?php elseif( Session::get('idPerfil')=='6' ): ?>
										<li><a href="<?php echo e(asset('/')); ?>programacion"><span class="submenu-label">Programación de Pedidos</span></a></li>    
									<?php else: ?>
										<?php if( Session::get('idPerfil')!='9'): ?>
											<li><a href="<?php echo e(asset('/')); ?>listarNotasdeVenta"><span class="submenu-label">Notas de Venta</span></a></li>
										<?php endif; ?>
										<li><a href="<?php echo e(asset('/')); ?>programacion"><span class="submenu-label">Programación de Pedidos</span></a></li>
									<?php endif; ?>
								</ul>							
							</li>
							<?php endif; ?>
							<?php if( Session::get('idPerfil')=='9' ): ?>
							<li class="openable open">
								<a href="#">
									<span class="menu-icon">
										<i class="fa fa-clock-o fa-lg"></i> 
									</span>
									<span class="text">
										Laboratorio
									</span>
									<span class="menu-hover"></span>
								</a>
								<ul class="submenu">
									<li><a href="<?php echo e(asset('/')); ?>guiasEnProceso"><span class="submenu-label">Certificados pendientes</span></a></li>
									<li><a href="<?php echo e(asset('/')); ?>modificarCertificado"><span class="submenu-label">Gestión de certificados</span></a></li>
								</ul>
							</li>							
							<?php endif; ?>
							<?php if( Session::get('grupoUsuario')=='CL' ): ?>
								<li><a href="<?php echo e(asset('/')); ?>clienteNotasdeVenta"><span class="submenu-label">Notas de Venta</span></a></li>
								<li><a href="<?php echo e(asset('/')); ?>clientePedidos"><span class="submenu-label">Pedidos</span></a></li>
						
							<?php endif; ?>							
							<li class="openable open">
								<a href=#">
									<span class="menu-icon">
										<i class="fa fa-clock-o fa-lg"></i> 
									</span>
									<span class="text">
										Informes
									</span>
									<span class="menu-hover"></span>
								</a>
								<ul class="submenu">
								    <?php if( Session::get('idPerfil')!='6' and Session::get('idPerfil')!='9' ): ?>
									<li><a href="<?php echo e(asset('/')); ?>historicoNotasdeVenta"><span class="submenu-label">Histórico de Notas de Venta</span></a></li>
									<?php endif; ?>
									<li><a href="<?php echo e(asset('/')); ?>historicoPedidos"><span class="submenu-label">Histórico de Pedidos Despachados</span></a></li>

									<li><a href="<?php echo e(asset('/')); ?>despachosPorMes"><span class="submenu-label">Despachos por mes</span></a></li>
									<li><a href="<?php echo e(asset('/')); ?>despachosPorAno"><span class="submenu-label">Despachos por año</span></a></li>
								</ul>								
							</li>
							<?php if( Session::get('idPerfil')!='6' and
								Session::get('idPerfil')!='14' and
								Session::get('idPerfil')!='15' and 
								Session::get('idPerfil')!='9'): ?>

								<li class="openable open">
									<a href="#">
										<span class="menu-icon">
											<i class="fa fa-file-text fa-lg"></i> 
										</span>
										<span class="text">
											Maestros
										</span>
										<span class="menu-hover"></span>
									</a>
									<ul class="submenu">
										<li><a href="<?php echo e(asset('/')); ?>listaEmpresas"><span class="submenu-label">Clientes</span></a></li>
										<?php if( Session::get('idPerfil')=='1' or
											Session::get('idPerfil')=='2' or
											Session::get('idPerfil')=='4' or
											Session::get('idPerfil')=='18'): ?>
										    <li><a href="<?php echo e(asset('/')); ?>listaCondicionesdePago"><span class="submenu-label">Condiciones de Pago</span></a></li>
										<?php endif; ?>
										<li><a href="<?php echo e(asset('/')); ?>listadeObras"><span class="submenu-label">Obras y Plantas (Clientes)</span></a></li>
										<?php if( Session::get('idPerfil')=='1' or Session::get('idPerfil')=='18'): ?>
											<li><a href="<?php echo e(asset('/')); ?>listaPlantas"><span class="submenu-label">Plantas QLSA</span></a></li>
										<?php endif; ?>
										<?php if( Session::get('idPerfil')=='1' or
											Session::get('idPerfil')=='2' or
											Session::get('idPerfil')=='4' or
											Session::get('idPerfil')=='5' or
											Session::get('idPerfil')=='11' or
											Session::get('idPerfil')=='18'): ?>
											<li><a href="<?php echo e(asset('/')); ?>listaProductos"><span class="submenu-label">Productos</span></a></li>
										<?php endif; ?>
										<?php if( Session::get('idPerfil')=='1' or
											Session::get('idPerfil')=='2' or
											Session::get('idPerfil')=='3' or
											Session::get('idPerfil')=='18' ): ?>																				
											<li><a href="<?php echo e(asset('/')); ?>listaUsuarios"><span class="submenu-label">Usuarios</span></a></li>
										<?php endif; ?>


										<?php if( Session::get('grupoUsuario')!='CL' and Session::get('idPerfil')!='9' and Session::get('idPerfil')!='6' ): ?>
										<li><a href="<?php echo e(asset('/')); ?>listaEmpresasTransporte"><span class="submenu-label">Empresas de Transporte</span></a></li>
										<?php endif; ?>

									    <?php if( Session::get('idPerfil')=='1'): ?>									
											<li><a href="<?php echo e(asset('/')); ?>parametros"><span class="submenu-label">Parámetros</span></a></li>
										<?php endif; ?>
									    <?php if( Session::get('idPerfil')!='0'): ?>									
											<li><a href="<?php echo e(asset('/')); ?>registroAcciones"><span class="submenu-label">Consultar Registro de Acciones</span></a></li>
										<?php endif; ?>										
										<?php if(Session::get('idPerfil')=='1' or Session::get('idPerfil')=='5' or Session::get('idPerfil')=='7' or Session::get('idPerfil')=='12'): ?>
											<li><a href="<?php echo e(asset('/')); ?>eliminacionGuiaDespacho"><span class="submenu-label">Liberar Nº de GD</span></a></li>
										<?php endif; ?>

										<?php if( Session::get('idPerfil')=='2' or Session::get('idPerfil')=='5' or Session::get('idPerfil')=='4' 
											or Session::get('idPerfil')=='18' or Session::get('idPerfil')=='11'): ?>
											<li><a href="<?php echo e(asset('/')); ?>costosMensuales"><span class="submenu-label">Costos Mensuales</span></a></li>
										<?php endif; ?>	
										<li><a href="<?php echo e(asset('/')); ?>listaRamplas"><span class="submenu-label">Ramplas</span></a></li>
										<li class="openable">
											<a href="#">
												<span class="submenu-label">Fletes, Distancias y Tiempos</span>
											</a>
											<ul class="submenu third-level">
												<li><a href="<?php echo e(asset('/')); ?>notaVentaVigenteCargos"><span class="submenu-label">Notas de Venta Vigentes</span></a></li>
												<li><a href="<?php echo e(asset('/')); ?>notaVentaCerradaCargos"><span class="submenu-label">Notas de Venta Cerradas</span></a></li>
												<li><a href="<?php echo e(asset('/')); ?>notaVentaCargosUrgente"><span class="submenu-label">Urgentes</span></a></li>
											</ul>
										</li>							
									</ul>
								</li>
							<?php endif; ?>
						<?php else: ?>
							<li class="active">
								<a href="<?php echo e(asset('/')); ?>registroSalida">
									<span class="menu-icon">
										<i class="fa fa-desktop fa-lg"></i> 
									</span>
									<span class="text">
										Registro de Salida
									</span>
									<span class="menu-hover"></span>
								</a>
							</li>													
						<?php endif; ?>	
					</ul>
					
					<!--<div class="alert alert-info">
						<img src="<?php echo e(asset('/')); ?>img/logo01.png" border="0" width="100%" height="100%">
					</div> -->
				</div><!-- /main-menu -->
			</div><!-- /sidebar-inner -->
		</aside>

		<div id="main-container">
			<?php echo $__env->yieldContent('contenedorprincipal', ''); ?>
		</div><!-- /main-container -->
		<!-- Footer
		================================================== -->
		<footer style="display:none">
		</footer>
		
		
		<!--Modal-->
		<div class="modal fade" id="newFolder">
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4>Create new folder</h4>
      				</div>
				    <div class="modal-body">
				        <form>
							<div class="form-group">
								<label for="folderName">Folder Name</label>
								<input type="text" class="form-control input-sm" id="folderName" placeholder="Folder name here...">
							</div>
						</form>
				    </div>
				    <div class="modal-footer">
				        <button class="btn btn-sm btn-success" data-dismiss="modal" aria-hidden="true">Close</button>
						<a href="#" class="btn btn-danger btn-sm">Save changes</a>
				    </div>
			  	</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div><!-- /wrapper -->

	<a href="" id="scroll-to-top" class="hidden-print"><i class="fa fa-chevron-up"></i></a>
	

	
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	
	<!-- Jquery -->

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

	<script src="<?php echo e(asset('/')); ?>js/app/app.js"></script>

  </body>
</html>
