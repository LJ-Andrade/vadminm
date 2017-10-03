<script>

// -------------------------------------------------------------------------- //
            // ** 1 ** - PREVIEW CLIENT DATA AND SELECT DOCTYPE //
// -------------------------------------------------------------------------- //

    /////////////////////////////////////////////////
	//              CLIENT  Finder        OK       //
	/////////////////////////////////////////////////

	// Get Client Data On Button Click
	$('#CompGetClientByBtn').click(function(){
		// Get Client Full Data
		var id         = $('#CompClientByCode').val();
		var route      = "{{ url('vadmin/get_client') }}/"+id+"";
        getClientDataForPreview(route);

	});

	// Get Client Data OnKeydown
	$("#CompClientByCode").on("keydown", function(e) {
		if(e.which == 13) {
			$('#CompGetClientByBtn').click();
		}
	});
	
	// Get Client Data On Autocomplete Input
	$('#CompClientAutoComplete').autocomplete({
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
            getClientDataForPreview(route);
		},
		response: function(event, ui) {
			$('#SmallLoader').html('');
		},
	}); 

    /////////////////////////////////////////////////
	//                 Functions                   //
	/////////////////////////////////////////////////

    // Get Full Client Data
    function getClientDataForPreview(route){
        $.ajax({
            url: route,
            type: 'get',
            dataType: 'json',
            beforeSend: function(){
				$('.Main-Loader').removeClass('Hidden');
            },
            success: function(data){
                output(data.client['id'], data.client['razonsocial'], data.letter);

            },
            error: function(data){
                console.log(data);
                // $('#Error').html(data.responseText);
            },
			complete: function(){
				$('.Main-Loader').addClass('Hidden');
			}
        }); 
	}


    // Outputs data Preview
	function output(id, razonsocial, letter){
		var output      = $('#ClientData');
		var outputerror = $('#ClientError');

		if(id != null){
            // Real Data
			$('#ClienteIdOutput').val(id);
            var doctypes = tiposComp(letter);
            $('#TiposComp').empty();
            $('#TiposComp').append(doctypes);
            $('#CompLetter').val(letter);
            $('#DocClientId').val(id);
            // Visual Data
			$('#ClientOutPut').removeClass('Hidden');
			output.html('Cód.:' + id + ' | ' + razonsocial);
			outputerror.addClass('Hidden');
		} else {
			$('#ClientOutPut').addClass('Hidden');
			outputerror.removeClass('Hidden');
		}
	}

	    // Set doc types
    function tiposComp(letter){
        // ********* WARNING ! **********
        // This values are OFFICIAL AFIP numbers.
        var doctypes;
        switch(letter){
            case 'A':
                doctypes = "<option value='1'>Factura</option>"+
                           "<option value='2'>Nota de Débito</option>"+
                           "<option value='3'>Nota de Crédito</option>"+
						   "<option value='P'>Presupuesto</option>";
                break;
            case 'B':
                doctypes = "<option value='6'>Factura</option>"+
                           "<option value='7'>Nota de Débito</option>"+
                           "<option value='8'>Nota de Crédito</option>"+
						   "<option value='P'>Presupuesto</option>";
                break;
        }
        return doctypes;
    }


// -------------------------------------------------------------------------- //
                     // ** 2 ** - SET INPUTS ON DOCUMENT //
