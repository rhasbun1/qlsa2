      

<?php $__env->startSection('contenedorprincipal'); ?>
<div class="padding-md">
	<input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">

  
<?php if(Session::get('grupoUsuario')!='CL' and (Session::get('idPerfil') == '2' || Session::get('idPerfil') == '4' || Session::get('idPerfil') == '18')): ?>

	
<div class="col-md-6">
		
		<a href="#modalToneladasDespachadasMensual"  data-toggle="modal">
			<div class="panel-stat3 bg-warning btn" style="width:100%">
				<h2 class="m-top-none"><?php echo e($datos[0]->cantidadGranelDespachadoEsteMes); ?> ton</h2>
        <font size=4><strong>Toneladas (granel) despachadas este Mes</strong></font>
        <br>
			</div>
      
		</a>
		</span>
	</div>

	<div class="col-md-6">
		<a href="#modalToneladasDespachadasAnual"  data-toggle="modal">
			<div class="panel-stat3 bg-warning btn" style="width:100%">
				<h2 class="m-top-none"><?php echo e($datos[0]->cantidadGranelAcumuladoAnual); ?> ton</h2>
        <font size=4><strong>Toneladas (granel) despachadas este Año</strong></font>
        <br>
			</div>
		</a>
	</div>


	
	<div class="col-md-3">
		<a href="#modalPendienteAprobacion" data-target="" id="notasVen"  data-toggle="modal">
			<div class="panel-stat3 bg-info btn" style="width:100%" >
				<h2 class="m-top-none"><?php echo e($datos[0]->cantidadNventasPendientesAprobacion); ?></h2>
        <h4>Notas de Venta </h4>
        <h4>pendientes de aprobación</h4>
        
			</div>
		</a>
	</div>
	
  <div class="col-md-3">
    <a href="#modalJefePedidosAtrasados" data-toggle="modal">
        <div class="panel-stat3 bg-info btn" style="width:100%">
          <h2 class="m-top-none"><?php echo e($datos[0]->cantidadPedidosAtrasados); ?></h2>
          <h3>Pedidos Atrasados</h3>
          <br>
          

        </div>
      </a>
    </div>

    <div class="col-md-3">
      <a href="#modalPedidosSinAprobar" data-toggle="modal">
          <div class="panel-stat3 bg-info btn" style="width:100%">
            <h2 class="m-top-none"><?php echo e($datos[0]->cantidadPedidosSinAprobar); ?></h2>
            <p> <h4>Pedidos pendientes de</h4>
            <h4>Aprobación de Crédito</h4></p>
          </div>
        </a>
      </div>
	

	
	
<?php endif; ?>
<?php if(Session::get('grupoUsuario')!='CL' and (Session::get('idPerfil') == '3' || Session::get('idPerfil') == '19')): ?>
	
	<div class="col-md-6">
		
		<a href="#modalToneladasDespachadasMensual"  data-toggle="modal">
			<div class="panel-stat3 bg-warning btn" style="width:100%">
				<h2 class="m-top-none"><?php echo e($datos[0]->cantidadGranelDespachadoEsteMes); ?> ton</h2>
        <font size=5><strong>Toneladas (granel) despachadas este Mes</strong></font>
        <br>
			</div>
		</a>
		</span>
	</div>

	<div class="col-md-6">
		<a href="#modalToneladasDespachadasAnual"  data-toggle="modal">
			<div class="panel-stat3 bg-warning btn" style="width:100%">
				<h2 class="m-top-none"><?php echo e($datos[0]->cantidadGranelAcumuladoAnual); ?> ton</h2>
        <font size=5><strong>Toneladas (granel) despachadas este Año</strong></font>
        <br>
			</div>
		</a>
	</div>


	<div class="col-md-3">
		<a href="<?php echo e(asset('/')); ?>#modalPedidoClientePendientes"  data-toggle="modal">
			<div class="panel-stat3 bg-info btn" style="width:100%">
				<h2 class="m-top-none"><?php echo e($datos[0]->cantidadPedidosIngresadosClienteSinAprobar); ?></h2>
        <h5>Pedidos Pendientes de </h5>
        
        <p><font size=5><strong>Preaprobación</strong></font></p>

        <font size=1>(ingresados por clientes)</font>
        
			</div>
		</a>

	</div>

  <div class="col-md-3">
    <a href="#modalJefePedidosAtrasados" data-toggle="modal">
        <div class="panel-stat3 bg-info btn" style="width:100%">
          <h2 class="m-top-none"><?php echo e($datos[0]->cantidadPedidosAtrasados); ?></h2>
          <br>
          <h4>Pedidos Atrasados </h4>
          <br>
        </div>
      </a>
    </div>


    <div class="col-md-3">
      <a href="#modalPedidosSinAprobar" data-toggle="modal">
          <div class="panel-stat3 bg-info btn" style="width:100%">
            <h2 class="m-top-none"><?php echo e($datos[0]->cantidadPedidosSinAprobar); ?></h2>
            <p> <h4>Pedidos pendientes de</h4>
              <h4>Aprobación de Crédito</h4></p>
              <br>    
          </div>
        </a>
      </div>
	
      

	
<?php endif; ?>
<?php if(Session::get('grupoUsuario')!='CL' and (Session::get('idPerfil') == '18' || Session::get('idPerfil') == '2' || Session::get('idPerfil') == '4')): ?>
	
