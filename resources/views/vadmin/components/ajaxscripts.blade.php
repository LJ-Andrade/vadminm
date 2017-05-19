<script>    


	/////////////////////////////////////////////////
	//                   LOADER                    //
	/////////////////////////////////////////////////

	var loaderSm = function loaderSm(text){
		var loader = '<img src="{{ asset("images/gral/loader-sm.svg") }}"/>' + text;
		return loader;
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

	// Stock Update
	$('#UpdateStockBtn').click(function(){
		var id      = $("#OutputInput").data('id');
		var value = $("#OutputInput").val();
		var route   = "{{ url('vadmin/update_prod_stock') }}/"+id+"";

		var success = alert_ok('Ok','Stock Actualizado');
		updateProduct(route, id, value, success);
		$("#ProductOutput").html('');

	});


	/////////////////////////////////////////////////
	//            SUBFAMILIAS - AJAX               //
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

	// cfCodigoInput
	// cfNombreInput
	// cfCantidadInput
	// cfPrecioInput
	
	// -- Extra Data --

	// TipoCte

	// -- Action --

	// AddItem

	// -- Outputs --

	// CfOutputPreview

	$("#cfCodigoInput").on( "keydown", function(e) {
		var id      = $(this).val();
		var tipocte = $('#TipoCte').data('tipocte');
		if(e.which == 13) {
			setProductById(id, tipocte);
		}
	});



	$('#autocomplete').autocomplete({
		// var url = "{{ url('vadmin/ajax_product_search') }}/search?query="+query;
		var url = 
		serviceUrl: "{{ url('vadmin/ajax_autocomplete') }}"
		//onSelect: function (suggestion) {
		//	alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
		//}
	});


		// By Name or Email
	$(document).on("keyup", "#autocsomplete", function(e){
		e.preventDefault();
		var query = $(this).val();
		



			//$.ajax({
			//	type: 'get',
			//	url: url,
			//	beforeSend: function(){
			//	},
			//	success: function(data){
			//		console.log(data[0].nombre);
			//		productos = data[0];
			//		// productos = data;
			//		// var obj = jQuery.parseJSON(data);
			//		// console.log( obj.name === "John" );
			//		// console.log(data);
			//		// $.each( data, function( key, value ) {
			//		// 	console.log( key + ": " + value );
			//		// });
			//	},
			//	error: function(data){
			//		console.log(data)
			//		$('#Error').html(data.responseText);
			//	}
			//});
		
	});



	function setProductById(id, tipocte) {	
	
		var route   = "{{ url('vadmin/get_product_and_price') }}/"+id+"";
		var nombre   = $('#cfNombreInput');

		console.log('Id de Producto: ' + id);
		console.log('Tipo de Cliente: ' + tipocte);
		var output  = $('#CfOutputPreview');
		var erroroutput = $('#DisplayErrorOutPut');
		
		$.ajax({
			url: route,
			method: 'post',             
			dataType: "json",
			data: {id: id, tipocte: tipocte},
			success: function(data){
				console.log(data.exist);
				if(data.exist == 1){
					output.removeClass('Hidden');
					nombre.val(data.producto);
					erroroutput.html('');
					
					output.html('<b>Producto: </b>' + data.producto + ' | <b>Precio:</b> ' + data.precio + '<br> Precio de Oferta: ' + data.preciooferta + ' (Cantidad: ' + data.cantoferta + ')');
					$('#PrecioInput').val(data.precio);
				} else {
					erroroutput.html('');
					output.removeClass('Hidden');
					nombre.val('');
					output.html('El producto no existe');
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