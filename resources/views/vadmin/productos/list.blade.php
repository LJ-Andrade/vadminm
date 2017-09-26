<div class="col-md-12 animated fadeIn main-list">

	@foreach($productos as $item)
	<div id="Id{{ $item->id }}" class="Select-Row-Trigger Item-Row row item-row {{ $item->estado }}">
		{{-- Column --}}
		<div class="noimg">
		</div>

		<div class="content">
			{{-- Column --}}
			<div class="col-xs-6 col-sm-4 col-md-4 inner">
				<div class="status">
					@if($item->estado=='activo')<span><i class="ion-record status active"></i></i></span>
					@else
					<span><i class="ion-record status paused"></i></span>
					@endif
				</div>
				<span><b>{{ $item->nombre }}</b></span><br>
				
				<span class="small">Cód.: {{ $item->codigo }}</span>
				
			</div>
			{{-- Column --}}
			<div class="col-xs-6 col-sm-3 col-md-4 mobile-hide inner-tags">
				<span class="small-text">{{ $item->categoria->nombre }} > {{ $item->familia->nombre }} > {{ $item->subfamilia->nombre }}</span>
				{{-- <span class="small-text">@if(is_null($item->familia)) @else Familia: {{  $item->familia->nombre }} @endif</span> <br>
				<span class="small-text">@if(is_null($item->subfamilia)) @else Subfamilia: {{ $item->subfamilia->nombre }} @endif</span> <br>--}}
			</div>
            <div class="col-md-3">
				@if($item->stockactual < $item->stockmin) <span class="small-text badge buttonCancel">Stock Depósito: {{ $item->stockactual }} </span><br>
				@else <span class="small-text">Stock Depósito: {{ $item->stockactual }} </span><br> @endif
				@if($item->stocklocal < $item->stockmin) <span class="small-text badge buttonCancel">Stock Local: {{ $item->stocklocal }} </span><br>
				@else <span class="small-text">Stock Local: {{ $item->stocklocal }} </span><br> @endif
				<br>
            </div>
		</div>
		{{-- Batch Delete --}} 
		<div class="batch-delete-checkbox">
			<input type="checkbox" class="BatchDelete" data-id="{{ $item->id }}">
		</div>
		{{-- Hidden Action Buttons --}}
		<div class="List-Actions lists-actions Hidden">
			@if ($item->estado == 'activo')
				<a class="UpdateStatusBtn btnSmall buttonOther" data-action="pausar" data-id="{!! $item->id !!}"><i class="ion-ios-pause"></i></a>
			@elseif ($item->estado == 'pausado')
				<a class="UpdateStatusBtn btnSmall buttonOther" data-action="activar" data-id="{!! $item->id !!}"><i class="ion-ios-play"></i></a>
			@endif
			<a href="{{ url('vadmin/productos/' . $item->id . '/edit') }}" class="ShowEditBtn btnSmall buttonOk" data-id="{{ $item->id }}">
				<i class="ion-ios-compose-outline"></i>
			</a>
			<a href="{{ url('vadmin/productos/'. $item->id) }}" class="btnSmall buttonOther">
				<i class="ion-ios-search"></i>
			</a>
			<a class="ShowPriceBtn btnSmall buttonOk" data-toggle="modal" data-target="#PriceModal" data-id="{!! $item->id !!}"><i class="ion-social-usd"></i></a>
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
	@if(! count($productos))
	<div class="Item-Row item-row empty-row">
		No se han encontrado productos
	</div>
	@endif
</div>
{!! $productos->render(); !!}
<br>
