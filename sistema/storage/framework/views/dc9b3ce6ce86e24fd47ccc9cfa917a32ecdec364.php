<html>
<title>Nota de Venta <?php echo e($notaventa[0]->idNotaVenta); ?></title>
<style type="text/css">
@page  {
	header: page-header;
	footer: page-footer;
}
</style>
    <body>
        <h4></h4>

<style type="text/css">
body{
	font-size: 14px
}
.tg  {border-collapse:collapse;border-spacing:0;border:none;}
.tg td{font-family:Arial, sans-serif;font-size:10px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:10px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.tg .tg-cpu2{text-align: left;border-color:#000000;vertical-align:top;font-size:12px;}
</style>
 
<h2>Nota de venta Nº <?php echo e($notaventa[0]->idNotaVenta); ?></h2> 
<table class="tg" width="100%" >
	<tbody>
  <tr>
    <th class="tg-cpu2"><b>Cliente</b></th>
    <th class="tg-cpu2" ><?php echo e($notaventa[0]->emp_nombre); ?></th>
    <th class="tg-cpu2" style="text-align:right"><b>Rut</b></th>
    <th class="tg-cpu2"><?php echo e($notaventa[0]->emp_rut); ?></th>
  </tr>
  <tr>
    <th class="tg-cpu2"><b>Cód. Softland</b></th>
    <th class="tg-cpu2"><?php echo e($notaventa[0]->codigoSoftland); ?></th>
    <th class="tg-cpu2" style="text-align:right"><b>Fecha</b></th>
    <th class="tg-cpu2"><?php echo e($notaventa[0]->fechahora_creacion); ?></th>
  </tr>
  <tr>
    <th class="tg-cpu2"><b>Obra/Planta</b></th>
    <th class="tg-cpu2" ><?php echo e($notaventa[0]->Obra); ?></th>    
    <th class="tg-cpu2" style="text-align:right"><b>Cotización</b></th>
    <th class="tg-cpu2"><?php echo e($notaventa[0]->cot_numero); ?> / <?php echo e($notaventa[0]->cot_año); ?></th>
  </tr>
  <tr>
    <th class="tg-cpu2"><b>Contacto</b></th>
    <th class="tg-cpu2" ><?php echo e($notaventa[0]->nombreContacto); ?></th>    
    <th class="tg-cpu2" style="text-align:right"><b>Orden de Compra Cliente</b></th>
    <th class="tg-cpu2"><?php echo e($notaventa[0]->cot_numero); ?> / <?php echo e($notaventa[0]->ordenCompraCliente); ?></th>
  </tr>
  <tr>
    <th class="tg-cpu2"><b>Teléfono</b></th>
    <th class="tg-cpu2" ><?php echo e($notaventa[0]->telefonoContacto); ?></th>    
    <th class="tg-cpu2" style="text-align:right"><b>Ejecutivo QL</b></th>
    <th class="tg-cpu2" ><?php echo e($notaventa[0]->usuario_encargado); ?></th>
  </tr>  
  <tr>
    <th class="tg-cpu2"><b>Correo</b></th>
    <th class="tg-cpu2" ><?php echo e($notaventa[0]->correoContacto); ?></th>
    <th class="tg-cpu2" style="text-align:right"><b>Creada por</b></th>
    <th class="tg-cpu2" ><?php echo e($notaventa[0]->usuario_creacion); ?></th>
  </tr>
  <tr>
    <?php if( Session::get('grupoUsuario')=='C'): ?>    
      <th class="tg-cpu2"><b>Cond.de Pago</b></th>
      <th class="tg-cpu2" ><?php echo e($notaventa[0]->condiciondePago); ?></th>
    <?php else: ?>
      <th class="tg-cpu2"><b></b></th>
      <th class="tg-cpu2" ></th>    
    <?php endif; ?>  
    <th class="tg-cpu2" style="text-align:right"><b>Aprobada por</b></th>
    <th class="tg-cpu2" ><?php echo e($notaventa[0]->usuario_validacion); ?></th>
  </tr>
</tbody>
</table>

<br>
<br>


<style type="text/css">
.tg2  {border-collapse:collapse;border-spacing:0;border-color:#ccc;}
.tg2 td{font-family:Arial, sans-serif;font-size:18px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg2 th{font-family:Arial, sans-serif;font-size:18px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tg2 .tg-mrzz{background-color:#f9f9f9;text-align:left}
.tg2 .tg-s268{text-align:left}
</style>

<table class="tg2"  width="100%">
  <tr>
    <th class="tg-s268">Producto</th>
    <th class="tg-s268">Diseño</th>
    <th class="tg-s268">Cantidad</th>
    <th class="tg-s268">Unidad</th>
    <?php if( Session::get('grupoUsuario')=='C' or Session::get('grupoUsuario')=='CL'): ?>
        <th class="tg-s268" style="text-align:right;">Precio Base ($)</th>
        <th class="tg-s268" style="text-align:right;">Precio Reajustado ($)</th>
        <th class="tg-s268" style="text-align:right;">% var</th>
    <?php endif; ?>    
    <th class="tg-s268">Por Entregar</th>
    <th class="tg-s268">Total Entregado</th>
    <th class="tg-s268">Saldo</th>
    <?php if( Session::get('grupoUsuario')=='C' or Session::get('grupoUsuario')=='CL'): ?>
        <th class="tg-s268">Glosa de Reajuste</th>
    <?php endif; ?>    
    <th class="tg-s268">Planta</th>
    <th class="tg-s268">Entrega</th>
  </tr>
  <?php $__currentLoopData = $detalle; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
    <td class="tg-mrzz"><?php echo e($eq->prod_nombre); ?></td>
    <td class="tg-mrzz"><?php echo e($eq->formula); ?></td>
    <td class="tg-mrzz" style="text-align:right"><?php echo e($eq->cantidad); ?></td>
    <td class="tg-mrzz"><?php echo e($eq->u_nombre); ?></td>
    <?php if( Session::get('grupoUsuario')=='C' or Session::get('grupoUsuario')=='CL'): ?>
        <td class="tg-mrzz" style="text-align:right;"><?php echo e(number_format( $eq->precio, 0, ',', '.' )); ?></td>
        <td class="tg-mrzz" style="text-align: right;"><?php echo e(number_format( $eq->precioActual, 0, ',', '.' )); ?></td>
        <td class="tg-mrzz" style="text-align: center;"><?php echo e(number_format( $eq->porcentajeVariacion, 1, ',', '.' )); ?></td>
    <?php endif; ?>
    <td class="tg-mrzz" style="text-align:right"><?php echo e($eq->porEntregar); ?></td>
    <td class="tg-mrzz" style="text-align:right"><?php echo e($eq->totalRetirado); ?></td>
    <td class="tg-mrzz" style="text-align:right"><?php echo e($eq->saldo); ?></td>
    <?php if( Session::get('grupoUsuario')=='C' or Session::get('grupoUsuario')=='CL'): ?>
        <td class="tg-mrzz" style="width: 250px"> <?php echo e($eq->cp_glosa_reajuste); ?> </td>
    <?php endif; ?>
    <td class="tg-mrzz"><?php echo e($eq->nombrePlanta); ?></td>
    <td class="tg-mrzz"><?php echo e($eq->nombreFormaEntrega); ?></td>
  </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 
</table>
<br>
<br>
<p><b>Observaciones</b></p>
<p><?php echo e($notaventa[0]->observaciones); ?></p>

<htmlpageheader name="page-header">
	 
</htmlpageheader>

<htmlpagefooter name="page-footer">
	 
</htmlpagefooter>


    </body>
</html>