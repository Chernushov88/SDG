$(document).ready(function(){
	$('#gallery ul li a').hover(
		function(){
			$(this).find('.zoom').show();
		},
		function(){
			$(this).find('.zoom').hide();
		}
	);

	$('#slider').bxSlider();
	$(".fbox").fancybox();

	$('#price .button').on('click',function(e){
		e.preventDefault();
		$('.popup').toggle();
		$('#cost').val($(this).attr("id"));
		$('.overlay').toggle();
	});
	$('#close_cross').on('click',function(e){
		e.preventDefault();
		$('.popup').hide();
		$('.overlay').hide();
	});
	$('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });

	if($(window).width()<769){
		$(".overlay").on("click",function(){
			$("#main-menu").hide();
			$(".overlay").hide();
			$(".burger").attr("src",$(".burger").attr("src").replace("burger_hover","burger"));
		});

		$("#main-menu li a").on("click",function(){
			$("#main-menu").hide();
			$(".overlay").hide();
			$(".burger").attr("src",$(".burger").attr("src").replace("burger_hover","burger"));
		});

		$(".burger").on("click",function(e){
			e.preventDefault();
			$("#main-menu").toggle();
			$(".overlay").toggle();
			if ($("#main-menu").css("display")=="block"){
				$(".burger").attr("src",$(".burger").attr("src").replace("burger","burger_hover"));
			}
			else{
				$(".burger").attr("src",$(".burger").attr("src").replace("burger_hover","burger"));
			}
		});
	}

	if ($(window).width()<417){
		$('#top p').html($('#top p').html().replace('<br>',' '));

		$('.lined li').each(function(){$(this).html('<span>'+$(this).html()+'</span>')});
	}
	//$('#phone').mask("+99 (999) 999-99-99");
});