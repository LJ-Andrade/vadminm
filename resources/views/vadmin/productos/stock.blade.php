@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Stock')

{{-- HEAD--}}
@section('header')
	@section('header_title', 'Stock de Productos') 
	@section('options')
	@endsection
@endsection

{{-- STYLES--}}
@section('styles')
	{{-- Include Styles Here --}}
@endsection

{{-- CONTENT --}}
@section('content')
	<div class="container">
		@include('vadmin.productos.stocksearcher')
		<div class="row">
			@include('vadmin.productos.stocklist')
		</div>
	</div>
@endsection

@section('scripts')
	{{-- Include Scripts Here --}}
@endsection

@section('custom_js')

	<script type="text/javascript">
    </script>

@endsection