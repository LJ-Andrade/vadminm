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
	//                CLIENT FINDER                //
	/////////////////////////////////////////////////
	

	$('#ClienteBySelect').on('change', function(e, p){
		var id     = $(this).chosen().val();
		var route  = "{{ url('vadmin/get_client') }}/"+id+"";
		var output = $('#ClientNameOutput');

		$.ajax({
				url: route,
				type: 'get',
				dataType: 'json',
				beforeSend: function(){
					$('#OutPut').removeClass('Hidden');
					output.html(loaderSm('Buscando...'));
				},
				success: function(data){
					var cliente = data.cliente.razonsocial;
					var codigo  = data.cliente.id;
					var cuit    = data.cliente.cuit;
					output.html('Código: ' + codigo + ' - ' + cliente);
					$('#ClienteIdOutput').val(codigo);
					$('#OutPut').removeClass('Hidden');
					$('#ClienteId').val(codigo);
				},
				error: function(data){
					console.log(data);
				}
			}); 
	});

	$("#CodigoCliente").on( "keydown", function(e) {
		
		if(e.which == 13) {
			var id    = $(this).val();
			var route = "{{ url('vadmin/get_client') }}/"+id+"";
			var output = $('#ClientNameOutput');

			$.get(route, function(data){
				if(data.cliente==null){
					output.html('El cliente no existe');
				} else {
					var cliente = data.cliente.razonsocial;
					var codigo  = data.cliente.id;
					var cuit    = data.cliente.cuit;
					
					output.html('Código: ' + codigo + ' - ' + cliente);
					$('#ClienteIdOutput').val(codigo);
					$('#OutPut').removeClass('Hidden');
					$('#ClienteId').val(codigo);
				}	
			});
		}
	});


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
	$("#CfCantidadInput").on( "keydown", function(e) {
		var cantofertainput = $(this).val();
		var cantofertamin   = $('#CantOfertaMin').html();
		var preciooferta    = $('#PrecioOferta').html();
		var precioInput     = $('#CfPrecioInput');
		var precioDisplay   = $('#CfPrecioDisplayUser');
		var originalprice   = $('#OriginalPrice').html();
		
		if(e.which == 13) {
			if (cantofertainput >= cantofertamin){
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
					}
					
					if(data.operacion == 'reparacion'){ 
						output.html("<b>Producto: </b>" + data.producto);
					}
					
					// console.log(data.operacion);
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
	

    
	/////////////////////////////////////////////////
	//              DESARROLLANDO                  //
	/////////////////////////////////////////////////

	function getClientData(route){
		return  $.get(route, function(data){});
	}


	

</script>