// -------------------------------------------------------------------------- //

    // ----------------------- Open NewDoc ----------------------------- //

    $('#OpenCompBtn').click(function(){

        // UI Effects
        $('#CompBody').removeClass('Hidden');
        $('#ClientFinder').addClass('Hidden');
        var clientid =  $('#DocClientId').val(); 

        // Set and Display Doc Type
        var doctype  = $('#TiposComp').val();
        var docname  = $('#TiposComp option:selected').html();
        var letter   = $('#CompLetter').val();
  		
        // Set and Display Client Data
        setDocClientData();
        
        // Get Pending Orders
        get_pending_orders(clientid);
      
        // Set and ** Official AFIP ** Data
        $('#DocDocType').val(doctype); // Afip
		$('#DocLetter').val(letter);

		// Set Submit Buttons, options and display info.
		// Display DocType
		$('#DisplayDocType').html(docname + ' ' + letter);
		
		// Set Operation type and buttons
		switch(doctype){
			case '1':
			case '6':
				// Facturas
				$('#PendingOrdersBtn').removeClass('Hidden');
				$('#EmitDocBtn').removeClass('Hidden');
				// Set Operation Type
				$('#DocModo').val('F');
				$('#DocOp').val('E');
				break;
			case 'P':
				// Presupuesto
				$('#MakePresupBtn').removeClass('Hidden');
				$('#DisplayDocType').html('');
				$('#DisplayDocType').html(docname);
				// Set Operation Type
				$('#DocModo').val('P');
				$('#DocOp').val('E');
				break;
			case '2':
				// Nota de Débito A
				$('#EmitDocBtn').removeClass('Hidden');
				// Set Operation Type
				$('#DocModo').val('ND');
				$('#DocOp').val('E');
				break;
			case '3':
				// Nota de Crédito A
				$('#EmitDocBtn').removeClass('Hidden');
				// Set Operation Type
				$('#DocModo').val('NC');
				$('#DocOp').val('E');
				break;
			case '7':
				// Nota de Débito B
				$('#EmitDocBtn').removeClass('Hidden');
				// Set Operation Type
				$('#DocModo').val('ND');
				$('#DocOp').val('E');
				break;
			case '8':
				// Nota de Crédito A
				$('#EmitDocBtn').removeClass('Hidden');
				// Set Operation Type
				$('#DocModo').val('NC');
				$('#DocOp').val('E');
				break;
		}
        
    });

	/////////////////////////////////////////////////
	//                 Functions                   //
	/////////////////////////////////////////////////


    // Set Doc Client Data
    function setDocClientData(){
        var id          =  $('#DocClientId').val(); 
        var route       = "{{ url('vadmin/get_client_doc_data') }}/"+id+"";
        var smallLoader = "<img src='{{ asset('images/gral/loader-sm.svg') }}'/>";

		$.ajax({
            url: route,
            type: 'get',
            dataType: 'json',
            beforeSend: function(){
                $('#DisplayClientData').html(smallLoader);
            },
            success: function(data){
                var clientdata  = $('#DisplayClientData');
                clientdata.html('');
				console.log(data.client['condicventas']['name']);
                var content     = "<span><b>Razón Social:</b> " + data.client['razonsocial'] + "</span></br>"+
							      "<span><b>Dir. Fiscal:</b> " + data.client['dirfiscal'] + "</span></br>"+
                                  "<span><b>Cuit:</b> " + data.client['cuit'] + "</span></br>"+
								  "<span>" + data.client['iva']['name'] + "</span></br>"+
								  "<span><b>Condición de Vta.:</b> " + data.client['condicventas']['name'] + "</span></br>";
							    //   "<span><b>Vendedor:</b> " + data.client['vendedor'] + "</span></br>"+
							    //   "<span><b>Flete:</b> " + data.client['nombreflete'] + "</span></br>";
				
				var dirsentrega = $('#DocDirsEntrega');
				$.each(data.client['direntregas'], function( index, value ) {
					dirsentrega.append("<option value='"+value['id']+"'>"+ value['name'] +"</option>");
				});

				// Set Client Inputs 
				$('#DocFlete').val(data.client['flete_id']);
				$('#DocUserId').val(data.client['user_id']);
				

                // Display Client Data in Doc Body
                clientdata.html(content);            
            },
            error: function(data){
                console.log(data);
                // $('#Error').html(data.responseText);
            }
        }); 
	}

// -------------------------------------------------------------------------- //
                     // ** 3 ** - ADD ITEMS TO DOCUMENT //
