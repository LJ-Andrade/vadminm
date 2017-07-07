{!! Form::open(['url' => 'vadmin/get_fc_data', 'method' => 'POST', 'id' => 'StoreFcForm']) !!}
    {{-- Sending data to FC --}}
    <input class="Hidden" id="ClientIdFc" name='clientid' type='' />
    <input class="Hidden" name='date' type='' value='{{ date("y-m-d") }}' />
    <div id="MarkAsFcDone"></div>
    
    <table class="table">
        <thead>
            <tr>
                <th>Cod.</th>
                <th>Descripción</th>
                <th class="mw100">P.U.</th>
                <th class="mw50">Cantidad</th>
                <th class="mw50">Subtotal</th>
                <th class="mw50">Iva</th>
                <th class="mw50">Total</th>
                <th></th>
            </tr>
        </thead>
        {{-- Fc Items --}}
    
        <tbody id="FcItems">
        </tbody>
    
        <tbody class="custom-table-body">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Iva: </td> 
                <td id="IvaSubTotal"></td>
                <input id="IvaSubtotalInput" name='ivasubtotal' type='hidden' />
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Subtotal: </td>
                <td id="SubTotal"></td>
                <input id="SubTotalInput" name='subtotal' type='hidden' />
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <input id="TotalInput" name='total' type='hidden' />
                <td>Total: </td>
                <td id="Total"></td>
            </tr>
        </tbody>
    </table>
{!! Form::close() !!}