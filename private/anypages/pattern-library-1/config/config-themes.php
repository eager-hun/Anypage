<?php

return [
    // Config for theme "frontend-seed":
    'frontend-seed' => [
        /**
         * Where window.apSettings and window.apAssets js objects get printed.
         *
         * Valid values are 'head' or 'body'.
         */
        'add-js-settings-object-to' => 'body',

        /**
         * String to use in the '?v=' URL param for .css and .js files.
         */
        'cache-bust-str' => '20200413-1',

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
         * key 'use-as':
         *   value 'reference':
         *      A <link> tag will be used.
         *   value 'inline':
         *      Uses a <style> tag to include styles in the document.
         *
         * key 'omit':
         *   value 'always'
         *     The entry will be ignored. It means you don't have to delete or
         *     comment out the entry, if you temporarily don't need it.
         *   value 'in-static-site'
         *      The entry will be used only in the dynamically built pages,
         *      the generated static site will not use the resource.
         */
        'stylesheets' => [
            [
                'source'    => 'app',
                'file'      => 'anypage-app.css',
                'use-as'    => 'reference',
            ],
            [
                'source'    => 'theme',
                'file'      => 'assets-built/gulp-out/css/bundle-main.css',
                'use-as'    => 'reference',
            ],
            [
                'source'    => 'theme',
                'file'      => 'assets-built/gulp-out/css/bundle-styleguide-infra.css',
                'use-as'    => 'reference',
            ],
            [
                'source'    => 'theme',
                'file'      => 'assets-static/css/static.css',
                'use-as'    => 'reference',
                'omit'      => 'always',
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
         *      the file will be looked for in the `assets-app` dir.
         *   value 'theme':
         *      the file will be looked for in the theme.
         *
         * key 'file':
         *   Path fragment from the designated source's default location,
         *   including the filename.
         *
         * key 'use-as':
         *   value 'reference':
         *      The script tag's `src` attribute will contain an URL pointing
         *      to the file.
         *   value 'inline':
         *      Includes the script in the document in a <script> tag.
         *
         * key 'omit':
         *   value 'always'
         *     The entry will be ignored. It means you don't have to delete or
         *     comment out the entry, if you temporarily don't need it.
         *   value 'in-static-site'
         *      The entry will be used only in the dynamically built pages,
         *      the generated static site will not use the resource.
         */
        'scripts' => [
            'head' => [
                [
                    'source'    => 'app',
                    'file'      => 'js-detect.js',
                    'use-as'    => 'inline',
                ],
                [
                    'source'    => 'theme',
                    'file'      => 'assets-static/js/feature-detects.js',
                    'use-as'    => 'reference',
                ],
            ],
            'body' => [
                [
                    'source'    => 'app',
                    'file'      => 'anypage-app-library.js',
                    'use-as'    => 'reference',
                ],
                [
                    'source'    => 'app',
                    'file'      => 'anypage-app-interactions.js',
                    'use-as'    => 'reference',
                ],
                [
                    'source'    => 'app',
                    'file'      => 'anypage-app-site-generator.js',
                    'use-as'    => 'reference',
                    'omit'      => 'in-static-site',
                ],
                [
                    'source'    => 'theme',
                    'file'      => 'assets-built/gulp-out/js/libs.js',
                    'use-as'    => 'reference',
                    'omit'      => 'always',
                ],
                [
                    'source'    => 'theme',
                    'file'      => 'assets-built/gulp-out/js/custom.js',
                    'use-as'    => 'reference',
                ],
                [
                    'source'    => 'theme',
                    'file'      => 'assets-built/gulp-out/js/styleguide.js',
                    'use-as'    => 'reference',
                ],
                [
                    'source'    => 'theme',
                    'file'      => 'assets-built/webpack-out/index.built.js',
                    'use-as'    => 'reference',
                ],
            ],
        ],

        /**
         * NOTE: for SVG sprites, the assumed source is in the "theme".
         */
        'svgSprites' => [
            'assets-built/gulp-out/graphics/svg-sprite/svg-sprite.symbol-mode.svg',
        ],
    ],
];


