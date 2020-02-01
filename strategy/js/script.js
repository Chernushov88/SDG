(function($) {
  "use strict";

  /* ========================================================================= */
  /*	Page Preloader
	/* ========================================================================= */

  // window.load = function () {
  // 	document.getElementById('preloader').style.display = 'none';
  // }

  $(function() {
    // this replaces document.ready
    setTimeout(function() {
      $("#preloader").fadeOut("slow", function() {
        $(this).remove();
      });
    }, 1500);
  });

  $(function() {
    $(".scroll a").on("click", function(e) {
      e.preventDefault();
      $("html, body").animate(
        { scrollTop: $($(this).attr("href")).offset().top - 70 },
        500,
        "linear"
      );
    });
  });
})(jQuery);

/*
 * jQuery Bootstrap Responsive Tabs v2.0.1 | Valeriu Timbuc - vtimbuc.com
 * github.com/vtimbuc/bootstrap-responsive-tabs
 * @license WTFPL http://www.wtfpl.net/about/
 */

(function($) {
  "use strict";

  var defaults = {
    accordionOn: ["xs"] // xs, sm, md, lg
  };

  $.fn.responsiveTabs = function(options) {
    var config = $.extend({}, defaults, options),
      accordion = "";

    $.each(config.accordionOn, function(index, value) {
      accordion += " accordion-" + value;
    });

    return this.each(function() {
      var $self = $(this),
        $navTabs = $self.find("> li > a"),
        $tabContent = $($navTabs.first().attr("href")).parent(".tab-content"),
        $tabs = $tabContent.children(".tab-pane");

      // Wrap the tabs
      $self
        .add($tabContent)
        .wrapAll('<div class="responsive-tabs-container" />');

      var $container = $self.parent(".responsive-tabs-container");

      $container.addClass(accordion);

      // Duplicate links for accordion
      $navTabs.each(function(i) {
        var $this = $(this),
          id = $this.attr("href"),
          active = "",
          first = "",
          last = "";

        // Add active class
        if ($this.parent("li").hasClass("active")) {
          active = " active";
        }

        // Add first class
        if (i === 0) {
          first = " first";
        }

        // Add last class
        if (i === $navTabs.length - 1) {
          last = " last";
        }

        $this
          .clone(false)
          .addClass("accordion-link" + active + first + last)
          .insertBefore(id);
      });

      var $accordionLinks = $tabContent.children(".accordion-link");

      // Tabs Click Event
      $navTabs.on("click", function(event) {
        event.preventDefault();

        var $this = $(this),
          $li = $this.parent("li"),
          $siblings = $li.siblings("li"),
          id = $this.attr("href"),
          $accordionLink = $tabContent.children('a[href="' + id + '"]');

        if (!$li.hasClass("active")) {
          $li.addClass("active");
          $siblings.removeClass("active");

          $tabs.removeClass("active");
          $(id).addClass("active");

          $accordionLinks.removeClass("active");
          $accordionLink.addClass("active");
        }
      });

      // Accordion Click Event
      $accordionLinks.on("click", function(event) {
        event.preventDefault();

        var $this = $(this),
          id = $this.attr("href"),
          $tabLink = $self.find('li > a[href="' + id + '"]').parent("li");

        if (!$this.hasClass("active")) {
          $accordionLinks.removeClass("active");
          $this.addClass("active");

          $tabs.removeClass("active");
          $(id).addClass("active");

          $navTabs.parent("li").removeClass("active");
          $tabLink.addClass("active");
        }
      });
    });
  };
})(jQuery);
$(document).ready(function() {
  site.init();
});

