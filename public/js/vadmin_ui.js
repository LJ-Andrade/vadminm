

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
