<?php

return [

    /**
     * Describing the app's environment and locations.
     * key 'working_dir':
     *   The subdirectory path in which the application's index.php sits inside
     *   the server document root.
     *   Provide an empty string if the index.php is located in the public root.
     *   No leading or trailing slashes.
     *
     * key 'path_to_app_assets':
     *   Used internally by the php script and also for creating URLs.
     *   Don't include "app-assets" itself.
     *   No leading or trailing slashes.
     *
     * key 'path_to_theme':
     *   Path leading to the "build" dir (containing .css & .js for the
     *   frontend). Used internally by the php script and also for creating
     *   URLs. Don't include "build" itself. No leading or trailing slashes.
     *
     * key 'html_export_dir':
     *   Used both internally in php script and to create URLs. Provide the
     *   location relative to SCRIPT_ROOT.
     *   No leading or trailing slashes.
     *
     * key 'http_protocol':
     *   String used in creating URLs.
     */
    'env' => [
        'working-dir'       => 'anypage-develop',
        'theme-dir-name'    => 'theme-seed',
        'html-export-dir'   => 'styleguide',
        'http-protocol'     => 'http',
        'http-protocol-v'   => '1.1',
    ],

    'app' => [
        /**
         * Templating.
         *
         * key 'enable-twig'
         *   If you disable twig, your only rendering engine option can be
         *   'php'.
         * key 'default-rendering-engine':
         *   Valid values are 'php' or 'twig'.
         */
        'templating' => [
            'enable-twig'                   => true,
            'default-rendering-engine'      => 'twig',
            'php-template-file-extension'   => '.tpl.php',
            'twig-template-file-extension'  => '.html.twig',
            'twig-renderer-options'         => [
                'debug'            => true,
                'cache'            => false,
                'strict_variables' => true,
                'autoescape'       => true,
                'optimizations'    => -1,
            ]
        ],
        'app-menu' => [
            'is-enabled' => true,
        ],
    ],

    'frontend-assets' => [
        /**
         * Where window.apSettings and window.apAssets js objects should be
         * printed.
         *
         * Valid values are 'head' or 'body'.
         */
        'add-js-settings-object-to' => 'body',

        /**
         * String to use in the '?v=' URL param for .css and .js files.
         */
        'cache-bust-str' => '20170507-1',

        /**
         * Development: livereload.
         *
         * Boolean, any truthy or falsy values will suffice.
         */
        'enable-livereload' => 1,

        /**
         * TODO: update docblock!!!
         *
         * Stylesheets to be included with the document.
         *
         * The array keys should contain either 'theme', 'app', or 'external'
         * substrings.
         *
         * Use 'external' for assets whose url should be left alone, and inserted
         * into the documents as is. Ideal for such things as e.g.
         * "https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"
         *
         * Use 'theme' for such files that are inside the theme directory; these
         * strings will have the base_url and $this->env['path_to_theme'] prepended
         * to them automatically when needed.
         *
         * Use 'app' for such files are sitting in /engineroom/app-assets.
         *
         * The numbers in the array keys provide just uniqueness (to prevent
         * overwriting). The order of the asset inclusion on the page is the order
         * of the declaration here (I assume, as long as the array key is a string).
         */
        'stylesheets' => [
            'app1'   => 'anypage-app.css',
            'theme1' => 'build/css/bundle-main.css',
            'theme2' => 'build/css/bundle-styleguide-infra.css',
            'theme3' => 'static-assets/css/static.css',
        ],

        /**
         * TODO: update docblock!!!
         *
         * Javascript files to be included with the document.
         *
         * Group the file locations into 'head' and 'body' arrays.
         *
         * The file-describing array keys should contain either 'theme', 'app', or
         * 'external' substrings.
         *
         * Use 'external' for assets whose url should be left alone, and inserted
         * into the documents as is. Ideal for such things as e.g.
         * "https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"
         *
         * Use 'theme' for such files that are inside the theme directory; these
         * strings will have the base_url and $this->env['path_to_theme'] prepended
         * to them automatically when needed.
         *
         * Use 'app' for such files are sitting in /engineroom/app-assets.
         *
         * The numbers in the array keys provide just uniqueness (to prevent
         * overwriting). The order of the asset inclusion on the page is the order
         * of the declaration here (I assume, as long as the array key is a string).
         */
        'scripts' => [
            'head' => [],
            'body' => [
                'app1'   => 'anypage-app.js',
                'theme1' => 'build/js/libs.js',
                'theme2' => 'build/js/custom.min.js',
                'theme3' => 'build/js/styleguide.min.js',
            ],
        ],
    ],
];