var site = new (function() {
  this.init = function() {
    // Scroll animate
    site.sectionsPrepare();

    $(window).bind("load scroll", function() {
      setTimeout(function() {
        site.sectionsAnimateControl();
      }, 200);
    });

    // UI
    site.tabs("faq");

    // Forms
    site.forms.validate(".b-form form");
    site.forms.controls(
      'input[type="checkbox"], input[type="radio"]',
      "select"
    );
  };

  this.tabs = function(selector, callback) {
    $("[data-" + selector + "]").each(function() {
      $(this)
        .find("[data-" + selector + "-item]")
        .hide();
      $(this)
        .find("[data-" + selector + "-item]:first")
        .show();

      $(this)
        .find("[data-" + selector + "-switcher] > li a")
        .removeClass("current");
      $(this)
        .find("[data-" + selector + "-switcher] > li:first a")
        .addClass("current");

      $(this)
        .find("[data-" + selector + '-switcher] a[href*="#"]')
        .click(function() {
          $(this)
            .closest("[data-" + selector + "]")
            .find("[data-" + selector + "-switcher] a")
            .removeClass("current");
          $(this).addClass("current");

          $(this)
            .closest("[data-" + selector + "]")
            .find("[data-" + selector + "-item]")
            .hide();
          $(this)
            .closest("[data-" + selector + "]")
            .find("[data-" + selector + "-item]" + $(this).attr("href"))
            .show();

          if (typeof callback != "undefined" && callback) {
            callback(
              $(this),
              $(this)
                .closest("[data-" + selector + "]")
                .find("[data-" + selector + "-item]" + $(this).attr("href"))
            );
          }

          return false;
        });
    });
  };

  this.sectionsPrepare = function() {
    //$('.b-content_section').fadeTo(1, 0);
  };

  this.sectionsAnimateControl = function() {
    $(".b-content_section").each(function() {
      var scroll =
        document.documentElement.scrollTop || document.body.scrollTop;

      if (scroll + $(window).height() - 150 > $(this).offset().top) {
        $(this).addClass("show");
        //$(this).fadeTo(800, 1);
      } else {
        //$(this).removeClass('show');
        //$(this).stop(true, true).fadeTo(800, 0);
      }
    });
  };

  this.forms = new (function() {
    this.msg = {
      required: "Это поле обязательно для заполнения",
      email: "Укажите корректный e-mail",
      captcha: "Неверный код проверки"
    };

    this.validate = function(selector) {
      var $form = $(selector);

      if (
        $.isFunction($.fn.validate) &&
        $form.length != 0 &&
        $form.data("checkup")
      ) {
        $form.validate({
          onChange: true,
          eachValidField: function() {
            $(this)
              .closest(".b-form_box")
              .removeClass("g-error");
            $(this)
              .closest(".b-form_box")
              .find(".b-form_box_error")
              .remove();
          },
          eachInvalidField: function(status, options) {
            $(this)
              .closest(".b-form_box")
              .addClass("g-error");
            $(this)
              .closest(".b-form_box")
              .find(".b-form_box_error")
              .remove();

            if (options.required) {
              if (!options.pattern) {
                if ($form.data("report") != "placeholder") {
                  $(this)
                    .closest(".b-form_box")
                    .append(
                      '<span class="b-form_box_error">' +
                        site.forms.msg.email +
                        "</span>"
                    );
                } else {
                  $(this)
                    .val("")
                    .attr("placeholder", site.forms.msg.email);
                }
              }
            } else {
              if ($form.data("report") != "placeholder") {
                $(this)
                  .closest(".b-form_box")
                  .append(
                    '<span class="b-form_box_error">' +
                      site.forms.msg.required +
                      "</span>"
                  );
              } else {
                $(this)
                  .val("")
                  .attr("placeholder", site.forms.msg.required);
              }
            }
          },
          invalid: function() {
            var documentScrollState =
                document.documentElement.scrollTop || document.body.scrollTop,
              targetPosition =
                $(this)
                  .find(".g-error:first")
                  .offset().top - 30;

            if (documentScrollState > targetPosition) {
              $("html, body").animate(
                {
                  scrollTop:
                    $(this)
                      .find(".g-error:first")
                      .offset().top - 20
                },
                200
              );
            }
          },
          valid: function(e) {
            e.preventDefault();

            var $targetFrom = $(this),
              data = $(this).serialize();

            $targetFrom.find(".g-btn").addClass("sending");

            $.ajax({
              url: $targetFrom.attr("action"),
              method: $targetFrom.attr("method"),
              data: data,
              dataType: "json",
              success: function(data) {
                $targetFrom.find(".g-btn").removeClass("sending");
                $targetFrom
                  .parent()
                  .find(".b-form_answer")
                  .remove();

                if (data.status) {
                  $targetFrom.after(
                    '<div class="b-form_answer blue"><p>Спасибо за заявку. Мы перезвоним Вам в ближайшее время.</p></div>'
                  );
                } else {
                  $targetFrom.after(
                    '<div class="b-form_answer red"><p>Ошибка! Попробуйте еще раз.</div></p>'
                  );
                }

                $targetFrom
                  .parent()
                  .find(".b-form_answer")
                  .fadeIn(300);
              }
            });
          }
        });
      }
    };

    this.controls = function(input, select) {
      if ($.isFunction($.fn.uniform)) {
        $(input).uniform();

        if (typeof select !== "undefined") {
          $(select).uniform({
            selectAutoWidth: false
          });
        }
      }
    };
  })();
})();

$(document).ready(function() {
  site.init();
});

