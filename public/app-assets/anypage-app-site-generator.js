
(function() {
    "use strict";

    var generatePages = function() {
        if ( ! ("staticSitePageUrlList" in window.apSettings)) {
            console.error("Url manifest not found.");
            return false;
        }

        // Default snapshot dirname prefix.
        let dirNamePrefix = 'version';
        if ("snapshotDirNamePrefix" in window.apSettings) {
          dirNamePrefix = window.apSettings.snapshotDirNamePrefix;
        }

        // Reset contents of the response-message drop-zone.
        document.getElementById('generator-feedback-area').innerHTML = "";

        var urlList = window.apSettings.staticSitePageUrlList;
        var now = new Date();

        var dirname = [
          dirNamePrefix,
          now.getFullYear() +
          padTimeWithZero((now.getMonth() + 1)) +
          padTimeWithZero(now.getDate()),
          padTimeWithZero(now.getHours()) +
          padTimeWithZero(now.getMinutes()) +
          padTimeWithZero(now.getSeconds())
        ].join('--');

        var urlParams = '?savePage=true&dir=' + dirname;

        var timeOut = 100; // Initial timeOut.
        var timeGap = 500; // Further time gap between requests.

        for (var key in urlList) {
            if (urlList.hasOwnProperty(key)) {
                var preppedUrl = urlList[key] + urlParams;
                issueRequest(preppedUrl, timeOut);
                timeOut = timeOut + timeGap;
            }
        }
    };

    var issueRequest = function(preppedUrl, timeOut) {
        window.setTimeout(function() {
            window.apAssets.ajaxSuite.ajaxRequest({
                "url":                preppedUrl,
                "insertResponseInto": 'generator-feedback-area',
                "action":             'append'
            });
        }, timeOut);
    };

    var padTimeWithZero = function(val) {
        return ("0" + val).slice(-2);
    };

    var generatorButton = document.getElementById("html-generator-button");

    if (generatorButton) {
        generatorButton.addEventListener("click", generatePages, false);
    }

})();
