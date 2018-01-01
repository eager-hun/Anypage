<?php

return [

    /**
     * Describing the app's environment and locations.
     *
     * key 'web-working-dir':
     *   The subdirectory path in which the application's index.php sits inside
     *   the server document root.
     *   Provide an empty string if the index.php is located in the public root.
     *   No leading or trailing slashes.
     *
     * key 'path-fragment-to-app-assets':
     *   Used internally by the php script and also for creating URLs.
     *   Don't include "app-assets" itself.
     *   No leading or trailing slashes.
     *
     * key 'path-fragment-to-themes':
     *   Path leading to the "built" dir (containing .css & .js for the
     *   frontend). Used internally by the php script and also for creating
     *   URLs. Don't include "build" itself. No leading or trailing slashes.
     *
     * key 'theme-dir-name':
     *   The active theme's directory name.
     *
     * key 'path-fragment-to-html-export-dir':
     *   The subdirectory path leading to the the generated instances' directory.
     *   Provide the location relative to DIRECTOR_DIR.
     *   No leading or trailing slashes.
     *
     * key 'html-export-dir-name':
     *   The name of the directory into which static site snapshots are copied.
     *
     * key 'http-protocol':
     *   String used in creating URLs.
     *
     * key 'http-protocol-v':
     *   String used in creating URLs.
     */
    'env' => [
        'web-working-dir'                   => 'anypage',
        'path-fragment-to-app-assets'       => 'public',
        'path-fragment-to-themes'           => 'public/themes',
        'theme-dir-name'                    => 'theme-seed',
        'path-fragment-to-html-export-dir'  => 'public',
        'html-export-dir-name'              => 'generated',
        'http-protocol'                     => 'http',
        'http-protocol-v'                   => '1.1',
    ],

    'app' => [
        /**
         * Templating.
         *
         * key 'enable-twig':
         *   If you disable twig, your only 'default-rendering-engine' option
         *   can be 'php'.
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
            // Boolean, any truthy or falsy values will suffice.
            'is-enabled' => 1,
        ],
    ],

    'frontend-assets' => [
        /**
         * Where window.apSettings and window.apAssets js objects get printed.
         *
         * Valid values are 'head' or 'body'.
         */
        'add-js-settings-object-to' => 'body',

        /**
         * String to use in the '?v=' URL param for .css and .js files.
         */
        'cache-bust-str' => '20180101-1',

        /**
         * Stylesheets to be included with the document.
         *
         * The array keys should contain either 'theme', 'app', or 'external'
         * substrings! (That hints the app to produce corresponding URLs.)
         *
         * Use 'external' for assets whose URL should be left alone, and
         * inserted into the documents as is. Ideal for such things as e.g.
         * `https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js`
         *
         * Use 'theme' for such files that are inside the theme directory.
         *
         * Use 'app' for the assets provided by the app itself (not the theme);
         * such files are likely to be sitting in `public/app-assets`.
         *
         * The numbers in the array keys provide just uniqueness (to prevent
         * overwriting). The order of the asset inclusion on the page is the
         * order of the declaration here (I assume, as long as the array key is
         * a string).
         *
         * Values:
         *   Path fragment from the app-assets' and the active theme's default
         *   locations, including the filename.
         */
        'stylesheets' => [
            'app1'   => 'anypage-app.css',
            'theme1' => 'built/gulp-out/css/bundle-main.css',
            'theme2' => 'built/gulp-out/css/bundle-styleguide-infra.css',
            'theme3' => 'static-assets/css/static.css',
        ],

        /**
         * Javascript files to be included with the document.
         *
         * Group the file locations into 'head' and 'body' arrays.
         *
         * The file-describing array keys should contain either 'theme', 'app',
         * or 'external' substrings. (That hints the app to produce
         * corresponding URLs.)
         *
         * Use 'external' for assets whose URL should be left alone, and
         * inserted into the documents as is. Ideal for such things as e.g.
         * `https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js`
         *
         * Use 'theme' for such files that are inside the theme directory.
         *
         * Use 'app' for the assets provided by the app itself (not the theme);
         * such files are likely to be sitting in `public/app-assets`.
         *
         * The numbers in the array keys provide just uniqueness (to prevent
         * overwriting). The order of the asset inclusion on the page is the
         * order of the declaration here (I assume, as long as the array key is
         * a string).
         *
         * key 'file':
         *   Path fragment from the app-assets' and the active theme's default
         *   locations, including the filename.
         *
         * key 'use_as':
         *   value 'reference':
         *      The script tag's `src` attribute will contain an URL pointing
         *      to the file.
         *   value 'inline':
         *      This does not work yet (un-implemented). Would include the
         *      script in the document.
         */
        'scripts' => [
            'head' => [],
            'body' => [
                'app1' => [
                    'file'   => 'anypage-app-library.js',
                    'use_as' => 'reference',
                ],
                'app2' => [
                    'file'   => 'anypage-app-site-generator.js',
                    'use_as' => 'reference',
                ],
                'app3' => [
                    'file'   => 'anypage-app-interactions.js',
                    'use_as' => 'reference',
                ],
                /*'theme1' => [
                    'file'   => 'built/gulp-out/js/libs.js',
                    'use_as' => 'reference',
                ],*/
                'theme2' => [
                    'file'   => 'built/gulp-out/js/custom.min.js',
                    'use_as' => 'reference',
                ],
                'theme3' => [
                    'file'   => 'built/gulp-out/js/styleguide.min.js',
                    'use_as' => 'reference',
                ],
                'theme4' => [
                    'file'   => 'built/webpack-out/index.built.js',
                    'use_as' => 'reference',
                ],
            ],
        ],

        /**
         * NOTE: for SVG sprites, the assumed location is in the "theme".
         */
        'svgSprites' => [
            'built/gulp-out/graphics/svg-sprite/svg-sprite.symbol-mode.svg',
        ],
    ],

    /**
     * Development: livereload.
     *
     * Boolean, any truthy or falsy values will suffice.
     */
    'enable-livereload' => 0,
];