var site = new (function() {
  this.init = function() {
    // Scroll animate
    site.sectionsPrepare();

    $(window).bind("load scroll", function() {
      setTimeout(function() {
        site.sectionsAnimateControl();
      }, 200);
    });

    // UI
    site.tabs("faq");

    // Forms
    site.forms.validate(".b-form form");
    site.forms.controls(
      'input[type="checkbox"], input[type="radio"]',
      "select"
    );
  };

  this.tabs = function(selector, callback) {
    $("[data-" + selector + "]").each(function() {
      $(this)
        .find("[data-" + selector + "-item]")
        .hide();
      $(this)
        .find("[data-" + selector + "-item]:first")
        .show();

      $(this)
        .find("[data-" + selector + "-switcher] > li a")
        .removeClass("current");
      $(this)
        .find("[data-" + selector + "-switcher] > li:first a")
        .addClass("current");

      $(this)
        .find("[data-" + selector + '-switcher] a[href*="#"]')
        .click(function() {
          $(this)
            .closest("[data-" + selector + "]")
            .find("[data-" + selector + "-switcher] a")
            .removeClass("current");
          $(this).addClass("current");

          $(this)
            .closest("[data-" + selector + "]")
            .find("[data-" + selector + "-item]")
            .hide();
          $(this)
            .closest("[data-" + selector + "]")
            .find("[data-" + selector + "-item]" + $(this).attr("href"))
            .show();

          if (typeof callback != "undefined" && callback) {
            callback(
              $(this),
              $(this)
                .closest("[data-" + selector + "]")
                .find("[data-" + selector + "-item]" + $(this).attr("href"))
            );
          }

          return false;
        });
    });
  };

  this.sectionsPrepare = function() {
    //$('.b-content_section').fadeTo(1, 0);
  };

  this.sectionsAnimateControl = function() {
    $(".b-content_section").each(function() {
      var scroll =
        document.documentElement.scrollTop || document.body.scrollTop;

      if (scroll + $(window).height() - 150 > $(this).offset().top) {
        $(this).addClass("show");
        //$(this).fadeTo(800, 1);
      } else {
        //$(this).removeClass('show');
        //$(this).stop(true, true).fadeTo(800, 0);
      }
    });
  };

  this.forms = new (function() {
    this.msg = {
      required: "Это поле обязательно для заполнения",
      email: "Укажите корректный e-mail",
      captcha: "Неверный код проверки"
    };

    this.validate = function(selector) {
      var $form = $(selector);

      if (
        $.isFunction($.fn.validate) &&
        $form.length != 0 &&
        $form.data("checkup")
      ) {
        $form.validate({
          onChange: true,
          eachValidField: function() {
            $(this)
              .closest(".b-form_box")
              .removeClass("g-error");
            $(this)
              .closest(".b-form_box")
              .find(".b-form_box_error")
              .remove();
          },
          eachInvalidField: function(status, options) {
            $(this)
              .closest(".b-form_box")
              .addClass("g-error");
            $(this)
              .closest(".b-form_box")
              .find(".b-form_box_error")
              .remove();

            if (options.required) {
              if (!options.pattern) {
                if ($form.data("report") != "placeholder") {
                  $(this)
                    .closest(".b-form_box")
                    .append(
                      '<span class="b-form_box_error">' +
                        site.forms.msg.email +
                        "</span>"
                    );
                } else {
                  $(this)
                    .val("")
                    .attr("placeholder", site.forms.msg.email);
                }
              }
            } else {
              if ($form.data("report") != "placeholder") {
                $(this)
                  .closest(".b-form_box")
                  .append(
                    '<span class="b-form_box_error">' +
                      site.forms.msg.required +
                      "</span>"
                  );
              } else {
                $(this)
                  .val("")
                  .attr("placeholder", site.forms.msg.required);
              }
            }
          },
          invalid: function() {
            var documentScrollState =
                document.documentElement.scrollTop || document.body.scrollTop,
              targetPosition =
                $(this)
                  .find(".g-error:first")
                  .offset().top - 30;

            if (documentScrollState > targetPosition) {
              $("html, body").animate(
                {
                  scrollTop:
                    $(this)
                      .find(".g-error:first")
                      .offset().top - 20
                },
                200
              );
            }
          },
          valid: function(e) {
            e.preventDefault();

            var $targetFrom = $(this),
              data = $(this).serialize();

            $targetFrom.find(".g-btn").addClass("sending");

            $.ajax({
              url: $targetFrom.attr("action"),
              method: $targetFrom.attr("method"),
              data: data,
              dataType: "json",
              success: function(data) {
                $targetFrom.find(".g-btn").removeClass("sending");
                $targetFrom
                  .parent()
                  .find(".b-form_answer")
                  .remove();

                if (data.status) {
                  $targetFrom.after(
                    '<div class="b-form_answer blue"><p>Спасибо за заявку. Мы перезвоним Вам в ближайшее время.</p></div>'
                  );
                } else {
                  $targetFrom.after(
                    '<div class="b-form_answer red"><p>Ошибка! Попробуйте еще раз.</div></p>'
                  );
                }

                $targetFrom
                  .parent()
                  .find(".b-form_answer")
                  .fadeIn(300);
              }
            });
          }
        });
      }
    };

    this.controls = function(input, select) {
      if ($.isFunction($.fn.uniform)) {
        $(input).uniform();

        if (typeof select !== "undefined") {
          $(select).uniform({
            selectAutoWidth: false
          });
        }
      }
    };
  })();
})();