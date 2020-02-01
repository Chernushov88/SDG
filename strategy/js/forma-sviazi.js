var iframe = document.createElement('iframe');

var currentScript = document.currentScript || (function() {
    var scripts = document.getElementsByTagName('script');
    return scripts[scripts.length - 1];
})();

var getLocation = function(href) {
    var l = document.createElement("a");
    l.href = href;
    return l;
};

var domain = ((getLocation(currentScript.src)).hostname);
iframe.src = "https://sdg-tradecom.getcourse.ru/cms/default/embed/id/10560";
iframe.frameborder = 0;
iframe.width = "100%";
iframe.height = "510";
iframe.style.borderStyle = "none";

addGcIframeWidget(iframe);

function addGcIframeWidget(iframe) {
    var thisScript = document.currentScript || (function() {
        var scripts = document.getElementsByTagName('script');
        return scripts[scripts.length - 1];
    })();

    var parent = thisScript.parentElement;

    parent.insertBefore(iframe, thisScript.nextSibling);

}
