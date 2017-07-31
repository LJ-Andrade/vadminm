

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

$('#PaymentBDiv').hide();
$('#PaymentCDiv').hide();
$('#PaymentRDiv').hide();

// Efectivo Button
$('#PaymentEBtn').click(function(){
	$('.PaymentDivs').hide(100);
	$('#PaymentModo').val('E');
	$('#PaymentEDiv').show(200);
});

// Banco Button
$('#PaymentBBtn').click(function(){
	$('.PaymentDivs').hide(100);
	$('#PaymentModo').val('B');
	$('#PaymentBDiv').show(200);
});

// Cheque Button
$('#PaymentCBtn').click(function(){
	$('.PaymentDivs').hide(100);
	$('#PaymentModo').val('C');
	$('#PaymentCDiv').show(200);
});

// Retencion Button
$('#PaymentRBtn').click(function(){
	$('.PaymentDivs').hide(100);
	$('#PaymentModo').val('R');
	$('#PaymentRDiv').show(200);
});