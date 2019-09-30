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
 
    <script src="https://cdn.syncfusion.com/ej2/dist/ej2.min.js" type="text/javascript"></script>
    <link href="https://cdn.syncfusion.com/ej2/material.css" rel="stylesheet">
	<link href="{{ asset('/') }}js/syncfusion/bootstrap-theme/ej.web.all.min.css" rel="stylesheet" />

	<!-- Datatable -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.3.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<link href="{{ asset('/') }}css/datatables.min.css" rel="stylesheet">    
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
	<link rel="shortcut icon" href="{{ asset('/') }}favicon.ico">
  </head>

  <body class="overflow-hidden">
	<!-- Overlay Div -->
	<!--  <div id="overlay" class="transparent"></div> -->
	

	<div id="wrapper" class="preload">
		<div id="top-nav" class="fixed skin-6">
			<a href="#" class="brand">
				<span><img src="{{ asset('/') }}img/logo02.png" border="0" width="70%" height="70%"></span>
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
						<strong>{{ Session::get('nombreUsuario') }}</strong>
						<span><i class="fa fa-chevron-down"></i></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a class="clearfix" href="#">
								<input type="hidden" id="idUsuarioSession" name="idUsuarioSession" value="{{ Session::get('idUsuario') }}" >
								<input type="hidden" id="idPerfilSession" value="{{ Session::get('idPerfil') }}" >
								<img src="{{ asset('/') }}img/user.jpg" alt="User Avatar">
								<div class="detail">
									<strong>{{ Session::get('nombreUsuario') }}</strong>
									@if ( Session::get('empresaUsuario')!='0' )
										<p class="grey">{{ Session::get('empresaNombre') }}</p> 
									@else
										<p class="grey">{{ Session::get('nombrePerfil') }}<br>{{ Session::get('correoUsuario') }}</p> 
									@endif	
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li><a tabindex="-1" class="main-link logoutConfirm_open" href="{{ asset('/') }}terminarSesion"><i class="fa fa-lock fa-lg"></i> Cerrar Sesión</a></li>
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
					<a class="btn btn-sm pull-right logoutConfirm_open"  href="{{ asset('/') }}terminarSesion">
						<i class="fa fa-power-off"></i>
					</a>
				</div><!-- /size-toggle -->	
				<div class="main-menu">
					<ul>
						@if ( Session::get('idPerfil')!='13' )
							@if ( Session::get('grupoUsuario')!='CL' and Session::get('idPerfil')!='6' )
								<li class="active">
									<a href="{{ asset('/') }}dashboard">
										<span class="menu-icon">
											<i class="fa fa-desktop fa-lg"></i> 
										</span>
										<span class="text">
											Inicio
										</span>
										<span class="menu-hover"></span>
									</a>
								</li>
							@endif
							@if ( Session::get('grupoUsuario')=='C' )
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
										<li><a href="{{ asset('/') }}listarNotasdeVenta"><span class="submenu-label">Notas de Venta</span></a></li>
										<li><a href="{{ asset('/') }}listarPedidos"><span class="submenu-label">Pedidos</span></a></li>
									</ul>							
								</li>
							@endif
							@if ( Session::get('grupoUsuario')=='P' )
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
									@if( Session::get('idPerfil')=='13')
										<li><a href="{{ asset('/') }}registroSalida"><span class="submenu-label">Registro de Salida</span></a></li>
									@elseif ( Session::get('idPerfil')=='7' or Session::get('idPerfil')=='6' or Session::get('idPerfil')=='5')
										@if( Session::get('idPerfil')!='6')
											<li><a href="{{ asset('/') }}listarNotasdeVenta"><span class="submenu-label">Notas de Venta</span></a></li>
										@endif
										<li><a href="{{ asset('/') }}programacion"><span class="submenu-label">Programación de Pedidos</span></a></li>
										<li><a href="{{ asset('/') }}registroSalida"><span class="submenu-label">Registro de Salidas</span></a></li>
									@elseif ( Session::get('idPerfil')=='6' )
										<li><a href="{{ asset('/') }}programacion"><span class="submenu-label">Programación de Pedidos</span></a></li>    
									@else
										@if( Session::get('idPerfil')!='9')
											<li><a href="{{ asset('/') }}listarNotasdeVenta"><span class="submenu-label">Notas de Venta</span></a></li>
										@endif
										<li><a href="{{ asset('/') }}programacion"><span class="submenu-label">Programación de Pedidos</span></a></li>
									@endif
								</ul>							
							</li>
							@endif
							@if ( Session::get('idPerfil')=='9' )
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
									<li><a href="{{ asset('/') }}guiasEnProceso"><span class="submenu-label">Certificados pendientes</span></a></li>
									<li><a href="{{ asset('/') }}modificarCertificado"><span class="submenu-label">Gestión de certificados</span></a></li>
								</ul>
							</li>							
							@endif
							@if ( Session::get('grupoUsuario')=='CL' )
								<li><a href="{{ asset('/') }}clienteNotasdeVenta"><span class="submenu-label">Notas de Venta</span></a></li>
								<li><a href="{{ asset('/') }}clientePedidos"><span class="submenu-label">Pedidos</span></a></li>
						
							@endif							
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
								    @if ( Session::get('idPerfil')!='6' and Session::get('idPerfil')!='9' )
									<li><a href="{{ asset('/') }}historicoNotasdeVenta"><span class="submenu-label">Histórico de Notas de Venta</span></a></li>
									@endif
									<li><a href="{{ asset('/') }}historicoPedidos""><span class="submenu-label">Histórico de Pedidos Despachados</span></a></li>
								</ul>								
							</li>
							@if ( Session::get('idPerfil')!='6' and
								Session::get('idPerfil')!='14' and
								Session::get('idPerfil')!='15' and 
								Session::get('idPerfil')!='9')

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
										<li><a href="{{ asset('/') }}listaEmpresas"><span class="submenu-label">Clientes</span></a></li>
										@if ( Session::get('idPerfil')=='1' or
											Session::get('idPerfil')=='2' or
											Session::get('idPerfil')=='4' or
											Session::get('idPerfil')=='18')
										    <li><a href="{{ asset('/') }}listaCondicionesdePago"><span class="submenu-label">Condiciones de Pago</span></a></li>
										@endif
										<li><a href="{{ asset('/') }}listadeObras"><span class="submenu-label">Obras y Plantas (Clientes)</span></a></li>
										@if ( Session::get('idPerfil')=='1' or Session::get('idPerfil')=='18')
											<li><a href="{{ asset('/') }}listaPlantas"><span class="submenu-label">Plantas QLSA</span></a></li>
										@endif
										@if ( Session::get('idPerfil')=='1' or
											Session::get('idPerfil')=='2' or
											Session::get('idPerfil')=='4' or
											Session::get('idPerfil')=='5' or
											Session::get('idPerfil')=='11' or
											Session::get('idPerfil')=='18')
											<li><a href="{{ asset('/') }}listaProductos"><span class="submenu-label">Productos</span></a></li>
										@endif
										@if ( Session::get('idPerfil')=='1' or
											Session::get('idPerfil')=='2' or
											Session::get('idPerfil')=='3' or
											Session::get('idPerfil')=='18' )																				
											<li><a href="{{ asset('/') }}listaUsuarios"><span class="submenu-label">Usuarios</span></a></li>
										@endif


										@if ( Session::get('grupoUsuario')!='CL' and Session::get('idPerfil')!='9' and Session::get('idPerfil')!='6' )
										<li><a href="{{ asset('/') }}listaEmpresasTransporte"><span class="submenu-label">Empresas de Transporte</span></a></li>
										@endif

									    @if ( Session::get('idPerfil')=='1')									
											<li><a href="{{ asset('/') }}parametros"><span class="submenu-label">Parámetros</span></a></li>
										@endif
										@if (Session::get('idPerfil')=='1' or Session::get('idPerfil')=='5' or Session::get('idPerfil')=='7' or Session::get('idPerfil')=='12')
											<li><a href="{{ asset('/') }}eliminacionGuiaDespacho"><span class="submenu-label">Liberar Nº de GD</span></a></li>
										@endif										
									</ul>
								</li>
							@endif
						@else
							<li class="active">
								<a href="{{ asset('/') }}registroSalida">
									<span class="menu-icon">
										<i class="fa fa-desktop fa-lg"></i> 
									</span>
									<span class="text">
										Registro de Salida
									</span>
									<span class="menu-hover"></span>
								</a>
							</li>													
						@endif	
					</ul>
					
					<!--<div class="alert alert-info">
						<img src="{{ asset('/') }}img/logo01.png" border="0" width="100%" height="100%">
					</div> -->
				</div><!-- /main-menu -->
			</div><!-- /sidebar-inner -->
		</aside>

		<div id="main-container">
			@yield('contenedorprincipal', '')
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
    <script src="{{ asset('/') }}bootstrap/js/bootstrap.js"></script>
   
	<!-- Flot -->
	<script src="{{ asset('/') }}js/jquery.flot.min.js"></script>
   
	<!-- Morris -->
	<script src="{{ asset('/') }}js/rapheal.min.js"></script>	
	<script src="{{ asset('/') }}js/morris.min.js"></script>	
	
	<!-- Colorbox -->
	<script src="{{ asset('/') }}js/jquery.colorbox.min.js"></script>	

	<!-- Sparkline -->
	<script src="{{ asset('/') }}js/jquery.sparkline.min.js"></script>
	
	<!-- Pace -->
	<script src="{{ asset('/') }}js/uncompressed/pace.js"></script>
	
	<!-- Popup Overlay -->
	<script src="{{ asset('/') }}js/jquery.popupoverlay.min.js"></script>
	
	<!-- Slimscroll -->
	<script src="{{ asset('/') }}js/jquery.slimscroll.min.js"></script>
	
	<!-- Modernizr -->
	<script src="{{ asset('/') }}js/modernizr.min.js"></script>
	
	<!-- Cookie -->
	<script src="{{ asset('/') }}js/jquery.cookie.min.js"></script>
	<script src="{{ asset('/') }}js/dataTables.buttons.min.js"></script>
	<script src="{{ asset('/') }}js/buttons.html5.min.js"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
	<section>
	    @yield('javascript')
	</section>    	

	<script src="{{ asset('/') }}js/app/app.js"></script>

  </body>
</html>
