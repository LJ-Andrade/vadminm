
<div class="output-inner"><b>{{ $cliente->razonsocial }}</b> (Cód: {{ $cliente->id }} )</div>
<div class="table-responsive">
    <table class="table">
        
        @if ($pedidositems->isEmpty() )
        <div class="col-md-12">
            El cliente no tiene pedidos pendientes
        </div>
        @else
        <thead>
            <tr>
                <th></th>
                <th>Cod.</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>P.Unit.</th>
                <th>Iva</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            {!! Form::open(['url' => 'vadmin/facturas', 'method' => 'POST', 'id' => 'NewFcForm']) !!}
            Items pendientes de facturación
            <input id="ClientId" type="text" value="{{ $cliente->id }}" class="Hidden">
            
            @foreach($pedidositems as $item)
            <tr class="item-row">
                <td><input type="checkbox" class="AddToFc" data-pedidoitemid="{{ $item->id }}"></td>
                <td>{{ $item->producto->id }}</td>
                <td>{{ $item->producto->nombre }}</td>
                <td>{{ $item->cantidad }}</td>
                <td>$ {{ $item->valor }}</td>
                <td></td>
                <td>$ {{ $item->cantidad * $item->valor }}</td>
            </tr>
            @endforeach 
            {!! Form::close() !!}
        </tbody>

        @endif
    </table>
</div>