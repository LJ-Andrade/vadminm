@component('vadmin.components.tablelist')
    @slot('tableTitles')
        <th></th>
        <th>Estado</th>
        <th>Número</th>
        <th>Cliente</th>
        <th>Fecha</th>
        <th></th>
    @endslot
    @slot('tableContent')
        @foreach($pedidos as $item)
            <tr id="Id{{ $item->id }}" class="TableList-Row table-list-row">
                <td class="list-checkbox">
                    <input type="checkbox" class="BatchDelete" data-id="{{ $item->id }}">
                </td>
                <td class="special-input">
                    <div class="select-container">
                    @if($item->estado == '1')
                        <div class="status status1"><i class="ion-ios-circle-filled"></i></div>
                        <div class="select">
                            {!! Form::select('estado', ['1' => 'Pendiente', '2' => 'Preparado', '3' => 'Enviado'], $item->estado, ['class' => 'PedidoStatus form-control', 'data-id' => $item->id]) !!}
                        </div>
                    
                    @elseif($item->estado == '2')
                        <div class="status status2"><i class="ion-ios-circle-filled"></i></div>
                        <div class="select">
                            {!! Form::select('estado', ['1' => 'Pendiente', '2' => 'Preparado', '3' => 'Enviado'], $item->estado, ['class' => 'PedidoStatus form-control', 'data-id' => $item->id]) !!}
                        </div>
                    @elseif($item->estado == '3')
                        <div class="status status3"><i class="ion-ios-circle-filled"></i></div>
                        <div class="select">
                            {!! Form::select('estado', ['1' => 'Pendiente', '2' => 'Preparado', '3' => 'Enviado'], $item->estado, ['class' => 'PedidoStatus form-control', 'data-id' => $item->id]) !!}
                        </div>
                    @else
                        <div class="status status4"><i class="ion-ios-circle-filled"></i></div>
                        <div class="select">
                            {!! Form::select('estado', ['1' => 'Pendiente', '2' => 'Preparado', '3' => 'Enviado'], $item->estado, ['class' => 'PedidoStatus form-control', 'data-id' => $item->id]) !!}
                        </div>
                    @endif
                    </div>
                </td>
                <td class="w100">N° {{ $item->id }}</td>
                <td>{{ $item->cliente->razonsocial }}</td>
                <td class="w150">{{ transDateT($item->created_at) }}</td>
                <td class="list-actions">
                    <div class="TableList-Actions inner Hidden">
                        <a href="{{ url('vadmin/pedidos/'. $item->id) }}" class="btn action-btn btnBlue">
							<i class="ion-ios-search"></i>
						</a>
                        <a  href="{{ URL::to('vadmin/exportPedidoPdf/'.$item->id) }}" class="Delete btn action-btn btnGrey" target="_blank">
							<i class="ion-ios-cloud-download-outline"></i>
						</a>                     
                        <a class="Delete btn action-btn btnRed" data-id="{!! $item->id !!}">
                            <i class="ion-ios-trash-outline"></i>
                        </a>
                        <a class="Close-Actions-Btn btn btn-close">
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
            <td></td>
            <td></td>
            <td></td>
            <td>No se han encontrado registros</td>
            <td></td>
            <td></td>
        </tr>
        @endif
    @endslot
    @slot('pagination')
        @if(isset($_GET['show']))
			{!! $pedidos->appends(['show' => $show])->render(); !!}
		@elseif(isset($_GET['id']))
            {!! $pedidos->appends(['id' => $id])->render(); !!}
        @else
            {!! $pedidos->render(); !!}
		@endif
    @endslot
@endcomponent
