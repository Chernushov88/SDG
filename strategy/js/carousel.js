function onPlayerStateChange(event) {
    var target_control = jQuery(event.target.getIframe()).parent().parent().parent().find(".controls");

    var target_caption = jQuery(event.target.getIframe()).parent().find(".carousel-caption");
    switch (event.data) {
        case -1:
            jQuery(target_control).fadeIn(500);
            jQuery(target_control).children().unbind('click');
            break
        case 0:
            jQuery(target_control).fadeIn(500);
            jQuery(target_control).children().unbind('click');
            break;
        case 1:
            jQuery(target_control).children().click(function() { return false; });
            jQuery(target_caption).fadeOut(500);
            jQuery(target_control).fadeOut(500);
            break;
        case 2:
            jQuery(target_control).fadeIn(500);
            jQuery(target_control).children().unbind('click');
            break;
        case 3:
            jQuery(target_control).children().click(function() { return false; });
            jQuery(target_caption).fadeOut(500);
            jQuery(target_control).fadeOut(500);
            break;
        case 5:
            jQuery(target_control).children().click(function() { return false; });
            jQuery(target_caption).fadeOut(500);
            jQuery(target_control).fadeOut(500);
            break;
        default:
            break;
    }
};

jQuery(window).bind('load', function() {
    jQuery(".carousel-caption").fadeIn(500);
    jQuery(".controls").fadeIn(500);
});

jQuery('.carousel').bind('slid.bs.carousel', function(event) {
    jQuery(".controls").fadeIn(500);
});