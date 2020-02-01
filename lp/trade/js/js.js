jQuery(document).ready(function($) {

    function goToByScroll(dataslide) {
        $('html, body').animate({
            scrollTop: $('.slide[data-slide="' + dataslide + '"]').offset().top + 2
        }, 2000);
    }
    $('.navigation li').click(function(e) {
        e.preventDefault();
        dataslide = $(this).attr('data-slide');
        goToByScroll(dataslide);
    });
    $('a.button').click(function(e) {
        e.preventDefault();
        dataslide = $(this).attr('data-slide');
        goToByScroll(dataslide);
    });
    //accordion
    $(".accordion div").eq(0).addClass("active");
    $(".accordion .accord_cont").eq(0).show();

    $(".accordion div").click(function() {
        $(this).next(".accord_cont").slideToggle("fast")
            .siblings(".accord_cont:visible").slideUp("fast");
        $(this).toggleClass("active");
        $(this).siblings("h3").removeClass("active");
    });

});