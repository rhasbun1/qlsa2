@extends('plantilla')      

@section('contenedorprincipal')


<script>
    function aprobarPedido(idPedido, fila){
        $.ajax({
            url: urlApp + "aprobarPedido",
            headers: { 'X-CSRF-TOKEN' : $("#_token").val() },
            type: 'POST',
            dataType: 'json',
            data: { idPedido: idPedido
                  },
            success:function(dato){
                var tabla=document.getElementById('tablaDetalle');
                tabla.rows[fila].cells[7].getElementsByTagName('button')[0].style.visibility = 'hidden';
            }
        })
    }
</script>

<div style="padding: 20px">
    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b>Pedidos por Aprobar</b>
        </div>
        <div class="padding-md clearfix">        
            <table id="tablaDetalle" class="table table-hover table-condensed table-responsive">
                <thead>
                    <th>Pedido Nº</th>
                    <th>Fecha Creación</th>
                    <th>Cliente</th>
                    <th>Obra/Planta</th>
                    <th>Total Iva incl.</th>
                    <th>Fecha Entrega</th>
                    <th>Planta</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($pedidos as $item)
                        <tr>
                            <td>{{ $item->idPedido }}</td>
                            <td>{{ $item->fechahora_creacion }}</td>
                            <td>{{ $item->emp_nombre }}</td>
                            <td>{{ $item->Obra }}</td>
                            <td align="right"><b>$ {{ number_format( $item->totalNeto + $item->montoIva, 0, ',', '.' ) }}</b></td>
                            <td>{{ $item->fechaEntrega }}</td>
                            <td>{{ $item->Planta }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" style="width: 80px" onclick="aprobarPedido({{ $item->idPedido }}, this.parentNode.parentNode.rowIndex)">Aprobar</button>
                                <a href="{{ asset('/') }}verpedido/{{ $item->idPedido }}/2/" class="btn btn-sm btn-success">Ver</a>
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

    
@endsection
