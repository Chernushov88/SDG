$(document).scroll(function(){
	var s = NEXTTEAM.scroll() + (screen.height > 900 ? 150 : 0);
	
	$(".numberer").html(s + " px");
	NEXTTEAM.windowTimer();
	
	if (NEXTTEAM.blockVisibility($(".clues"), s, 0))
	{
		NEXTTEAM.counter($(".clues li").eq(0).find('big'), 1, 56, '', 10);
		NEXTTEAM.counter($(".clues li").eq(1).find('big'), 1, 5, '', 500);
		NEXTTEAM.counter($(".clues li").eq(3).find('big'), 1, 22, '', 40);
		NEXTTEAM.counter($(".clues li").eq(4).find('big'), 1, 2, '.0', 1500);
	}
	
	if (NEXTTEAM.blockVisibility($("ul.my-reshenie"), s, 1)) {
		NEXTTEAM.stepByStep($("ul.my-reshenie > li"), 500, 'opacity-1', 0);
	}
	
	if (NEXTTEAM.blockVisibility($("table.logos"), s, 2)) {
		NEXTTEAM.stepByStep($("table.logos td"), 100, 'opacity-1', 0);
	}
	
	if (NEXTTEAM.blockVisibility($("ul.your-questions"), s, 3)) {
		NEXTTEAM.stepByStep($("ul.your-questions > li"), 200, 'opacity-1 margintop-0', 0);
	}
	
	if (NEXTTEAM.blockVisibility($(".acciyayay"), s, 4)) {
		$(".acciyayay").css("opacity", "1");
	}
	
	if (NEXTTEAM.blockVisibility($(".zatrudnyaetes"), s, 5)) {
		NEXTTEAM.stepByStep($("ul.zatrudnyaetes > li"), 350, 'opacity-1 margintop-0', 0);
		$(".eqeqeqe").css("opacity","1");
	}
});

$(document).keydown(function(e){
	if (e.keyCode == 27) {
		NEXTTEAM.stepBacker();
		NEXTTEAM.darker(0);
	}
});

$(document).click(function(){
	NEXTTEAM.windowTimer();
});

$(document).ready(function(){
	
	$(".prev-cli, .next-cli").hover(function(){
		if ($(this).hasClass("prev-cli")) {
			$(this).addClass('prev-hover ');
			$('.next-cli').removeClass('next-hover ');
		} else {
			$(this).addClass('next-hover ');			
		}
	}, function(){
		if ($(this).hasClass("prev-cli")) {
			$(this).removeClass('prev-hover ');
			$('.next-cli').addClass('next-hover');
		}
	});
	
	NEXTTEAM.arrAnimator(0);

	if (/MSIE [8|7]/i.test(navigator.userAgent)) {
		$(".yaiki ul li").addClass('nors');	
	}
	
	/* конфигураци наших работ */
	slidering({
		sliderBlock:	".cases",
		sliderIn: 		".incases > div",
		nextArr:		".next-cli",
		prewArr:		".prev-cli",
		slideAmount:	$(".cases .incases > div > .cli-tem").size(),
		slideWidth: 	960,
		duration: 		600,
		auto: 			true,
		arrNimator: 	true
	});

	/* Слайдер в шапке */
	slidering({
		sliderBlock:	".slidering",
		sliderIn: 		".inslide > div",
		nextArr:		".next-cli",
		prewArr:		".prev-cli",
		slideAmount:	$(".slidering .inslide > div > .item").size(),
		slideWidth: 	575,
		duration: 		600,
		auto: 			true,
		autoInterval:	4000
	});

	$('input, textarea').placeholder();

	$(".tabhs li").hover(function(){
		NEXTTEAM.tabs($(this), 'acttab', 'acts');
	});

	$(".close-info").click(function (){
		NEXTTEAM.infoBlock('close', '');
	});

	$(".your-questions li").click(function() {
		if ($(this).parents(".actquest").removeClass("actquest")) {
			$(".step-2").addClass("actquest");
			$("i.consult-type").html($(this).attr("data"));
			$("input[name='question']").val($(this).text());
		}
	});
	
	$(".submit").click(function(){
		var PAR = $(this).parent(),
			$name = PAR.find("input[name='name']"),
			$phone = PAR.find("input[name='phone']"),
			$email = PAR.find("input[name='email']"),
			$target = PAR.find("input[name='target']"),
			$question = PAR.find("input[name='question']");
		if($name.val()=="" || $phone.val()=="")
		{
			NEXTTEAM.infoBlock('err', 'Пожалуйста, заполните необходимые поля.');	
			$name.css("backgroundColor","#FFE6E5");
			$phone.css("backgroundColor","#FFE6E5");
		} else {
			$darker.height($(document).height()).fadeIn('fast');
			
			$(".okno").css("marginTop", (NEXTTEAM.scroll() + 100) + "px");
			
			$(".letter-text").addClass('height-900');
		}
	});
});

