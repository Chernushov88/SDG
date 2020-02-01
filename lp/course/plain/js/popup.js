 /*

 PopUp Reader v0.1.0
 Copyright © 2014 Artem Loginov
 http://loginov.biz/

 License:
 MIT License - http://www.opensource.org/licenses/mit-license.php

 */

(function($) {

    var popup = new function() {

        this.isOpen = false;
        this.documentScrollState = 0;

        this.init = function(url, callback, args, options) {

            if(!popup.isOpen) {

                popup.open(url, callback, args, options);

            } else {

                popup.change(url, callback, args, options);

            }

        };

        this.open = function(url, callback, args, options) {

            var $body = $('body'),
                html = '<div class="b-popup"><div class="b-popup-box"><div class="h-loaded-content"></div><span class="close"></span></div><div class="h-mask"></div></div>';

            popup.documentScrollState = document.documentElement.scrollTop || document.body.scrollTop;
  
            $body.append(html);
            $body.addClass('h-popup-on');
            $('.b-popup').show();

            var $box = $('.b-popup-box'),
                $boxHeight = $box.height();

            if($(window).width() < 640) {
                $box.css({ minHeight: $(window).height() });
            }

            $box.css({ marginBottom: 'auto', marginTop: ($(window).height() - $boxHeight) / 2 });

            popup.load(url, callback, args);

            $body.on('click', '.close, .h-mask', function(){
                popup.close();
            });
            
            $('.h-wrapper').css({ top: -popup.documentScrollState });
            $('html, body').scrollTop(0);

            popup.isOpen = true;

        };

        this.change = function(url, callback, args, options) {

            $('.b-popup-box').css({ width: options.readerWidth }).removeClass('loaded');

            if(popup.isOpen) {
                $('.h-loaded-content').empty();
            }

            popup.load(url, callback, args);

        };

        this.close = function() {

            $('.b-popup').fadeOut(400, function(){

                $(this).remove();
                $('.h-wrapper').css({ top: 0 });
                $('body').removeClass('h-popup-on').removeClass('blur');

                document.documentElement.scrollTop = 0;
                document.body.scrollTop = 0;
                window.scrollBy(0, popup.documentScrollState);

                popup.isOpen = false;

            });

        };

        this.load = function(url, callback, args) {

            $('.b-popup-box .h-loaded-content').load(url, function(){

                var $box = $('.b-popup-box');

                $box.addClass('loaded');

                if(callback && typeof callback != 'undefined') {
                    callback(args);
                }

                var $boxHeight = $('.b-popup-box .h-loaded-content').height();

                if($(window).height() > $boxHeight) {
                    $box.animate({ marginBottom: 'auto', marginTop: ($(window).height() - $boxHeight) / 2, height: $boxHeight }, 150, function() {
                        $box.css({ height: 'auto' });
                    });
                } else {
                    $box.animate({ marginBottom: 100, marginTop: 100, height: $boxHeight }, 150, function() {
                        $box.css({ marginTop: 100, marginBottom: 100, height: 'auto' });
                    });
                }

            });


        };

    };

    $.fn.readerPopUp = function(options) {

        var defaults = {
            onLoaded: false,
            onLoadedArguments: false
        };

        options = $.extend(defaults, options);

        if($('.h-wrapper').length == 0) {

            $('body').wrapInner('<div class="h-wrapper"></div>');

        }

        this.click(function(e) {

            e.preventDefault();

            var url = (typeof $(this).attr('href') != 'undefined') ? $(this).attr('href') : $(this).data('href');

            if(url.match(/#/gi)) {
                url = url.split('#')[0] + ' #' + url.split('#')[1];
            }

            popup.init(url, options.onLoaded, options.onLoadedArguments, options);

        });

    };

})(jQuery);