<?php endif; ?>
<?php if((Session::get('idPerfil') == '14' || Session::get('idPerfil') == '15')): ?>
	<div class="col-md-3">
	<a href="#modalPedidoClienteEnProceso"   data-toggle="modal">
			<div class="panel-stat3 bg-info btn" style="width:100%">
				<h2 class="m-top-none"><?php echo e($datos[0]->cantidadPedidosProcesoCliente); ?></h2>
        <h4>Pedidos en Proceso</h4>
        <br>
			</div>
		</a>
	</div>
	<div class="col-md-3">
	<a href="<?php echo e(asset('/')); ?>historicoPedidos"   data-toggle="modal">
			<div class="panel-stat3 bg-info btn" style="width:100%">
				<h2 class="m-top-none"><?php echo e($datos[0]->cantidadPedidosDespachadosCliente); ?></h2>
        <h4>Pedidos Despachados</h4>
        <br>
			</div>
		</a>
  </div>
  
  <div class="col-md-3">

    <a href="#modalPedidosSinAprobar1" data-toggle="modal">
        <div class="panel-stat3 bg-info btn" style="width:100%">
          <h2 class="m-top-none"><?php echo e($datos[0]->pedidosSinAprobarClientes); ?></h2>
          <p> <h4>Pedidos pendientes de</h4>
            <h4>Aprobación de Crédito</h4></p>
        </div>
      </a>
    </div>


	

<?php endif; ?>
<?php if((Session::get('idPerfil') == '6' || Session::get('idPerfil') == '7' || Session::get('idPerfil') == '8' || Session::get('idPerfil') == '5')): ?>
	<div class="col-md-3">
			<a href="<?php echo e(asset('/')); ?>#modalJefePedidosEnProceso" data-toggle="modal">
				<div class="panel-stat3 bg-info btn" style="width:100%">
					<h2 class="m-top-none"><?php echo e($datos1[0]->cantidadPedidosEnProceso); ?> </h2>
          <h4>Pedidos En Proceso</h4>
          <br>
				</div>
			</a>
		</div>

		<div class="col-md-3">
		<a href="#modalPedidosAGranelSinAsignacionHorario"  data-toggle="modal">
			<div class="panel-stat3 bg-info btn" style="width:100%">
				<h2 class="m-top-none"><?php echo e($datos2[0]->cantidadPedidosGranelSinAsignacion); ?></h2>
        <h4>Pedidos a granel </h4>
        <br>
			</div>
		</a>
	</div>
	
	<div class="col-md-3">
	<a href="#modalJefePedidosAtrasados" data-toggle="modal">
			<div class="panel-stat3 bg-info btn" style="width:100%">
				<h2 class="m-top-none"><?php echo e($datos3[0]->cantidadPedidosAtrasados); ?></h2>

				<h4>Pedidos Atrasados </h4>
        <br>
			</div>
		</a>
	</div>



<?php endif; ?>

<?php if((Session::get('idPerfil') == '9')): ?>

<div class="col-md-3">
		<a href="#modalJefeLabCertificados"  data-toggle="modal">	
			<div class="panel-stat3 bg-info btn" style="width:100%">
				<h2 class="m-top-none"><?php echo e($datos[0]->cantidadPedidosSinCertificados); ?></h2>
        <h4>Certificados pendientes</h4>
        <br>
			</div>
		</a>
	</div>
	
	<div class="col-md-3 text-center">
	<a href="#modalJefeLabModificadoHaceUnaHora"  data-toggle="modal">
			<div class="panel-stat3 bg-info btn" style="width:100%">
				<h2 class="m-top-none"><?php echo e($datos[0]->cantidadPedidosModificadosUltimaHora); ?></h2>
        <h5>Pedidos Modificados</h5>
        <h5> durante las últimas 24 horas</h5>
			</div>
		</a>
	</div>


<?php endif; ?>

<?php if((Session::get('idPerfil') == '11')): ?>

<div class="col-md-6">
  <a href="#modalPedidosSinAprobar" data-toggle="modal">
      <div class="panel-stat3 bg-warning btn" style="width:102%">
        <h2 class="m-top-none"><?php echo e($datos[0]->cantidadPedidosSinAprobar); ?></h2>
        <h3><strong>Pedidos pendientes de Aprobación de Crédito</strong></h3>
        
      </div>
    </a>
  </div>


<div class="col-md-3">
		<a href="#modalToneladasDespachadasMensual" data-toggle="modal">
			<div class="panel-stat3 bg-info btn" style="width:100%">
				<h2 class="m-top-none"><?php echo e($datos[0]->cantidadGranelDespachadoEsteMes); ?> ton</h2>
        <h4>Toneladas (granel) </h4>
        <h4>despachadas este Mes</h4>
			</div>
		</a>
	</div>
	
	<div class="col-md-3">
		<a href="#modalToneladasDespachadasAnual" data-toggle="modal">
			<div class="panel-stat3 bg-info btn" style="width:100%">
				<h2 class="m-top-none"><?php echo e($datos[0]->cantidadGranelAcumuladoAnual); ?> ton</h2>
      <h4>Toneladas (granel) </h4>
      <h4>despachadas este Año</h4>
			</div>
		</a>
  </div>
  

  


<?php endif; ?>

