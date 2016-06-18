
(function() {
  "use strict";

  console.log('Hi from anypage-app.js');

  var ajaxSuite = {};

  ajaxSuite.ajaxRequest = function(args) {
    var address = args.url;
    var xhr = new XMLHttpRequest();
    if (xhr != undefined) {
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
    if (xhr.readyState == 4) {
      // console.log('ajaxreceive');
      var container = document.createElement('div');
      container.className = 'ajax-response';
      if (xhr.status == 200) {
        container.innerHTML = xhr.responseText;
      } else {
        container.innerHTML = "Ajax error:\n\n" + xhr.status
      }

      var ajaxInsertTarget = document.getElementById(args.insertResponseInto);

      if (args.action == 'append') {
        ajaxInsertTarget.appendChild(container);
      }
      else if (args.action == 'prepend') {
        ajaxInsertTarget.insertBefore(container, ajaxInsertTarget.firstChild);
      }
      else if (args.action == 'replace') {
        ajaxInsertTarget.innerHTML = container.innerHTML;
      }
    }
  };

  window.apAssets.ajaxSuite = ajaxSuite;

  var callbackRouter = function(event) {
    var event = event || window.event;
    var target = event.target || event.srcElement;

    if (target.id == 'html-generator-button') {
      generatePages(window.apSettings.pageUrlList);
    }
  };

  var generatePages = function (urlList) {
    var now = new Date();
    var dirname = [
      now.getDate(),
      '-',
      now.getMonth() + 1,
      '-',
      now.getFullYear(),
      '_',
      now.getHours(),
      '-',
      now.getMinutes(),
      '-',
      now.getSeconds()
    ].join('');
    var urlParams = '?gen=true&dir=' + dirname;

    var timeOut = 100; // Initial timeOut.
    var timeGap = 500; // Further time gap between requests.

    for (var key in urlList) {
      if (urlList.hasOwnProperty(key)) {
        var preppedUrl = urlList[key] + urlParams;
        generatePagesCallback(preppedUrl, timeOut);
        timeOut = timeOut + timeGap;
      }
    }
  }

  var generatePagesCallback = function(preppedUrl, timeOut) {
    window.setTimeout(function() {
      window.apAssets.ajaxSuite.ajaxRequest({
        "url":                preppedUrl,
        "insertResponseInto": 'app-ajax-messages',
        "action":             'append',
      });
    }, timeOut);
  }

  document.body.addEventListener('click', callbackRouter, false);
})();

