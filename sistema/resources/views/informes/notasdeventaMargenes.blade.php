@extends('plantilla')  
@section('contenedorprincipal')

<div class="control-section">
	<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <div class="panel panel-default" id="contenedor3">
        <div class="panel-heading">
            <b>Notas de Venta y Márgenes</b>
        </div>  
    </div>    	
    <div class="content-wrapper">
        <div id="Grid">
        </div>
	</div>
	<a href="{{ asset('/') }}dashboard" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>

</div>

@endsection
@section('javascript')
    <!-- Datepicker -->
    <script src="{{ asset('/') }}js/bootstrap-datepicker.min.js"></script>  

    <!-- Timepicker -->
    <script src="{{ asset('/') }}js/bootstrap-timepicker.min.js"></script>
    <script src="{{ asset('/') }}js/app/funciones.js"></script>

    <script src="{{ asset('/') }}js/syncfusion/jquery.globalize.js"></script>
	<script src="{{ asset('/') }}js/syncfusion/lang/globalize.culture.en-US.min.js"></script>

	<script id="template_costo" type="text/x-template">
        ${if(costo==0)}
        	PENDIENTE
        ${else}
        	${costo}
        ${/if}
    </script>
	<script id="template_Flete" type="text/x-template">
        ${if(Flete==-1)}
        	<div style="text-align:center;width:100%">PENDIENTE</div>
        ${else}
        	${Flete}
        ${/if}
    </script>
    <style>
        .e-grid .e-headercell {
            height:70px !important;
        }
        .e-grid .e-headercelldiv{ /* grid headercell font styles*/ 
		    font-size: 10px; 
		} 
    </style>    

    <script>

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
                    "Csvexport": "Exportar a CSV",
                    "FilterButton": "Filtrar",
                    "ClearButton": "Quitar",                    	            
                    "SelectAll": "Seleccionar todo",
                    "Search": "Buscar",
                    "Blanks": "Vacío",
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


		function renderGrid(data){
			var columnas;

			columnas=[
	            { field: 'fechaCreacion', headerText: 'Fecha Creación', width: 120, textAlign: 'Right'},
	            { field: 'idNotaVenta', headerText: 'Nº Nota Venta', width: 80 },
	            { field: 'nombreCliente', headerText: 'Cliente', width: 200, textAlign: 'Left' },
	            { field: 'nombreObra', headerText: 'Obra/Planta', width: 200, textAlign: 'Left' },
	            { field: 'nombreProducto', headerText: 'Producto', width: 150, textAlign: 'Left' },
	            { field: 'nombrePlanta', headerText: 'Planta QLSA', width: 100 },
				{ field: 'cantidadTotal', headerText: 'Cantidad', width: 100, textAlign: 'Right', format: "N" },		
	            { field: 'saldo', headerText: 'Saldo', width: 100, textAlign: 'Right', format: "N" },	
	            { field: 'unidad', headerText: 'Unidad', width: 100, textAlign: 'Center' },
	            { field: 'formato', headerText: 'Formato', width: 100, textAlign: 'Center' },
	            { field: 'costo', headerText: 'Costo Unit. Actual($)', width: 100,  textAlign: 'Center', format: "N", template: '#template_costo' },	
	            { field: 'otrosCostos', headerText: 'Otros Costos($)', width: 100, textAlign: 'Right', format: "N" },	
	            { field: 'Flete', headerText: 'Flete Unit. Actual($)', width: 100, textAlign: 'Right', format: "N", template: '#template_Flete' },	
	            { field: 'precioVentaUnitarioActual', headerText: 'Precio Venta Unit. Actual($)', width: 100, textAlign: 'Right', format: "N" },
	            //{ field: 'totalPrecioVenta', headerText: 'Total Precio Venta $', width: 100, textAlign: 'Right', format: 'N' },	
	            { field: 'margenBrutoUnitarioActual', headerText: 'Margen Bruto Unit. Actual ($)', width: 100, textAlign: 'Right', format: "N" },
	            { field: 'margenBrutoUnitarioActualPorcentaje', headerText: 'Margen Bruto Unit.Actual(%)', width: 100, textAlign: 'Right', format: "N" },
	            { field: 'facturado', headerText: 'Total Facturado a la fecha($)', width: 100, textAlign: 'Right', format: "N" },	
	            { field: 'margenBrutoTotal', headerText: 'Margen Bruto Total a la fecha($)', width: 100, textAlign: 'Right', format: "N" },
	            { field: 'margenBrutoTotalPorcentaje', headerText: 'Margen Bruto Total a la fecha(%)', width: 100, textAlign: 'Right', format: "N" } 
	        ];


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
		        allowCsvExport: true,
		        height: 500,
		        rowHeight: 20,       
		        toolbar: ['ExcelExport'],
		        columns: columnas,
		        pageSettings: { pageCount: 5, pageSize: 10, pageSizes: ['10', '50', 'All'] },
		        aggregates: [{
		            columns: [
		            	{
			                type: 'Sum',
			                field: 'cantidadTotal',
			                format: 'N',
			                footerTemplate: '<b>${Sum}</b>'
		            	},
		            	{
			                type: 'Sum',
			                field: 'saldo',
			                format: 'N',
			                footerTemplate: '<b>${Sum}</b>'
		            	},		            	
		            ]
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
			            grid.csvExport(getCsvExportProperties());
			        }
			    };		    		
		}	

		function cargarDatos(){
			var data=[];

            $.ajax({
                url: urlApp +'api/obtenerNotasdeVentaMargenes',
                headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
                type: 'POST',
                dataType: 'json',
                data: {},
                success:function(dato){
                		data=dato;
                		renderGrid(data);
                },
                error: function(jqXHR, text, error){
                    alert('Ha ocurrido un error!, vuelva a presionar el botón Buscar Selección');
                }                
            })
		};

		cargarDatos();  

	 	function getExcelExportProperties() {
	        return {
	            header: {
	                headerRows: 2,
	                rows: [
	                    { index: 1, cells: [{ index: 1, colSpan: 5, value: 'NOTAS DE VENTA Y MARGENES', style: { fontColor: '#C25050', fontSize: 25, hAlign: 'Center', bold: true } }] }
	                ]
	            },            
	            fileName: "notadeventaMargenes.xlsx"
	        };
	    }

		function getPdfExportProperties() {	
	        return {
	            header: {
	                fromTop: 0,
	                height: 60,
	                contents: [
	                    {
	                        type: 'Text',
	                        value: 'NOTAS DE VENTA Y MARGENES',
	                        position: { x: 150, y: 0 },
	                        style: { textBrushColor: '#C25050', fontSize: 18 },
	                    }
	                ]
	            },
	            fileName: "notadeventaMargenes.pdf"
	        };
	    }

		function getCsvExportProperties() {
	        return {           
	            fileName: "notadeventaMargenes.csv"
	        };
	    }

    </script>

@endsection    