<?php if((Session::get('idPerfil') == '10')): ?>
<div class="row">
    <div class="col-md-6">
        <a href="#NotaVentaSinFlete"  data-toggle="modal">
          <div class="panel-stat3 bg-warning btn" style="width:100%">
            <h2 class="m-top-none"><?php echo e($datos[0]->cantidadNotaVentaConFleteSinAsignar); ?></h2>
            <font size=5><strong>Asignaciones de Flete pendientes</strong></font>
            <br>
            <br>
          </div>
        </a>
    </div>


    <div class="col-md-3">
        <a href="#modalPedidoSinTransporteAsignado" data-toggle="modal">
          <div class="panel-stat3 bg-info btn" style="width:100%">
            <h2 class="m-top-none"><?php echo e($datos[0]->cantidadPedidosSinTransporteAsignado); ?></h2>
            <h4>Pedidos sin Transporte </h4>
            <h4>asignado</h4>
          </div>
        </a>
    </div>

    <div class="col-md-3">

        <a href="#modalAtrasadoTransporte" data-toggle="modal">
          <div class="panel-stat3 bg-info btn" style="width:100%">
            <h2 class="m-top-none"><?php echo e($datos[0]->cantidadPedidosAtrasadosTransporte); ?></h2>
              
            <h4>Pedidos Atrasados</h4>
            <h4>(despacho pendiente)</h4>
            
          </div>
        </a>
    </div>
</div>








<?php endif; ?>

</div>


<!-- Modals -->



