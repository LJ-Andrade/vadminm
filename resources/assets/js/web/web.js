//////////////////////////////
// 							//
//        LOADER            //
//                          //
//////////////////////////////

$(document).ready(function () {
	// Animate loader off screen
	// $(".Loader").fadeOut("slow");
	$(".LoaderSolo").fadeOut("slow");
	
	new WOW().init();


	//////////////////////////////
	// 							//
	//        NAVIGATION        //
	//                          //
	//////////////////////////////


	var section       = $('#actual_section').data('section');
	var logo          = $('.navbar .navbar-brand');
	var navbar        = $('.navbar-default');


    function nav_logic() {

	    switch(section) {

	    	//////// HOME /////////
	    	case "home":
	    		// $('body').css('padding-top','0');
	    		logo.css('opacity','0');
	    		$('.navbar .navbar-right').css('border-bottom', '1px solid white');
	    		navbar.addClass('home-nav');

	    		$(window).scroll(function() {
				    var scrollPos = $(window).scrollTop();

				    
				    if (scrollPos > 250) {
				      navbar.addClass('change-nav');
				      logo.css('opacity','100');
				    } else {
				      navbar.removeClass('change-nav');
				      logo.css('opacity','0');
				    }
			    });

	    	break;

	    	//////// PORTFOLIO /////////
	    	case "portfolio":

	    		$(window).scroll(function() {

				    navbar = $('.navbar-default');

				    if (scrollPos > 250) {
				      navbar.addClass('change-nav');
				    } else {
				      navbar.removeClass('change-nav');
				    }
			    });

	    	break;


	    	//////// GENERIC /////////
	    	default:
	    		$(window).scroll(function() {
				    
				    var scrollPos = $(window).scrollTop(),
				    navbar   = $('.navbar-default');
				    
				    if (scrollPos > 250) {
				      navbar.addClass('change-nav');
				    } else {
				      navbar.removeClass('change-nav');
				    }
			    });
	    }

    }


    // ----------- End Navigation Script ------------ //

    //Activate nav effects in desktop
	if (screen.width > 775) {
        nav_logic();
    }
    else {}




}); // Document Ready
