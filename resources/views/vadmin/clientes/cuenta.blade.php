
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
	{!! Html::style('plugins/datepickermonth/MonthPicker.css') !!}
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
								<div class="title">
									<b>Mes: </b> <span class="custom-badge blue-back">{{ $mes }}</span>
									@if($saldoAnterior != '' ) |<b> Saldo Anterior: </b> <span class="custom-badge blue-back">${{ $saldoAnterior }} </span>@endif
									
								</div>
								<thead>
									<tr>
										<th>Movimiento</th>
										<th>Detalle</th>
										<th>Pertenece a</th>
										<th>Egresos</th>
										<th>Ingresos</th>
										<th style="text-align:right">Fecha</th>
										<th></th>
									</tr>
								</thead>
		
								<tbody id="MovementItems">
									@if($movimientos->isEmpty())
									<tr>
										<th>No hay movimientos</th>
									</tr>
									@endif
									@foreach( $movimientos as $item )
											
										@if($item->op == 'I')
										<tr id="Id{{ $item->id }}" class="ingreso">
										@elseif($item->op == 'E')
										<tr id="Id{{ $item->id }}" class="egreso">
										@else
										<tr id="Id{{ $item->id }}" >
										@endif
											<td>{{ movementType($item->modo) }}</td>
											{{-- Details --}}
											<td>
											@if($item->det1)   {{ $item->det1}} @endif
											@if($item->det2) | {{ $item->det2}} @endif
											@if($item->det3) | {{ $item->det3}} @endif
											@if($item->det4) | {{ $item->det4}} @endif
											@if($item->det5) | {{ $item->det5}} @endif

											{{-- Comp Number --}}
											<td>@if($item->comprobante_nro)N° {{ $item->comprobante_nro }}@endif</td>
											
											{{-- Movements Values --}}
											@if($item->op == 'E')
											<td>$ {{ $item->importe }}</td>
											<td></td>
											@else
											@endif

											@if($item->op == 'I')
											<td></td>
											<td>$ {{ $item->importe }}</td>
											@else
											@endif

											{{-- Creation Date --}}
											<td style="text-align:right">{{ transDateT($item->created_at) }}</td>
											@if($item->op == 'E')
											<td></td>
											@else
											<td class="delete DeleteMovement" data-id="{{ $item->id }}"><i class="ion-close-round"></i></td>
											@endif
										</tr>
									@endforeach
								</tbody>
								<tr class="totals-tr">
									<td></td>
									<td></td>
									<td></td>
									<td style="text-align: right"><b>SALDO: </b> </td>
									<td><span id="FinalTotal"><b>$ {{ $saldo }}</b></span></td>
									<td></td>
									<td></td>
								</tr>
							</table>
						</div>
					</div>
					<div class="pull-right">
						<button id="ExportPdf1" class="btnSmall green-back"><i class="ion-android-exit"></i> Generar Pdf</button>
						<a href="{{ URL::to('vadmin/exportAccountExcel/'.$client->id.'/xls',str_replace(' ', '-', $client->razonsocial.'('.$fecha.')')) }}"><button class="btnSmall blue-back"><i class="ion-android-exit"></i> Descargar Excel</button></a>
					</div>
					{{-- <div class="input-append date" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
						<input id="DatePicker" class="span2" size="16" type="text" value="12-02-2012">
						<span class="add-on"><i class="icon-th"></i></span>
						<button id="MonthSelector" class="btnSm btnBlue">Filtrar</button>							
					</div> --}}
					<input id="MonthInput" type="text" class="month-year-input">
					<button id="MonthSelector" class="btnSm btnBlue">Filtrar</button> | 
					<button id="MonthShowAll" class="btnSm btnGreen">Mostrar Todos</button>

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
	{{-- 	{!! $movimientos->render(); !!} --}}
		<button id="BatchDeleteBtn" class="button buttonCancel batchDeleteBtn Hidden"><i class="ion-ios-trash-outline"></i> Eliminar seleccionados</button>
	</div>  
	
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('plugins/datepickermonth/MonthPicker.js') }}" ></script>
@endsection

@section('custom_js')
	
	<script>
		
		/////////////////////////////////////////////////
		//         Filter List By Month And Year       //
		/////////////////////////////////////////////////

		$("#MonthInput").MonthPicker({
			Button: '<button>...</button>',
			i18n: {
				year: "Año",
				backTo: "Volver a",
				months: ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dec"]
			}
		});

		$('#MonthSelector').click(function(e){
			e.preventDefault();
			var input  = $('#MonthInput').val();
			var month  = $('#MonthInput').MonthPicker('GetSelectedMonth');
			var year   = $('#MonthInput').MonthPicker('GetSelectedYear');
			var id     = "{{ $client->id }}";
			var route  = "{{ url('vadmin/clientes/cuenta') }}/id="+id+"/month="+month+"/year="+year+"/action=show";

			if(input != '') {
				window.location.href = route;
			} else {
			}

		});

		$('#MonthShowAll').click(function(){
			var id     = "{{ $client->id }}";
			var route  = "{{ url('vadmin/clientes/cuenta') }}/id="+id+"/month=*/year=*/action=show";
			window.location.href = route;
		});
		
		/////////////////////////////////////////////////
		//                  Export                     //
		/////////////////////////////////////////////////

		$('#ExportPdf1').click(function(){
			var id     = getUrlParams().id;
			var month  = getUrlParams().month;
			var year   = getUrlParams().year;
			
			var route = "{{ url('vadmin/clientes/cuenta') }}/id="+id+"/month="+month+"/year="+year+"/action=exportPdf";
			// console.log(route);
			window.open(route, '_blank');

		});

		function getUrlParams() {
			
			var pathArray = window.location.pathname.split( '/' );
			pathArray.reverse();
			
			var action = splitvar(pathArray[0]);
			var year   = splitvar(pathArray[1]);
			var month  = splitvar(pathArray[2]);
			var id     = splitvar(pathArray[3]);

			var data = {};

			data['id']     = id;
			data['month']  = month;
			data['year']   = year;
			data['action'] = action;
			
			return data;
		}

		function splitvar(data){
			var data = data.split('=');
			var data = data[1];
			return data;
		}

		/////////////////////////////////////////////////
		//                 Calculations                //
		/////////////////////////////////////////////////

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

		/////////////////////////////////////////////////
		//                 Destroy                     //
		/////////////////////////////////////////////////

		// -------------- Single Delete -------------- //
		$(document).on('click', '.DeleteMovement', function(e){
			e.preventDefault();
			var id    = $(this).data('id');
			var route = "{{ url('vadmin/delete_movement') }}/"+id+"";
			deleteAndReload(id, route, 'Cuidado!','Desea borrar este movimiento?');
			
		});


	</script>
@endsection