<div class="modal fade" id="modalAtrasadoTransporte"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:90%" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Pedidos Atrasados (despacho pendiente)</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tablaModalAtrasadoTransporte" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                <th >Pedido</th>             
                <th >Estado</th>
                <th >Fecha Creación</th>
                <th >Planta de Origen </th>
                <th >Cliente</th>
                <th >Obra/Planta</th>
                <th >Producto</th>
                <th >Cantidad</th>
                <th>Unidad</th>
                <th >Fecha Entrega</th>
                
              
               
                    
                </thead>
                
                <tbody>
                <?php $__currentLoopData = $listaPedidoAtrasadoTransporte; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                               <tr>
                                
                                    <td style="width: 50px"><?php echo e($item->idPedido); ?></td>
                                    <td style="width: 120px"><?php echo e($item->estado); ?></td>
                                    <td style="width: 120px"><?php echo e($item->fechahora_creacion); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombrePlanta); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombreCliente); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombreObra); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombreProducto); ?></td>
                                    <td style="width: 120px"><?php echo e($item->cantidad); ?></td>
                                    <td style="width: 120px"><?php echo e($item->u_nombre); ?></td>
                                    <td style="width: 120px"><?php echo e($item->fechaEntrega); ?></td>
                                    
                                  
                                    
                                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>           
                </tbody>
                
         </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>





  <div class="modal fade" id="modalPedidoSinTransporteAsignado"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Pedidos sin Transporte asignado</h2>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tablaModalPedidoSinTransporteAsignado" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                <th >Id Pedido</th> 
                <th >Cliente</th> 
                <th >Planta de Origen</th> 
                <th>Obra/Planta </th>
                <th >Producto</th>
                <th>Unidad</th>
                <th >Fecha de Carga</th>
              
               
               
                    
                </thead>
                
                
                
                <tbody>
                <?php $__currentLoopData = $listaPedidoSinFechaDeCarga; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                                <tr>
                                    <td style="width: 50px"><?php echo e($item->idPedido); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombreEmpresa); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombrePlanta); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombreObra); ?></td>
                                    <td style="width: 120px"><?php echo e($item->prod_nombre); ?></td>
                                    <td style="width: 120px"><?php echo e($item->u_nombre); ?></td>
                                    <td style="width: 120px"><?php echo e(date('d/m/Y', strtotime($item->fechaCarga))); ?></td>
                                    
                                   
                                    
                                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            
                </tbody>
                
         </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="NotaVentaSinFlete"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Asignaciones de Flete pendientes</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tablaNotaVentaSinFlete" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>

                <th >Nota de Venta</th>  
                <th >Cliente</th>  
                <th >Planta de Origen</th>  
                <th>Obra/Planta</th>       
               

                </thead>
                
                
               
                <tbody>
                <?php $__currentLoopData = $listaNotaVentaSinFlete; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                                <tr>
                                    <td style="width: 120px"><?php echo e($item->idNotaVenta); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombreCliente); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombrePlanta); ?></td> 
                                    <td style="width: 120px"><?php echo e($item->nombreObra); ?></td>
                                   
                                   
                                    
                                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>          
                </tbody>
                
         </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modalJefeLabModificadoHaceUnaHora"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:90%" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h2 class="modal-title" id="exampleModalLabel">Pedidos Modificados durante las últimas 24 horas</h2>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tablaModalJefeLabModificadoHaceUnaHora" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                <th>Pedido</th>
                <th >Tipo</th>             
                <th >Motivo</th>
                <th >Fecha Hora</th>
                <th >Nombre Usuario</th>
                <th>Planta de Origen</th>
                <th>Cliente</th>
                <th>Obra Planta </th>
                <th>Producto </th>
               
               
                    
                </thead>
                
                
                
                <tbody>
                <?php $__currentLoopData = $listaAccionesHaceUnaHora; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
                            
                                <tr>
                                  <td style="width:50px"><?php echo e($item->idPedido); ?></td>
                                  <td style="width:120px "><?php echo e($item->tipo); ?></td>
                                  <td style="width: 120px"><?php echo e($item->motivo); ?></td>
                                  <td style="width:120px "><?php echo e(date('d/m/Y', strtotime($item->fechaHora))); ?></td>
                                  <td style="width: 120px"><?php echo e($item->nombreUsuario); ?></td>
                                  <td style="width: 120px"><?php echo e($item->nombre); ?></td>
                                  <td style="width:120px "><?php echo e($item->nombreEmpresa); ?></td>
                                  <td style="width: 120px"><?php echo e($item->nombreObra); ?></td>
                                  <td style="width:120px "><?php echo e($item->nombreProducto); ?></td>
                                   
                                    
                                </tr>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            
                </tbody>
                
         </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="modalJefeLabCertificados"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:90%" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h2 class="modal-title" id="exampleModalLabel">Certificados Pendientes</h2>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tablaModalJefeLabCertificados" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                <th >Pedido</th>             
                <th >Estado</th>
                <th >Planta de Origen</th>
                <th >Cliente</th>
                <th >Obra/Planta</th>
                <th >Producto</th>
                <th >Cantidad</th>
                <th>Unidad</th>
                
                <th >Horario de Salida</th>

                
               
                    
                </thead>
                
                
              
                <tbody>
                <?php $__currentLoopData = $listaJefeLabCertificadosPorSubir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                                <tr>
                                    <td style="width: 50px"><?php echo e($item->idPedido); ?></td>
                                    <td style="width:120px "><?php echo e($item->estadoPedido); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombrePlanta); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombreCliente); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombreObra); ?></td>
                                    <td style="width:120px "><?php echo e($item->prod_nombre); ?></td>
                                    
                                    <td style="width: 120px;text-align: right;"><?php echo e(number_format( $item->cantidad, 0, ',', '.' )); ?></td>
                                    <td style="width: 120px"><?php echo e($item->u_nombre); ?></td>
                                    <td style="width: 120px"><?php echo e($item->fechaHoraSalida); ?></td>

                                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>            
                </tbody>
               
         </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="modalJefePedidosAtrasados"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:90%" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h2 class="modal-title" id="exampleModalLabel">Pedidos Atrasados (despacho pendiente)</h2>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tablaModalJefePedidosAtrasados" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                <th >Pedido</th>             
                <th >Estado</th>
                <th >Fecha Creación</th>
                <th>Planta de Origen</th>
                <th >Cliente</th>
                <th>Obra/Planta</th>
                <th >Producto</th>
                <th >Cantidad</th>
                <th>Unidad</th>
                <th>Fecha Entrega</th>
                
                
                </thead>
               
                <tbody>
                <?php $__currentLoopData = $listaJefePedidosAtrasados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                                <tr>
                                    <td style="width: 50px"><?php echo e($item->idPedido); ?></td>
                                    <td style="width: 120px"><?php echo e($item->estadoPedido); ?></td>
                                    <td style="width: 120px"><?php echo e($item->fechahora_creacion); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombrePlanta); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombreCliente); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombreObra); ?></td>
                                    <td style="width: 120px"><?php echo e($item->prod_nombre); ?></td>
                                    <td style="width: 30px;text-align: right;"><?php echo e(number_format( $item->cantidad, 0, ',', '.' )); ?></td>
                                    <td style="width: 120px"><?php echo e($item->u_nombre); ?></td>
                                    <td style="width: 120px"><?php echo e($item->fechaEntrega); ?></td>
                                   
                                   
                                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>          
                </tbody>
                
         </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="modalPedidosAGranelSinAsignacionHorario"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:90%" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h2 class="modal-title" id="exampleModalLabel">Pedidos a granel sin Horario de Carga</h2>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tablaModalPedidosAGranelSinAsignacionHorario" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                <th >Pedido</th>             
                <th >Estado</th>
                <th>Planta de Origen</th>
                <th >Cliente</th>
                <th>Obra/Planta</th>
                <th >Producto</th>
                <th >Cantidad</th>
                <th>Unidad</th>
               
                    
                </thead>
                
                <tbody>
                <?php $__currentLoopData = $listaJefeGranelSinAsignacionDeHorario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                                <tr>
                                    <td style="width: 50px"><?php echo e($item->idPedido); ?></td>
                                    <td style="width: 120px"><?php echo e($item->estadoPedido); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombrePlanta); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombreCliente); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombreObra); ?></td>
                                    
                                    <td style="width: 120px"><?php echo e($item->prod_nombre); ?></td>
                                    
                                    <td style="width: 30px;text-align: right;"><?php echo e(number_format( $item->cantidad, 0, ',', '.' )); ?></td>
                                    <td style="width: 120px"><?php echo e($item->u_nombre); ?></td>
                                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>         
                </tbody>
                
         </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="modalJefePedidosEnProceso"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:90%" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Pedidos en Proceso</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tablaModalJefePedidosEnProceso" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                <th >Pedido</th>
                <th >Planta de Origen</th>             
                <th >Estado</th>
                <th >Fecha Creación</th>
                <th >Cliente</th>
                <th> Planta/Obra</th>
                <th >Producto</th>
                <th >Cantidad</th>
                <th>Unidad</th>
                <th>Fecha de Entrega</th>
               
                    
                </thead>
                
                  
               
                <tbody>
                <?php $__currentLoopData = $listaJefePedidoEnProceso; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                                <tr>
                                    <td style="width: 50px"><?php echo e($item->idPedido); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombrePlanta); ?></td>
                                    <td style="width: 120px"><?php echo e($item->estadoPedido); ?></td>
                                    <td style="width: 120px"><?php echo e($item->fechahora_creacion); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombreCliente); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombreObra); ?></td> 
                                    <td style="width: 120px"><?php echo e($item->prod_nombre); ?></td>
                                   
                                    <td style="width: 30px;text-align: right;"><?php echo e(number_format( $item->cantidad, 0, ',', '.' )); ?></td>
                                    <td style="width: 120px"><?php echo e($item->u_nombre); ?></td>
                                    <td style="width: 120px"><?php echo e($item->fechaEntrega); ?></td>
                                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>         
                </tbody>
               
         </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="modalPedidoClienteEnDespacho"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:90%" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Pedidos Atrasados </h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tablaModalPedidoClienteEnDespacho" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                <th >Pedido</th>             
                <th >Estado</th>
              
                <th >Cliente</th>
                <th >Fecha Creación</th>
                <th >Producto</th>
                
              
               
                    
                </thead>
                
                <tbody>
                <?php $__currentLoopData = $listaPedidoClienteEnDespacho; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                                <tr>
                                    <td style="width: 50px"><?php echo e($item->idPedido); ?></td>
                                    <td style="width: 120px"><?php echo e($item->estadoPedido); ?></td>
                                    
                                    <td style="width: 120px"><?php echo e($item->nombreCliente); ?></td>
                                    <td style="width: 120px"><?php echo e($item->fechahora_creacion); ?></td>
                                    
                                    <td style="width: 120px"><?php echo e($item->prod_nombre); ?></td>
                
                                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>         
                </tbody>
                
         </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modalPedidosSinAprobar1"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:90%" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h2 class="modal-title" id="exampleModalLabel">Pedidos Pendientes de Aprobación de Crédito</h2>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tablaModalPedidosSinAprobar" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                <th >Pedido</th> 
                <th >Fecha Creación</th>            
                <th >Estado</th>
                <th >Cliente</th>
                <th>Obra/Planta</th>
                <th >Producto</th>
                <th>Fecha de Entrega</th>
                <th>Total ($)</th>


               
                    
                </thead>
                
                <tbody>
                <?php $__currentLoopData = $listaPedidoSinAprobarClientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                
                                    <td style="width: 50px"><?php echo e($item->idPedido); ?></td>
                                    <td style="width: 120px"><?php echo e($item->fechahora_creacion); ?></td>
                                    <td style="width: 120px"><?php echo e($item->estado); ?></td>
                                    <td style="width: 120px"><?php echo e($item->emp_nombre); ?></td>
                                    <td style="width: 120px"><?php echo e($item->Obra); ?></td>
                                    <td style="width: 120px"><?php echo e($item->prod_nombre); ?></td>
                                    <td style="width: 120px"><?php echo e($item->fechaEntrega); ?></td>
                                    <td style="width: 120px"><?php echo e(number_format($item->total, 0, ",", ".")); ?></td>



                                    
                                  
                                    
                                </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>         
                </tbody>
               
         </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalPedidosSinAprobar"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:90%" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h2 class="modal-title" id="exampleModalLabel">Pedidos Pendientes de Aprobación de Crédito</h2>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tablaModalPedidosSinAprobar1" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                <th >Pedido</th> 
                <th >Fecha Creación</th>            
                <th >Estado</th>
                <th >Cliente</th>
                <th>Obra/Planta</th>
                <th >Producto</th>
                <th>Fecha de Entrega</th>
                <th>Total ($)</th>


               
                    
                </thead>
                
                <tbody>
                <?php $__currentLoopData = $listaPedidoSinAprobar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                
                                    <td style="width: 50px"><?php echo e($item->idPedido); ?></td>
                                    <td style="width: 120px"><?php echo e($item->fechahora_creacion); ?></td>
                                    <td style="width: 120px"><?php echo e($item->estado); ?></td>
                                    <td style="width: 120px"><?php echo e($item->emp_nombre); ?></td>
                                    <td style="width: 120px"><?php echo e($item->Obra); ?></td>
                                    <td style="width: 120px"><?php echo e($item->prod_nombre); ?></td>
                                    <td style="width: 120px"><?php echo e($item->fechaEntrega); ?></td>
                                    <td style="width: 120px"><?php echo e(number_format($item->total,0,",",".")); ?></td>



                                    
                                  
                                    
                                </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>         
                </tbody>
               
         </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modalPedidosSinAprobarCliente"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:90%" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h2 class="modal-title" id="exampleModalLabel">Pedidos sin aprobar</h2>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tablaModalClienteSinAprobar" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                <th >Pedido</th>             
                <th >Estado</th>
              
                <th >Cliente</th>
                <th >Fecha Creación</th>
                <th >Producto</th>
                <th>total ($)</th>
                
              
               
                    
                </thead>
                
                <tbody>
                <?php $__currentLoopData = $listaPedidoSinAprobarCliente; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                
                                    <td style="width: 50px"><?php echo e($item->idPedido); ?></td>
                                    <td style="width: 120px"><?php echo e($item->estado); ?></td>
                                    
                                    <td style="width: 120px"><?php echo e($item->emp_nombre); ?></td>
                                    <td style="width: 120px"><?php echo e($item->fechahora_creacion); ?></td>
                                    <td style="width: 120px"><?php echo e($item->prod_nombre); ?></td>

                                    <td style="width: 120px"><?php echo e(number_format($item->total, 0, ",", ".")); ?></td>
                                    
                                  
                                    
                                  
                                    
                                </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>         
                </tbody>
               
         </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="modalPedidoClienteEnProceso"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:90%" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Pedidos en Proceso</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tablaModalClienteEnProceso" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                <th >Pedido</th>  
                <th >Fecha Creación</th>           
                <th >Estado</th>
                
                <th >Obra</th>
                <th >Producto</th>
                <th>Cantidad</th>
                <th>Unidad</th>
                <th>Fecha de Entrega</th>
                
              
               
                    
                </thead>
                
                <tbody>
                <?php $__currentLoopData = $listaPedidoClienteEnProceso; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                
                                    <td style="width: 50px"><?php echo e($item->idPedido); ?></td>
                                    <td style="width: 120px"><?php echo e($item->fechahora_creacion); ?></td>
                                    <td style="width: 120px"><?php echo e($item->estadoPedido); ?></td>
                                    
                                    <td style="width: 120px"><?php echo e($item->nombreObra); ?></td>
                                    <td style="width: 120px"><?php echo e($item->prod_nombre); ?></td>
                                    <td style="width: 120px"><?php echo e($item->cantidad); ?></td>
                                    <td style="width: 120px"><?php echo e($item->u_nombre); ?></td>
                                    <td style="width: 120px"><?php echo e($item->fechaEntrega); ?></td>
                                    
                                    
                                  

                                </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>         
                </tbody>
               
         </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>






