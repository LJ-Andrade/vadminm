
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Factura')

{{-- HEAD--}}
@section('header')
	@section('header_title')
		Hoja de Factura
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
			    <h1>Título: </h1>
            </div>		
			<div class="content">
				<div class="row">
					
					<div class="col-md-6">
						<b>Texto:</b>
                  
					</div>

					<div class="col-md-6">
						<b>Otro Texto:</b>   
						
					</div>
				</div>	
			</div>		
		</div>
	</div>  
		
@endsection

@section('scripts')
	{{-- Include Scripts Here --}}
@endsection