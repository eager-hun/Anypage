(function () {
    "use strict";

    // #########################################################################
    // Toggling the app-menu.

    var appMenuActive = false;
    var appMenu = document.getElementById("app-menu");
    var toggleButton = document.getElementById("app-menu-toggle");
    var screen = document.getElementById("app-menu-screen");

    var appMenuToggle = function (event) {
        if (!appMenuActive) {
            appMenu.classList.add("is-active");
            toggleButton.classList.add("is-active");
            screen.classList.add("is-active");

            appMenuActive = true;
        }
        else {
            appMenu.classList.remove("is-active");
            toggleButton.classList.remove("is-active");
            screen.classList.remove("is-active");

            appMenuActive = false;
        }
    };

    if (toggleButton) {
        toggleButton.addEventListener('click', appMenuToggle, false);
    }

    if (screen) {
        screen.addEventListener('click', appMenuToggle, false);
    }
})();
