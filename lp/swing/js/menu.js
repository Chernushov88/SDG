jQuery(document).ready(function($) {
  $(window).stellar();

  var links = $(".navigation").find("li");
  slide = $(".slide");
  button = $(".button");
  mywindow = $(window);
  htmlbody = $("html,body");

  slide.waypoint(function(event, direction) {
    dataslide = $(this).attr("data-slide");

    if (direction === "down") {
      $('.navigation li[data-slide="' + dataslide + '"]')
        .addClass("active")
        .prev()
        .removeClass("active");
    } else {
      $('.navigation li[data-slide="' + dataslide + '"]')
        .addClass("active")
        .next()
        .removeClass("active");
    }
  });

  mywindow.scroll(function() {
    if (mywindow.scrollTop() == 0) {
      $('.navigation li[data-slide="1"]').addClass("active");
      $('.navigation li[data-slide="2"]').removeClass("active");
    }
  });

  function goToByScroll(dataslide) {
    htmlbody.animate(
      {
        scrollTop: $('.slide[data-slide="' + dataslide + '"]').offset().top + 2
      },
      2000,
      "easeInOutQuint"
    );
  }

  // links.click(function(e) {
  //   e.preventDefault();
  //   dataslide = $(this).attr("data-slide");
  //   goToByScroll(dataslide);
  // });

  // button.click(function(e) {
  //   e.preventDefault();
  //   dataslide = $(this).attr("data-slide");
  //   goToByScroll(dataslide);
  // });

  //DROP menu
  $(".btn_dropdown").click(function() {
    $(".navigation").slideToggle("slow");
  });

  $(".accordion div")
    .eq(1)
    .addClass("active");
  $(".accordion .accord_cont")
    .eq(1)
    .show();

  $(".accordion div").click(function() {
    $(this)
      .next(".accord_cont")
      .slideToggle("fast")
      .siblings(".accord_cont:visible")
      .slideUp("fast");
    $(this).toggleClass("active");
    $(this)
      .siblings("div")
      .removeClass("active");
  });

  // drop_menu();

  // sliderHeight();

  // mymargtop();
});

// $(window).bind("resize", function() {
//   //Update slider height
//   sliderHeight();

//   mymargtop();
// });

// $(window).resize(function() {
//   drop_menu();
// });
