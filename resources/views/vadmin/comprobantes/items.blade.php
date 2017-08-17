{{-- //// Product Finder //// --}}
	<div id="ProductFinder" class="wd-container Hidden">
		<div class="CloseBtn closeButton"><i class="ion-close-round"></i></div>
		<div class="row">
			<div class="col-md-12">
				<div class="title">Agregar producto</div>
			</div>
			<div class="col-md-4 col-sm-6">
				{!! Form::label('searchbyname', 'Nombre') !!}
				{!! Form::text('searchbyname', null, ['id' => 'PfNameInput', 'class' => 'form-control']) !!}
			</div>
			<div class="col-md-2 col-sm-6">
				{!! Form::label('searchbycode','Código') !!}
				{!! Form::text('searchbycode', null, ['id' => 'PfCodeInput', 'class' => 'form-control']) !!} 
			</div>
			<div class="col-md-3 col-sm-6">
				{!! Form::label('cantidad','Cantidad') !!}
				{!! Form::text('cantidad', null, ['id' => 'PfAmmountInput', 'class' => 'form-control']) !!} 
			</div>
			<div class="col-md-3 col-sm-6">
				{!! Form::label('precio','Precio') !!} <br>
				@if( Auth::user()->type =='superadmin' or Auth::user()->type =='admin' )
				{!! Form::text('precio', null, ['id' => 'PfPriceInput', 'class' => 'form-control']) !!}
				@else
				{!! Form::text('precio', null, ['id' => 'PfPriceInput', 'class' => 'form-control ']) !!}
				<span id="PfPriceDisplayUser"></span>
				@endif
			</div>
			{!! Form::text('precio', null, ['id' => 'PfProductIva', 'class' => 'form-control Hidden']) !!}
			
			{{-- Preview Product Name --}}
			<div class="col-md-12 horiz-container">
				<div id="PfOutputPreview" class="inner Hidden"></div>
				<div id="DisplayErrorOutPut" class="inner Hidden"></div>
				<div id="PfLoader"></div>
			</div>
			{{-- Add Product To Fc --}}
			<div class="col-md-3 horizontal-btn-container">
				<button id="AddItemtBtn" class="btn btnSquareHoriz buttonOk" ><i class="ion-plus-round"></i> Agregar</button>
			</div>
			
		</div>

	</div> {{-- /wd-container Product Finder --}}

	{{-- //// Pend Orders //// --}}
	<div id="PendingOrders" class="wd-container Hidden">
		<div class="CloseBtn closeButton"><i class="ion-close-round"></i></div>
		<div class="row">
			<div class="col-md-12">
				<div class="title">Pedidos Pendientes</div>
			</div>
		</div>
		<div id="PendingOrdersList"></div>
	</div> {{-- /wd-container Pedidos --}}
