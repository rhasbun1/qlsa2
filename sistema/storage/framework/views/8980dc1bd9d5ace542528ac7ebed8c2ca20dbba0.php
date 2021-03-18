<?php $__env->startSection('title', 'Error'); ?>

<?php $__env->startSection('message', 'Ocurrió un error inesperado, vuelva a registrarse. Si continua el error favor informe al área de soporte'); ?>

<?php echo $__env->make('errors::layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>