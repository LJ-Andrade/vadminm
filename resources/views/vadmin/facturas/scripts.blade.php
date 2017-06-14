<script>
	/////////////////////////////////////////////////
	//              PRODUCT Finder                 //
	/////////////////////////////////////////////////

	// -- Inputs --

	// PfCodeInput
	// PfNameInput
	// PfAmmountInput
	// PfPriceInput
	
	// -- Extra Data --

	// TipoCte

	// -- Action --

	// AddItem

	// -- Outputs --

	// PfOutputPreview

	// Search By Code
	$("#PfCodeInput").on( "keydown", function(e) {
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
		var precioDisplay   = $('#PfPriceDisplayUser');
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
		var precioDisplay = $('#PfPriceDisplayUser');
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


</script>