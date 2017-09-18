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
        Cliente: {{ $client->razonsocial }} 
    </div> <br>
    <table class="table"  style="width: 100%;">
          <div class="title">
            <b>Mes: </b> <span class="custom-badge blue-back">{{ $mes }}</span>
            @if($saldoAnterior != '' ) |<b> Saldo Anterior: </b> <span class="custom-badge blue-back">${{ $saldoAnterior }} </span>@endif
            
        </div>
        <thead>
            <tr>
                <th>Movimiento</th>
                <th>Detalle</th>
                <th>Pertenece a</th>
                <th>Importe</th>
                {{-- <th>Subtotal</th> --}}
                <th style="text-align:right">Fecha</th>
                <th></th>
            </tr>
        </thead>

        <tbody id="MovementItems">
            @if($movimientos->isEmpty())
            <tr>
                <th>No hay movimientos</th>
            </tr>
            @endif
            @foreach( $movimientos as $item )
                @if($item->op == 'I')
                <tr class="ingreso">
                @elseif($item->op == 'E')
                <tr class="egreso">
                @else
                <tr>
                @endif
                    <td>{{ movementType($item->modo) }}</td>
                    <td>{{ $item->det1 }} {{ $item->det2 }}</td>
                    <td>@if($item->comprobante_nro)N° {{ $item->comprobante_nro }}@endif</td>
                    {{-- <td><input class="Importe"  disabled type="text" value="{{ $item->importe }}" disabled></td>
                    <td><input  class="Subtotal" disabled type="text" value="" disabled></td> --}}
                    <td>$ {{ $item->importe }}</td>
                    {{-- <td>$ {{ $item->subtotal }}</td> --}}
                    <td style="text-align:right">{{ transDateT($item->created_at) }}</td>
                    <td></td>
                </tr>
            @endforeach
        <tr class="totals-tr">
            <td></td>
            <td></td>
            <td style="text-align: right"><b>SALDO: $ </b> </td>
            <td><span id="FinalTotal">{{ $saldo }}</span></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
</body>
</html>