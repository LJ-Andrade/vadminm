<script>    

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
			// We add this option to put ProductSelect to work on single product result
			$('#ProductSelect').append("<option value=''>Seleccione una opción</option>");
			$.each(data, function(index, productos){
				$('#ProductSelect').append("<option value='"+productos.id+"' data-name='"+ productos.nombre +"' data-stockactual='"+ productos.stockactual +"'>"+ productos.nombre +"</option>");
			});
			$('#ProductSelect').trigger("chosen:updated");
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


	// ProductOutput
	

	// Get Client By Id
	function get_client(route){

		$.get(route, function(data){
			
			console.log(data);
			
		});

	}


    
</script>