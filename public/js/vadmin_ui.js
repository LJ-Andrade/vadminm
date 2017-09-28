function toggleLoader(){
  $('.Main-Loader').toggleClass('Hidden');
    // if (!$('.Main-loader').hasClass('Hidden')) {
    //   // This prevents scroll on loader
    // //   $('html').css({ 'overflow': 'hidden', 'height': '100%' });
    // } else {
    // //   $('html').css({ 'overflow-y': 'scroll', 'height': '100%' });
    // }
}

//--------------------- LISTS ------------------------- //

// ----------------- List Actions---------------------- //

$(document).ready(function(){
	$(document).on("click",".TableList-Row",function(e) {
		$('.TableList-Actions').addClass('Hidden');
		$(this).children().children('.TableList-Actions').removeClass('Hidden');
	});

	// Close Actions
	$(document).on("click",".Close-Actions-Btn",function(e) {
		e.preventDefault();
		e.stopPropagation();
		$(this).parent().addClass('Hidden');
	})

});

$('.Select-Row-Trigger').click(function(){

	$('.List-Actions').addClass('Hidden');
	$(this).children('.List-Actions').removeClass('Hidden');

});

// ----------------- Payments --------------------- //

$('#AddPaymentBForm').hide();
$('#AddPaymentCForm').hide();
$('#AddPaymentRForm').hide();


// // Efectivo Button
$('#PaymentEBtn').click(function(){
	$('.PaymentForms').hide(100);
	$('#AddPaymentEForm').show(200);
});

// Banco Button
$('#PaymentBBtn').click(function(){
	$('.PaymentForms').hide(100);
	$('#AddPaymentBForm').show(200);
});

// // Cheque Button
// Banco Button
$('#PaymentRBtn').click(function(){
	$('.PaymentForms').hide(100);
	$('#AddPaymentRForm').show(200);
});

// // Retencion Button
// Banco Button
$('#PaymentCBtn').click(function(){
	$('.PaymentForms').hide(100);
	$('#AddPaymentCForm').show(200);
});



$('#ClientAccountSidebar').hide();

// ClientAccountSidebar
$('#ClientAccountSidebarBtn').click(function(){

	$('#ClientAccountSidebar').fadeIn(200);
	$('#ClientAccountTable').removeClass('col-md-12');
	$('#ClientAccountTable').addClass('col-md-8');
});

$('#CloseClientAccountSideBar').click(function(){
		
	$('#ClientAccountSidebar').hide(0);
	$('#ClientAccountTable').addClass('col-md-12');
	$('#ClientAccountTable').removeClass('col-md-8');
});

//--------------------- FACTURACION ------------------------- //

$('#OpenFcBtn').click(function(){
	$('#FcBody').removeClass('Hidden');
	$('#ClientFinder').addClass('Hidden');
});


$('#ProductFinderBtn').click(function(){
	$('#ProductFinder').removeClass('Hidden');
});

$('#PendingOrdersBtn').click(function(){
	$('#PendingOrders').removeClass('Hidden');
});

$('.CloseBtn').click(function(){
	$(this).parent().addClass('Hidden');
});


//--------------------- CARDS  ------------------------- //

// Data Input

$('#AddProductBtn').click(function(){
	$(this).addClass('Hidden');
	$('#ProductFinder').removeClass('Hidden');

});

