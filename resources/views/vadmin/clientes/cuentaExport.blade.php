<div class="big-form small-text-table">
    <div class="inner-row">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Movimiento</th>
                        <th>Detalle</th>
                        <th>Factura</th>
                        <th>Importe</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody id="FcItems">
                    @foreach( $movements as $item )
                        {{-- Detalle --}}
                        @if($item->op == 'F')
                        <tr class="factura-test">
                            <td><i class="ion-reply"></i> FC N° {{ $item->numero }}</td>
                            <td></td>
                            <td></td>
                            <td>- $ {{ $item->total }}</td>
                            <td>{{ transDateT($item->created_at) }}</td>
                        </tr>
                        @endif
                        @if($item->op == 'P')
                        <tr class="pago-test">
                            <td><i class="ion-forward"></i> 
                                {{ paymentType($item->modo) }}
                            </td>
                            <td>
                                @if($item->ret_nro != null)
                                    N° {{$item->ret_nro}} - 
                                    {{ $item->ret_tipo }} -
                                    {{ $item->ret_jurisdiccion }}
                                @endif
                                @if($item->ch_banco != null)
                                    N° {{ $item->ch_banco_nro }} -
                                    Cuit: {{ $item->ch_cuit }} <br>
                                    Banco: {{ $item->ch_banco }} 
                                    ({{ $item->ch_sucursal }}) -
                                    {{ $item->ch_fechacobro }}
                                @endif
                                @if($item->bco_movimiento != null)
                                    {{ $item->bco_movimiento }}
                                @endif
                            </td>
                            <td>@if($item->factura_nro != null)
                                N° {{ $item->factura_nro }}
                                @endif
                            </td>
                            <td>+ ${{ $item->importe }}</td>
                            <td>{{ transDateT($item->created_at) }}</td>
                        </tr>
                        @endif
                    @endforeach
                   
                </tbody>
            </table>
        </div>
    </div>
</div>