// $.fn.extend({
	// getSetSSValue: function(value){
		// if (value){
			// $(this).val(value).change();
			// return this;
		// } else {
			// return $(this).find(':selected').val();
		// }
	// },
	// resetSS: function(){
		// var oldOpts = $(this).data('ssOpts');
		// $this = $(this);
		// $this.next().remove();
		// $this.unbind('.sSelect').sSelect(oldOpts);
	// }
// });

var NEXTTEAM = {
	scroll: function () {
		var html = document.documentElement,
			body = document.body,
			scrollTop = html.scrollTop || body && body.scrollTop || 0;
		return scrollTop -= html.clientTop;
	},
	
	stepByStep: function (el, time, classToEl, tek) {
		if (tek < el.size()) {
			el.eq(tek).addClass(classToEl);
			setTimeout(function(){
				NEXTTEAM.stepByStep(el, time, classToEl, ++tek);
			}, time);
		} else return tek;
	},
	
	tabs: function (el, class1, class2) {
		el.parent().find('li').removeClass(class1);
		el.addClass(class1);
		
		var $tab = $('.tabs').find('.tab');
		$tab.removeClass(class2);
		$tab.eq(el.index()).addClass(class2);
	},
	
	getBgPos: function (el) {
		var pos = el.css('backgroundPosition').split(' ');
		return pos[1].replace('px', '');
	},
	
	counter: function (el, start, limit, text, time) {
		if (start <= limit) {
			el.html(start + text);
			setTimeout(function(){NEXTTEAM.counter(el, ++start, limit, text, time);}, time + start * 3);
		}
	},
	
	infoBlock: function (command, content) {
		
		var el = $('.infoblock');
		command == 'err' ? el.addClass('err') : el.removeClass('err');
		
		if (command == 'close') {
			el.css({'opacity': '0', 'top': '-20px'});
		} else {
			el.css({'opacity': '1','top': '0px'})
			 .find('span')
			 .html(content);
		}
	},
	
	arrAnimator: function(ind){
		$(".progressive-arr").each(function(){
			$(this).css("width", "30px");
		});
		$(".result-block").eq(ind).find(".progressive-arr").each(function(){
			$(this).css("width", $(this).attr("data") + "px");
		});
	},
	
	stepBacker: function(){
		$(".step-2").removeClass("actquest");
		$(".step-1").addClass("actquest");
	},
	
	darker: function(command){
		var $darker = $(".darker");
		
		if(command == 1 || command == true) {
			$darker.height($(document).height()).fadeIn('fast');
			
			$(".okno").css("marginTop", (NEXTTEAM.scroll() + 100) + "px");
			
			$(".letter-text").addClass('height-900');
		} else {
			$darker.hide();
			$(".letter-text").removeClass('height-900');
		}
	},
	
	darker2: function(command) {
		var $darker = $(".darker2");
		
		if(command == 1 || command == true) {
			$darker.height($(document).height()).fadeIn('fast');
			$(".okno2").css("marginTop", NEXTTEAM.scroll() + "px");
		} else {
			$darker.hide();
		}
	},
	
	flags: [],
	blockVisibility: function(el, s, flag){
		if (el.offset().top - (screen.height * 0.6) < s && NEXTTEAM.flags[flag] != 1 ) {
			NEXTTEAM.flags[flag] = 1;
			return true;
		} else return false;
	},
	
	timer: [],
	windowTimer: function(){
		clearTimeout(NEXTTEAM.timer[0]);
		clearInterval(NEXTTEAM.timer[3]);
		NEXTTEAM.favicon(0);
		
		NEXTTEAM.timer[0] = setTimeout(function(){
			NEXTTEAM.timer[1] = 1;
			NEXTTEAM.darker2(1);
			NEXTTEAM.favicon(1);
		}, (NEXTTEAM.timer[1] == 1 ? 180000 : 60000));
	},
	
	favicon: function(com) {
		var $favicon = $("#favicon"),
			ficon1 = "/templates/nextteam_new/img/favicon.png",
			ficon2 = "/templates/nextteam_new/img/favicon2.png",
			title1 = "Начните торговать на NYSE!",
			title2 = "Вы отвлеклись?";
		
		if (com != 1) {
			$favicon.attr("href", ficon1);
			$("title").text(title1);
		} else {
			NEXTTEAM.timer[3] = setInterval(function(){				
				if (++NEXTTEAM.timer[2] == 1) {
					$favicon.attr("href", ficon1);
					$("title").text(title1);
				} else {
					NEXTTEAM.timer[2] = 0;
					$favicon.attr("href", ficon2);
					$("title").text(title2);
				}
			}, 500);
		}
	}
};