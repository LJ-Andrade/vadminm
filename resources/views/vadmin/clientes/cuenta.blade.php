
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
		<div class="actions">
			<button id="ClientAccountSidebarBtn" type="button" class="animated fadeIn btnSm buttonOther">Ingresar Pagos</button>
		</div>
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
		<div class="row account-container">
			<div id="Error"></div>
				<div id="ClientAccountTable" class="col-md-12">
					<div class="big-form small-text-table">
						<div class="inner-row">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>Movimiento</th>
											<th>Detalle</th>
											<th>Pertenece a</th>
											<th>Importe</th>
											<th>Subtotal</th>
											<th style="text-align:right">Fecha</th>
										</tr>
									</thead>
			
									<tbody id="MovementItems">
										@if($movimientos->isEmpty())
										<tr>
											<th>Aún no hay movimientos</th>
										</tr>
										@endif
										@foreach( $movimientos as $item )
											@if($item->op == 'I')
											<tr class="ingreso">
											@elseif($item->op == 'E')
											<tr class="egreso">
											@else
											<tr>
											@endif
												<td>{{ movementType($item->modo) }}</td>
												<td>{{ $item->det1 }} {{ $item->det2 }}</td>
												<td>@if($item->comprobante_nro)N° {{ $item->comprobante_nro }}@endif</td>
												{{-- <td><input class="Importe"  disabled type="text" value="{{ $item->importe }}" disabled></td>
												<td><input  class="Subtotal" disabled type="text" value="" disabled></td> --}}
												<td>$ {{ $item->importe }}</td>
												<td>$ {{ $item->subtotal }}</td>
												<td style="text-align:right">{{ transDateT($item->created_at) }}</td>
											</tr>
										@endforeach
									</tbody>
									<tr class="totals-tr">
										<td></td>
										<td></td>
										<td></td>
										<td style="text-align: right"><b>SALDO: $ {{ $saldo }}</b> </td>
										<td><span id="FinalTotal"></span></td>
										<td></td>
									</tr>
								</table>
							</div>
						</div>
						<a href="{{ URL::to('vadmin/exportAccountPdf/'.$client->id) }}" target="_blank"><button class="btnSmall green-back"><i class="ion-android-exit"></i> Generar Pdf</button></a>
						<a href="{{ URL::to('vadmin/exportAccountExcel/'.$client->id.'/xls',str_replace(' ', '-', $client->razonsocial.'('.$fecha.')')) }}"><button class="btnSmall blue-back"><i class="ion-android-exit"></i> Descargar Excel</button></a>
					</div>
				</div>
				{{-- SideBar --}}
				<div id="ClientAccountSidebar" class="side-bar-container col-md-4">
					<div class="side-bar">
						<div id="CloseClientAccountSideBar" class="close-this">X</div>
						<div class="title">
							Ingreso de Pagos
						</div>
						@include('vadmin.clientes.payments')
					</div>
				</div>	
			<br>
		</div>
		{!! $movimientos->render(); !!}
		<button id="BatchDeleteBtn" class="button buttonCancel batchDeleteBtn Hidden"><i class="ion-ios-trash-outline"></i> Eliminar seleccionados</button>
	</div>  
	
@endsection

@section('scripts')
	@include('vadmin.components.ajaxscripts');
@endsection

@section('custom_js')
	
	<script>

		function calcSubtotals(){
			
			$('#MovementItems tr').each(function(index,value){
				
				var value    = $(this).find('td .Importe').val();
				// Set first subtotal to 0 and get all previous subtotals
				if(index==0){
					lastvalue = 0;
				} else {
					lastvalue    = $(this).prev().find('td .Subtotal').val();
				}

				var subtotal = (parseFloat(value) + parseFloat(lastvalue));
				// console.log('Subtotal: ' + subtotal);
				
				$(this).find('td .Subtotal').val(subtotal);
			});
			
			
			var total = $("#MovementItems tr:last-child .Subtotal").val();
			
			$('#FinalTotal').html(total);

		}

		calcSubtotals();

	</script>
@endsection

