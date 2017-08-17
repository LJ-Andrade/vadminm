@component('vadmin.components.tablelist')  
    @slot('tableTitles')
        @if(isset($_GET['tipocte']))
        {{-- <th></th> --}}
        <th>Código</th>
        <th>Descripción</th>
        <th>Stock Actual</th>
        <th>Precio</th>
        <th></th>
        @endif
    @endslot
    @slot('tableContent')
        @foreach($products as $item)
            @if(isset($_GET['tipocte']))

            <tr id="Id{{ $item->id }}" class="TableList-Row table-list-row">
                <td>{{ $item->id }}</td>
                <td>{{ $item->nombre }}</td>
                <td>{{ $item->stockactual }}</td>
                    {{-- PRECIOS GREMIO --}}
                    @if($_GET['tipocte'] == '1')
                        {{-- Pesos --}}
                        @if($item->monedacompra == '1')
                            <td>$ {{ calcFinalPrice($item->costopesos, $item->pjegremio)  }}</td>
                        @endif
                        {{-- Dolar --}}
                        @if($item->monedacompra == '2')
                            <td>$ {{ calcFinalPriceConvert($item->costodolar, $item->pjegremio, $dolarsist)  }}</td>
                        @endif
                        {{-- Euro --}}
                        @if($item->monedacompra == '3')
                            <td>$ {{ calcFinalPriceConvert($item->costoeuto, $item->pjegremio, $eurosist)  }}</td>
                        @endif
                    {{-- PRECIOS PARTICULARES --}}
                    @elseif($_GET['tipocte'] == '2')
                         {{-- Pesos --}}
                        @if($item->monedacompra == '1')
                            <td>$ {{ calcFinalPrice($item->costopesos, $item->pjeparticular)  }}</td>
                        @endif
                        {{-- Dolar --}}
                        @if($item->monedacompra == '2')
                            <td>$ {{ calcFinalPriceConvert($item->costodolar, $item->pjeparticular, $dolarsist)  }}</td>
                        @endif
                        {{-- Euro --}}
                        @if($item->monedacompra == '3')
                            <td>$ {{ calcFinalPriceConvert($item->costoeuto, $item->pjeparticular, $eurosist)  }}</td>
                        @endif
                    {{-- PRECIOS ESPECIALES --}}
                    @elseif($_GET['tipocte'] == '3')
                         {{-- Pesos --}}
                        @if($item->monedacompra == '1')
                            <td>$ {{ calcFinalPrice($item->costopesos, $item->pjeespecial)  }}</td>
                        @endif
                        {{-- Dolar --}}
                        @if($item->monedacompra == '2')
                            <td>$ {{ calcFinalPriceConvert($item->costodolar, $item->pjeespecial, $dolarsist)  }}</td>
                        @endif
                        {{-- Euro --}}
                        @if($item->monedacompra == '3')
                            <td>$ {{ calcFinalPriceConvert($item->costoeuto, $item->pjeespecial, $eurosist)  }}</td>
                        @endif
                    {{-- PRECIOS DE OFERTA --}}
                    @elseif($_GET['tipocte'] == '4')
                         {{-- Pesos --}}
                        @if($item->monedacompra == '1')
                            <td>$ {{ calcFinalPrice($item->costopesos, $item->pjeoferta)  }}</td>
                        @endif
                        {{-- Dolar --}}
                        @if($item->monedacompra == '2')
                            <td>$ {{ calcFinalPriceConvert($item->costodolar, $item->pjeoferta, $dolarsist)  }}</td>
                        @endif
                        {{-- Euro --}}
                        @if($item->monedacompra == '3')
                            <td>$ {{ calcFinalPriceConvert($item->costoeuto, $item->pjeoferta, $eurosist)  }}</td>
                        @endif
                            {{-- $valorcompra, $producto->pjegremio,     $eurosist->valor --}}
                    @else
                    @endif
                <td class="list-actions">
                    <div class="TableList-Actions inner Hidden">                        
                        <a href="{{ url('vadmin/productos/'. $item->id) }}" class="btn action-btn btnBlue">
							<i class="ion-ios-search"></i>
						</a>
                        {{--  <a class="Delete btn action-btn btnRed" data-id="{!! $item->id !!}">
                            <i class="ion-ios-trash-outline"></i>
                        </a> --}}
                        <a class="Close-Actions-Btn btn btn-close btnGrey">
                            <i class="ion-ios-close-empty"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @endif
        @endforeach
    @endslot
    @slot('tableEmpty')
        @if(! count($products))
        <tr>
            <td>No se han encontrado registros</td>
        </tr>
        @endif
    @endslot
    @slot('pagination')
        {!! $products->render(); !!}
    @endslot
@endcomponent
