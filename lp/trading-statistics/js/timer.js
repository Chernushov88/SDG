(function() {
    var _id = "e8fb6817e6834b343a57c8a1e9ab8552";
    while (document.getElementById("timer" + _id)) _id = _id + "0";
    document.write("<div id='timer" + _id + "' style='width:400px;height:auto;text-align:center;margin:10px 0;'></div>");
    var _t = document.createElement("script");
    _t.src = "js/timer.min.js";
    var _f = function(_k) { var l = new MegaTimer(_id, { "view": [1, 1, 1, 1], "type": { "currentType": "1", "params": { "usertime": true, "tz": "3", "utc": 1553799600000 } }, "design": { "type": "circle", "params": { "width": "6", "radius": "40", "line": "solid", "line-color": "#05215e", "background": "solid", "background-color": "rgba(255,255,255,0.07)", "direction": "direct", "number-font-size": "35", "number-font-color": "#05215e", "separator-margin": "5", "separator-on": false, "separator-text": ":", "text-on": true, "text-font-size": "12", "text-font-color": "#05215e" } }, "designId": 7, "theme": "black", "width": 485, "height": 156 }); if (_k != null) l.run(); };
    _t.onload = _f;
    _t.onreadystatechange = function() { if (_t.readyState == "loaded") _f(1); };
    var _h = document.head || document.getElementsByTagName("head")[0];
    _h.appendChild(_t);
}).call(this);