"use strict";
! function(t, l) {
    if ("localhost" !== location.hostname && "127.0.0.1" !== location.hostname) {
        if (!l.createElementNS || !l.createElementNS("http://www.w3.org/2000/svg", "svg").createSVGRect) return;
        var e, r, a = "localStorage" in t && null !== t.localStorage,
            o = function() {
                l.body.insertAdjacentHTML("afterbegin", r)
            },
            i = function() {
                l.body ? o() : l.addEventListener("DOMContentLoaded", o)
            };
        if (a && 1 == localStorage.getItem("inlineSVGrev") && (r = localStorage.getItem("inlineSVGdata"))) return i();
        try {
            (e = new XMLHttpRequest).open("GET", "./build/img/symbol_sprite.html", !0), e.onload = function() {
                200 <= e.status && e.status < 400 && (r = e.responseText, i(), a && (localStorage.setItem("inlineSVGdata", r), localStorage.setItem("inlineSVGrev", 1)))
            }, e.send()
        } catch (e) {}
    } else l.querySelector("body").innerHTML = '<div id="spritesvg"></div>' + l.querySelector("body").innerHTML, $("#spritesvg").load("./build/img/symbol_sprite.html");
    var n = 0 !== l.querySelectorAll('[data-toggle="modal"]').length && l.querySelectorAll('[data-toggle="modal"]');
    if (n) {
        var c = l.querySelector('[data-id="main-form"]'),
            d = c.querySelector("[data-comment-import]"),
            u = c.querySelector(".form-email"),
            s = c.querySelector(".form-phone");
        n.forEach(function(e) {
            e.addEventListener("click", function() {
                c.action = "https://sdg-tradecom.getcourse.ru/pl/lite/block-public/process-html?id=" + e.getAttribute("data-widget-id"), d.value = e.getAttribute("data-comment-import"), e.hasAttribute("data-field-phone") ? (s.querySelector("input").setAttribute("required", ""), s.style.display = "block") : s.style.display = "none", e.hasAttribute("data-field-email") ? (u.querySelector("input").setAttribute("required", ""), u.style.display = "block") : s.style.display = "none", l.querySelector(".modal-title").innerHTML = e.getAttribute("data-title"), c.querySelector("button").innerHTML = e.innerHTML, c.querySelector("button").addEventListener("click", function() {
                    c.checkValidity() && dataLayer.push({
                        event: "" + e.getAttribute("data-push-success")
                    })
                })
            })
        })
    }

    function m(e) {
        var t = l.cookie.match(new RegExp("(?:^|; )" + e.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") + "=([^;]*)"));
        return t ? decodeURIComponent(t[1]) : void 0
    }! function() {
        var t = void 0,
            r = void 0;
        if (m("_ym_uid") && (t = "YM - " + (t = m("_ym_uid"))), m("_ga")) {
            var e = m("_ga").split(".");
            r = "GA - " + (r = e[2] + "." + e[3])
        }
        r || (r = ""), t || (t = "");
        var a = !!l.querySelectorAll('[data-id="client-id"]') && l.querySelectorAll('[data-id="client-id"]');
        a && a.forEach(function(e) {
            e && (e.value = r + (r && t ? " | " : "") + t)
        })
    }();
    var y = 0 !== l.querySelectorAll("__gc__internal__form__helper").length && l.querySelectorAll("__gc__internal__form__helper");
    y && (y.forEach(function(e) {
        e.value = t.location.href
    }), l.getElementsByClassName("__gc__internal__form__helper")[0].value = t.location.href);
    var p = 0 !== l.querySelectorAll("[data-push]").length && l.querySelectorAll("[data-push]"),
        g = !!t.dataLayer;
    p && g && p.forEach(function(e) {
        e.addEventListener("click", function() {
            dataLayer.push({
                event: "" + e.getAttribute("data-push")
            })
        })
    }), $(l).on("click", ".js-videoPoster", function(e) {
        e.preventDefault();
        var t, r, a, l = $(this).closest(".js-videoWrapper");
        r = (t = l).find(".js-videoIframe"), a = r.data("src"), t.addClass("videoWrapperActive"), r.attr("src", a)
    })
}(window, document);