@extends('vadmin.layouts.export')
    @section('content')
    <div class="export-container">
        <div class="export-table">
            <div class="exp-table-header">
                <div class="right">
                    {{ transDateT($pedido->created_at) }}<br> 
                </div>
                <div class="left">
                    <span class="title">PEDIDO </span>(N° {{ $pedido->id }})</span> <br>
                    <b>Cliente:</b> {{ $pedido->cliente->razonsocial}} <br>
                    <b>Direcciones de entrega:</b><br> @foreach($pedido->cliente->direntregas as $direntrega) {{ $direntrega->name }} | @endforeach  <br>
                    <b>Flete:</b> {{ $pedido->cliente->flete->name }} ( {{ $pedido->cliente->flete->direccion }} )
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
                    @foreach($pedido->pedidositems as $item)
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