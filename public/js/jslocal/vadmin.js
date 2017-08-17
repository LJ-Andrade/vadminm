$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//////////////////////////////
// 							//
//          LOADERS         //
//                          //
//////////////////////////////

// $(document).ajaxStart(function(){
//     toggleLoader();
// });

// $(document).ajaxComplete(function(){
// 	toggleLoader();
// });




var get_client = function(route){
		
	var output;
	$.ajax({
		url: route,
		type: "GET",
		async: true,
		success: function (data) {
			output = data;
			return output;
		},
		error: function () {}
	}); 
	return output;

}


//////////////////////////////
// 							//
//  KEY SHORTCUTS ACTIONS   //
//                          //
//////////////////////////////


// New Item

Mousetrap.bind(['command+k', 'f4'], function(e) {
	var href = $('#ToNewItem').attr('href');
	console.log(href);
	window.location.href = href;
	return false;
});


//////////////////////////////
// 							//
//           SKIN           //
//                          //
//////////////////////////////

//--------------------- NEW AND EDIT AJAX FORMS ------------------------- //

	$(document).on("click", ".ShowNewBtn", function(e){
	// $('.ShowNewBtn').click(function(){
		// $('#List').addClass('Hidden');
		$('.ShowNewBtn').addClass('Hidden');
		$('#NewFormContainer').removeClass('Hidden');
		$('.ShowListBtn').removeClass('Hidden');
		$('#EditFormContainer').addClass('Hidden');
		resetForm('NewForm');		
	});

	$('.ShowListBtn').click(function(){
		$('#List').removeClass('Hidden');
		$('.ShowNewBtn').removeClass('Hidden');
		$('#NewFormContainer').addClass('Hidden');
		$('#EditFormContainer').addClass('Hidden');
		$('.ShowListBtn').addClass('Hidden');
	});

	$('.CloseFormBtn').click(function(e){
		e.preventDefault();
		$('#NewFormContainer').addClass('Hidden');
		$('#EditFormContainer').addClass('Hidden');
		$('.ShowNewBtn').removeClass('Hidden');
		$('.ShowListBtn').addClass('Hidden');
		$('.ShowPassInputBtn').show();
		$('.PasswordSlot').html('');
	});

	$('.CloseSmallForm').on('click', function(){

		$(this).parents().eq(3).addClass('Hidden');
		$('.ShowNewBtn').removeClass('Hidden');
		$('.ShowListBtn').addClass('Hidden');

	});



//-------------- Create Forms --------------------//

// Add Delivery Address
$('.OpenDirsEntregaBtn').click(function(){
	$('.DirsEntregaDiv').toggleClass('Hidden');

	var icon = $(this).children();

	if (icon.hasClass('ion-chevron-right')) {
		icon.removeClass('ion-chevron-right');
		icon.addClass('ion-chevron-down');
	} else {
		icon.removeClass('ion-chevron-down');
		icon.addClass('ion-chevron-right');
	}
	
	
});

$('.CloseDirsEntregaBtn').click(function(){
	var icon = $('.OpenDirsEntregaBtn').children();
	$('.DirsEntregaDiv').addClass('Hidden');
	icon.removeClass('ion-chevron-down');
	icon.addClass('ion-chevron-right');
});


//////////////////////////////
// 							//
//        FUNCTIONS         //
//                          //
//////////////////////////////

// function confirm_delete(id, bigtext, smalltext) {
// 	swal({
// 		title: bigtext,
// 		text: smalltext,
// 		type: 'warning',
// 		showCancelButton: true,
// 		confirmButtonColor: '#3085d6',
// 		cancelButtonColor: '#d33',
// 		confirmButtonText: 'ELIMINAR',
// 		cancelButtonText: 'Cancelar',
// 		confirmButtonClass: 'button buttonOk',
// 		cancelButtonClass: 'button buttonCancel',
// 		buttonsStyling: false
// 	}).then(function () {
// 		delete_item(id);
// 	},
// 	function (dismiss) {
// 		if (dismiss == 'cancel') {
// 		console.log('')
// 		}
// 	}
// 	);
// }


// function confirm_batch_delete(id, bigtext, smalltext) {
// 	swal({
// 		title: bigtext,
// 		text: smalltext,
// 		type: 'warning',
// 		showCancelButton: true,
// 		confirmButtonColor: '#3085d6',
// 		cancelButtonColor: '#d33',
// 		confirmButtonText: 'ELIMINAR',
// 		cancelButtonText: 'Cancelar',
// 		confirmButtonClass: 'button buttonOk',
// 		cancelButtonClass: 'button buttonCancel',
// 		buttonsStyling: false
// 	}).then(function () {
// 		batch_delete_item(id);
// 	},
// 	function (dismiss) {
// 		if (dismiss == 'cancel') {
// 		console.log('')
// 		}
// 	}
// 	);
// }

function resetForm(id) {
    document.getElementById(id).reset();
}




//////////////////////////////
// 							//
//          ALERTS          //
//                          //
//////////////////////////////

function alert_ok(bigtext, smalltext){

	swal(
	  bigtext,
	  smalltext,
	  'success'
	);

}

function alert_error(bigtext, smalltext){

	swal(
	  bigtext,
	  smalltext,
	  'error'
	);
	
}

function alert_info(bigtext, smalltext){

	swal({
  		title: bigtext,
		type: 'info',
		html: smalltext,
		showCloseButton: true,
		showCancelButton: false,
		confirmButtonText:
			'<i class="ion-checkmark-round"></i> Ok!'
		});
}


//////////////////////////////
// 							//
//        ACTIONS           //
//                          //
//////////////////////////////

$('.btnClose, .btnClose2').click(function(){
	$(this).parent().fadeOut( 200 );
});


//////////////////////////////
// 							//
//        FILTERS           //
//                          //
//////////////////////////////


$('.OpenFilters').click(function(){
	$('.Search-Filters').fadeIn(200);
});


