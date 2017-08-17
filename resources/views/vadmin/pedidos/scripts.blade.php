<script>
	/////////////////////////////////////////////////
    //               CHANGE STATUS                 //
    /////////////////////////////////////////////////

	// $(document).on('change', '#PedidoStatus', function(e) { 

	// 	var id     = $('#PedidoId').val();
	// 	var status = $(this, 'option').val();
	// 	var route  = "{{ url('/vadmin/update_pedido_status') }}/"+id+"";
    //     console.log(id);
	// 	// $.ajax({
			
	// 	// 	url: route,
	// 	// 	method: 'post',             
	// 	// 	dataType: 'json',
	// 	// 	data: { id: id, estado: status
	// 	// 	},
	// 	// 	success: function(data){
	// 	// 		var updatedStatus = (data.lastStatus);
	// 	// 		alert_ok('Ok','Estado actualizado');
	// 	// 		// console.log(data);
	// 	// 	},
	// 	// 	error: function(data)
	// 	// 	{
	// 	// 		$('#Error').html(data.responseText);
	// 	// 	},
	// 	// });
	// });

    
	$(document).on('change', '.PedidoStatus', function(e) { 
        var id     = $(this).data('id');
        var status = $(this, 'option:selected').val();
		var route  = "{{ url('/vadmin/update_pedido_status') }}/"+id+"";
		
		$.ajax({	
			url: route,
			method: 'post',             
			dataType: 'json',
			data: { id: id, estado: status
			},
			success: function(data){
				var updatedStatus = (data.lastStatus);
				alert_ok('Ok','Estado actualizado');
				reloadPage();
			},
			error: function(data)
			{
				$('#Error').html(data.responseText);
			},
		});
	});

</script>