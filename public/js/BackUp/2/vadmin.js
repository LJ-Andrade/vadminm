$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
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




//--------------------- LISTS ------------------------- //

// ----------------- List Actions---------------------- //

$(document).ready(function() {

	// $('.List-Actions').hide();

	// Show Actions
	$(document).on("click",".Lists-Actions-Trigger",function(e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).parent().parent().siblings('.List-Actions').removeClass('Hidden');
	});

	// Close Actions
	$(document).on("click",".Close-Actions-Btn",function(e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).parent().addClass('Hidden');
	})

});

// ----------------- Batch Delete --------------------- //

$(document).on("click", ".BatchDelete", function(e){

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


//////////////////////////////
// 							//
//        FUNCTIONS         //
//                          //
//////////////////////////////


function confirm_delete(id, bigtext, smalltext) {
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
		delete_item(id);
	});
}


function confirm_batch_delete(id, bigtext, smalltext) {
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
		batch_delete_item(id);
	});
}

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

//////////////////////////////
// 							//
//        ACTIONS           //
//                          //
//////////////////////////////

$('.btnClose').click(function(){
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

//////////////////////////////
// 							//
//        LOADER            //
//                          //
//////////////////////////////

// $(document).ajaxStart(function(){
//     // $(".loader").removeClass("Hidden");
//     // $('html').css({ 'overflow': 'hidden', 'height': '100%' });
//     toggleLoader();
// });

// $(document).ajaxComplete(function(){
//     // $(".loader").addClass("Hidden");
//     // $('html').css({ 'overflow-Y': 'scroll', 'height': '100%' });
//     toggleLoader();
// });

// function toggleLoader()
// {
//   $('.loader').toggleClass('Hidden');
//     if (!$('.loader').hasClass('Hidden')) {
//       // This prevents scroll on loader
//       $('html').css({ 'overflow': 'hidden', 'height': '100%' });
//     } else {
//       $('html').css({ 'overflow-Y': 'scroll', 'height': '100%' });
//     }
// }
