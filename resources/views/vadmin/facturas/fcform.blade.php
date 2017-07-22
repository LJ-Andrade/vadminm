{!! Form::open(['url' => 'vadmin/generate_fc', 'method' => 'POST', 'id' => 'FcForm']) !!}
    {{-- Data Required by Webservice 

    pto_vta                        // Punto de Vta
    invoice_num                    // (?) Numero de factura?
    tax                            //
    doc_type  (#DocTypeFc)         // (?)
    tipo_comp (#TipoCompFc)        // Factura - Nota de Crédito - Nota de Débito
    
    //// COLLECT DATA TO FC //// --}}
    
    {{--Id de Cliente --}}
    <input id="ClientIdFc" class="" name='clientid' type='text'  /> <br>
    {{-- Fecha --}}
    <input class="" name='date' type='text' value='{{ date("Y-m-d") }}' />
    {{-- Categoría de Iva --}}
    <input id="DocTypeFc" class="" name='doc_type' type='text' />
    {{-- Tipo de Documento(Factura) --}}
    <input id="TipoCompFc" class="" name='tipo_comp' type='text' />

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
    <button id="MakeFcBtn" type="submit" class="btn button buttonOk pull-right"><i class="ion-share"></i> Facturar</button>
{!! Form::close() !!}