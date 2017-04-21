
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Pedidos')

{{-- HEAD--}}
@section('header')
	@section('header_title')
		Hoja de Pedido
    @endsection 
	@section('options')
		<div class="actions">
            <a href="{{ url('vadmin/pedidos') }}" class="btn btnSm buttonOther">Volver</a>
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
			    <h1>Cliente: {{ $pedido->cliente->razonsocial}}</h1>
				<div class="small-text">Pedido N°: {{ $pedido->id }} </div>
				<div class="right text-right">Creado el <br> {{ transDateT($pedido->created_at) }}</div>
            </div>		
			<div class="content">
				<div class="row">
					<div class="col-md-12 subtitle">
						<div class="col-md-3">Item</div>
						<div class="col-md-3">Cantidad</div>
						<div class="col-md-3">Precio U.</div>
						<div class="col-md-3">Total</div>
					</div>
					@foreach($pedido->pedidositems as $item) 
					<div class="col-md-12">
						<div class="col-md-3"><span>{{ $item->producto->nombre }}</span></div> 
						<div class="col-md-3"><span>{{ $item->cantidad }}</span>	</div>
						<div class="col-md-3"><span>$ {{ $item->valor}}</span>	</div>
						<div class="col-md-3"><span>$ {{ $item->cantidad * $item->valor}}</span>	</div>
					</div>
					@endforeach
					<div class="col-md-3 pull-right">
						<br>
						<div class="">
							TOTAL <br> <b>$ {{ $total }}</b>
						</div>
					</div>
				</div>	
			</div>		
		</div>
	</div>  
		
@endsection

@section('scripts')
	{{-- Include Scripts Here --}}
@endsection