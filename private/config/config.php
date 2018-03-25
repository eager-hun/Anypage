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
     *   Include in it the very directory that files of interest are sitting in
     *   (app-assets).
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
        'web-working-dir'                   => '',
        'path-fragment-to-app-assets'       => 'app-assets',
        'path-fragment-to-themes'           => 'themes',
        'theme-dir-name'                    => 'frontend-seed',
        'html-export-dir-name'              => 'generated',
        'http-protocol'                     => 'http',
        'http-protocol-v'                   => '1.1',
    ],

    'app' => [
        /**
         * Nice URLs.
         *
         * Without:
         * 'hostname.local/index.php?path=foo/bar'
         *
         * With:
         * 'hostname.local/foo/bar'
         *
         * The nice URLs setting impacts the app only when served as dynamic,
         * interpreted php, and doesn't have any effect on the generated static
         * instances.
         *
         * Boolean, any truthy or falsy values will suffice.
         */
        'nice-urls' => 0,

        /**
         * Templating.
         *
         * key 'enable-twig':
         *   If you disable twig, your only 'default-rendering-engine' option
         *   can be 'php'.
         *
         * key 'default-rendering-engine':
         *   Valid values are 'php' or 'twig'.
         *
         * key 'twig-render-options => cache':
         *   Use `false` or e.g. `PRIVATE_RESOURCES . '/twig-cache'`.
         *
         * @see https://twig.symfony.com/doc/2.x/api.html
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
                'autoescape'       => 'name',
                'optimizations'    => -1,
            ]
        ],
        'app-menu' => [
            // Boolean, any truthy or falsy values will suffice.
            'is-enabled' => 1,
        ],
        'generator' => [
            'snapshot-directory-name-prefix' => 'anypage-v',
        ],
    ],

    'code' => [
        'html-attribute-values-handled-as-array' => [
            'data-foo-array' => [
                'separator' => ', ',
            ],
            'data-bar-array' => [
                'separator' => '; ',
            ],
        ]
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
        'cache-bust-str' => '20180315-1',

        /**
         * Stylesheets to be included with the document.
         *
         * key 'source':
         *   value 'external':
         *      for assets whose URL should be left alone, used as script src
         *      as is. Ideal for things from CDNs.
         *   value 'app':
         *      the file will be looked for in the `app-assets` dir.
         *   value 'theme':
         *      the file will be looked for in the theme.
         *
         * key 'file':
         *   Path fragment from the designated source's default location,
         *   including the filename.
         *
         * key 'use_as':
         *   value 'reference':
         *      A <link> tag will be used.
         *   value 'inline':
         *      Uses a <style> tag to include styles in the document.
         *
         * key 'ignore':
         *   Boolean. The entry will be ignored. It means you don't have to
         *   delete or comment out the entry, if you temporarily don't need it.
         */
        'stylesheets' => [
            [
                'source'    => 'app',
                'file'      => 'anypage-app.css',
                'use_as'    => 'reference',
            ],
            [
                'source'    => 'theme',
                'file'      => 'built/gulp-out/css/bundle-main.css',
                'use_as'    => 'reference',
            ],
            [
                'source'    => 'theme',
                'file'      => 'built/gulp-out/css/bundle-styleguide-infra.css',
                'use_as'    => 'reference',
            ],
            [
                'source'    => 'theme',
                'file'      => 'static-assets/css/static.css',
                'use_as'    => 'reference',
                'ignore'    => 1,
            ],
        ],

        /**
         * Javascript files to be used with the document.
         *
         * Group the file locations into 'head' and 'body' arrays.
         *
         * key 'source':
         *   value 'external':
         *      for assets whose URL should be left alone, used as script src
         *      as is. Ideal for things from CDNs.
         *   value 'app':
         *      the file will be looked for in the `app-assets` dir.
         *   value 'theme':
         *      the file will be looked for in the theme.
         *
         * key 'file':
         *   Path fragment from the designated source's default location,
         *   including the filename.
         *
         * key 'use_as':
         *   value 'reference':
         *      The script tag's `src` attribute will contain an URL pointing
         *      to the file.
         *   value 'inline':
         *      Includes the script in the document in a <script> tag.
         *
         * key 'ignore':
         *   Boolean. The entry will be ignored. It means you don't have to
         *   delete or comment out the entry, if you temporarily don't need it.
         */
        'scripts' => [
            'head' => [],
            'body' => [
                [
                    'source'    => 'app',
                    'file'      => 'anypage-app-library.js',
                    'use_as'    => 'reference',
                ],
                [
                    'source'    => 'app',
                    'file'      => 'anypage-app-site-generator.js',
                    'use_as'    => 'reference',
                ],
                [
                    'source'    => 'app',
                    'file'      => 'anypage-app-interactions.js',
                    'use_as'    => 'reference',
                ],
                [
                    'source'    => 'theme',
                    'file'      => 'built/gulp-out/js/libs.js',
                    'use_as'    => 'reference',
                    'ignore'    => 1,
                ],
                [
                    'source'    => 'theme',
                    'file'      => 'built/gulp-out/js/custom.js',
                    'use_as'    => 'reference',
                ],
                [
                    'source'    => 'theme',
                    'file'      => 'built/gulp-out/js/styleguide.js',
                    'use_as'    => 'reference',
                ],
                [
                    'source'    => 'theme',
                    'file'      => 'built/webpack-out/index.built.js',
                    'use_as'    => 'reference',
                ],
            ],
        ],

        /**
         * NOTE: for SVG sprites, the assumed source is in the "theme".
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
