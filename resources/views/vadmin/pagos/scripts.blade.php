<script>
	/////////////////////////////////////////////////
	//                 UI EFFECTS                  //
	/////////////////////////////////////////////////
		
	$('#OpenPaymentBtn').click(function(e){
		e.preventDefault();
		$('#NewPayment').removeClass('Hidden');
		$('#ClientFinder').addClass('Hidden');
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


	/////////////////////////////////////////////////////////
	//                    FILL RECIEVE                     //
	/////////////////////////////////////////////////////////

	$('#OpenPaymentBtn').click(function(e){
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
				console.log(razonsocial);
				$('#ClientName').html(razonSocial);
				$('#ClientCode').html(code);
				
			}

		});
		
		
	});

	


	/////////////////////////////////////////////////////////
	//                                                     //
	/////////////////////////////////////////////////////////



</script>