// -------------------------------------------------------------------------- //


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
		// To prevent max 17 items fill
		var itemsCount = countItems();
		if (itemsCount <= 17 ) {

			var description = $('#PfNameInput').val();
			var code        = $('#PfCodeInput').val();
			var quantity    = $('#PfAmmountInput').val();
			var price       = $('#PfPriceInput').val();
			var iva         = $('#PfProductIva').val();
			var erroroutput = $('#DisplayErrorOutPut');
			var output      = $('#PfOutputPreview');
			// Round Price
			price = roundAndConvertDecimal(price);

			if (description == '' || code == '' || quantity == '' || price == ''){
				erroroutput.html('');
				erroroutput.removeClass('Hidden');
				erroroutput.html('Falta completar un campo');
			} else {
				output.html('');
				output.addClass('Hidden');
				// Calc Price * Ammount
				var subtotalItem = parseFloat(price) * parseFloat(quantity);
				// Calc Iva
				var itemIva      = parseFloat(subtotalItem) * parseFloat(iva) / 100;
				itemIva = roundAndConvertDecimal(itemIva);
				var total = (parseFloat(subtotalItem) + parseFloat(itemIva));
				total = roundAndConvertDecimal(total);
				console.log(total);
				// Make Row
				var result = "<tr id='ItemId"+itemnum+"' class='fcItemRow'>"+
								"<td style='display:none'><input name='items["+itemnum+"][type]' type='text'   value='?' class='ro mw100' readonly /></td>"+
								"<td><input name='items["+itemnum+"][code]'                      type='number' value='"+ code +"' class='ro mw100' readonly /></td>"+
								"<td><input name='items["+itemnum+"][description]'               type='text'   value='"+ description +"' class='ro' readonly /></td>"+
								"<td><input name='items["+itemnum+"][quantity]'                  type='number' value='"+ parseInt(quantity) +"' step='1' class='mw50 AmmountCorrection vinput' /></td>"+
								"<td><input name='items["+itemnum+"][price]'                     type='number' value='"+ parseFloat(price) +"' class='mw100 UnitPrice vinput' /></td>"+							
								"<td><input name='items["+itemnum+"][sum_price]'                 type='number' value='"+ parseFloat(subtotalItem) +"' class='ro mw100 SubTotals' readonly /></td>"+
								"<td class='Hidd'><input name='items["+itemnum+"][sum_tax]'       type='number' value='"+ parseFloat(itemIva) +"' class='ro ItemIva IvaSubtotals' data-ivapercent='" + parseFloat(iva) + "'  readonly />(" + parseFloat(iva) + "%)</td>"+
								"<td class='Hidden'><input name='items["+itemnum+"][discount]'   type='number' value='0' /></td>"+
								"<td><input name='items["+itemnum+"][total]'                     type='number' value='"+ total +"' class='ro mw100 SubTotalsTax' readonly /></td>"+
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
		if (itemsCount <= 17 ) {

			var orderid      = $(this).data('orderid');
			var code         = $(this).data('code');
			var description  = $(this).data('name');
			var quantity     = $(this).data('ammount');
			var price        = $(this).data('price');
			price            = roundAndConvertDecimal(price);
			var subtotalItem = $(this).data('subtotal');
			var iva          = $(this).data('iva');
			var itemIva      = parseFloat(subtotalItem) * parseFloat(iva) / 100;
			itemIva          = roundAndConvertDecimal(itemIva);
			var total        = (parseFloat(subtotalItem) + parseFloat(itemIva));
			total            = roundAndConvertDecimal(total);

			var result = "<tr id='ItemId"+itemnum+"' class='fcItemRow fcItemRowPending'>"+
								"<td style='display:none'><input name='items["+itemnum+"][type]' type='text'   value='?'                                  class='ro mw100' readonly /></td>"+
								"<td><input name='items["+itemnum+"][code]'                      type='number' value='"+ code +"'                         class='ro mw100' readonly /></td>"+
								"<td><input name='items["+itemnum+"][description]'               type='text'   value='"+ description +"'                  class='ro' readonly /></td>"+
								"<td><input name='items["+itemnum+"][quantity]'                  type='number' value='"+ parseInt(quantity) +"'  step='1' class='mw50 AmmountCorrection vinput' /></td>"+
								"<td><input name='items["+itemnum+"][price]'                     type='number' value='"+ parseFloat(price) +"'            class='mw100 UnitPrice vinput' /></td>"+							
								"<td><input name='items["+itemnum+"][sum_price]'                 type='number' value='"+ parseFloat(subtotalItem) +"'     class='ro mw100 SubTotals' readonly /></td>"+
								"<td class='Hidd'><input name='items["+itemnum+"][sum_tax]'      type='number' value='"+ parseFloat(itemIva) +"'          class='ro ItemIva IvaSubtotals' data-ivapercent='" + parseFloat(iva) + "'  readonly />(" + parseFloat(iva) + "%)</td>"+
								"<td class='Hidden'><input name='items["+itemnum+"][discount]'   type='number' value='0' /></td>"+
								"<td><input name='items["+itemnum+"][total]'                     type='number' value='"+ total +"' class='ro mw100 SubTotalsTax' readonly /></td>"+
								"<td class='DeleteRow deleteRow' data-id="+ code +" data-orderid="+ orderid +"><i class='ion-minus-circled'></i></td>"+
							"</tr>";

			itemnum += 1;
			//Print row
			$(this).parent().parent().hide();
			$('#FcItems').append(result);

			ordersToDeletion.push(orderid);

			recalcTotals();
			console.log('Items a facturar ' + ordersToDeletion);

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
			var totalOutput    = $(this).closest('tr').find('td .SubTotalsTax');
			roundAndConvertDecimal(totalOutput);
			// Calculations
			var newSubtotal    = parseFloat(newAmmount) * parseFloat(unitPrice);
			var newIva         = (newSubtotal * parseFloat(ivaPercent) / 100);
			var newTotal       = (newSubtotal+newIva);

			// Set results
			subtotalOutput.val(newSubtotal);
			ivaOutput.val(newIva);
			totalOutput.val(newTotal);
			
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
			var totalOutput    = $(this).closest('tr').find('td .SubTotalsTax');
			roundAndConvertDecimal(totalOutput);
			// Calculations
			var newSubtotal    = parseFloat(ammount) * parseFloat(unitPrice);
			var newIva         = (newSubtotal * parseFloat(ivaPercent) / 100);
			var newTotal       = (newSubtotal+newIva);
			// Set results
			subtotalOutput.val(newSubtotal);
			ivaOutput.val(newIva);
			totalOutput.val(newTotal);
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

	/////////////////////////////////////////////////
	//                 Functions                   //
	/////////////////////////////////////////////////


	// Price and Ammount Calculations
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
		totals = roundAndConvertDecimal(totals);
		$('#Total').html('<b>$' + totals + '</b>');
		// Round Up and Two Decimals
		$('#TotalInput').val(totals);

	}

	function calcIvaSum(){
		
		$('#IvaSubTotal').val('');
		var sum = 0;
		$('.IvaSubtotals').each(function(){
			sum     += parseFloat($(this).val());
			$('#IvaSubTotal').html('<b>$' + roundAndConvertDecimal(sum) +'</b>');
		});
		// Round Up and Two Decimals
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
		// Round Up and Two Decimals
		sum = roundAndConvertDecimal(sum);
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
					var price        = round2Fixed(parseFloat(data.price));
					var offerammount = data.offerammount;
					var offerprice   = round2Fixed(parseFloat(data.offerprice));
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

	function round2Fixed(value) {
		value = +value;

		if (isNaN(value))
		return NaN;

		// Shift
		value = value.toString().split('e');
		value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + 2) : 2)));

		// Shift back
		value = value.toString().split('e');
		return (+(value[0] + 'e' + (value[1] ? (+value[1] - 2) : -2))).toFixed(2);
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

	// -------------------------------------------------------------------------- //
            // ** 4 ** - COLLECT DOC DATA //
	// -------------------------------------------------------------------------- //
	
	$(document).on("click", '#DocForm', function(e){
		e.preventDefault();
	});
	

	$(document).on("click", '#EmitDocBtn', function(e){
		e.preventDefault();

		// Validation (Prevents empty FC content)
		var tbody = $("#FcItems");
		if (tbody.children().length == 0) {
			alert_error('Alto','No se han ingresado items');
		} else {

		var formdata = $('#DocForm').serialize();
		var data     = { formdata: formdata };
		var route    = "{{ url('vadmin/generate_comp') }}";
		var message  = $('#DocMessage');
		$.ajax({
			type: 'POST',
			url: route,
			data: formdata,
			dataType: 'json',
			beforeSend(){
				$('#EmitDocBtn').html('Conectando...');
			},
			success: function(data){
				// Send Data to Webservice
				wsfeConnect(data);
			},
			error: function(data){
				message.removeClass('Hidden');
				message.html(data.responseText);
				console.log(data);
			},
			complete: function(data){
				$('#EmitDocBtn').html('Emitir');
			}
		});

		}
	});
	

	function wsfeConnect(fcdata){
		// For Test
		var cae = "67283492528894";
		var nro = 2082;
		var vto = "20170725";
		var pending = $('#MarkDone');
		//$.each( ordersToDeletion, function( index, value ){
		//	pending.append("<input name='markdone["+ index +"]' value='"+ value +"' type='hidden' />");
		//});
		//store_comp(cae, nro, vto);

		var data    = fcdata;
		var route   = "{{ asset('Feafip/wsfe-client.php') }}";
		var message = $('#DocMessage');
		var pending = $('#MarkDone');
		$.ajax({
			type: 'POST',
			url: route,
			data: { fcdata: data },
			dataType: 'JSON',
			success: function(data){
				console.log(data);
				// If webservice connection succeded store comp and downloadpdf
				if(data.sucess == true){
					$.each( ordersToDeletion, function( index, value ){
						pending.append("<input name='markdone["+ index +"]' value='"+ value +"' type='hidden' />");
					});
					message.removeClass('Hidden');
					message.html(data);
					var pdf =  "{{ url('public/Feafip/facturas') }}/"+data.nro+".pdf";
					window.open(pdf,'_blank');
					store_comp(data.cae, data.nro, data.vto);
					// Redirect
					window.location.replace("{{ url('vadmin/comprobantes') }}");
					console.log(data);
				} else {
					message.removeClass('Hidden');
					message.html(data.responseText);
				}
				$('#EmitDocBtn').html('Emitido');
			},
			error: function(data){
				console.log('ERROR !');
				console.log(data);
				message.removeClass('Hidden');
				message.html(data.responseText);
			}
		});
	}

	// Not working yet
	function store_comp(cae, nro, vto){
		// DO THIS IF FC to AFIP RESULT IS TRUE
		// --------------------------------------------//
		// Data to Store FC
		
		var docdata = $('#DocForm').serialize() + '&cae=' + cae + '&nro=' + nro + '&vto=' + vto ;
		var route   = "{{ url('vadmin/store_comp') }}";
		var message = $('#DocMessage');
	
		$.ajax({
			type: 'GET',
			url: route,
			dataType: 'JSON',
			data: docdata,
			beforeSend: function(){
			},
			success: function(data){ 
				console.log(data);
				message.html(data);
			},
			error: function(data){
				message.removeClass('Hidden');
				console.log(data);
				message.html(data.responseText);
			}
		});

	}


	/////////////////////////////////////////////////
	//                 UI EFECTS                   //
	/////////////////////////////////////////////////


	$('#ProductFinderBtn').click(function(){
		$('#ProductFinder').removeClass('Hidden');
	});

	$('#PendingOrdersBtn').click(function(){
		$('#PendingOrders').removeClass('Hidden');
	});

	$('.CloseBtn').click(function(){
		$(this).parent().addClass('Hidden');
	});

	var loaderSm = function(text){
		var loader = '<img src="{{ asset("images/gral/loader-sm.svg") }}"/>' + text;
		return loader;
	}

</script>