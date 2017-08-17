@component('vadmin.components.tablelist')
    @slot('tableTitles')
        <th></th>
        <th>Zona</th>
        <th></th>
        <th></th>
        <th></th>
    @endslot
    @slot('tableContent')
        @foreach($zonas as $item)
            <tr id="Id{{ $item->id }}" class="TableList-Row table-list-row">
                <td class="list-checkbox">
                    <input type="checkbox" class="BatchDelete" data-id="{{ $item->id }}">
                </td>
                <td>{{ $item->name }}</td>
                <td></td>
                <td></td>
                <td class="list-actions">
                    <div class="TableList-Actions inner Hidden">
                        <a href="{{ url('/vadmin/zonas/' . $item->id . '/edit') }}" class="btn action-btn btnGreen" data-id="{{ $item->id }}">
                            <i class="ion-edit"></i>
                        </a>
                        {{-- <a target="_blank" class="btn action-btn btnBlue">
                            <i class="ion-ios-search"></i>
                        </a> --}}
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
        @if(! count($zonas))
        <tr>
            <td>No se han encontrado registros</td>
        </tr>
        @endif
    @endslot
    @slot('pagination')

    @endslot
@endcomponent