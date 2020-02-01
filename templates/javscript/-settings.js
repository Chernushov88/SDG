$(document).ready(function(){

    $('#slideshow').fadeSlideShow({
	   width: 640,
       height:400,
       interval: 6000,
       pause:2500,
       speed: 'slow',
       autoplay: true,

	});
    
    $('.colum .left ul li:last, .colum .right ul li:last').css('border', 'none');
    
    $('.openDropMenu').click(function(){
        $('.openDropMenu').removeClass('click').next('ul').removeClass('open').parent('li').removeClass('activejs');
        
          if($(this).attr('id') != 'active')
          {
            $('.openDropMenu').removeAttr('id');
            $(this).parent('li').addClass('activejs');
            $(this).next('ul').addClass('open');
            $(this).addClass('click').attr('id', 'active');  
          }
          else
          {
            $(this).parent('li').removeClass('activejs');
            $(this).next('ul').removeClass('open');
            $('.openDropMenu').removeAttr('id');
          }
          
    });
    $('.lens').mouseover(function(){
       $('.searchForm').fadeIn('slow');
    });
    
    $('.searchForm').mouseleave(function(){
        var focus = $('#searchInput:focus');
       
        if(focus.length == '0')
        {
            $('.searchForm').fadeOut('slow');
        }
    });    
    $(document).click(function(e) {
          if ($(e.target).parents().filter('.topmenu').length != 1) 
          {
            $('.openDropMenu').removeClass('click').next('ul').removeClass('open').parent('li').removeClass('activejs');
          }
          if ($(e.target).parents().filter('.search').length != 1)
          {
            $('.searchForm').fadeOut('slow');
          }
    });
    
    var sectionMenu = $('.sectionMenu').height();
    $('#shadowUL').css({height:sectionMenu});
    if(sectionMenu > 150)
    {
        $('.shadowBg').css({height: (sectionMenu - 130)});
    }
    
    $('#otdel').change(function(){
       brsq(); 
    });
    
});
$(function(){
    $('div.social div a').tipsy({gravity: 's', fade:true, opacity: 1});
    $('.services .main ul li a').tipsy({gravity: 'e', fade:true, opacity: 1});
    $("#contactform input, #contactform textarea, #contactform select, #contactform button").uniform();
});

function brsq() {
    var otdel = $('#otdel').val();
    var brsqContainer = $('.brsqContainer');
    if(otdel == 2) {
        brsqContainer.show();
    } else {
        brsqContainer.hide();
    }
}

function errorForm(o, text)
{
    o.after('<span class="error"> &mdash; '+text+'</span>');
}

function ckeckEmail(email)
{
    return (/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i).test(email.val());
}



