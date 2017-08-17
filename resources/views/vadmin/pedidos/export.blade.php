@extends('vadmin.layouts.export')
    @section('content')
    <div class="container">
        <div class="row">
            <div class="export-table">
                <div class="exp-table-header">
                    
                    <div class="col-md-6 left">
                        <span class="title">Orden de Compra</span> <br>
                        <span class="title-desc"><b>Cliente:</b> {{ $pedido->cliente->razonsocial}}</span>
                        <div id="ClientData" data-pedidoid="{{ $pedido->id }}" data-clientid="{{ $pedido->cliente->id }}"></div>
                        <div id="TipoCte" class="small-text" data-tipocte="{{ $pedido->cliente->tipo_id }}"><b>Tipo de cliente: </b>{{ $tipocte }}</div>
                        <div class="small-text"><b>Pedido N°:</b> {{ $pedido->id }} </div>
                    </div>
                    <div class="col-md-6 right">
                        <div><b>Creado el</b> {{ transDateT($pedido->created_at) }}<br> 
                        <b>Por</b> {{ $pedido->user->name }}</div>		
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
    </div>
    @endsection