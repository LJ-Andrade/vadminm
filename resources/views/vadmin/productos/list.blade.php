<div class="col-md-12 animated fadeIn main-list">

	@foreach($productos as $item)
	<div id="Id{{ $item->id }}" class="row Item-Row item-row Select-Row-Trigger">
		{{-- Column --}}
		<div class="noimg">
		</div>

		<div class="content">
			{{-- Column --}}
			<div class="col-xs-6 col-sm-4 col-md-4 inner">
				<span><b>{{ $item->nombre }}</b></span><br>
				<span class="small">Código: {{ $item->id }}</span>
			</div>
			{{-- Column --}}
			<div class="col-xs-6 col-sm-3 col-md-4 mobile-hide inner-tags">
				
			</div>
            <div class="col-md-3">
            
            </div>
		</div>
		{{-- Batch Delete --}} 
		<div class="batch-delete-checkbox">
			<input type="checkbox" class="BatchDelete" data-id="{{ $item->id }}">
		</div>
		{{-- Hidden Action Buttons --}}
		<div class="List-Actions lists-actions Hidden">
			<a class="ShowEditBtn btnSmall buttonOk" data-id="{{ $item->id }}">
				<i class="ion-ios-compose-outline"></i>
			</a>
			<a href="{{ url('vadmin/productos/'. $item->id) }}" class="btnSmall buttonOther">
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
	@if(! count($productos))
	<div class="Item-Row item-row empty-row">
		No se han encontrado productos
	</div>
	@endif
</div>
{!! $productos->render(); !!}
<br>
