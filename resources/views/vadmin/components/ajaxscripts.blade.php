<script>    


	/////////////////////////////////////////////////
	//                   LOADER                    //
	/////////////////////////////////////////////////

	var loaderSm = function(text){
		var loader = '<img src="{{ asset("images/gral/loader-sm.svg") }}"/>' + text;
		return loader;
	}
	var loaderRow = $('#LoaderRow');
	loaderRow.hide();

	var smallLoader  = '<img src="{{ asset("images/gral/loader-sm.svg") }}"/> Actualizando...';

	/////////////////////////////////////////////////
	//         SET LOC BY PROV - AJAX              //
	/////////////////////////////////////////////////

	$('#ProvinciasAjax').on('change',function(e){
	
		var id    = e.target.value;
		var route = "{{ url('vadmin/get_locs') }}/"+id+"";
		set_localidad(id, route)

	});

	function set_localidad(id, route){
		
		$.get(route, function(data){
			console.log(data);
			// Vacía el Select de OPTIONS
			$('#LocalidadAjax').find('option').remove().end();
			// We add this option to put ProductSelect to work on single product result
			$('#LocalidadAjax').append("<option value=''>Seleccione una opción</option>");
			// Recorre Array de data traída por ajax
			$.each(data, function(index, localidades){
				// Genera los OPTIONS correspondientes
				$('#LocalidadAjax').append("<option value='"+localidades.id+"'>"+ localidades.name +"</option>");
			});
			// Hace un update del plugin CHOSEN para que se representen los OPTIONS.
			$('#LocalidadAjax').trigger("chosen:updated");
		});
	}

	/////////////////////////////////////////////////
	//            SUBFAMILIAS - AJAX               //
	/////////////////////////////////////////////////

	$('#FamiliasSelect').on('change',function(e){
		// console.log(e)
		var id    = e.target.value;
		var route = "{{ url('vadmin/productos_subfamilias') }}/"+id+"";
		$.get(route, function(data){
			// Vacía el Select de OPTIONS
			$('#SubfamiliasSelect').find('option').remove().end();
			// We add this option to put ProductSelect to work on single product result
			$('#SubfamiliasSelect').append("<option value=''>Seleccione una opción</option>");
			// Recorre Array de data traída por ajax
			$.each(data, function(index, subfamilias){
				// Genera los OPTIONS correspondientes
				$('#SubfamiliasSelect').append("<option value='"+subfamilias.id+"'>"+ subfamilias.nombre +"</option>");
			});
			// Hace un update del plugin CHOSEN para que se representen los OPTIONS.
			$('#SubfamiliasSelect').trigger("chosen:updated");
		});
	});

	// Get Client
	$('#SubfamiliasSelect').on('change',function(e){
		// console.log(e)
		var ids    = e.target.value;
		var route = "{{ url('vadmin/show_products') }}/"+ids+"";
		$.get(route, function(data){
			$('#ProductSelect').find('option').remove().end();
			$('#ProductOnlySelect').find('option').remove().end();
			// We add this option to put ProductSelect to work on single product result
			$('#ProductSelect').append("<option value=''>Seleccione una opción</option>");
			$.each(data, function(index, productos){
				var div = "<option value='"+productos.id+"' data-name='"+ productos.nombre +"' data-stockactual='"+ productos.stockactual +"'>"+ productos.nombre +"</option>"
				$('#ProductSelect').append(div);
				$('#ProductOnlySelect').append(div);
			});
			$('#ProductSelect').trigger("chosen:updated");
			$('#ProductOnlySelect').trigger("chosen:updated");
		});
	});

	// Product Stock Prepare
	$('#ProductSelect').on('change',function(e){
		// console.log(e)
		var id           = $('#ProductCode').val();
		var family       = $("#FamiliasSelect option:selected").val();
		var subfamily    = $("#SubfamiliasSelect option:selected").val();
		var product      = $("#ProductSelect option:selected").val();
		var productstock = $("#ProductSelect option:selected").data('stockactual');
		var productname  = $("#ProductSelect option:selected").data('name');
		var output       = $("#ProductOutput");

		output.html("Nombre: <b>" + productname + "</b> | Código: " + product + "<br> Stock Actual: " + productstock + "<br>");
		output.append("<label>Nuevo Stock: </label></br>");
		output.append("<input val='"+ productstock +"' data-id='"+ product +"' type='text' name='outputinput' id='OutputInput'>")
		$('#OutputInput').val(productstock);
	});


	/////////////////////////////////////////////////
	//            PRODUCT UPDATE STOCK             //
	/////////////////////////////////////////////////

	// Update when click on #UpdateStockBtn
	$('#UpdateStockBtn').click(function(){
		var id     = $("#SumStock").data('productid');
		var route  = "{{ url('vadmin/update_prod_stock') }}/"+id+"";
		var value  =  $("#SumStock").val();
		var action = location.reload();
		sumStock(route, id, value, action);
	});

	// Update when press ENTER on #SumStock
	$("#SumStock").on("keypress", function(e) {
		if(e.which == 13) {
			var id    = $(this).data('productid');
			var route = "{{ url('vadmin/update_prod_stock') }}/"+id+"";
			var value = $(this).val();
			var action = location.reload();
			sumStock(route, id, value, action);
		}
	});


	/////////////////////////////////////////////////
	//              CLIENT  Finder        OK       //
	/////////////////////////////////////////////////

	// Get Client Data On Button Click
	$('#ClientByCodeBtn').click(function(){
		// Get Client Full Data
		var id         = $('#ClientByCode').val();
		var route      = "{{ url('vadmin/get_client') }}/"+id+"";
		
		getClientData(route).done(function(data){
			if (data.client != null){
				var id          = data.client['id'];
				var razonsocial = data.client['razonsocial'];
			} 
			// Send Client Data to Output
			output(id, razonsocial);
		});
	});

	// Get Client Data OnKeydown
	$("#ClientByCode").on("keydown", function(e) {
		if(e.which == 13) {
			$('#ClientByCodeBtn').click();
		}
	});
	
	// Get Client Data On Autocomplete Input
	$('#ClientAutoComplete').autocomplete({
		source: "{!!URL::route('client_autocomplete')!!}",
		minlength: 1,
		autoFocus: true,
		search: function(){
			$('#SmallLoader').html(loaderSm('Buscando...'));
		},
		select:function(e,data)
		{
			var id    = data.item.id;
			var route = "{{ url('vadmin/get_client') }}/"+id+"";

			// Get Client Full Data
			getClientData(route).done(function(data){
				var id          = data.client['id'];
				var razonsocial = data.client['razonsocial'];

				// Send Client Data to Output
				output(id, razonsocial)
			});
			
		},
		response: function(event, ui) {
			$('#SmallLoader').html('');
		},
	});

	// Print Selected Data and Fill Inputs
	function output(id, razonsocial){
		var output      = $('#ClientData');
		var outputerror = $('#ClientError');

		if(id != null){
			$('#ClienteIdOutput').val(id);
			$('#ClientOutPut').removeClass('Hidden');
			output.html('Cód.:' + id + ' | ' + razonsocial);
			outputerror.addClass('Hidden');
		} else {
			$('#ClientOutPut').addClass('Hidden');
			outputerror.removeClass('Hidden');
		}
	}

	/////////////////////////////////////////////////
	//              GET CLIENT DATA                //
	/////////////////////////////////////////////////

	function getClientData(route){
		return  $.get(route, function(data){});
	}


	/////////////////////////////////////////////////
	//               REVISAR                       //
	/////////////////////////////////////////////////


	/////////////////////////////////////////////////
	//              PRODUCT Finder                 //
	/////////////////////////////////////////////////

	// -- Inputs --

	// CfCodigoInput
	// CfNombreInput
	// CfCantidadInput
	// CfPrecioInput
	
	// -- Extra Data --

	// TipoCte

	// -- Action --

	// AddItem

	// -- Outputs --

	// CfOutputPreview

	// Search By Code
	$("#CfCodigoInput").on( "keydown", function(e) {
		var id        = $(this).val();
		var tipocte   = $('#TipoCte').data('tipocte');
		var operacion = $('#Operacion').val();
		if(e.which == 13) {
			setProductAndPrice(id, tipocte, operacion);
		}
	});

	// Search By Name Autocomplete Product Name Input
	
	$('#CfNombreInput').autocomplete({
		source: "{!!URL::route('autocomplete')!!}",
		minlength: 1,
		autoFocus: true,
		search: function(){
			$('#CfLoader').html('<img src="{{ asset("images/gral/loader-sm.svg") }}"/>');
		},
		select:function(e,ui)
		{
			// $('#searchname').val(ui.item.value);
			// console.log(ui.item.id);
			var id        = ui.item.id;
			var tipocte   = $('#TipoCte').data('tipocte');
			var operacion = $('#Operacion').val();
			setProductAndPrice(id, tipocte, operacion);
			$('#CfCodigoInput').val(id);
		}
	});

	// Set Ammount and look for offer
	$("#CfCantidadInput").on( "keypress", function(e) {
		var cantofertainput = $(this).val();
		var cantofertamin   = $('#CantOfertaMin').html();
		var preciooferta    = $('#PrecioOferta').html();
		var precioInput     = $('#CfPrecioInput');
		var precioDisplay   = $('#CfPrecioDisplayUser');
		var originalprice   = $('#OriginalPrice').html();

		if(e.which == 13) {
			if (parseInt(cantofertainput) >= parseInt(cantofertamin)){
				precioDisplay.html(preciooferta);
				precioInput.val(preciooferta);
			} else {
				precioDisplay.html(originalprice);
				precioInput.val(originalprice);
			}
		}
	});


	// Display Product Info
	function setProductAndPrice(id, tipocte, operacion) {	
		console.log('ok');
		var route         = "{{ url('vadmin/get_product_and_price') }}/"+id+"";
		var nombre        = $('#CfNombreInput');
		var precioInput   = $('#CfPrecioInput');
		var precioDisplay = $('#CfPrecioDisplayUser');
		var output        = $('#CfOutputPreview');
		var cfloader      = $('#CfLoader');
		var erroroutput   = $('#DisplayErrorOutPut');
		
		$.ajax({
			url: route,
			method: 'post',             
			dataType: "json",
			data: {id: id, tipocte: tipocte, operacion: operacion},
			beforeSend: function(){
				cfloader.html('<img src="{{ asset("images/gral/loader-sm.svg") }}"/>');
			},
			success: function(data){
				// console.log(data.exist);
				// console.log(data);
				if(data.exist == 1){
					nombre.val(data.producto);
					nombre.trigger("chosen:updated");
					precioDisplay.html(data.precio);
					erroroutput.html('');
					cfloader.html('');
					output.removeClass('Hidden');
					output.html("");

					if(data.operacion == 'pedido'){ 
						output.html("<b>Producto: </b>" + data.producto + " | <b>Precio:</b> <span id='OriginalPrice'>" + data.precio + "</span><br> Precio de Oferta: <span id='PrecioOferta'>" + data.preciooferta + " </span> (Cantidad: <span id='CantOfertaMin'>" + data.cantoferta + "</span>)");
						precioInput.val(data.precio);
						console.log(data);
					}
					
					if(data.operacion == 'reparacion'){ 
						output.html("<b>Producto: </b>" + data.producto);
					}
					
					console.log(data.operacion);
				} else {
					output.removeClass('Hidden');
					output.html('El producto no existe');
					nombre.val('');
					erroroutput.html('');
					erroroutput.addClass('Hidden');
					cfloader.html('');
				}
			
			},
			error: function(data)
			{
				output.html(data.responseText);
				output.removeClass('Hidden');
				//
				$('#Error').html(data.responseText);
				console.log(data);	
			},
		});
	}

	function addItem(route, data){ 
		var preview     = $('#CfOutputPreview');
		var erroroutput = $('#DisplayErrorOutPut');

		$.ajax({
			url: route,
			method: 'post',             
			dataType: "json",
			data: data,
			beforeSend: function(){
				loaderRow.show();
			},
			success: function(data){
				location.reload();
				loaderRow.hide();
				// console.log(data);	
			},
			error: function(data)
			{
				// console.log(data);
				loaderRow.hide();
				$('#Error').html(data.responseText);
				erroroutput.html('El producto no existe');
				erroroutput.removeClass('Hidden');
			},
		});

	}
	


	

</script>