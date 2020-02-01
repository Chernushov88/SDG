                           

(function ($) { "use strict";
	
	/* ========================================================================= */
	/*	Page Preloader
	/* ========================================================================= */
	
	// window.load = function () {
	// 	document.getElementById('preloader').style.display = 'none';
	// }

	$(function(){ // this replaces document.ready
		setTimeout(function(){
		  $('#preloader').fadeOut('slow', function() {
			$(this).remove();
		  });
		 }, 1500);
	  });

	$(function() {
		$('.scroll a').on('click', function(e) {
			e.preventDefault();
			$('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top - 70}, 500, 'linear');
		});

		});

})(jQuery);




                            