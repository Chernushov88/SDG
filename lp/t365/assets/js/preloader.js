                           (function ($) {
                               "use strict";

                               /* ========================================================================= */
                               /*	Page Preloader
                               /* ========================================================================= */

                               // window.load = function () {
                               // 	document.getElementById('preloader').style.display = 'none';
                               // }

                               $(function () { // this replaces document.ready
                                   setTimeout(function () {
                                       $('#preloader').fadeOut('slow', function () {
                                           $(this).remove();
                                       });
                                   }, 1500);
                               });
                           })(jQuery);
