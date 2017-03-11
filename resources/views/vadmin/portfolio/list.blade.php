
<div class="col-md-12 animated fadeIn main-list">

	@foreach($articles as $article)
	<div id="Id{{ $article->id }}" class="row Item-Row item-row Select-Row-Trigger" data-data="{{ $article }}">
		{{-- Column --}}
		<div class="img">
			
			@if(count($article->images))
			<img class="thumb" src="{{ asset('webimages/portfolio/'. $article->images->first()->name ) }}">
			@else
			<img class="thumb" src="{{ asset('webimages/gen/genlogo.jpg') }}">
			@endif

		</div>

		<div class="content">
			{{-- Column --}}
			<div class="col-xs-6 col-sm-4 col-md-4 inner">
				<span><b>{{ $article->title }}</b></span><br>
				<span class="small">{{ $article->category->name }}</span>
			</div>
			{{-- Column --}}
			<div class="col-xs-6 col-sm-3 col-md-4 mobile-hide inner-tags">
				
			</div>
	
		</div>
			{{-- Action Button --}}
		<div class="lists-actions-trigger">
			<button type="button" class="Lists-Actions-Trigger action-btn" data-toggle="modal" data-target="#Article-Actions">
				<i class="ion-ios-gear-outline"></i>
			</button>
		</div>
		
		{{-- Right Slot --}}
		<div class="Status-Icon Status{{ $article->id }} status-icon">
			{{-- Batch Delete --}} 
			<input type="checkbox" class="BatchDelete" data-id="{{ $article->id }}">
		</div>
		{{-- Hidden Action Buttons --}}
		<div class="List-Actions lists-actions Hidden">
			<a href="{{ route('portfolio.edit', $article->id) }}" class="btnSmall buttonOk">
				<i class="ion-ios-compose-outline"></i>
			</a>
			<a href="{!! route('web.portfolio.article',$article->slug ) !!}" target="_blank" class="btnSmall buttonOther">
				<i class="ion-ios-search"></i>
			</a>
			<button class="Delete btnSmall buttonCancel" data-id="{!! $article->id !!}">
				<i class="ion-ios-trash-outline"></i>
			</button>
			<a class="Close-Actions-Btn btn btn-danger btn-close">
				<i class="ion-ios-close-empty"></i>
			</a>
		</div>
	</div>

	@endforeach





	{{-- If there is no articles published shows this --}}
	@if(! count($articles))
	<div class="item-row empty-row">
		No se han encontrado artículos
	</div>
	@endif
</div>
{!! $articles->render(); !!}
<br>
