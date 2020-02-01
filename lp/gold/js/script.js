//LOADER/SPINNER
$(window).bind("load", function() {

    "use strict";

    $(".spn_hol").fadeOut(1000);
});









// //PRETTYPHOTO

// $(document).ready(function() {

//     "use strict";

//     $("a[rel^='prettyPhoto']").prettyPhoto({
//         show_title: false,
//         /* true/false */
//     });
// });



// //WOW JS
// $(document).ready(function() {

//     "use strict";

//     new WOW().init();
// });



// //RESPONSIVE VIDEO
// $(document).ready(function() {

//     "use strict";

//     // Basic FitVids Test
//     $(".video").fitVids();
// });





/// SMOOTH SCROLL           

// $(document).ready(function() {

//     "use strict";

//     var scrollAnimationTime = 1200,
//         scrollAnimation = 'easeInOutExpo';
//     $('a.scrollto').bind('click.smoothscroll', function(event) {
//         event.preventDefault();
//         var target = this.hash;
//         $('html, body').stop().animate({
//             'scrollTop': $(target).offset().top
//         }, scrollAnimationTime, scrollAnimation, function() {
//             window.location.hash = target;
//         });
//     });
//     //COUNTER
//     $('.counter_num').counterUp({
//         delay: 10,
//         time: 2000
//     });
// });