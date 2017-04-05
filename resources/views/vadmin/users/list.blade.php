
<div class="col-md-12 animated fadeIn main-list">

	@foreach($users as $user)
	<div id="Id{{ $user->id }}" class="row Item-Row item-row Select-Row-Trigger" data-data="{{ $user }}">
		{{-- Column --}}
		<div class="img">
			@if($user->avatar)
			<img class="thumb" src="{{ asset('images/users/'. $user->avatar ) }}">
			@else
			<img class="thumb" src="{{ asset('images/gen/user-gen.jpg') }}">
			@endif
		</div>

		<div class="content">
			{{-- Column --}}
			<div class="col-xs-6 col-sm-4 col-md-4 inner withimg">
				<span><b>{{ $user->name }}</b></span><br>
				<span class="small">{{ $user->email }}</span>
			</div>
			{{-- Column --}}
			<div class="col-xs-6 col-sm-3 col-md-4 mobile-hide inner-tags">
				<span class="small-text"></span><span class="custom-badge buttonOk">{{ typeTrd($user->type) }}</span> <br>
				<span class="small-text"></span><span class="custom-badge buttonOther">{{ roleTrd($user->role) }}</span>
			</div>
		
		</div>
		{{-- Batch Delete --}} 
		<div class="batch-delete-checkbox">
			<input type="checkbox" class="BatchDelete" data-id="{{ $user->id }}">
		</div>
		{{-- Hidden Action Buttons --}}
		<div class="List-Actions lists-actions Hidden">
			<a class="ShowEditBtn btnSmall buttonOk" data-id="{{ $user->id }}">
				<i class="ion-ios-compose-outline"></i>
			</a>
			<a target="_blank" class="btnSmall buttonOther">
				<i class="ion-ios-search"></i>
			</a>
			<button class="Delete btnSmall buttonCancel" data-id="{!! $user->id !!}">
				<i class="ion-ios-trash-outline"></i>
			</button>
			<a class="Close-Actions-Btn btn btn-danger btn-close">
				<i class="ion-ios-close-empty"></i>
			</a>
		</div>
	</div>

	@endforeach





	{{-- If there is no articles published shows this --}}
	@if(! count($users))
	<div class="Item-Row item-row empty-row">
		No se han encontrado usuarios
	</div>
	@endif
</div>
{!! $users->render(); !!}
<br>
