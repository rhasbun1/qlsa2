  
<?php $__env->startSection('contenedorprincipal'); ?>

<div class="control-section">
	<input type="hidden" id="_token" name="_token" value="<?php echo e(csrf_token()); ?>">
    <div class="panel panel-default" id="contenedor3">
        <div class="panel-heading">
            <b>Pedidos Despachadados por Año</b>
        </div>
        <div class="padding-md clearfix">
        	<div class="row">
        		<div class="col-md-3" style="display: inline-block;">
        			Año Inicio&nbsp&nbsp&nbsp
        			<input id="anoInicio" maxlength="4" class="form-control input-sm" style="width: 60px;display: inline;" onkeypress='return isNumberKey(event)'>
        		</div>
        		<div class="col-md-3" style="display: inline-block;">
        			Año Término&nbsp&nbsp&nbsp
        			<input id="anoTermino" maxlength="4" class="form-control input-sm" style="width: 60px;display: inline;" onkeypress='return isNumberKey(event)'>
        		</div>
        		<div class="col-md-3">
        			<label style="width:150px">Ver Todos los tiempos</label><input id="checkTodo" type="checkbox" class="chk" onchange="bloquear();"><span class="custom-checkbox"></span>
        		</div>         		
        	</div>
        	<div class="row" style="padding-top: 15px">
        		<div class="col-md-2">
					Planta QLSA de origen
        		</div>
        		<div class="col-md-2">
	                <select id="idPlanta" class="form-control input-sm">
	                	<option value="0">Todas</option>
	                    <?php $__currentLoopData = $plantas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                       <option value="<?php echo e($item->idPlanta); ?>"><?php echo e($item->nombre); ?> </option>
	                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                             
	                </select>        			
        		</div>
        		<div class="col-md-1">
					Unidad
        		</div>
        		<div class="col-md-2">
        			<select id="tipo" class="form-control input-sm">
        				<option value="1">Granel</option>
        				<option value="2">Tambor</option>
        				<option value="3">Especialidad</option>
        			</select>
        		</div>
        		<div class="col-md-1">
					<button class="btn btn-success btn-sm" onclick="cargarDatos();">Obtener Informe</button>
        		</div>        		         		
        	</div>
        </div>        
    </div>    	
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

    <script src="<?php echo e(asset('/')); ?>js/syncfusion/jquery.globalize.js"></script>
	<script src="<?php echo e(asset('/')); ?>js/syncfusion/lang/globalize.culture.en-US.min.js"></script>

    <style>
        .e-grid .e-headercell {
            height:70px !important;
        }
    </style>    

    <script>


	    var date = '';
	    date += ((new Date()).getMonth().toString()) + '/' + ((new Date()).getDate().toString());
	    date += '/' + ((new Date()).getFullYear().toString());

	    var fecha=new Date();
	    anoInicio.value=fecha.getFullYear().toString();
		anoTermino.value=fecha.getFullYear().toString();

		ej.base.L10n.load({
		    'en-US': {
		        'grid': {
		            'EmptyRecord': 'No hay información para mostrar',
		            'GroupDropArea': 'Arrastre columna aquí para agrupar',
		            'UnGroup': 'Ungroup',
		            'Item': 'Item',
		            'Items': 'Items',
		            'ClearFilter': 'Borrar filtro',
                    "Print": "Imprimir",
                    "Pdfexport": "Exportar a PDF",
                    "Excelexport": "Exportar a Excel",
                    "FilterButton": "Filtrar",
                    "ClearButton": "Quitar",                    	            
                    "SelectAll": "Seleccionar todo",
                    "Search": "Buscar",
		        },
		        'pager': {
		            'currentPageInfo': '{0} de {1}',
		            'totalItemsInfo': '({0} Items)',
		            'firstPageTooltip': 'Ir a primera página',
		            'lastPageTooltip': 'Ir a última página',
		            'nextPageTooltip': 'Siguiente página',
		            'previousPageTooltip': 'Página anterior',
		            'nextPagerTooltip': 'nextPagerTooltip',
		            'previousPagerTooltip': 'previousPagerTooltip'
		        },
		    }
		});

		function bloquear(){
			if( checkTodo.checked ){
				anoInicio.readOnly=true;
				anoTermino.readOnly=true;
			}else{
				anoInicio.readOnly=false;
				anoTermino.readOnly=false;

			}
		}

		function renderGrid(data){
			var columnas;
			if(tipo.value==2){
				columnaTotal={ field: 'TotalDespachado2', headerText: 'Total Despachado', width: 120, textAlign: 'Right' };
				columnas=[
		            { field: 'ano', headerText: 'Año', width: 90, textAlign: 'Right'},
		            { field: 'nombrePlanta', headerText: 'Planta', width: 100 },
		            { field: 'nombreCliente', headerText: 'Cliente', width: 200, textAlign: 'Left' },
		            { field: 'nombreObra', headerText: 'Obra', width: 200, textAlign: 'Left' },
		            { field: 'nombreProducto', headerText: 'Producto', width: 150, textAlign: 'Left' },
					{ field: 'TotalDespachado', headerText: 'Total Despachado Mensual (Tambores)', width: 150, textAlign: 'Right', format: "C2" },		       
					{ field: 'TotalDespachado2', headerText: 'Total Despachado Mensual (Kg)', width: 150, textAlign: 'Right', format: "C2"  },	
		        ];				
			}else{
				columnas=[
		            { field: 'ano', headerText: 'Año', width: 90, textAlign: 'Right'},
		            { field: 'nombrePlanta', headerText: 'Planta', width: 100 },
		            { field: 'nombreCliente', headerText: 'Cliente', width: 200, textAlign: 'Left' },
		            { field: 'nombreObra', headerText: 'Obra', width: 200, textAlign: 'Left' },
		            { field: 'nombreProducto', headerText: 'Producto', width: 150, textAlign: 'Left' },
					{ field: 'TotalDespachado', headerText: 'Total Despachado Mensual', width: 150, textAlign: 'Right', format: "C2" },		
		            { field: 'unidad', headerText: 'Unidad', width: 120, textAlign: 'Center' },
		        ];
			}
		    

		    var grid = new ej.grids.Grid({
		        dataSource: data,
		        locale: 'en-US',
		        allowPaging: true,
		        allowSorting: true,
		        allowGrouping: false,
		        gridLines: 'Vertical',
		        allowFiltering: true,
		        allowTextWrap: true,
		        filterSettings: { type: 'CheckBox' },
		        allowExcelExport: true,
		        allowPdfExport: true,
		        height: 500,
		        rowHeight: 20,       
		        toolbar: ['ExcelExport', 'PdfExport', 'Print'],
		        columns: columnas,
		        pageSettings: { pageCount: 5, pageSize: 10, pageSizes: ['10', '50', 'All'] },
		        aggregates: [{
		            columns: [{
		                type: 'Sum',
		                field: 'TotalDespachado',
		                format: 'C2',
		                footerTemplate: '<b>Total: ${Sum}</b>'
		            }]
		        }]       
		    });

		    document.getElementById('Grid').innerHTML='';
		    grid.appendTo('#Grid');

			grid.toolbarClick = function (args) {
			        if (args.item.id === 'Grid_pdfexport') {
			            grid.pdfExport(getPdfExportProperties());
			        }
			        if (args.item.id === 'Grid_excelexport') {
			            grid.excelExport(getExcelExportProperties());
			        }
			        if (args.item.id === 'Grid_csvexport') {
			            grid.csvExport();
			        }
			    };		    		
		}	

		function cargarDatos(){
			var data=[];

			var inicio=0;
			var termino=0;

			if( !checkTodo.checked ){
					inicio=anoInicio.value;
					termino=anoTermino.value;	
			}

            $.ajax({
                url: urlApp +'api/obtenerDespachosPorAno',
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: { 
                        anoInicio: inicio,
                        anoTermino: termino,
                        unidad: tipo.value,
                        idPlanta: idPlanta.value 
                      },
                success:function(dato){
                		data=dato;
                		renderGrid(data);
                },
                error: function(jqXHR, text, error){
                    alert('Ha ocurrido un error!, vuelva a presionar el botón Buscar Selección');
                }                
            })
		};    

	 	function getExcelExportProperties() {
	 		var inicio = anoInicio.value;
	 		var termino = anoTermino.value;
	 		var planta=idPlanta.options[idPlanta.selectedIndex].text;
	 		if(checkTodo.checked){
	 			inicio="Todos los tiempos";
	 			termino="";
	 		}
	        return {
	            header: {
	                headerRows: 7,
	                rows: [
	                    { index: 1, cells: [{ index: 1, colSpan: 5, value: 'PEDIDOS DESPACHADOS POR AÑO', style: { fontColor: '#C25050', fontSize: 25, hAlign: 'Center', bold: true } }] },
	                    {
	                        index: 3,
	                        cells: [
	                            { index: 1, colSpan: 2, value: "Planta", style: { fontColor: '#C67878', fontSize: 15, bold: true } },
	                            { index: 4, value: "Año Inicio", style: { fontColor: '#C67878', bold: true } },
	                            { index: 5, value: "Año Termino", style: { fontColor: '#C67878', bold: true }, width: 150 }
	                        ]
	                    },
	                    {
	                        index: 4,
	                        cells: [{ index: 1, colSpan: 2, value: planta },
	                        { index: 4, value: inicio }, { index: 5, value: termino, width: 150 }

	                        ]
	                    }
	                ]
	            },

	            footer: {
	                footerRows: 8,
	                rows: [
	                    { cells: [{ colSpan: 6, value: "", style: { fontColor: '#C67878', hAlign: 'Center', bold: true } }] },
	                    { cells: [{ colSpan: 6, value: "", style: { fontColor: '#C67878', hAlign: 'Center', bold: true } }] }
	                ]
	            },
	            
	            fileName: "exceldocument.xlsx"
	        };
	    }

		function getPdfExportProperties() {
	 		var inicio = anoInicio.value;
	 		var termino = anoTermino.value;
	 		var planta=idPlanta.options[idPlanta.selectedIndex].text;
	 		if(checkTodo.checked){
	 			inicio="Todos los tiempos";
	 			termino="";
	 		}			
	        return {
	            header: {
	                fromTop: 0,
	                height: 120,
	                contents: [
	                    {
	                        type: 'Text',
	                        value: 'PEDIDOS DESPACHADOS POR AÑO',
	                        position: { x: 150, y: 0 },
	                        style: { textBrushColor: '#C25050', fontSize: 18 },
	                    },
	                    {
	                        type: 'Text',
	                        value: 'Año Inicio',
	                        position: { x: 400, y: 50 },
	                        style: { textBrushColor: '#C67878', fontSize: 12 },
	                    },
	                    {
	                        type: 'Text',
	                        value: 'Año Término',
	                        position: { x: 500, y: 50 },
	                        style: { textBrushColor: '#C67878', fontSize: 12 },
	                    }, {
	                        type: 'Text',
	                        value: inicio,
	                        position: { x: 400, y: 70 },
	                        style: { textBrushColor: '#000000', fontSize: 12 },
	                    },
	                    {
	                        type: 'Text',
	                        value: termino,
	                        position: { x: 500, y: 70 },
	                        style: { textBrushColor: '#000000', fontSize: 12 },
	                    },
	                    {
	                        type: 'Text',
	                        value: 'Planta',
	                        position: { x: 20, y: 50 },
	                        style: { textBrushColor: '#C67878', fontSize: 12 }
	                    },
	                    {
	                        type: 'Text',
	                        value: planta,
	                        position: { x: 20, y: 70 },
	                        style: { textBrushColor: '#000000', fontSize: 12 }
	                    },
	                ]
	            },
            
	            fileName: "pdfdocument.pdf"
	        };
	    }


    </script>

<?php $__env->stopSection(); ?>    
<?php echo $__env->make('plantilla', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>