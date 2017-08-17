<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <style>
        table td,th{
            padding: 2px 10px;
            font-size: 12px;
            border-top: 1px solid #ddd
        }

    </style>
</head>
<body>
    <div>
        Últimos movimientos | 
        Cliente: {{ $client }} 
    </div> <br>
    <table class="table"  style="width: 100%;">
        <thead>
            <tr>
                <th>Movimiento</th>
                <th>Detalle</th>
                <th>Factura</th>
                <th>Importe</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $movements as $item )
                {{-- Detalle --}}
                @if($item->op == 'F')
                <tr>
                    <td><i class="ion-reply"></i> FC N° {{ $item->numero }}</td>
                    <td></td>
                    <td></td>
                    <td>- $ {{ $item->total }}</td>
                    <td>{{ transDateT($item->created_at) }}</td>
                </tr>
                @endif
                @if($item->op == 'P')
                <tr>
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
            <tr class="totals-tr">
                <td></td>
                <td></td>
                <td>
                    @if ($totals < 0)
                        <b>Saldo a Favor:</b>
                    @elseif($totals == 0)
                        Aún no hay movimientos
                    @else
                        <b>Debe:</b>
                    @endif
                </td>
                <td>
                    @if ($totals < 0)
                        <b>$ {{ str_replace('-', '', $totals) }} </b>
                    @elseif($totals == 0)
                        
                    @else
                        <b>$ {{ $totals }} </b>
                    @endif

                </td>
                <td></td>
            </tr>
            
        </tbody>
    </table>
</body>
</html>