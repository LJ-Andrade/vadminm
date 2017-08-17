<div class="table-responsive"> 
    <table class="table">
        <thead>
            <tr>
                <th>Cod.</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>P.Unit.</th>
                <th>Iva</th>
                <th>SubTotal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($pedidositems as $item)
            <tr class="custom-tr PendingOrder" id="PoId{{ $item->id }}">
			    <td class="PoId">{{ $item->producto->id }}</td>
                <td>{{ $item->producto->nombre }}</td>
                <td class="mw50">{{ $item->cantidad }}</td>
                <td>{{ $item->valor }}</td>
                <td>{{ $item->producto->condiva }}</td>
                <td>{{ $item->valor * $item->cantidad }}</td>
                <td><button class="PendigOrderBtn btn btnSquareHoriz buttonOk" 
                data-orderid="{{ $item->id }}"
                data-id="{{ $item->producto->id }}"
                data-name="{{ $item->producto->nombre }}"
                data-ammount="{{ $item->cantidad }}"
                data-price="{{ $item->valor }}"
                data-iva="{{ $item->producto->condiva }}"
                data-subtotal="{{ $item->valor * $item->cantidad }}"
                ><i class="ion-plus-round"></i></button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
