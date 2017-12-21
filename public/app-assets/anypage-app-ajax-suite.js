
(function() {
    "use strict";

    var ajaxSuite = {};

    ajaxSuite.ajaxRequest = function(args) {
        var address = args.url;
        var xhr = new XMLHttpRequest();
        if (xhr !== undefined) {
            xhr.onreadystatechange = function() {
                ajaxSuite.ajaxResponseHandler(xhr, args);
            };
            xhr.open('POST', address, true);
            xhr.send('');
            console.log('Sent request to ' + address);
        }
        else {
            console.log('No xhr.');
        }
    };

    ajaxSuite.ajaxResponseHandler = function(xhr, args) {
        if (xhr.readyState === 4) {
            var container = document.createElement('div');
            container.className = 'ajax-response';

            var responseBody = xhr.responseText;

            if (xhr.status === 200) {
                container.innerHTML = responseBody;
            }
            else {
                var serviceMessage = "Ajax error: " + xhr.status;
                container.innerHTML = serviceMessage + '<br>' + responseBody;
            }

            var ajaxInsertTarget = document.getElementById(args.insertResponseInto);

            if (args.action === 'append') {
                ajaxInsertTarget.appendChild(container);
            }
            else if (args.action === 'prepend') {
                ajaxInsertTarget.insertBefore(container, ajaxInsertTarget.firstChild);
            }
            else if (args.action === 'replace') {
                ajaxInsertTarget.innerHTML = container.innerHTML;
            }
        }
    };

    window.apAssets.ajaxSuite = ajaxSuite;

})();
