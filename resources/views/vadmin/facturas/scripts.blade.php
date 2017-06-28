<script>
	/////////////////////////////////////////////////
	//                 UI EFFECTS                  //
	/////////////////////////////////////////////////

	$('#OpenFcBtn').click(function(){
		$('#FcBody').removeClass('Hidden');
		$('#ClientFinder').addClass('Hidden');
	});
	

	$('#ProductFinderBtn').click(function(){
		$('#ProductFinder').removeClass('Hidden');
	});
	
	$('#PendingOrdersBtn').click(function(){
		$('#PendingOrders').removeClass('Hidden');
	});

	$('.CloseBtn').click(function(){
		$(this).parent().addClass('Hidden');
	});
	

	
	/////////////////////////////////////////////////////////
	//             Get and Set Client Data                 //
	/////////////////////////////////////////////////////////

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


	
	// Get all pedidositems and clientdata Function
	function get_pedidositems(id) {

		var client = $('#ClientNameOutput');
		var output = $('#OutPut');
		var loader = $('#SmallLoader');
		var route  = "{{ url('vadmin/get_pending_orders') }}/"+id+"";

		$.ajax({
			url: route,
			type: 'post',
			beforeSend: function(){
				output.removeClass('Hidden');
				loader.removeClass('Hidden');
				loader.html(loaderSm('Buscando...'));
			},
			success: function(data){
				$('#PendingOrdersList').html(data);
				loader.addClass('Hidden');
				console.log(data);
			},
			error: function(data){
				console.log('Error');
				console.log(data);
				$('#PendingOrdersList').html(data.responseText);
			}
		}); 
	
	}

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
	//                  FC Type                    //
	/////////////////////////////////////////////////	


	
	$("#TipoFcSelect").on( "change", function(e) {
		var tipofcid = $("#TipoFcSelect option:selected").val();
		var namefc   = $("#TipoFcSelect option:selected").html();
		
		// To Fc
		$('#TipoFcId').val(tipofcid);
		$('#TipoFcName').val(namefc);
	
	});	


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
		var tipoCteId = $('#TipoCteId').val();

		if(e.which == 13) {
			if(tipoCteId == ''){
				console.log('Tratando de engañarme? ...');
			} else {
				getProductData(id, tipoCteId);
			}
		}
	});

	// Search By Name Autocomplete Product Name Input
	$('#PfNameInput').autocomplete({
		source: "{!!URL::route('autocomplete')!!}",
		minlength: 1,
		autoFocus: true,
		search: function(){
			$('#CfLoader').html('<img src="{{ asset("images/gral/loader-sm.svg") }}"/>');
		},
		select:function(e,ui)
		{
			var id        = ui.item.id;
			var tipocte   = $('#TipoCteId').val();
			getProductData(id, tipocte);
			$('#PfCodeInput').val(id);
		},
		response: function(event, ui) {
			$('#CfLoader').html('');
		}
	});

	// Set Ammount and look for offer
	$("#PfAmmountInput").on( "keydown", function(e) {
		var offerAmmount    = $(this).val();
		var minOfferAmmount = $('#MinOfferAmmount').html();
		var recOfferPrice   = $('#RecOfferPrice').html();
		var priceInput      = $('#PfPriceInput');
		var priceDisplay    = $('#PfPriceDisplayUser');
		var originalPrice   = $('#OriginalPrice').html();
		
		if(e.which == 13) {
			if (parseInt(offerAmmount) >= parseInt(minOfferAmmount)){
				priceDisplay.html(recOfferPrice);
				priceInput.val(recOfferPrice);
			} else {
				priceDisplay.html(originalPrice);
				priceInput.val(originalPrice);
			}
		}
	});

	var itemnum    = 0;

	// Add a mew item (product) to FC
	$('#AddItemtBtn').click(function(){

		var itemsCount = countItems();
		console.log(itemsCount);
		if (itemsCount <= 5 ) {

			var name        = $('#PfNameInput').val();
			var code        = $('#PfCodeInput').val();
			var ammount     = $('#PfAmmountInput').val();
			var price       = $('#PfPriceInput').val();
			var iva         = $('#PfProductIva').val();
			var erroroutput = $('#DisplayErrorOutPut');
			var output      = $('#PfOutputPreview');

			if (name == '' || code == '' || ammount == '' || price == ''){
				erroroutput.html('');
				erroroutput.removeClass('Hidden');
				erroroutput.html('Falta completar un campo');
			} else {
				output.html('');
				output.addClass('Hidden');
				// Calc Price * Ammount
				var subtotalItem = parseFloat(price) * parseFloat(ammount);
				// Calc Iva
				var itemIva      = parseFloat(subtotalItem) * parseFloat(iva) / 100;
				// Make Row
				
				var result = "<tr id='ItemId"+itemnum+"' class='fcItemRow'>"+
								"<td><input name='items["+itemnum+"][code] type='number' value='"+ code +"' class='ro mw100' readonly /></td>"+
								"<td><input name='items["+itemnum+"][name] type='text'   value='"+ name +"' class='ro' readonly /></td>"+
								"<td><input name='items["+itemnum+"][ammount] type='number' value='"+ parseFloat(ammount) +"' class='mw50 AmmountCorrection' /></td>"+
								"<td><input name='items["+itemnum+"][price] type='number' value='"+ parseFloat(price) +"' class='mw100 UnitPrice' /></td>"+							
								"<td class='Hid'><input name='items["+itemnum+"][iva] type='number' value='"+ parseFloat(itemIva) +"' data-ivapercent='" + parseFloat(iva) + "' class='ro ItemIva IvaSubtotals' readonly />(" + parseFloat(iva) + "%)</td>"+
								"<td><input name='items["+itemnum+"][subtotal] type='number' value='"+ parseFloat(subtotalItem) +"' class='ro mw100 SubTotals' readonly /></td>"+
								"<td class='DeleteRow deleteRow'><i class='ion-minus-circled'></i></td>"+
							"</tr>";
				itemnum += 1;
				//Print row
				$('#FcItems').append(result);
				
				recalcTotals();

				// Show ammount of added items to FC
				countItems();
			}

		} else {
			alert_error('Alto','Ya se ha agregado la cantidad máxima de items');
		}

	});
	
	var ordersToDeletion = [];

	$(document).on("click", '.PendigOrderBtn', function(e){
		var itemsCount = countItems();
		console.log(itemsCount);
		if (itemsCount <= 5 ) {

			var orderid      = $(this).data('orderid');
			var code         = $(this).data('id');
			var name         = $(this).data('name');
			var ammount      = $(this).data('ammount');
			var price        = $(this).data('price');
			var subtotalItem = $(this).data('subtotal');
			var iva          = $(this).data('iva');
			
			var itemIva      = parseFloat(subtotalItem) * parseFloat(iva) / 100;

			var result = "<tr id='ItemId"+itemnum+"' class='fcItemRow fcItemRowPending'>"+
								"<td><input name='items["+itemnum+"][code] type='number' value='"+ code +"' class='ro mw100' readonly /></td>"+
								"<td><input name='items["+itemnum+"][name] type='text'   value='"+ name +"' class='ro' readonly /></td>"+
								"<td><input name='items["+itemnum+"][ammount] type='number' value='"+ parseFloat(ammount) +"' class='mw50 AmmountCorrection' /></td>"+
								"<td><input name='items["+itemnum+"][price] type='number' value='"+ parseFloat(price) +"' class='mw100 UnitPrice' /></td>"+							
								"<td class='Hid'><input name='items["+itemnum+"][iva] type='number' value='"+ parseFloat(itemIva) +"' data-ivapercent='" + parseFloat(iva) + "' class='ro ItemIva IvaSubtotals' readonly />(" + parseFloat(iva) + "%)</td>"+
								"<td><input name='items["+itemnum+"][subtotal] type='number' value='"+ parseFloat(subtotalItem) +"' class='ro mw100 SubTotals' readonly /></td>"+
								"<td class='DeleteRow deleteRow' data-id="+ code +" data-orderid="+ orderid +"><i class='ion-minus-circled'></i></td>"+
							"</tr>";
			itemnum += 1;
			//Print row
			$(this).parent().parent().hide();
			$('#FcItems').append(result);


			ordersToDeletion.push(orderid);

			recalcTotals();
			console.log(ordersToDeletion);

			// Show ammount of added items to FC
			countItems();
		} else {
			alert_error('Alto','Ya se ha agregado la cantidad máxima de items');
		}


	});
	
	// Ammount Correction
	$(document).on("keydown", '.AmmountCorrection', function(e){

		if(e.which == 13) {

			var newAmmount     = $(this).val();
			var unitPrice      = $(this).closest('tr').find('td .UnitPrice').val();
			var ivaPercent     = $(this).closest('tr').find('td .IvaSubtotals').data('ivapercent');
			var subtotalOutput = $(this).closest('tr').find('td .SubTotals');
			var ivaOutput      = $(this).closest('tr').find('td .IvaSubtotals');

			// Calculations
			var newSubtotal    = parseFloat(newAmmount) * parseFloat(unitPrice);
			var newIva         = (newSubtotal * parseFloat(ivaPercent) / 100);

			// Set results
			subtotalOutput.val(newSubtotal);
			ivaOutput.val(newIva);
			
			// Recalculate totals
			recalcTotals();

			countItems();
	
		}

	});

	// Price Correction
	$(document).on("keydown", '.UnitPrice', function(e){

		if(e.which == 13) {

			var ammount        = $(this).closest('tr').find('td .AmmountCorrection').val();
			var unitPrice      = $(this).val();
			var ivaPercent     = $(this).closest('tr').find('td .IvaSubtotals').data('ivapercent');
			var subtotalOutput = $(this).closest('tr').find('td .SubTotals');
			var ivaOutput      = $(this).closest('tr').find('td .IvaSubtotals');

			// Calculations
			var newSubtotal    = parseFloat(ammount) * parseFloat(unitPrice);
			var newIva         = (newSubtotal * parseFloat(ivaPercent) / 100);

			// Set results
			subtotalOutput.val(newSubtotal);
			ivaOutput.val(newIva);
			
			// Recalculate totals
			recalcTotals();
		
		}

	});

	// Delete Item Row (New Orders)
	$(document).on("click", '#FcItems .fcItemRow .DeleteRow', function(){
		$(this).parent().remove();
		// Calc subtot again
		recalcTotals();
	});

	// Delete Item Row (Pending Orders)
	$(document).on("click", '#FcItems .fcItemRowPending .DeleteRow', function(){
		// $(this).parent().remove();
		var id      = $(this).data('id');
		var orderid = $(this).data('orderid');
		$('#PoId'+orderid).show();
		console.log('Id a borrar: '+orderid);
		
		var index = ordersToDeletion.indexOf(orderid);
		
		ordersToDeletion.splice(index, 1);
		console.log(ordersToDeletion);
		// Calc subtot again
		recalcTotals();

		countItems();
	});


	function recalcTotals(){
		calcSubtotal();
		calcIvaSum();
		calcTotal();
	}

	function calcTotal(){
		
		var ivas = 0;
		$('.IvaSubtotals').each(function(){
			ivas += parseFloat($(this).val());
		});

		var subtots = 0;
		$('.SubTotals').each(function(){
			subtots += parseFloat($(this).val());
		});
		var totals = ivas + subtots;
		$('#Total').html('<b>$' + totals + '</b>');
		$('#TotalInput').val(totals);

	}

	function calcIvaSum(){
		
		$('#IvaSubTotal').val('');
		var sum = 0;
		$('.IvaSubtotals').each(function(){
			sum += parseFloat($(this).val());
			$('#IvaSubTotal').html('<b>$' + sum +'</b>');
		});
		$('#IvaSubtotalInput').val(sum);
	
	}

    // Calc FC Items Price Subtotal No Iva.
	function calcSubtotal(){
		
		$('#SubTotal').val('');
		var sum = 0;
		$('.SubTotals').each(function(){
			sum += parseFloat($(this).val());
			$('#SubTotal').html('<b>$' + sum +'</b>');
		});
		$('#SubTotalInput').val(sum);
	
	}

	function countItems(){

		var counter = $('#CantItems');
		var rowCount = $('#FcItems tr').length;
		counter.html('');
		counter.html(rowCount);
		return rowCount+1;

	}


	/////////// -------------------------- ////////////////

	// GET PRODUCT PRICE
	function getProductData(id, tipocte){
		
		var route       = "{{ url('vadmin/get_product_data') }}/"+id+"";
		var pfloader    = $('#PfLoader');
		var erroroutput = $('#DisplayErrorOutPut');
		var output      = $('#PfOutputPreview');

		$.ajax({
			url: route,
			method: 'post',             
			dataType: "json",
			data: {id: id, tipocte: tipocte},
			beforeSend: function(){
				pfloader.html('<img src="{{ asset("images/gral/loader-sm.svg") }}"/>');
			},
			success: function(data){
				if(data.exist == 1){
					
					var name         = data.product; 
					var price        = parseFloat(data.price);
					var offerammount = data.offerammount;
					var offerprice   = parseFloat(data.offerprice);
					var iva          = parseFloat(data.iva);

					// Hide previous error
					erroroutput.addClass('Hidden');
					// Show search data
					productOutput(name, price, offerammount, offerprice, iva);

				} else {
					// Hide last search result
					output.html('');
					output.addClass('Hidden');
					// Show error
					erroroutput.removeClass('Hidden');
					erroroutput.html('El producto no existe');
					productOutput('','','','','');
				}
			
			},
			error: function(data)
			{	
				console.log(data.responseText);
				// $('#Error').html(data.responseText);	
			},
			complete: function(){
				pfloader.html('');
			}
		});

	}

	function productOutput(name, price, offerammount, offerprice, iva){

		var nameInput    = $('#PfNameInput');
		var priceInput   = $('#PfPriceInput');
		var priceDisplay = $('#PfPriceDisplayUser');
		var output       = $('#PfOutputPreview');
		var erroroutput  = $('#DisplayErrorOutPut');
		var pfloader     = $('#PfLoader');
		var ivaInput     = $('#PfProductIva');

		// Display product preview
		output.removeClass('Hidden');
		output.html("<b>Producto: </b>" + name + " | <b>Precio:</b> <span id='OriginalPrice'>" + price + "</span><br> Precio de Oferta: <span id='RecOfferPrice'>" + offerprice + " </span> (Cantidad: <span id='MinOfferAmmount'>" + offerammount + "</span>)<br>Iva: <span id='ProductIva'>"+ iva +" %</span>");
		priceInput.val(price);
		ivaInput.val(iva);
		// Update Autocomplete Input when use code input
		nameInput.val(name);
		nameInput.trigger("chosen:updated");

	}


	

	/////////////////////////////////////////////////////////
	//                    FILL FC                          //
	/////////////////////////////////////////////////////////

	$('#OpenFcBtn').click(function(e){
		e.preventDefault();
		var id    = $('#ClienteIdOutput').val();
		var route = "{{ url('vadmin/get_client_data') }}/"+id+"";
		
		var razonsocial = '';
		var cuit        = '';
		var tipocte     = '';
		var tipocteid   = '';
		var vendedor    = '';
		var flete       = '';
		var categIva    = '';


		// Get Client Data
		getClientData(route).done(function(data){
			
			if (data.client != null){
				var code        = id;
				var razonSocial = data.client['razonsocial'];
				var cuit        = data.client['cuit'];
				var tipocte     = data.client['tipocte'];
				var tipocteid   = data.client['tipo_id'];
				var vendedor    = data.client['vendedor'];
				var flete       = data.client['flete_id'];
				var categIva    = data.client['categiva'];
				var categIvaId  = data.client['categiva_id'];
				var dirFiscal   = data.client['dirfiscal'];
				
				$('#RazonSocial').html(razonSocial);
				$('#Cuit').html(cuit);
				$('#TipoCte').html(tipocte);
				$('#TipoCteId').val(tipocteid)
				$('#Vendedor').html(vendedor);
				$('#Flete').html(flete);


				// Data to FC 			
				$('#ClientIdFC').val(id);
				$('#RazonSocialFC').val(razonSocial);
				$('#DirFiscalFc').val(dirFiscal);
				$('#CuitFC').val(cuit);
				$('#CategIvaFc').val(categIva);
				$('#CategIvaIdFc').val(categIvaId);
				
			}

		});
		
		get_pending_orders(id);
		
	});

	

	// Get All Pending order Items
	function get_pending_orders(id){
		var route  = "{{ url('vadmin/get_pending_orders') }}/"+id+"";
		
		$.ajax({
			type: 'get',
			url: route,
			success: function(data){
				// console.log(data);
				$('#PendingOrdersList').empty().html(data);
				$('#PendingOrdersList').html(data.responseText);
			},
			error: function(data){
				console.log(data);
				$('#PendingOrdersList').html(data.responseText);
			}
		});

	}

	/////////////////////////////////////////////////////////
	//                  Collect FC Data                    //
	/////////////////////////////////////////////////////////


	$(document).on("click", '#MakeFcBtn', function(e){
		e.preventDefault();

		// ********** Recordar de validar cuando no hayan items cargados ********* //

		//Validations
		// Check if FC Type is selected
		var fcType    = $('#TipoFcSelect option:selected').val();
		// var fcContent = $('#FcItems option:selected').lenght;
		// console.log(fcContent);
		// if(fcContent){
		// 	console.log('ok');
			
		// } else {
		// 	alert_error('Alto','No se han ingresado items');
		// }


		if(fcType == 0){
			alert_error('Alto','No se ha seleccionado tipo de factura');
		} 
		// else if(fcContent == 0) {
		// 	alert_error('Alto','No se han ingresado items');
		// }
		 else {
			var input = "<input name='markAsFcDone["+  +"]' type='' />";
			var div   = $('#MarkAsFcDone');
			
			// Set pendingorders to done
			$.each( ordersToDeletion, function( index, value ){
				div.append("<input name='markAsFcDone["+ index +"]' value='"+ value +"' type='hidden' />");
			});
			
			// var form        = $('#FcForm');
			// var data = JSON.stringify( $(form).serializeArray() ); //  <-----------

			// console.log( data );
			// return false; //don't submit
			// // console.log(form);
			// console.log('Se deben borrar los items de pedidos ' + ordersToDeletion);
			
			$('#FcForm').submit();

		}
	

	});

</script>