
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Cuentas Corrientes')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Cuenta corriente') 
    @section('header_subtitle')
        | {{ $client->razonsocial }} 
    @endsection
	@section('options')

	@endsection
@endsection

{{-- STYLES--}}
@section('styles')
	{{-- Include Styles Here --}}
@endsection

{{-- CONTENT --}}
@section('content')
	@component('vadmin.components.mainloader')@endcomponent

    <div class="container">
		<div class="row">
			<div id="Error"></div>	
			<div class="row">
				{{ $incomings }}
			</div>
			<br>
		</div>
		<button id="BatchDeleteBtn" class="button buttonCancel batchDeleteBtn Hidden"><i class="ion-ios-trash-outline"></i> Eliminar seleccionados</button>
	</div>  
	
@endsection

@section('scripts')
	{{-- Include Scripts Here --}}
@endsection

@section('custom_js')

@endsection

