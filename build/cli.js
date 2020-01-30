"use strict";
window.addEventListener("load", function() {
  function r(e) {
    var o = document.cookie.match(
      new RegExp(
        "(?:^|; )" +
          e.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") +
          "=([^;]*)"
      )
    );
    return o ? decodeURIComponent(o[1]) : void 0;
  }
  !(function() {
    if ("function" == typeof NodeList.prototype.forEach) return;
    NodeList.prototype.forEach = Array.prototype.forEach;
  })();
  var e = function() {
      var o = void 0,
        t = void 0;
      if ((r("_ym_uid") && (o = "YM - " + (o = r("_ym_uid"))), r("_ga"))) {
        var e = r("_ga").split(".");
        t = "GA - " + (t = e[2] + "." + e[3]);
      }
      t || (t = ""), o || (o = "");
      var n =
        !!document.querySelectorAll('[data-id="client-id"]') &&
        document.querySelectorAll('[data-id="client-id"]');
      return (
        0 !== n.length
          ? n.forEach(function(e) {
              e && (e.value = t + (t && o ? " | " : "") + o);
            })
          : (n = document.querySelectorAll(
              "[name='formParams[userCustomFields][157562]']"
            )).forEach(function(e) {
              e && (e.innerHTML = t + (t && o ? " | " : "") + o);
            }),
        0 < n.length
      );
    },
    o = e();
  if (!o)
    var t = null,
      n = setInterval(function() {
        console.log("step interval"),
          t++,
          o
            ? (console.log("interval done"), clearInterval(n))
            : (console.log("CLI is empty"),
              (o = e()),
            50 < t && clearInterval(n));
      }, 5e2);
  document
    .querySelectorAll(".__gc__internal__form__helper")
    .forEach(function(e) {
      e.value = window.location.href;
    });
});
