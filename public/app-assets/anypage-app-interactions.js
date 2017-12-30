
(function() {
    "use strict";


    // #########################################################################
    // Toggling the app-menu.

    var appMenuToggle = function(event) {

        console.log(event);

        var appMenu = document.getElementById("app-menu");
        appMenu.classList.toggle("slide-in");
    };

    var toggleButton = document.getElementById("app-menu-toggle");

    if (toggleButton) {
        toggleButton.addEventListener('click', appMenuToggle, false);
    }

})();
