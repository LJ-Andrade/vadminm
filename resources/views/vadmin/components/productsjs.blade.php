<script>
    
    /*--------------------------------------------------------------*/
    /* Loader
    /*--------------------------------------------------------------*/
    var loaderRow = $('#LoaderRow');
	loaderRow.hide();

    /*--------------------------------------------------------------*/
    /* PRODUCT INPUTS
    /*--------------------------------------------------------------*/

    var prodId              = $('#OutProdId');
    var prodName            = $('#OutProdName');
    var prodPrice           = $('#OutProdPrice');
    var prodAmmount         = $('#OutProdAmmount');
    var prodOffer           = $('#OutProdOffer');
    var prodOfferMinAmmount = $('#OutProdOfferMinAmmount');

    /*--------------------------------------------------------------*/
    /* PRODUCT FINDER
    /*--------------------------------------------------------------*/
    
    // ----------- Search By Code ------------------- //
    // On Btn Click
    $('#PFByCodeBtn').on('click', function() {
        var id = $('#PFByCode').val();
        var tipocte   = $('#TipoCte').data('tipocte');
		var operacion = $('#Operacion').val();
        if(id == ''){
        } else {
            setProductAndPrice(id, tipocte, operacion);
        }
    });

    // On Press Enter Key
	$('#PFByCode').on('keydown', function(e) {
        
		var id        = $(this).val();
		var tipocte   = $('#TipoCte').data('tipocte');
		var operacion = $('#Operacion').val();
		if(e.which == 13) {
            if(id == ''){
            } else {
			    setProductAndPrice(id, tipocte, operacion);
            }
		}
	});


    // ----------- Search By Name (Autocomplete) ----------------- //	
	$('#PFByName').autocomplete({
		source: "{!!URL::route('autocomplete')!!}",
		minlength: 1,
		autoFocus: true,
		search: function(){
			$('#PFLoader').html('<img src="{{ asset("images/gral/loader-sm.svg") }}"/>');
		},
		select:function(e,ui)
		{
			var id        = ui.item.id;
			var tipocte   = $('#TipoCte').data('tipocte');
			var operacion = $('#Operacion').val();
			setProductAndPrice(id, tipocte, operacion);
			$('#PFByCode').val(id);
		}
	});

    // Set Ammount and look for offer
    // On Btn Click
    $('#PFAmmountBtn').on('click', function() {
        var ammount   = $("#PFAmmount").val();
        setPriceOrOffer(ammount);
       
    });

    // On Enter Key
	$("#PFAmmount").on( "keypress", function(e) {
		var ammount = $(this).val();
		if(e.which == 13) {
			setPriceOrOffer(ammount);
		}
	});

    function setPriceOrOffer(ammount){
		var minammount = parseInt(prodOfferMinAmmount.val());
		var ammount    = parseInt(ammount);

		if (minammount == 0 ){
			console.log('No tiene oferta');
			$('#PFPrice').val(prodPrice.val());
		} else {
			if (ammount >= minammount){
				console.log('Es mayor');
				$('#PFPrice').val(prodOffer.val());
			} else {
				console.log('Es menor');
				$('#PFPrice').val(prodPrice.val());
			}
		}
    }

    // Display Product Info
	function setProductAndPrice(id, tipocte, operacion) {	
        console.log(id, tipocte, operacion);
		var route   = "{{ url('vadmin/get_product_and_price') }}/"+id+"";
		var display = $('#DisplayProductData');
		var loader  = $('#PFLoader');

		$.ajax({
			url: route,
			method: 'post',             
			dataType: "json",
			data: {id: id, tipocte: tipocte, operacion: operacion},
			beforeSend: function(){
				loader.removeClass('Hidden');
			},
			success: function(data){
				if(data.exist == 1){
					if(data.operacion == 'pedido'){ 
						display.html("<b>Producto: </b>" + data.producto + " | <b>Precio:</b> <span id='OriginalPrice'>" + data.precio + "</span><br> Precio de Oferta: <span id='PrecioOferta'>" + data.preciooferta + " </span> (Cantidad: <span id='CantOfertaMin'>" + data.cantoferta + "</span>)");
                        $('#PFByName').val(data.producto);

                        // Inputs to calc offer price                       
                        prodPrice.val(data.precio);
                        prodOffer.val(data.preciooferta);
                        prodOfferMinAmmount.val(data.cantoferta);
					}
					if(data.operacion == 'reparacion'){ 
						display.html("<b>Producto: </b>" + data.producto);
					}
				} else {
					$('#PFByName').val('');
					display.html('El producto no existe');	
				}
                loader.addClass('Hidden');
			},
			error: function(data)
			{
				$('#Error').html(data.responseText);
				console.log(data);	
			},
		});
	}

    // ----------- This Comes from an action from VIEW ----------------- //	
    function addItem(route, data){ 
        var erroroutput  = $('#DisplayProductError');

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