
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Factura')

{{-- HEAD--}}
@section('header')
	@section('header_title')
		Confección de Factura
    @endsection 
	@section('options')
		<div class="actions">
            <a href="{{ url('/vadmin/facturas') }}" class="btn btnSm buttonOther">Volver</a>
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
			 
				<h2>Cliente: {{ $cliente->razonsocial}}</h2>
				<div id="ClienteCuit">Cuit: {{ $cliente->cuit }}</div>
				<div id="TipoCte" data-tipocte="{{ $cliente->tipo_id }}">Tipo: {{ $cliente->tipoct->name }}</div>
				<div class="right text-right">{{ date("d/m/y") }} <br> 
					<select name="" id="">
						<option value="">A</option>
						<option value="">B</option>
					</select>
				</div>
            </div>		
			<div class="content">
				<div class="row">
					<div class="col-md-12">
					
						<b>Items:</b>
						@foreach($items as $item)

						<div class="col-md-12">
							{{ $item->producto->id }}
							{{ $item->producto->nombre }}
							{{ $item->producto->costopesos }}
						</div> <br>
						@endforeach
					</div>

				</div>	
			</div>		
		</div>
	</div>  
		
@endsection

@section('scripts')
	{{-- Include Scripts Here --}}
@endsection