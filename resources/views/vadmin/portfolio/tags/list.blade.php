
<div class="col-md-12 animated fadeIn main-list">

	@foreach($tags as $tag)
	<div id="Id{{ $tag->id }}" class="Item-Row Select-Row-Trigger row item-row simple-list" data-data="{{ $tag }}">
		{{-- Column --}}
		<div class="img">
	
		</div>

		<div class="content">
			{{-- Column --}}
			<div class="col-xs-6 col-sm-4 col-md-4 inner">
				<span><b>{{ $tag->name }}</b></span><br>
			</div>
			{{-- Column --}}
			<div class="col-xs-6 col-sm-3 col-md-4 mobile-hide inner-tags">
			</div>
			
		</div>

		{{-- Action Button --}}
		<div class="lists-actions-trigger">
			<button type="button" class="Lists-Actions-Trigger action-btn" data-toggle="modal" data-target="#Actions{{ $tag->id }}">
				<i class="ion-ios-gear-outline"></i>
			</button>
		</div>

	
		{{-- Hidden Action Buttons --}}
		<div class="List-Actions lists-actions Hidden">
			<a class="ShowEditBtn btnSmall buttonOk" data-id="{{ $tag->id }}">
				<i class="ion-ios-compose-outline"></i>
			</a>
			<a target="_blank" class="btnSmall buttonOther">
				<i class="ion-ios-search"></i>
			</a>
			<button class="Delete btnSmall buttonCancel" data-id="{!! $tag->id !!}">
				<i class="ion-ios-trash-outline"></i>
			</button>
			<a class="Close-Actions-Btn btn btn-danger btn-close">
				<i class="ion-ios-close-empty"></i>
			</a>
		</div>
			{{-- Right Slot --}}
		<div class="Status-Icon Status{{ $tag->id }} status-icon">
			{{-- Batch Delete --}} 
			<input type="checkbox" class="BatchDelete" data-id="{{ $tag->id }}">
		</div>
	</div>

	@endforeach





	{{-- If there is no articles published shows this --}}
	@if(! count($tags))
	<div class="Item-Row item-row empty-row">
		No se han encontrado categorías
	</div>
	@endif
</div>
{!! $tags->render(); !!}
<br>
