$(document).ready(function(){
    site.init();
});

var site = new function() {

    this.init = function() {

        // Scroll animate
        site.sectionsPrepare();

        $(window).bind('load scroll', function () {
            setTimeout(function() {
                site.sectionsAnimateControl();
            }, 200);
        });

        // UI
        site.anchors();
        site.carousel();
        site.sticker();
        site.tabs('faq');

        // Forms
        site.forms.validate('.b-form form');
        site.forms.controls('input[type="checkbox"], input[type="radio"]', 'select');

        // Popup
        $('[data-popup]').reader({
            boxWidth: 420,
            overlayOpacity: .5,
            afterLoad: function() {
                site.forms.validate('.b-reader .b-form form');
                site.forms.controls('.b-reader input[type="checkbox"], .b-reader input[type="radio"]', '.b-reader select');
            }
        });

    };

    this.carousel = function() {

        $('#b-carousel').featureCarousel({
            trackerIndividual: false,
            trackerSummation: false,
            largeFeatureWidth: 435,
            largeFeatureHeight: 275,
            smallFeatureWidth: 340,
            smallFeatureHeight: 215,
            topPadding: 0,
            sidePadding: 0,
            carouselSpeed: 700,
            leavingCenter: function() {
                $('.b-content_carousel_wrapper_screen').fadeIn(200);
            },
            movedToCenter: function() {
                $('.b-content_carousel_wrapper_screen').fadeOut(250);
            }
        });

    };

    this.sticker = function() {

        var $stick = $('.b-header_stick');

        $(window).bind('scroll.topBar load.topBar', function() {

            var scroll = document.documentElement.scrollTop || document.body.scrollTop,
                top = $(window).height();

            if(scroll > top) {
                $stick.fadeIn(200);
            } else {
                if(!$('html').hasClass('b-reader-on')) {
                    $stick.fadeOut(200);
                }
            }

        });

    };

    this.anchors = function() {

        $('a[href^="#"]').click(function(e) {

            e.preventDefault();

            var url = $(this).attr('href');

            if(url.length > 1) {

                var targetPosition = $($(this).attr('href')).offset().top;

                $('html, body').animate({ scrollTop: targetPosition - 100 }, 350);

                /*
                var documentScrollState = document.documentElement.scrollTop || document.body.scrollTop,
                    targetHeight = $($(this).attr('href')).outerHeight();
                */

                /*if(documentScrollState < targetPosition || documentScrollState > targetPosition + targetHeight) {
                    $('html, body').animate({ scrollTop: targetPosition - 140 }, 350);
                }*/

            }

        });

    };

    this.tabs = function(selector, callback) {

        $('[data-' + selector + ']').each(function(){

            $(this).find('[data-' + selector + '-item]').hide();
            $(this).find('[data-' + selector + '-item]:first').show();

            $(this).find('[data-' + selector + '-switcher] > li a').removeClass('current');
            $(this).find('[data-' + selector + '-switcher] > li:first a').addClass('current');

            $(this).find('[data-' + selector + '-switcher] a[href*="#"]').click(function(){

                $(this).closest('[data-' + selector + ']').find('[data-' + selector + '-switcher] a').removeClass('current');
                $(this).addClass('current');

                $(this).closest('[data-' + selector + ']').find('[data-' + selector + '-item]').hide();
                $(this).closest('[data-' + selector + ']').find('[data-' + selector + '-item]' + $(this).attr('href')).show();

                if(typeof callback != 'undefined' && callback) {
                    callback($(this), $(this).closest('[data-' + selector + ']').find('[data-' + selector + '-item]' + $(this).attr('href')));
                }

                return false;

            });

        });

    };

    this.sectionsPrepare = function() {

        //$('.b-content_section').fadeTo(1, 0);

    };

    this.sectionsAnimateControl = function() {

        $('.b-content_section').each(function(){

            var scroll = document.documentElement.scrollTop || document.body.scrollTop;

            if(scroll + $(window).height() - 150 > $(this).offset().top) {

                $(this).addClass('show');
                //$(this).fadeTo(800, 1);

            } else {

                //$(this).removeClass('show');
                //$(this).stop(true, true).fadeTo(800, 0);

            }

        });

    };

    this.forms = new function() {

        this.msg = {
            required: 'Это поле обязательно для заполнения',
            email: 'Укажите корректный e-mail',
            captcha: 'Неверный код проверки'
        };

        this.validate = function(selector) {

            var $form = $(selector);

            if ($.isFunction($.fn.validate) && $form.length != 0 && $form.data('checkup')) {

                $form.validate({
                    onChange: true,
                    eachValidField: function() {
                        $(this).closest('.b-form_box').removeClass('g-error');
                        $(this).closest('.b-form_box').find('.b-form_box_error').remove();
                    },
                    eachInvalidField: function(status, options) {
                        $(this).closest('.b-form_box').addClass('g-error');
                        $(this).closest('.b-form_box').find('.b-form_box_error').remove();

                        if(options.required) {
                            if(!options.pattern) {
                                if($form.data('report') != 'placeholder') {
                                    $(this).closest('.b-form_box').append('<span class="b-form_box_error">' + site.forms.msg.email + '</span>');
                                } else {
                                    $(this).val('').attr('placeholder', site.forms.msg.email);
                                }
                            }
                        } else {
                            if($form.data('report') != 'placeholder') {
                                $(this).closest('.b-form_box').append('<span class="b-form_box_error">' + site.forms.msg.required + '</span>');
                            } else {
                                $(this).val('').attr('placeholder', site.forms.msg.required);
                            }
                        }

                    },
                    invalid: function() {

                        var documentScrollState = document.documentElement.scrollTop || document.body.scrollTop,
                            targetPosition = $(this).find('.g-error:first').offset().top - 30;

                        if(documentScrollState > targetPosition) {
                            $('html, body').animate({ scrollTop: $(this).find('.g-error:first').offset().top - 20 }, 200);
                        }

                    },
                    valid: function(e) {

                        e.preventDefault();

                        var $targetFrom = $(this),
                            data = $(this).serialize();

                        $targetFrom.find('.g-btn').addClass('sending');

                        $.ajax({
                            url: $targetFrom.attr('action'),
                            method: $targetFrom.attr('method'),
                            data: data,
                            dataType: 'json',
                            success: function(data) {

                                $targetFrom.find('.g-btn').removeClass('sending');
                                $targetFrom.parent().find('.b-form_answer').remove();

                                if(data.status) {
                                    $targetFrom.after('<div class="b-form_answer blue"><p>Спасибо за заявку. Мы перезвоним Вам в ближайшее время.</p></div>');
                                } else {
                                    $targetFrom.after('<div class="b-form_answer red"><p>Ошибка! Попробуйте еще раз.</div></p>');
                                }

                                $targetFrom.parent().find('.b-form_answer').fadeIn(300);

                            }

                        });

                    }
                });

            }

        };

        this.controls = function(input, select) {

            if ($.isFunction($.fn.uniform)) {

                $(input).uniform();

                if(typeof select !== 'undefined') {
                    $(select).uniform({
                        selectAutoWidth: false
                    });
                }

            }

        };

    };

};
