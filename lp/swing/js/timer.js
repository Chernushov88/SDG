(function() {
    var _id = "e8fb6817e6834b343a57c8a1e9ab8552";
    while (document.getElementById("timer" + _id)) _id = _id + "0";
    document.write("<div id='timer" + _id + "' style='width:100%;height:auto;text-align:left;margin:10px 0;'></div>");
    var _t = document.createElement("script");
    _t.src = "js/timer.min.js";
    var _f = function(_k) { var l = new MegaTimer(_id, { "view": [1, 1, 1, 1], "type": { "currentType": "1", "params": { "usertime": false, "tz": "3", "utc": 1539010800000 } }, "design": { "type": "text", "params": { "number-font-size": "50", "number-font-color": "#f9ae00", "separator-margin": "4", "separator-on": true, "separator-text": ":", "text-on": true, "text-font-size": "20", "text-font-color": "#fff" } }, "designId": 1, "theme": "white", "width": 151, "height": 36 }); if (_k != null) l.run(); };
    _t.onload = _f;
    _t.onreadystatechange = function() { if (_t.readyState == "loaded") _f(1); };
    var _h = document.head || document.getElementsByTagName("head")[0];
    _h.appendChild(_t);
}).call(this);