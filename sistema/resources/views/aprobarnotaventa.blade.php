@extends('plantilla')      

@section('contenedorprincipal')

  
<div style="padding: 20px">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b>Notas de Venta por Aprobar</b>
        </div>
        <div class="padding-md clearfix"> 
            <table id="tablaDetalle" class="table table-hover table-condensed table-responsive">
                <thead>
                    <th>Nota Venta</th>
                    <th>Cotización</th>
                    <th>Año</th>
                    <th>Fecha Creación</th>
                    <th>Cliente</th>
                    <th>Obra</th>
                    <th>Estado</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($listaNotasdeVenta as $item)
                        <tr>
                            <td>{{ $item->idNotaVenta }}</td>
                            <td>{{ $item->cot_numero }}</td>
                            <td>{{ $item->cot_año }}</td>
                            <td>{{ $item->fechahora_creacion }}</td>
                            <td>{{ $item->emp_nombre }}</td>
                            <td>{{ $item->Obra }}</td>
                            @if($item->aprobada==1)
                                <td>Aprobada</td>
                            @else
                                <td>Pendiente de Aprobación</td>
                            @endif
                            <td>
                                <a href="{{ asset('/') }}vernotaventa/{{ $item->idNotaVenta }}/2/" class="btn btn-xs btn-info" style="width: 60px">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>      
        </div>
    </div>
    <div style="padding-top:18px; padding-bottom: 20px;padding-left: 20px">
        <a href="{{ asset('/') }}dashboard" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
    </div>
</div>


@endsection

@section('javascript')
    <!-- Datepicker -->

    <script src="{{ asset('/') }}js/bootstrap-datepicker.min.js"></script>  

    <!-- Timepicker -->
    <script src="{{ asset('/') }}js/bootstrap-timepicker.min.js"></script>  

    <script src="{{ asset('/') }}js/app/funciones.js"></script>
    <!-- Datatable -->
    <script src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
@endsection