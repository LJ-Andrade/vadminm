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
				$('#BatchDeleteBtn').addClass('Hidden');
				if (data.success == true) {
					$('#Id'+id).hide(200);
					for(i=0; i < id.length ; i++){
						$('#Id'+id[i]).hide(200);
					}
					alert_ok('Ok!','Eliminación completa');
					return true;
				} else {
					alert_error('Ups!','Ha ocurrido un error (Puede que este registro tenga relación con otros items en el sistema). Debe eliminar primero los mismos.');
					console.log(data);
					return false;
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

var deleteAndReload = function(id, route, bigtext, smalltext) {
	
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
				$('#BatchDeleteBtn').addClass('Hidden');
				if (data.success == true) {
					alert_ok('Ok!','Eliminación completa');
					reloadPage();
				} else {
					alert_error('Ups!','Ha ocurrido un error (Puede que este registro tenga relación con otros items en el sistema). Debe eliminar primero los mismos.');
					return false;
				}
			},
			error: function(data)
			{
				$('#Error').html(data.responseText);
				console.log(data);	
			}
		});
	});

}


/////////////////////////////////////////////////
//                 FUNCTIONS                   //
/////////////////////////////////////////////////

function formatNum(num, fixed) {
    var re = new RegExp('^-?\\d+(?:\.\\d{0,' + (fixed || -1) + '})?');
    return num.toString().match(re)[0];
}


function reloadPage(){
	location.reload();
}

/////////////////////////////////////////////////
//                 NUMBERS                     //
/////////////////////////////////////////////////

function roundAndConvertDecimal(number){
	var result = parseFloat(number).toFixed(2);
	return result;
}

/////////////////////////////////////////////////////////
//             Get and Set Client Data                 //
/////////////////////////////////////////////////////////

// ------------------- Get Client -------------------- //

	// // Get Client Data On Button Click
	// $('#ClientByCodeBtn').click(function(){
	// 	// Get Client Full Data
		
	// 	var id         = $('#ClientByCode').val();
	// 	var route      = "{{ url('vadmin/get_client') }}/"+id+"";
		
	// 	getClientData(route).done(function(data){
			
	// 		if (data.client != null){
	// 			var id          = data.client['id'];
	// 			var razonsocial = data.client['razonsocial'];
	// 		} 
	// 		// Send Client Data to Output
	// 		output(id, razonsocial);
	// 	});
	// });

	// // Get Client Data OnKeydown
	// $("#ClientByCode").on("keydown", function(e) {
	// 	if(e.which == 13) {
	// 		$('#ClientByCodeBtn').click();
	// 	}
	// });
	
	// // Get Client Data On Autocomplete Input
	// $('#ClientAutoComplete').autocomplete({
	// 	source: "{!!URL::route('client_autocomplete')!!}",
	// 	minlength: 1,
	// 	autoFocus: true,
	// 	search: function(){
	// 		$('#SmallLoader').html(loaderSm('Buscando...'));
	// 	},
	// 	select:function(e,data)
	// 	{
	// 		var id    = data.item.id;
	// 		var route = "{{ url('vadmin/get_client') }}/"+id+"";

	// 		// Get Client Full Data
	// 		getClientData(route).done(function(data){
	// 			var id          = data.client['id'];
	// 			var razonsocial = data.client['razonsocial'];

	// 			// Send Client Data to Output
	// 			output(id, razonsocial)
	// 		});
			
	// 	},
	// 	response: function(event, ui) {
	// 		$('#SmallLoader').html('');
	// 	},
	// });