<div class="modal fade" id="modalToneladasDespachadasAnual"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:90%" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h2 class="modal-title" id="exampleModalLabel">Toneladas (granel) despachadas este Año</h2>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tablaModalToneladasDespachadasAnual" class="table table-hover table-condensed table-responsive" style="width: 100%">
	  <thead>
					<th style="width:80px;text-align: right;">Nº de Pedido</th>       
                    <th>Planta Origen</th>
                    <th style="width: 200px">Cliente</th>
                    <th>Obra/Planta</th>
                    <th>Producto</th>
    				        <th style="width: 60px">Cantidad</th>
					          <th>Transporte</th>
                    <th>Conductor</th>
                    <th style="width: 80px">Fecha Salida</th>
    	</thead>
                
                <tbody>
				
                <?php $__currentLoopData = $listatoneladasAnuales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php
                    $fecha = explode(" ", $item->fechaHoraSalida);
                
                ?>
				<tr>
                            <td><?php echo e($item->idPedido); ?></td>
                            <td><?php echo e($item->plantaQLSA); ?></td>
                            <td><?php echo e($item->nombreCliente); ?></td>
                            <td><?php echo e($item->nombreObra); ?></td>
                            <td><?php echo e($item->prod_nombre); ?></td>
                            <td><?php echo e($item->cantidadDespachada); ?></td>
                            <td><?php echo e($item->nombreTransporte); ?></td>
                            <td><?php echo e($item->nombreConductor); ?></td>
                            <td><?php echo e(date('d/m/Y', strtotime($fecha[0]))); ?> <?php echo e($fecha[1]); ?></td>
				</tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        
				
                </tbody>
               
               
			</table> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="modalToneladasDespachadasMensual"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:90%" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Toneladas (granel) despachadas este Mes</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tablaModalToneladasDespachadasMensual" class="table table-hover table-condensed table-responsive" style="width: 100%">
				<thead>
					<th style="width:80px;text-align: right;">Nº de Pedido</th>
                    
                    <th>Planta Origen</th>
                    <th style="width: 200px">Cliente</th>
                    <th>Obra/Planta</th>
                    <th>Producto</th>
    				        <th style="width: 60px">Cantidad</th>
					          <th>Transporte</th>
                    <th>Conductor</th>
                    <th style="width: 80px">Fecha Salida</th>
					
				</thead>
                
                <tbody>
                <?php $__currentLoopData = $listaToneladasaMensuales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $fecha = explode(" ", $item->fechaHoraSalida);
                
                ?>
               
				<tr>  
                            <td><?php echo e($item->idPedido); ?></td>
                            <td><?php echo e($item->plantaQLSA); ?></td>
                            <td><?php echo e($item->nombreCliente); ?></td>
                            <td><?php echo e($item->nombreObra); ?></td>
                            <td><?php echo e($item->prod_nombre); ?></td>
                            <td><?php echo e($item->cantidadDespachada); ?></td>
                            <td><?php echo e($item->nombreTransporte); ?></td>
                            <td><?php echo e($item->nombreConductor); ?></td>
                            <td><?php echo e(date('d/m/Y', strtotime($fecha[0]))); ?> <?php echo e($fecha[1]); ?></td>
							</tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        
                </tbody>
               
               
			</table> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modalPedidosEnProceso"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style="width:90%" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h2 class="modal-title" id="exampleModalLabel">Pedidos en Proceso</h2>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tablaPedidosEnProceso" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                <thead>
                <th >Pedido</th>             
                <th >Estado</th>
                <th >Cliente</th>
                <th >Obra/Planta</th>
                <th >Producto</th>
                <th >Cantidad</th>
                <th >Unidad</th>
                <th>Fecha Entrega</th>
                <th >Forma Entrega</th>
                <th >Planta Origen</th>
                <th >Fecha Carga<br>Programada</th>
                <th >Transporte</th>
                <th >Fecha Creación</th>
                <th >Nº Aux.</th>
                    
                </thead>
                
                <tbody>
				<?php $__currentLoopData = $listaPedidosEnProceso; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
				<tr>
                                    <td style="width: 50px"><?php echo e($item->idPedido); ?></td>
                                                                        
                                    <td style="width: 50px"><?php echo e($item->estadoPedido); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombreCliente); ?></td>
                                    <td style="width: 120px"><?php echo e($item->nombreObra); ?></td>
                                    <td style="width: 70px">
                                        <?php echo e($item->prod_nombre); ?>                                   
                                    </td>
                                    <td style="width: 30px;text-align: right;"><?php echo e(number_format( $item->cantidad, 0, ',', '.' )); ?></td>
                                    <td style="width: 30px;text-align: center"><?php echo e($item->u_nombre); ?></td>
                                    <td style="width: 100px"><?php echo e($item->fechaEntrega); ?> <?php echo e($item->horarioEntrega); ?></td>
                                    <td style="width: 70px"><?php echo e($item->formaEntrega); ?></td>
                                    <td style="width: 70px"><?php echo e($item->nombrePlanta); ?></td>
                                    <td style="width: 100px"><?php echo e($item->fechaCarga); ?> <?php echo e($item->horaCarga); ?> </td>
                                    <td style="width: 150px"><?php echo e($item->apellidoConductor); ?> / <?php echo e($item->empresaTransporte); ?></td>
                                    <td style="width: 50px;text-align: right;"><?php echo e($item->fechahora_creacion); ?></td>
                                    <td style="width: 80px;text-align: center;"><?php echo e($item->numeroAuxiliar); ?></td>
                                </tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                </tbody>
                
         </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modalPendienteAprobacion"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Notas de Venta pendientes de Aprobación</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <table id="tablaNotaVentaPendiente" class="table table-hover table-condensed table-responsive" style="width:100%">
                <thead>

                <th>Fecha Creación</th>
                    <th>Cliente</th>
                    <th>Obra/Planta</th>
                    <th>Ejecutivo QL</th>
                    <th>Estado</th>
                    

                </thead>
                
                <tbody id="notaVentas1">
              
                    <?php $__currentLoopData = $listaNotasdeVenta; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                                        
                          <td><?php echo e($item1->fechahora_creacion); ?></td>        
                          <td><?php echo e($item1->emp_nombre); ?></td>
                          <td><?php echo e($item1->Obra); ?></td>
                          <td><?php echo e($item1->nombreUsuarioEncargado); ?></td>
                          <?php if($item1->aprobada==1): ?>
                                  <td>Aprobado</td>
                          <?php else: ?>
                                  <td>Pendiente de Aprobación</td>
                          <?php endif; ?>  

                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			          
              </tbody>
            </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="modalPedidoClientePendientes"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="ModalPedidoCliente">Pedidos Pendientes de Preaprobación (ingresados por clientes)</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="tablaModalClientePendiente" class="table table-hover table-condensed table-responsive" style="width:100%">
                <thead>

                    <th>Pedido Nº</th>
                    
                    <th>Fecha Creación</th>
                    <th>Cliente</th>
                    <th>Obra/Planta</th>
                    <?php if( Session::get('idPerfil')=='11' ): ?>
                        <th><b>Total c/IVA</b></th>
                    <?php else: ?>
                        <th style="display: none"><b>Total c/IVA</b></th>
                    <?php endif; ?>    
                    <th>Fecha Entrega</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>

                </thead>
                
                <tbody>
				<?php $__currentLoopData = $listaPedidosIngresadosporClientesSinAprobar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <tr>
                            
                            <td><?php echo e($item->idPedido); ?></td>                   
                            <td><?php echo e($item->fechahora_creacion); ?></td>
                            <td><?php echo e($item->emp_nombre); ?></td>
                            <td><?php echo e($item->Obra); ?></td>
                            <?php if( Session::get('idPerfil')=='11' ): ?>
                                <td align="right"><b>$ <?php echo e(number_format( $item->totalNeto + $item->montoIva, 0, ',', '.' )); ?></b></td>
                            <?php else: ?>
                                <td align="right" style="display: none"><b>$ <?php echo e(number_format( $item->totalNeto + $item->montoIva, 0, ',', '.' )); ?></b></td>
                            <?php endif; ?>    
                            <td><?php echo e($item->fechaEntrega); ?></td>
                            <td><?php echo e($item->prod_nombre); ?></td>
                            <td><?php echo e(number_format( $item->cantidad, 0, ',', '.' )); ?></td> 
                            <td><?php echo e($item->u_nombre); ?></td>
                        </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
            </table>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>





