$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


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


//--------------------- LISTS ------------------------- //

// ----------------- List Actions---------------------- //

$(document).ready(function(){
	$(document).on("click",".Select-Row-Trigger",function(e) {
		$('.List-Actions').addClass('Hidden');
		$(this).children('.List-Actions').removeClass('Hidden');
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
//         FORMULES         //
//                          //
//////////////////////////////

function formatNum(num, fixed) {
    var re = new RegExp('^-?\\d+(?:\.\\d{0,' + (fixed || -1) + '})?');
    return num.toString().match(re)[0];
}


function calcPtje(preciocosto, pjegremio){
	var calc   = parseFloat(preciocosto) * parseFloat(pjegremio) / 100;
	var result = parseFloat(preciocosto) + parseFloat(calc);
	var result = Math.round(result*Math.pow(10,2))/Math.pow(10,2);
	return result;
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


//////////////////////////////
// 							//
//        LOADER            //
//                          //
//////////////////////////////

$(document).ajaxStart(function(){
    toggleLoader();
});

$(document).ajaxComplete(function(){
	toggleLoader();
});

function toggleLoader(){
  $('.Main-Loader').toggleClass('Hidden');
    // if (!$('.Main-loader').hasClass('Hidden')) {
    //   // This prevents scroll on loader
    // //   $('html').css({ 'overflow': 'hidden', 'height': '100%' });
    // } else {
    // //   $('html').css({ 'overflow-y': 'scroll', 'height': '100%' });
    // }
}


