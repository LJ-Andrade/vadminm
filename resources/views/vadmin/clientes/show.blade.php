
@extends('vadmin.layouts.main')

{{-- PAGE TITLE--}}
@section('title', 'Vadmin | Clientes')

{{-- HEAD--}}
@section('header')
	@section('header_title')
		
        Cliente: {{ $cliente->razonsocial }}
    @endsection 
	@section('options')
		<div class="actions">
            <a href="{{ url('vadmin/clientes') }}" class="btn btnSm buttonOther">Volver</a>
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

            <div class="col-md-3"><b>Razón Social:</b></div>        <div class="col-md-3"> {{ $cliente->razonsocial }} </div><br>
		    <div class="col-md-3"><b>Código de Cliente:</b></div>   <div class="col-md-3"> {{ $cliente->id }} </div> <br>
            <div class="col-md-3"><b>CUIT:</b></div>                <div class="col-md-3"> {{ $cliente->cuit }} </div><br>
            <div class="col-md-3"><b>Dirección Fiscal:</b></div>    <div class="col-md-3"> {{ $cliente->dirfiscal }} </div><br>
            <div class="col-md-3"><b>Provincia:</b></div>           <div class="col-md-3"> {{ $cliente->provincia->name }} </div><br>
            <div class="col-md-3"><b>Localidad:</b></div>    
			<div class="col-md-3"> @if(is_null($cliente->localidad)) @else {{ $cliente->localidad->name }} @endif </div><br>

			<div class="col-md-3"><b>Condiciones de Vta.:</b></div> 
			<div class="col-md-3"> @if(is_null($cliente->condicventas)) @else {{ $cliente->condicventas->name }} @endif </div><br>

			<div class="col-md-3"><b>Lista de Precios:</b></div>    
			<div class="col-md-3"> @if(is_null($cliente->listas)) @else {{ $cliente->listas->name }} @endif </div><br>
			
			<div class="col-md-3"><b>Vendedor:</b></div>            
			<div class="col-md-3"> @if(is_null($cliente->user)) @else {{ $cliente->user->name }} @endif </div><br>
			
			<div class="col-md-3"><b>Zona:</b></div>                
			<div class="col-md-3"> @if(is_null($cliente->zona)) @else {{ $cliente->zona->name }} @endif </div><br>

			<div class="col-md-3"><b>Flete:</b></div>     
			<div class="col-md-3"> @if(is_null($cliente->flete)) @else {{ $cliente->flete->name }} @endif </div><br>
          
		</div>
		<button id="BatchDeleteBtn" class="button buttonCancel batchDeleteBtn Hidden"><i class="ion-ios-trash-outline"></i> Eliminar seleccionados</button>
	</div>  
	<div id="Error"></div>	
@endsection

@section('scripts')
	{{-- Include Scripts Here --}}
@endsection