<?php $__env->stopSection(); ?>




<?php $__env->startSection('javascript'); ?>
    <!-- Datepicker -->
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-datepicker.min.js"></script> 
    <script src="<?php echo e(asset('/')); ?>locales/bootstrap-datepicker.es.min.js"></script>

    <!-- Timepicker -->
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-timepicker.min.js"></script>  



   <script src="<?php echo e(asset('/')); ?>js/app/funciones.js"></script>

    

    <script>
	
	
        $(document).ready(function() {
          
            
            // DataTable
            var table=$('#tablaModalClientePendiente').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
				dom: 'Bfrtip',
				buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Pedidos Pendientes de Preaprobación (ingresados por clientes)',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4,5,6,7 ]
                        }
                    }
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }        
			});



      // $(document).on('click','#notasVen', e=>
      // {
      //   $.ajax({
      //       url: urlApp + "notaVentas",
      //       type: "POST",
      //       data:{},
      //       dataType: "JSON",
      //       success: function(data) {

      //         var html = '';
      //         var i;
      //         for (i = 0; i < data.length; i++) {
      //           html += '<tr>' +
      //           '<td>'+data[i].fechahora_creacion+'</td>' +
      //           '<td>'+data[i].emp_nombre+'</td>' +
      //           '<td>'+data[i].Obra+'</td>' +
      //           '<td>'+data[i].nombreUsuarioEncargado+'</td>' 
      //           if(data[i].aprobada==1){
      //            + '<td>'+"Aprobado"+'</td>' 
      //           }else{
      //            + '<td>'+"Pendiente de Aprobación"+'</td>'
      //           } 
      //           + '<tr>';
      //         }
      //         $('#notaVentas1').html(html);
      //       }
      //   })
      // });
        
      var table=$('#tablaModalJefeLabModificadoHaceUnaHora').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
				dom: 'Bfrtip',
				buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Pedidos Modificados durante las últimas 24 horas',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    }
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }  
                              
			});
			 // DataTable
			 var table=$('#tablaNotaVentaPendiente').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
				dom: 'Bfrtip',
				buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Notas de Venta pendientes de Aprobación',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    }
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }  
                              
			}); //finData
			
			 // DataTable
			 var table=$('#tablaPedidosEnProceso').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
				dom: 'Bfrtip',
				buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Pedidos en Proceso',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4,5,6,7,8,9,10,11,12,13 ]
                        }
                    }
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }  
                              
			}); //finData
			
			 // DataTable
			 var table=$('#tablaModalToneladasDespachadasMensual').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
				dom: 'Bfrtip',
				buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Toneladas (granel) despachadas este Mes',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4,5,6,7,8 ]
                        }
                    }
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }  
                              
			}); //finData
			
			 // DataTable
			 var table=$('#tablaModalToneladasDespachadasAnual').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
				dom: 'Bfrtip',
				buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Toneladas (granel) despachadas este Año',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ,5,6,7,8]
                        }
                    }
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }  
                              
			}); //finData
			

			 // DataTable
			 var table=$('#tablaModalClienteEnProceso').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
				dom: 'Bfrtip',
				buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Pedidos en Proceso',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ,5,6,7]
                        }
                    }
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }  
                              
			}); //finData

			 // DataTable
			 var table=$('#tablaModalPedidoClienteEnDespacho').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
				dom: 'Bfrtip',
				buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Pedidos Atrasados',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ,5]
                        }
                    }
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }  
                              
			}); //finData

			// DataTable
			var table=$('#tablaModalJefePedidosEnProceso').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
				dom: 'Bfrtip',
				buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Pedidos en Proceso',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ,5,6,7,8,9]
                        }
                    }
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }  
                              
			}); //finData

			// DataTable
			var table=$('#tablaModalPedidosAGranelSinAsignacionHorario').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
				dom: 'Bfrtip',
				buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Pedidos a granel sin Horario de Carga',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ,5,6,7]
                        }
                    }
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }  
                              
			}); //finData

			// DataTable
			var table=$('#tablaModalJefePedidosAtrasados').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
				dom: 'Bfrtip',
				buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Pedidos Atrasados (despacho pendiente)',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ,5,6,7,8,9]
                        }
                    }
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }  
                              
			}); //finData

				// DataTable
				var table=$('#tablaModalJefeLabCertificados').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
				dom: 'Bfrtip',
				buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Certificados Pendientes',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ,5,6,7]
                        }
                    }
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }  
                              
			}); //finData

			
				// DataTable
				var table=$('#tablaModalPedidosSinAprobar1').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
                dom: 'Bfrtip',
                buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Pedidos Pendientes de Aprobación de Crédito',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ,5,6,7]
                        }
                    }               
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }  
                              
			}); //finData
     
				// DataTable
				var table=$('#tablaNotaVentaSinFlete').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
				dom: 'Bfrtip',
				buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Asignaciones de Flete pendientes',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                    }
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }  
                              
			}); //finData

			// DataTable
			var table=$('#tablaModalPedidoSinTransporteAsignado').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
				dom: 'Bfrtip',
				buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Pedidos sin Transporte asignado',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4,5,6 ]
                        }
                    }
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }  
                              
			}); //finData

			// DataTable
			var table=$('#tablaModalAtrasadoTransporte').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
				dom: 'Bfrtip',
				buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Pedidos Atrasados (aún sin despacharse)',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ,5,6,7,8,9]
                        }
                    }
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }  
                              
			}); //finData

      	// DataTable
			var table=$('#tablaModalClienteSinAprobar').DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
				dom: 'Bfrtip',
				buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Pedidos sin aprobar',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    }
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }  
                              
			}); //finData

      
      	// DataTable
			var table=$("#tablaModalPedidosSinAprobar").DataTable({
                orderCellsTop: true,
                fixedHeader: true,  
                lengthMenu: [[6, 12, 20, 40], ["6", "12", "20", "40"]],
				dom: 'Bfrtip',
				buttons: [
                                  
                                            
                    'pageLength',                
                    {
                        extend: 'excelHtml5',
                        title: 'Pedidos pendientes de Aprobación de Crédito',
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: 'Excel',                        
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ,5,6,7]
                        }
                    }
                ],                
                                
                "order": [[ 0, "desc" ]],
                language:{url: "<?php echo e(asset('/')); ?>locales/datatables_ES.json"}
                ,initComplete: function () {
                    actualizarFiltros(this.api());
                }  
                              
			}); //finData

        } );
        function addCommas(nStr) { 
            nStr += ''; 
            var x = nStr.split('.'); 
            var x1 = x[0]; 
            var x2 = x.length > 1 ? '.' + x[1] : ''; 
            var rgx = /(\d+)(\d{3})/; 
            while (rgx.test(x1)) { 
              x1 = x1.replace(rgx, '$1' + ',' + '$2'); 
            } 
            return x1 + x2; 
        } 

    </script>
    
<?php $__env->stopSection(); ?>





<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>