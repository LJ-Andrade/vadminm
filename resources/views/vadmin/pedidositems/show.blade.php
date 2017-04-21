
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Pedidos Items')

{{-- HEAD--}}
@section('header')
	@section('header_title')
		Hoja Item de Pedidos
    @endsection 
	@section('options')
		<div class="actions">
            <a href="{{ url('vadmin/pedidositems') }}" class="btn btnSm buttonOther">Volver</a>
		</div>	
	@endsection
@endsection

{{-- STYLES--}}
@section('styles')
	{{-- Include Styles Here --}}
@endsection
{{-- CONTENT --}}
@section('content')
    <div class="container">
        <div id="Error"></div>
		<div class="row big-card">
		 	<div class="title">
			    <h1>Cliente: {{ $pedidositem->cliente->razonsocial }}</h1>
            </div>		
			<div class="content">
				<div class="row">
					
					<div class="col-md-6">
						{{$pedidositem->producto->nombre}}
					</div>

					<div class="col-md-6">
						
					</div>
				</div>	
			</div>		
		</div>
	</div>  
		
@endsection

@section('scripts')
	{{-- Include Scripts Here --}}
@endsection