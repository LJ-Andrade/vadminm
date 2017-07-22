// ----------------- Batch Delete --------------------- //

$(document).on("click", ".BatchDelete", function(e){
	e.stopPropagation();
	batch_select(this);

	var checkbox = $(this).prop('checked');
	if(checkbox){
		$(this).parent().addClass('row-selected');
	} else {
		$(this).parent().removeClass('row-selected');
	}
});

function batch_select(trigger) {
	
	var countSelected = $('input:checkbox:checked').length;

	if(countSelected >= 2) {
		$('#BatchDeleteBtn').removeClass('Hidden');
	} else  {
		$('#BatchDeleteBtn').addClass('Hidden');
	}

}


var deleteRecord = function(id, route, bigtext, smalltext) {
	
	swal({
		title: bigtext,
		text: smalltext,
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'ELIMINAR',
		cancelButtonText: 'Cancelar',
		confirmButtonClass: 'button buttonOk',
		cancelButtonClass: 'button buttonCancel',
		buttonsStyling: false
	}).then(function () {
		$.ajax({
			url: route,
			method: 'POST',             
			dataType: 'JSON',
			data: { id: id },
			beforeSend: function(){
				// $('#Main-Loader').removeClass('Hidden');
			},
			success: function(data){
				console.log(data);
				if (data.success == true) {
					$('#Id'+id).hide(200);
					for(i=0; i < id.length ; i++){
						$('#Id'+id[i]).hide(200);
					}
					alert_ok('Ok!','Eliminación completa');
				} else {
					alert_error('Ups!','Ha ocurrido un error');
					console.log(data);
				}
			},
			error: function(data)
			{
				$('#Error').html(data.responseText);
				console.log(data);	
			},
			complete: function()
			{
				// $('#Main-Loader').addClass('Hidden');
			}
		});
	});

}
