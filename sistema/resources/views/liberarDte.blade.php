@extends('plantilla')      

@section('contenedorprincipal')

<div class="panel-body">
	<h4>Liberar Nº DTE</h4>

	<div class="row" style="padding-top: 5px">
		<div class="col-md-2">
			Tipo de DTE
		</div>
		<div class="col-md-2">
			<select class="form-control input-sm"></select>
		</div>
	</div>

	<div class="row" style="padding-top: 5px">
		<div class="col-md-2">
			Nº DTE
		</div>
		<div class="col-md-2">
			<input class="form-control input-sm">
		</div>
		<div class="col-md-1">
			<button class="btn btn-sm btn-success">Buscar</button>
		</div>
	</div>

	<div class="row" style="padding-top: 5px">
		<div class="col-md-2">
			Razón social
		</div>
		<div class="col-md-6">
			<input class="form-control input-sm">
		</div>
	</div>

	<div class="row" style="padding-top: 5px">
		<div class="col-md-2">
			Rut
		</div>
		<div class="col-md-2">
			<input class="form-control input-sm">
		</div>
	</div>

	<div class="row" style="padding-top: 5px">
		<div class="col-md-2">
			Motivo
		</div>
		<div class="col-md-8">
			<input class="form-control input-sm">
		</div>
	</div>
	<br><br>
	<button class="btn btn-sm btn-success">Linerar Nº DTE</button>
	<button class="btn btn-sm btn-success">Atrás</button>

</div>

@endsection

@section('javascript')
<script src="{{ asset('/') }}js/app/funciones.js"></script>
<script>
	$(document).ready(function() {

	});
</script>
@endsection