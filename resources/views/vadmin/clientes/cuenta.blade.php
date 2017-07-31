
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
				<div class="col-md-8">
					<div class="big-form small-text-table">
						<div class="inner-row">
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th>Movimiento</th>
											<th>Detalle</th>
											<th>Factura</th>
											<th>Importe</th>
											<th>Fecha</th>
										</tr>
									</thead>
									<tbody id="FcItems">
										@foreach( $movements as $item )
											{{-- Detalle --}}
											@if($item->op == 'F')
											<tr class="factura-test">
												<td><i class="ion-reply"></i> FC N° {{ $item->numero }}</td>
												<td></td>
												<td></td>
												<td>- $ {{ $item->total }}</td>
												<td>{{ transDateT($item->created_at) }}</td>
											</tr>
											@endif
											@if($item->op == 'P')
											<tr class="pago-test">
												<td><i class="ion-forward"></i> 
													{{ paymentType($item->modo) }}
												</td>
												<td>
													@if($item->ret_nro != null)
														N° {{$item->ret_nro}} - 
														{{ $item->ret_tipo }} -
														{{ $item->ret_jurisdiccion }}
													@endif
													@if($item->ch_banco != null)
														N° {{ $item->ch_banco_nro }} -
														Cuit: {{ $item->ch_cuit }} <br>
														Banco: {{ $item->ch_banco }} 
														({{ $item->ch_sucursal }}) -
														{{ $item->ch_fechacobro }}
													@endif
													@if($item->bco_movimiento != null)
														{{ $item->bco_movimiento }}
													@endif
												</td>
												<td>@if($item->factura_nro != null)
													N° {{ $item->factura_nro }}
													@endif
												</td>
												<td>+ ${{ $item->importe }}</td>
												<td>{{ transDateT($item->created_at) }}</td>
											</tr>
											@endif
										@endforeach
										<tr class="totals-tr">
											<td></td>
											<td></td>
											<td>
												@if ($totals < 0)
												  <b>Saldo a Favor:</b>
												@elseif($totals == 0)
													Aún no hay movimientos
												@else
												 <b>Debe:</b>
												@endif
											</td>
											<td>
												@if ($totals < 0)
												  <b>$ {{ str_replace('-', '', $totals) }} </b>
												@elseif($totals == 0)
													
												@else
												 <b>$ {{ $totals }} </b>
												@endif

											</td>
											<td></td>
										</tr>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href="{{ URL::to('vadmin/downloadExcel/Pago/xls',str_replace(' ', '-', $client->razonsocial.'('.$fecha.')')) }}"><button class="btnSmall green-back">Descargar Excel</button></a>
											</td>
											<td>
												<a href="{{ URL::to('vadmin/exportAccount/'.$client->id.'/xls',str_replace(' ', '-', $client->razonsocial.'('.$fecha.')')) }}"><button class="btnSmall green-back"><i class="ion-android-exit"></i> Descargar Excel</button></a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="side-bar">
						<div class="title">
							Ingreso de Pagos
						</div>
						@include('vadmin.components.payments')
					</div>
				</div>	
			<br>
		</div>
		<button id="BatchDeleteBtn" class="button buttonCancel batchDeleteBtn Hidden"><i class="ion-ios-trash-outline"></i> Eliminar seleccionados</button>
	</div>  
	
@endsection

@section('scripts')
	@include('vadmin.components.ajaxscripts');
@endsection

@section('custom_js')

@endsection

