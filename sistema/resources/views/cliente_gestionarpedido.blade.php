@extends('plantilla')      

@section('contenedorprincipal')

<div style="padding: 5px">
    <div class="panel panel-default table-responsive">
        <div class="panel-heading">
            <b>Nuevo Pedido</b>
        </div>
        <div class="padding-md clearfix"> 
            <div> 
                <input type="hidden" id="idCliente">
                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-sm-1 col-lg-1">
                        Nota de Venta
                    </div>
                    <div class="col-sm-1 col-lg-1">
                        <input class="form-control input-sm" id="txtNumeroNotaVenta" readonly value='{{ $NotadeVenta[0]->idNotaVenta }}'>
                    </div>
                 
                    <div class="col-sm-1 col-lg-1">
                        Cliente
                    </div>
                    <div class="col-sm-3 col-lg-3">
                        <input class="form-control input-sm" id="txtNombreCliente" readonly  value="{{ $NotadeVenta[0]->emp_nombre}}">
                    </div>
                    <div class="col-sm-1 col-lg-1">
                        Fecha
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <input class="form-control input-sm" id="txtFechaCotizacion" readonly value="{{ $NotadeVenta[0]->fechahora_creacion}}">
                    </div>
                    <div class="col-sm-1 col-lg-1">
                        Cotización
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-2">
                        <input class="form-control input-sm" id="txtAno" readonly value="{{ $NotadeVenta[0]->cot_numero }} / {{ $NotadeVenta[0]->cot_año}}">
                    </div>
                </div>
                <div class="row" style="padding-top: 10px">
                    <div class="col-sm-1 col-lg-1">
                        Obra
                    </div>
                    <div class="col-sm-3 col-lg-3">
                        <input class="form-control input-sm" id="txtUsuarioValida" readonly value="{{ $NotadeVenta[0]->Obra}}">
                    </div>                 
                    <div class="col-sm-1 col-lg-1">
                        Ejecutivo QL
                    </div>
                    <div class="col-sm-3 col-lg-3">
                        <input class="form-control input-sm" id="txtUsuarioCrea" readonly value="{{ $NotadeVenta[0]->usuario_encargado }}">
                    </div>
                    <div class="col-sm-1 col-lg-1">
                        Valida
                    </div>
                    <div class="col-sm-3 col-lg-3">
                        <input class="form-control input-sm" id="txtUsuarioValida" readonly value="{{ $NotadeVenta[0]->usuario_validacion}}">
                    </div> 
                </div>
            </div>
            <div style="padding-top: 10px">
                <table id="tablaDetalle" class="table table-hover table-condensed table-responsive">
                    <thead>
                        <th style="display: none">Codigo</th>
                        <th width="15%">Producto</th>
                        <th width="5%">Diseño</th>
                        <th width="10%">Precio</th>
                        <th width="5%">Cantidad</th>
                        <th width="5%">Unidad</th>
                        <th width="5%">Saldo</th>
                        <th width="5%">Cantidad<br>Solicitada</th>
                        <th width="15%">Planta de Origen</th>
                        <th width="20%">Forma de Entrega</th>
                    </thead>
                    <tbody>
                        @foreach($NotadeVentaDetalle as $item)
                            <tr>
                                <td style="display: none">{{ $item->prod_codigo }}</td>
                                <td>{{ $item->prod_nombre }}</td>
                                <td>{{ $item->formula }}</td>
                                <td align="right">{{ number_format( $item->precio, 0, ',', '.' ) }}</td>
                                <td align="right">{{ $item->cantidad }}</td>
                                <td>{{ $item->u_nombre }}</td>
                                <td align="right">{{ $item->saldo }}</td>
                                <td aling="right"><input class="form-control input-sm" onblur="verificarCantidad(this);" onkeypress="return isNumberKey(event)" ></td>
                                <td>
                                    <select class="form-control input-sm">
                                        @foreach($Plantas as $planta)
                                            @if( $item->idPlanta==$planta->idPlanta )
                                                <option value="{{ $planta->idPlanta }}" selected>{{ $planta->nombre }}</option>
                                            @else
                                                <option value="{{ $planta->idPlanta }}">{{ $planta->nombre }}</option>
                                            @endif    
                                        @endforeach 
                                    </select>                                    
                                </td>
                                <td>
                                    <select class="form-control input-sm">
                                        @foreach($FormasdeEntrega as $formaEntrega)
                                            @if( $item->idFormaEntrega==$formaEntrega->idFormaEntrega )
                                                <option value="{{ $formaEntrega->idFormaEntrega }}" selected>{{ $formaEntrega->nombre }}</option>
                                            @else
                                                <option value="{{ $formaEntrega->idFormaEntrega }}">{{ $formaEntrega->nombre }}</option>
                                            @endif
                                        @endforeach 
                                    </select>                                    
                                </td>
                            </tr>
                        @endforeach            
                    </tbody>
                </table>
            </div> 
            <div style="padding: 10px">
                <div class="row">
                    <div class="col-sm-2 col-md-2">
                        Contacto
                        <input id="txtNombreContacto" class="form-control input-sm" value="{{ $NotadeVenta[0]->nombreContacto}}">
                    </div> 
                    <div class="col-sm-2 col-md-2">
                        Correo
                        <input id="txtCorreoContacto" class="form-control input-sm" value="{{ $NotadeVenta[0]->correoContacto}}">
                    </div>
                    <div class="col-sm-2 col-md-2">
                        Telefono/Móvil
                        <input id="txtTelefono" class="form-control input-sm" value="{{ $NotadeVenta[0]->telefonoContacto}}">
                    </div>
                    <div class="col-sm-2 col-md-2">
                        Fecha de Entrega (*)
                        <div class="input-group date" id="divFechaEntrega">
                            <input type="text" class="form-control input-sm" id="txtFechaEntrega">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-1">
                        Horario
                        <select id="horario" class="form-control input-sm">
                            <option>AM</option>
                            <option>PM</option>
                        </select> 
                    </div>            
                 
                </div>
                <div class="row" style="padding-top: 10px">
                    <div class="col-sm-4 col-md-4">
                        Observaciones
                        <input id="txtObservaciones" class="form-control input-sm">
                    </div>
                    <div class="col-sm-4 col-md-4" style="padding-top: 20px">  
                        <label class="label-checkbox"><input type="checkbox" id="noExcederCantidad"><span class="custom-checkbox"></span>No exceder la cantidad solicitada</label>                 
                    </div>    
                </div>

            </div>
            <div style="padding:18px">
                <button class="btn btn-success btn-sm" onclick="crearPedido('CL');">Crear Pedido</button>
                <a href="{{ asset('/') }}clienteNotasdeVenta" class="btn btn-sm btn-warning" style="width:80px">Atrás</a>
            </div> 

            <div style="padding:18px">
                <b>Consideraciones para despachos a granel:</b>
                <div class="row" style="padding-top: 15px; padding-left: 30px">
                    <ul>
                        <li>{{ $parametros[0]->notaPedido1 }}</li>
                        <li>{{ $parametros[0]->notaPedido2 }}</li>
                    </ul>
                </div>
            </div>    
        </div>
    </div>
</div>

@endsection

@section('javascript')
    <!-- Datepicker -->
    <script src="{{ asset('/') }}js/bootstrap-datepicker.min.js"></script>  
    <script src="{{ asset('/') }}locales/bootstrap-datepicker.es.min.js"></script>
    
    <!-- Timepicker -->
    <script src="{{ asset('/') }}js/bootstrap-timepicker.min.js"></script>  

    <script src="{{ asset('/') }}js/app/funciones.js"></script>
    
    <script src="{{ asset('/') }}js/app/gestionarpedido.js"></script>
    <!-- Datatable -->
    <script src="{{ asset('/') }}js/jquery.dataTables.min.js"></script>
    
@endsection