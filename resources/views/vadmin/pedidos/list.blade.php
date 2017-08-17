@component('vadmin.components.tablelist')
    @slot('tableTitles')
        <th></th>
        <th>Estado</th>
        <th>Número</th>
        <th>Cliente</th>
        <th>Facturado</th>
        <th></th>
    @endslot
    @slot('tableContent')
        @foreach($pedidos as $item)
            <tr id="Id{{ $item->id }}" class="TableList-Row table-list-row">
                <td class="list-checkbox">
                    <input type="checkbox" class="BatchDelete" data-id="{{ $item->id }}">
                </td>
                <td class="special-input" style="width: 130px">
                    @if($item->estado == '1')
                        {!! Form::select('estado', ['1' => 'Pendiente', '2' => 'Preparado', '3' => 'Enviado'], $item->estado, ['class' => 'PedidoStatus form-control input-back-red', 'data-id' => $item->id]) !!}
                    @elseif($item->estado == '2')
                        {!! Form::select('estado', ['1' => 'Pendiente', '2' => 'Preparado', '3' => 'Enviado'], $item->estado, ['class' => 'PedidoStatus form-control input-back-green', 'data-id' => $item->id]) !!}
                    @elseif($item->estado == '3')
                        {!! Form::select('estado', ['1' => 'Pendiente', '2' => 'Preparado', '3' => 'Enviado'], $item->estado, ['class' => 'PedidoStatus form-control input-back-blue', 'data-id' => $item->id]) !!}
                    @else
                        {!! Form::select('estado', ['1' => 'Pendiente', '2' => 'Preparado', '3' => 'Enviado'], $item->estado, ['class' => 'PedidoStatus form-control input-back-grey', 'data-id' => $item->id]) !!}
                    @endif
                </td>
                <td>N° {{ $item->id }}</td>
                <td>{{ $item->cliente->razonsocial }}</td>
                <td>{{ transDateT($item->created_at) }}</td>
                <td class="list-actions">
                    <div class="TableList-Actions inner Hidden">
                        <a href="{{ URL::to('vadmin/exportPedidoPdf/'.$item->id.'/pedido') }}" target="_blank">
							<img class="small-list-img" src="{{ asset('images/gral/pdfsmall.png') }}">
						</a>                     
                        <a href="{{ url('vadmin/pedidos/'. $item->id) }}" class="btn action-btn btnBlue">
							<i class="ion-ios-search"></i>
						</a>
                        <a class="Delete btn action-btn btnRed" data-id="{!! $item->id !!}">
                            <i class="ion-ios-trash-outline"></i>
                        </a>
                        <a class="Close-Actions-Btn btn btn-close btnGrey">
                            <i class="ion-ios-close-empty"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    @endslot
    @slot('tableEmpty')
        @if(! count($pedidos))
        <tr>
            <td>No se han encontrado registros</td>
        </tr>
        @endif
    @endslot
    @slot('pagination')
        {!! $pedidos->render(); !!}
    @endslot
@endcomponent
