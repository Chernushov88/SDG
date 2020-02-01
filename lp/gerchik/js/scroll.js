/**
 * Copyright (c) 2013 mopapy.
 * mail - mopapy@gmail.com
 * site - www.joomlall.ru
**/
$(document).ready(function () {
    $("a").click(function () {
        var elementClick = $(this).attr("href");
        var destination = $(elementClick).offset().top;
        if ($.browser.safari) {
            $('body').animate({ scrollTop: destination }, 1500); //1500 - скорость прокрутки
        } else {
            $('html').animate({ scrollTop: destination }, 1500);
        }
        return false; 
    });
});