
<div class="col-md-12 animated fadeIn main-list">

	@foreach($clientes as $item)
	<div id="Id{{ $item->id }}" class="row Item-Row item-row Select-Row-Trigger" data-data="{{ $item }}">
		{{-- Column --}}
		<div class="noimg">
		</div>

		<div class="content">
			{{-- Column --}}
			<div class="col-xs-6 col-sm-4 col-md-4 inner">
				<span><b>{{ $item->razonsocial }}</b></span><br>
				<span class="small">Código: {{ $item->id }}</span>
			</div>
			{{-- Column --}}
			<div class="col-xs-6 col-sm-3 col-md-4 mobile-hide inner-tags">
				<span class="small-text">{{ $item->dirfiscal }}</span><br>
				<span class="small-text">@if (is_null($item->provincia)) @else {{ $item->provincia->name }} @endif</span>
				<span class="small-text">@if (is_null($item->localidad)) @else | {{ $item->localidad->name }} @endif</span>
			</div>
            <div class="col-md-3">
            	<span class="small-text">@if(is_null($item->iva)) @else {{ $item->iva->name }} @endif</span> <br>
				<span class="small-text">@if(is_null($item->listas)) @else {{ $item->listas->name }} @endif</span>
            </div>
		</div>
		{{-- Action Button --}}
		<div class="lists-actions-trigger">
			<button type="button" class="Lists-Actions-Trigger action-btn" data-toggle="modal" data-target="#Article-Actions{{ $item->id }}">
				<i class="ion-ios-gear-outline"></i>
			</button>
		</div>
		{{-- Right Slot --}}
		<div class="Status-Icon Status{{ $item->id }} status-icon">
			{{-- Batch Delete --}} 
			<input type="checkbox" class="BatchDelete" data-id="{{ $item->id }}">
		</div>
		{{-- Hidden Action Buttons --}}
		<div class="List-Actions lists-actions Hidden">
			<a class="ShowEditBtn btnSmall buttonOk" data-id="{{ $item->id }}">
				<i class="ion-ios-compose-outline"></i>
			</a>
			<a href="{{ url('vadmin/clientes/'. $item->id) }}" class="btnSmall buttonOther">
				<i class="ion-ios-search"></i>
			</a>
			<button class="Delete btnSmall buttonCancel" data-id="{!! $item->id !!}">
				<i class="ion-ios-trash-outline"></i>
			</button>
			<a class="Close-Actions-Btn btn btn-danger btn-close">
				<i class="ion-ios-close-empty"></i>
			</a>
		</div>
	</div>

	@endforeach

	{{-- If there is no articles published shows this --}}
	@if(! count($clientes))
	<div class="Item-Row item-row empty-row">
		No se han encontrado clientes
	</div>
	@endif
</div>
{!! $clientes->render(); !!}
<br>
