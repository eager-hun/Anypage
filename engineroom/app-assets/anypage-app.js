
(function() {
  "use strict";

  console.log('Hi from anypage-app.js');

  var htmlGenerator = function(event) {
    var event = event || window.event;
    var target = event.target || event.srcElement;
    if (target.id == 'html-generator-button') {
      console.log('Gen.');
    }
  };

  document.body.addEventListener('click', htmlGenerator, false);
})();

