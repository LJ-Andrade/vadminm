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
			output(id, razonsocial)

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
			//console.log('Cantidad ' + offerAmmount);
			//console.log('Cantidad minima ' + minOfferAmmount);
			//var test = (parseInt(offerAmmount) >= parseInt(minOfferAmmount));
			//console.log('La cantidad es mayor o igual a la minima :' + test);
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
			console.log("Cantidad " + ammount);
			var itemIva      = parseFloat(subtotalItem) * parseFloat(iva) / 100;
			console.log("Iva total " + itemIva)
			// Make Row
			
			var result = "<tr id='ItemId"+itemnum+"' class='fcItemRow'>"+
							"<td><input name='items["+itemnum+"][code] type='number' value='"+ code +"' class='ro mw100' readonly /></td>"+
							"<td><input name='items["+itemnum+"][name] type='text'   value='"+ name +"' class='ro' readonly /></td>"+
							"<td><input name='items["+itemnum+"][ammount] type='number' value='"+ parseFloat(ammount) +"' class='mw50 AmmountCorrection' /></td>"+
							"<td><input name='items["+itemnum+"][price] type='number' value='"+ parseFloat(price) +"' class='mw100 SubtotCorrection' /></td>"+							
							"<td class='Hid'><input name='items["+itemnum+"][iva] type='number' value='"+ parseFloat(itemIva) +"' class='ro ItemIva IvaSubtotals' readonly />(" + parseFloat(iva) + "%)</td>"+
							"<td><input name='items["+itemnum+"][subtotal] type='number' value='"+ parseFloat(subtotalItem) +"' class='ro mw100 SubTotals' readonly /></td>"+
							"<td class='DeleteRow deleteRow'><i class='ion-minus-circled'></i></td>"+
						  "</tr>";
			itemnum += 1;
			//Print row
			$('#FcItems').append(result);
			// Calc Items Subtotals
			calcSubtotal();
			// Calc Items Iva Subtotal
			calcIvaSum();
			// Calc Items Total
			calcTotal();
		}

	});
	
	// Ammount Correction
	$(document).on("keydown", '.AmmountCorrection', function(e){
		
		var newIva      = $(this).closest('tr').find('td .IvaSubtotals');
		

		if(e.which == 13) {

			var newammount  = $(this).val();
			var unitPrice   = $(this).closest('tr').find('td .UnitPrice').val();
			var newSubtotal = parseInt(newammount) * parseInt(unitPrice);

			calcRowValues(unitPrice, newammount, );
		
			var newIva          = newSubtotal
			//$(this).closest('tr').find('td .SubtotCorrection').val(newsubtotal);
			newSutotalInput.val(newSubtotal);
		}

	});

	function calcRowValues(unitPrice, ammount, iva){

			var subtotalInput = $(this).closest('tr').find('td .SubTotals');


			calcSubtotal();
			calcIvaSum();
			calcTotal();
			

	}



	// Delete Item Row
	$(document).on("click", '#FcItems .fcItemRow .DeleteRow', function(){
		$(this).parent().remove();
		// Calc subtot again
		calcSubtotal();
		calcIvaSum();
		calcTotal();
	});
 

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

		// Get Client Data
		getClientData(route).done(function(data){
			
			if (data.client != null){
				razonsocial = $('#RazonSocial').html(data.client['razonsocial']);
				cuit        = $('#Cuit').html(data.client['cuit']);
				tipocte     = $('#TipoCte').html(data.client['tipocte']);
				tipocteid   = $('#TipoCteId').val(data.client['tipo_id'])
				vendedor    = $('#Vendedor').html(data.client['vendedor']);
				flete       = $('#Flete').html(data.client['flete_id']);

				// Fill Main FC OutPuts 
				$('#RazonSocialInput').val(data.client['razonsocial']);
				$('#CuitInput').val(data.client['cuit']);
			}

		});
		
	});

	// Get all pedidositems and clientdata Function
	function get_pedidositems(id) {

		var client = $('#ClientNameOutput');
		var output = $('#OutPut');
		var loader = $('#SmallLoader');
		var route  = "{{ url('vadmin/get_pedidositems_fc') }}/"+id+"";

		$.ajax({
			url: route,
			type: 'post',
			beforeSend: function(){
				output.removeClass('Hidden');
				loader.removeClass('Hidden');
				loader.html(loaderSm('Buscando...'));
			},
			success: function(data){
				$('#FullOutput').html(data);
				loader.addClass('Hidden');
			},
			error: function(data){
				console.log('Error');
				$('#Error').html(data.responseText);
			}
		}); 
	
	}


	/////////////////////////////////////////////////////////
	//                  Collect FC Data                    //
	/////////////////////////////////////////////////////////

	



	$(document).on("click", '#MakeFcBtn', function(e){
		e.preventDefault();

		var razonSocial = $('#RazonSocial').text();
		var cuit        = $('#Cuit').text();
		var vendedor    = $('#Vendedor').text();
		var tipoCte     = $('#TipoCte').text();
		var tipoCteId   = $('#TipoCteId ').val();
		var flete       = $('#Flete').text();

		var form        = $('#FcForm tr').serializeArray();
		
		$('#FcForm').submit();


	});

</script>