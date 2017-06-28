
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
				<div id="FcBody" class="big-form">
					<div class="inner-row">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Facturado</th>
										<th>Pagos</th>
									</tr>
								</thead>
								<tbody id="FcItems">
									@foreach( $fcs as $fc)
									<tr>
										<td>$ {{ $fc->total }}</td>
										<td>$ 0 </td>
									</tr>
									@endforeach
									<tr>
										<td>
											Debe: <b>$ {{ $incomings }} </b>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
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

