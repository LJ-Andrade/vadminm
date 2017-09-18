<script>
	/////////////////////////////////////////////////
    //               CHANGE STATUS                 //
    /////////////////////////////////////////////////


	$(document).on('change', '#ReparacionStatus', function(e) { 
		var id     = $('#ReparacionId').val();
        var status = $(this, 'option:selected').val();
		changeStatus(id, status);
	});

	$(document).on('change', '.ReparacionStatus', function(e) { 
        var id     = $(this).data('id');
        var status = $(this, 'option:selected').val();
		changeStatus(id, status);
	});


	function changeStatus(id, status){
		
		var route  = "{{ url('/vadmin/update_repair_status') }}/"+id+"";
		
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
	}


</script>