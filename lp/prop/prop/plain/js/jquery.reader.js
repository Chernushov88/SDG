/*

 JQuery Reader v 0.1.2
 Copyright © 2014 Artem Loginov
 http://loginov.biz/

 License:
 GNU General Public License 2 - http://opensource.org/licenses/GPL-2.0

 */

(function($){

    var reader = new function() {

        this.app = new function() {

            this.init = function($element, options) {

                $.extend(reader.settings, reader.defaultOptions, options);

                var rel = $element.attr('rel') || false,
                    url = reader.settings.url || $element.attr('href') || $element.data('href') || '/';
                url = (url.match(/#/gi) && url.indexOf('#') != 0) ? url.split('#')[0] + ' #' + url.split('#')[1] : url;

                reader.current = reader.helpers.popupRelations($element, rel);

                var action = (!reader.isOpen) ? 'open' : 'reload';

                reader.app[action](url, rel);

            };

            this.open = function(url, rel) {

                // Reader layout
                var $document = $('html').addClass((!reader.settings.content) ? 'loading' : ''),
                    $body = $('body'),

                    $reader = $('<div class="' + reader.settings.namespace + '"></div>').css({ paddingLeft: reader.settings.boxHorizontalGutters, paddingRight: reader.settings.boxHorizontalGutters }),

                    $readerBox = $('<div class="' + reader.settings.namespace + '_box"></div>').fadeTo(100, 0).appendTo($reader),
                    $readerBoxContent = $('<div class="' + reader.settings.namespace + '_box_content"></div>').appendTo($readerBox),

                    $readerOverlay = $('<div class="' + reader.settings.namespace + '_overlay"></div>').fadeTo(100, 0),
                    $readerCloseBtn = $('<div class="' + reader.settings.namespace + '_close"></div>'),

                    $readerLocker = $('<div class="' + reader.settings.namespace + '_locker"></div>'),

                    $readerPrev = $('<div class="' + reader.settings.namespace + '_nav prev"></div>'),
                    $readerNext = $('<div class="' + reader.settings.namespace + '_nav next"></div>');

                // Append close btn
                switch(reader.settings.closeBtnLocation) {

                    default:
                    case 'box':
                        $readerCloseBtn.appendTo($readerBox);
                        break;

                    case 'overlay':
                        $readerCloseBtn.appendTo($reader);
                        break;

                }

                // Append overlay
                if(reader.settings.overlay) {
                    $document.addClass('overlay');
                    $readerOverlay.appendTo($reader);
                }

                // Append navigation buttons
                if(rel) {

                }

                // Scroll state
                reader.scrollState = document.documentElement.scrollTop || document.body.scrollTop;

                // Get user agent scroll bar width
                reader.scrollBarWidth = reader.helpers.getScrollBarWidth();

                $document.addClass('loading');

                // Switch popup mode
                switch(reader.settings.mode) {

                    default:
                    case 'reader':

                        if ($(document).height() > $(window).height()) {
                            $document.addClass('outer-scroll');
                        }

                        $body.wrapInner($readerLocker.css({ marginTop: -reader.scrollState }));
                        $document.addClass(reader.settings.namespace + '-on lock');

                        break;

                    case 'modal':

                        $body.wrapInner($readerLocker);
                        $document.addClass(reader.settings.namespace + '-on');

                        break;

                }

                // Show popup
                $body.prepend($reader);
                $readerOverlay.fadeTo(reader.settings.overlayFadeSpeed, reader.settings.overlayOpacity);

                reader.isOpen = true;

                // Close events init
                $readerCloseBtn.bind('click.readerClose', function() {

                    reader.app.close($reader, reader.settings.namespace);

                });

                if(reader.settings.overlayCloseEvent) {

                    $readerOverlay.bind('click.readerClose', function() {
                        reader.app.close($reader, reader.settings.namespace);
                    });

                }

                // Show animate
                switch(reader.settings.animateStyle) {

                    default:
                    case 'fade':

                        $readerBox.css({ top: ($(window).height() - $readerBox.outerHeight()) / 2, width: 'auto', maxWidth: reader.settings.boxWidth });

                        break;

                }

                var getContentMethod = (reader.settings.content || url.indexOf('#') == 0) ? 'appendContent' : 'loadContent';

                reader.app[getContentMethod]($readerBox, $readerBoxContent, url, reader.settings.afterLoad);

            };

            this.reload = function(url) {

                var $reader = $('.' + reader.settings.namespace),
                    $readerBox = $('.' + reader.settings.namespace + '_box'),
                    $readerBoxContent = $('.' + reader.settings.namespace + '_box_content');

                switch(reader.settings.changeStyle) {

                    default:
                    case 'fade':

                        $readerBox.css({ height: $readerBox.height() });

                        $readerBoxContent.fadeTo(reader.settings.animateSpeed, 0, function() {

                            var getContentMethod = reader.settings.content ? 'appendContent' : 'loadContent';
                            reader.app[getContentMethod]($readerBox, $readerBoxContent, url, reader.settings.afterLoad);

                        });

                        break;

                    case 'slide':

                        var position = $readerBox.offset(),

                            $cloneBox = $readerBox.clone(true).css({ position: 'absolute', zIndex: 2, top: position.top, left: position.left + 150, opacity: 0 }),
                            $cloneBoxContent = $cloneBox.find('.' + reader.settings.namespace + '_box_content').fadeTo(1, 0);

                        $cloneBox.prependTo($reader).height($cloneBoxContent.height());

                        $cloneBoxContent.fadeTo(reader.settings.animateSpeed, 0, function() {

                            $cloneBox.animate({ left: position.left, opacity: 1 }, reader.settings.animateSpeed / 2, function() {

                                $readerBox.remove();
                                $cloneBox.css({ position: 'relative', zIndex: 1, left: 0 });

                                var getContentMethod = reader.settings.content ? 'appendContent' : 'loadContent';
                                reader.app[getContentMethod]($cloneBox, $cloneBoxContent, url, reader.settings.afterLoad);

                            });

                        });

                        break;

                }

            };

            this.close = function($reader, namespace) {

                $reader.fadeOut(400, function(){

                    $(this).remove();

                    $('.' + namespace + '_locker').css({ marginTop: 0 });
                    $('html').removeClass(namespace + '-on lock outer-scroll inner-scroll');

                    reader.helpers.unwrap($('body'), '.' + namespace + '_locker');

                    document.documentElement.scrollTop = 0;
                    document.body.scrollTop = 0;
                    window.scrollBy(0, reader.scrollState);

                    reader.isOpen = false;

                });

            };

            this.loadContent = function($box, $container, url, callback) {

                $container.load(url, function(){

                    $('html').removeClass('loading');

                    reader.helpers.resizer($box, $container);

                    // Bind resize window
                    $(window).unbind('resize.readerResize').bind('resize.readerResize', function() {

                        if(reader.resizeTimeout) {
                            clearTimeout(reader.resizeTimeout);
                        }

                        reader.resizeTimeout = window.setTimeout(function() {
                            reader.helpers.resizer($box, $container);
                        }, 300);

                    });

                    if(callback && typeof callback !== 'undefined') {
                        callback($box);
                    }

                });

            };

            this.appendContent = function($box, $container, url, callback) {

                var html = (!reader.settings.content && url.indexOf('#') == 0) ? $(url).html() : reader.settings.content;

                $container.html(html);

                reader.helpers.resizer($box, $container);

                // Bind resize window
                $(window).unbind('resize.readerResize').bind('resize.readerResize', function() {

                    if(reader.resizeTimeout) {
                        clearTimeout(reader.resizeTimeout);
                    }

                    reader.resizeTimeout = window.setTimeout(function() {
                        reader.helpers.resizer($box, $container);
                    }, 300);

                });

                if(callback && typeof callback !== 'undefined') {
                    callback($box);
                }

            };

            this.show = function(options) {

                reader.app.init(this, options || {});

                return this;

            };

            this.hide = function(options) {

                var hideOptions = $.extend({}, reader.defaultOptions, options);

                reader.app.close($('.' + hideOptions.namespace), hideOptions.namespace);

                return this;

            };

            this.destroy = function() {

                $('body').off('click.readerOpen', this.selector);

                return this;

            };

        };

        this.helpers = new function() {

            this.getScrollBarWidth = function() {

                var $element = $('<div class="h-scrollbar-test"></div>').css({ position: 'absolute', left: -99999, top: -99999, overflowY: 'scroll', width: 50, height: 50, visibility: 'hidden' });

                $('body').append($element);

                var scrollBarWidth = $element[0].offsetWidth - $element[0].clientWidth;

                $element.remove();

                return scrollBarWidth;

            };

            this.resizer = function($box, $container) {

                var $document = $('html').removeClass('inner-scroll'),
                    windowWidth = $(window).width(),
                    outerWidth = $box.outerWidth() - $box.width();

                //$box.css({ width: (reader.settings.boxWidth + outerWidth > windowWidth) ? 'auto' : reader.settings.boxWidth });

                var windowHeight = $(window).height(),
                    windowGuttersHeight = windowHeight - reader.settings.boxVerticalGutters * 2,
                    outerHeight = $box.outerHeight() - $box.height(),
                    contentHeight = $container.css({ overflow: 'hidden' }).height() + outerHeight,

                    heightCompare = contentHeight >= windowGuttersHeight,

                    animateProps = {
                        top: heightCompare ? 0 : (windowHeight - contentHeight) / 2,
                        marginTop: heightCompare ? reader.settings.boxVerticalGutters : 0,
                        marginBottom: heightCompare ? reader.settings.boxVerticalGutters : 0,
                        height: contentHeight - outerHeight,
                        maxHeight: (reader.settings.mode == 'modal') ? windowGuttersHeight - outerHeight : 'none'
                    };

                $document.toggleClass('inner-scroll', contentHeight > windowGuttersHeight && reader.settings.mode == 'modal');

                $box.animate(animateProps, reader.settings.animateSpeed / 2, function() {

                    $container.css({ overflow: 'auto' }).fadeTo(reader.settings.animateSpeed / 2, 1);

                    if (reader.settings.mode == 'reader') {
                        $box.css({ height: 'auto' });
                    }

                    $box.fadeTo(reader.settings.animateSpeed / 2, 1);

                });

            };

            this.unwrap = function($this, selector) {

                return $this.each(function() {
                    var t = this,
                        c = (typeof selector !== 'undefined') ? $(t).find(selector) : $(t).children().first();
                    if (c.length === 1) {
                        c.contents().appendTo(t);
                        c.remove();
                    }
                });

            };

            this.popupRelations = function($element, rel) {

                var $collection = $('[rel="' + rel + '"]');

                return (rel && $collection.length) ? $element.index('[rel="' + rel + '"]') : false;

            };

        };

        this.defaultOptions = {

            //Params
            url: false,
            content: false,             // text/html or false

            namespace: 'b-reader',      // css-prefix for popup layout
            mode: 'reader',             // 'reader' - common scroll mode, 'modal' - popup is fixed behind content

            animateStyle: 'fade',
            animateSpeed: 300,

            changeStyle: 'fade',        // 'fade'/'slide'

            boxVerticalGutters: 50,      // number of pixels
            boxHorizontalGutters: 50,    // number of pixels
            boxWidth: 800,              // number of pixels or string 'auto'

            overlay: true,
            overlayCloseEvent: true,
            overlayOpacity: 0.5,
            overlayFadeSpeed: 300,

            closeBtnLocation: 'overlay',    // 'overlay', 'box'

            // Callbacks
            afterLoad: function() {  }    // box - popup box jquery object

        };

        this.settings = {  };

        this.isOpen = false;
        this.current = 0;
        this.scrollState = 0;
        this.scrollBarWidth = 18;

        this.resizeTimeout = null;

    };

    $.fn.reader = function(param) {

        var $body = $('body'),
            selector = this.selector;

        if (reader.app[param]) {

            return reader.app[param].apply(this, Array.prototype.slice.call(arguments, 1));

        } else if (typeof param === 'object' || !param ) {

            $body.on('click.readerOpen', selector, function(e) {

                e.preventDefault();

                reader.app.init($(this), param || {});

            });

            return this;

        } else {

            return $.error('Method "' +  param + '" is not defined in jQuery.reader');

        }

    };

})(jQuery);