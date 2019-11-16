  
<?php $__env->startSection('contenedorprincipal'); ?>

<div class="control-section">
	<input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
    <div class="content-wrapper">
        <div id="Grid">
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <!-- Datepicker -->
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-datepicker.min.js"></script>  

    <!-- Timepicker -->
    <script src="<?php echo e(asset('/')); ?>js/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo e(asset('/')); ?>js/app/funciones.js"></script>

    <script>
		this.default = function () {

			var data=[];

            $.ajax({
                url: urlApp +'obtenerDespachosPorMes',
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        anoInicio: '2018',
                        anoTermino: '2019',
                        unidad: '0',
                        idPlanta: '0' 
                      },
                success:function(dato){
                		data=dato;
                    }

                },
                error: function(jqXHR, text, error){
                    alert('Ha ocurrido un error!, vuelva a presionar el botón Buscar Selección');
                }                
            })

		    var grid = new ej.grids.Grid({
		        dataSource: data,
		        allowPaging: true,
		        columns: [
		            { field: 'ano', headerText: 'Año', width: 70, textAlign: 'Right' },
		            { field: 'nombrePlanta', headerText: 'Planta', width: 150 },
		            { field: 'nombreCliente', headerText: 'Cliente', width: 200, textAlign: 'Right' },
		            { field: 'nombreObra', headerText: 'Obra', width: 200, textAlign: 'Right', format: 'C2' },
		            { field: 'nombreProducto', headerText: 'Producto', width: 150, textAlign: 'Center' },
		            { field: 'TotalDespachado', headerText: 'Total Despachado', width: 120, textAlign: 'Center' },
		            { field: 'unidad', headerText: 'Unidad', width: 100, textAlign: 'Center' },
		        ],
		        pageSettings: { pageCount: 3 }
		    });
		    grid.appendTo('#Grid');
		};    	
    </script>

<?php $__env->stopSection(); ?>    
<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>