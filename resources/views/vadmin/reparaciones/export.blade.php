@extends('vadmin.layouts.export')
    @section('content')
    <div class="export-container">
        <div class="export-table">
            <div class="exp-table-header">
                <div class="right">
                    {{ transDateT($reparacion->created_at) }}<br> 
                </div>
                <div class="left">
                    <span class="title">REPARACIÓN </span>(N° {{ $reparacion->id }})</span> <br>
                    <b>Cliente:</b> {{ $reparacion->cliente->razonsocial }} <br>
                    
                    @if($reparacion->cliente->direntregas->count() > 0)
                    <b>Direcciones de entrega:</b><br> @foreach($reparacion->cliente->direntregas as $direntrega) {{ $direntrega->name }} | @endforeach  <br>
                    @endif
                    @if($reparacion->cliente->flete) <b>Flete:</b> 
                    {{$reparacion->cliente->flete->name }} ( {{ $reparacion->cliente->flete->direccion }} )
                    }} 
                    @endif
                </div>
                <div class="clearfix"></div>
            </div>	
            <table class="table">
                <thead>
                    <tr>
                        <th>Cod.</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>P.Unit.</th>
                        <th>SubTotal</th>
                    </tr>
                </thead>
            
                <tbody>
                    @foreach($reparacion->reparacionesitems as $item)
                    <tr class="item-row">
                        <td>{{ $item->producto->id }}</td>
                        <td>{{ $item->producto->nombre }}</td>
                        <td>{{ $item->cantidad }}</td>
                        <td>$ {{ $item->valor }}</td>
                        <td>$ {{ $item->cantidad * $item->valor }}</td>
                        
                    </tr>
                    @endforeach 
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right"><b>TOTAL:</b></td>
                        <td>$ <b>{{ $total }} </b></td>
                    </tr>
                </tbody>        
            </table>
        </div>

    </div>
    @endsection