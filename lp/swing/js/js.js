function sliderHeight() {

    wh = $(window).height();
    $('#slide1').css({
        height: wh
    });

}

function mymargtop() {
    var body_h = $(window).height();
    var container_h = $('.filtr_bg').height();
    var marg_top = Math.abs((body_h - container_h) / 2);
    $('.filtr_bg').css('margin-top', marg_top);
    $('.filtr_bg').css('margin-bottom', marg_top);
}

function drop_menu() {
    //DROP menu
    if ($(window).width() < 750) {
        $(".navigation li").click(function () {
            $(".navigation").slideToggle("slow");
        });
    }
}

jQuery(document).ready(function ($) {


    $(window).stellar();

    var links = $('.navigation').find('li');
    slide = $('.slide');
    button = $('.button');
    mywindow = $(window);
    htmlbody = $('html,body');


    slide.waypoint(function (event, direction) {

        dataslide = $(this).attr('data-slide');

        if (direction === 'down') {
            $('.navigation li[data-slide="' + dataslide + '"]').addClass('active').prev().removeClass('active');
        } else {
            $('.navigation li[data-slide="' + dataslide + '"]').addClass('active').next().removeClass('active');
        }

    });

    mywindow.scroll(function () {
        if (mywindow.scrollTop() == 0) {
            $('.navigation li[data-slide="1"]').addClass('active');
            $('.navigation li[data-slide="2"]').removeClass('active');
        }
    });

    function goToByScroll(dataslide) {
        htmlbody.animate({
            scrollTop: $('.slide[data-slide="' + dataslide + '"]').offset().top + 2
        }, 2000, 'easeInOutQuint');
    }



    links.click(function (e) {
        e.preventDefault();
        dataslide = $(this).attr('data-slide');
        goToByScroll(dataslide);
    });

    button.click(function (e) {
        e.preventDefault();
        dataslide = $(this).attr('data-slide');
        goToByScroll(dataslide);

    });


    // // Sticky Navigation	
    // $(".menu").sticky({
    //     topSpacing: 0
    // });

    //DROP menu
    $(".btn_dropdown").click(function () {
        $(".navigation").slideToggle("slow");
    });


    // //prettyPhoto
    // $("a[rel^='prettyPhoto']").prettyPhoto();

    // //Image hover
    // $(".hover_img").live('mouseover', function () {
    //     var info = $(this).find("img");
    //     info.stop().animate({
    //         opacity: 0.51
    //     }, 300);
    //     $(".preloader").css({
    //         'background': 'none'
    //     });
    // });
    // $(".hover_img").live('mouseout', function () {
    //     var info = $(this).find("img");
    //     info.stop().animate({
    //         opacity: 1
    //     }, 300);
    //     $(".preloader").css({
    //         'background': 'none'
    //     });
    // });

    //accordion
    $(".accordion div").eq(1).addClass("active");
    $(".accordion .accord_cont").eq(1).show();

    $(".accordion div").click(function () {
        $(this).next(".accord_cont").slideToggle("fast")
            .siblings(".accord_cont:visible").slideUp("fast");
        $(this).toggleClass("active");
        $(this).siblings("div").removeClass("active");
    });

    drop_menu();

    sliderHeight();

    mymargtop();

});

$(window).bind('resize', function () {

    //Update slider height
    sliderHeight();

    mymargtop();

});

$(window).resize(function () {


    drop_menu();

});
