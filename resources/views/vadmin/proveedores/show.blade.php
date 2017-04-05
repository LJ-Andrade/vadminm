
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Proveedores')

{{-- HEAD--}}
@section('header')
	@section('header_title')
		Hoja de Proveedor
    @endsection 
	@section('options')
		<div class="actions">
            <a href="{{ url('vadmin/proveedores') }}" class="btn btnSm buttonOther">Volver</a>
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
		<div class="row big-card">		
			<h1>{{ $proveedor->nombre }}</h1>
			<hr class="softhr">
			<div class="col-md-6">
				<b>Razón Social: </b>{{ $proveedor->razonsocial }} <br>
                <b>Código: </b>{{ $proveedor->id }} <br>
                <b>Cuit: </b>{{ $proveedor->cuit }} <br>
                <b>Ingresos Brutos: </b>{{ $proveedor->ingbrutos }} <br>
                <b>Condición de Iva: </b>@if(is_null($proveedor->iva)) @else {{ $proveedor->iva->name }} @endif <br> 
			</div>
            <div class="col-md-6">
                <b>Teléfonos: </b>{{ $proveedor->telefonos }} <br>
                <b>E-mail: </b>@if(is_null($proveedor->email)) @else {{ $proveedor->email}} @endif <br>
                <b>Dirección: </b>@if(is_null($proveedor->direccion)) @else {{ $proveedor->direccion}} @endif <br>
                <b>País: </b>@if(is_null($proveedor->pais)) @else {{ $proveedor->pais}} @endif <br>
                <b>Código Postal: </b>@if(is_null($proveedor->codpostal)) @else {{ $proveedor->codpostal}} @endif <br>
                <b>Provincia: </b>@if(is_null($proveedor->provincia)) @else {{ $proveedor->provincia->name}} @endif <br>
                <b>Localidad: </b>@if(is_null($proveedor->localidad)) @else {{ $proveedor->localidad->name}} @endif <br>
            </div>
            <div class="col-md-12">
                <hr class="softhr">
                <b>Notas:</b>     <br>
                @if(is_null($proveedor->notas)) @else {{ $proveedor->notas}} @endif 
            </div>		
		</div>		
		<button id="BatchDeleteBtn" class="button buttonCancel batchDeleteBtn Hidden"><i class="ion-ios-trash-outline"></i> Eliminar seleccionados</button>
	</div>  
	<div id="Error"></div>	
@endsection

@section('scripts')
	{{-- Include Scripts Here --}}
@endsection