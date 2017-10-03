<div id="CompBody" class="big-form Hidden">
{!! Form::open(['method' => 'POST', 'id' => 'DocForm']) !!}
    <div class="row inner-row">
        <div class="col-md-4 col-xs-12 header-left">
            {{-- Left Head Data --}}
            <div id="DisplayClientData"></div>
        </div>
        <div class="col-md-4 header-center">
            <div class="text"><span id="DisplayDocType" class="display-doc-type"></span></div> <br>
        </div>
        <div class="col-md-4 col-xs-12 header-right">
            {{-- Right Head Data --}}
            <b>Fecha:</b> {{ date("d/m/y") }} <br>
            <b>Punto de Venta: </b><br>
            {!! Form::select('pto_vta', ['150' => 'Depósito', '140' => 'Local'], Auth::user()->pto_vta, ['id' => 'DocPtoVta', 'class' => 'Select-Chosen form-control short-input']) !!}
        </div>
    </div>
    <hr>

    <div class="inner-row">
        <div id="SmallLoader"></div>
        <div class="table-responsive">          
            {{-- //// COLLECT DATA TO FC //// --}}
                {{-- Operación --}}
                <div class="Hidden">
                    Tipo de Operacion 
                    <input id="DocModo" name='modo' type='text'  /> <br>
                    Ingreso O Egreso
                    <input id="DocOp" name='op' type='text'  /> <br>
                    {{-- Id de Cliente --}}
                    Id Cliente
                    <input id="DocClientId" name='clientid' type='text'  /> <br>
                    {{-- Fecha --}}
                    <input name='date' type='text' value='{{ date("Y-m-d") }}' /> <br>
                    {{-- Tipo de Documento(Factura) --}}
                    Tipo de Doc Id
                    <input id="DocDocType"  name='tipo_comp' type='text' /> <br>
                 {{-- Flete Id
                    <input id="DocFlete" name='flete' type='text' /> <br> 
                    User Id (Vendedor)
                    <input id="DocUserId" name='vendedor' type='text' /> <br> --}}  
                    Letra
                    <input id="DocLetter" name='letter' type='text' /> <br>
                </div>

                <div id="MarkDone"></div>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th class="mw50">Cod.</th>
                            <th>Descripción</th>
                            <th class="mw50">Cantidad</th>
                            <th class="mw100">P. Unitario</th>
                            <th class="mw50">Subtotal</th>
                            <th class="mw50">Iva</th>
                            <th class="mw50">Importe</th>
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
                            <td>Subtotal: </td>
                            <td id="SubTotal"></td>
                            <input id="SubTotalInput" name='subtotal' type='hidden' />
                        </tr>
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
                            <input id="TotalInput" name='total' type='hidden' />
                            <td><b>TOTAL:</b> </td>
                            <td id="Total"></td>
                        </tr>
                    </tbody>
                </table>
        </div>
        {{-- Totals --}} 
        <div class="row">
            <div class="col-md-12">
                <hr class="softhr">
                <div class="col-md-6">
                    <div>Cantidad de items: <span id="CantItems">0</span> </div> <br>
                    
                </div>
                <div class="col-md-6 text-right">
                    {{-- <button id="MakeFcBtn" type="button" class="btn button buttonOk"><i class="ion-share"></i> Facturar</button> --}}
                    {{-- <button type="button" class="btn button grey-back"><i class="ion-ios-printer"></i> Imprimir</button> --}}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <button id="EmitDocBtn" class="btn button buttonOk pull-right Hidden"><i class="ion-share"></i> Emitir</button>
    <button id="MakePresupBtn" class="btn button buttonOk pull-right Hidden"><i class="ion-share"></i> Generar Presupuesto</button>
    <br>
    <button id="ProductFinderBtn" class="btn btnSquareHoriz btnBlue" ><i class="ion-plus-round"></i> Agregar Item</button>
    <button id="PendingOrdersBtn" class="btn btnSquareHoriz btnYellow Hidden"><i class="ion-plus-round"></i> Pedidos Pendientes</button>
</div> {{-- / big-form FC BODY--}}