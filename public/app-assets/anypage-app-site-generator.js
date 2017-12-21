
(function() {
    "use strict";

    var callbackRouter = function(event) {
        var event = event || window.event;
        var target = event.target || event.srcElement;

        if (target.id === 'html-generator-button') {
            generatePages();
        }
    };

    var generatePages = function() {
        if (!("staticSitePageUrlList" in window.apSettings)) {
            console.error("Url manifest not found.");
            return false;
        }

        var urlList = window.apSettings.staticSitePageUrlList;
        var now = new Date();

        var dirname = [
            'version',
            now.getFullYear(),
            padTimeWithZero((now.getMonth() + 1)),
            padTimeWithZero(now.getDate()),
            padTimeWithZero(now.getHours()),
            padTimeWithZero(now.getMinutes()),
            padTimeWithZero(now.getSeconds())
        ].join('-');

        var urlParams = '?savePage=true&dir=' + dirname;

        var timeOut = 100; // Initial timeOut.
        var timeGap = 500; // Further time gap between requests.

        for (var key in urlList) {
            if (urlList.hasOwnProperty(key)) {
                var preppedUrl = urlList[key] + urlParams;
                generatePagesCallback(preppedUrl, timeOut);
                timeOut = timeOut + timeGap;
            }
        }
    };

    var generatePagesCallback = function(preppedUrl, timeOut) {
        window.setTimeout(function() {
            window.apAssets.ajaxSuite.ajaxRequest({
                "url":                preppedUrl,
                "insertResponseInto": 'app-ajax-messages',
                "action":             'append'
            });
        }, timeOut);
    };

    var padTimeWithZero = function(val) {
        return ("0" + val).slice(-2);
    };

    document.body.addEventListener('click', callbackRouter, false);

})();
