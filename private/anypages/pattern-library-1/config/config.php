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
     *   (assets-app).
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
        'path-fragment-to-app-assets'       => 'assets-app',
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
        'nice-urls' => 1,

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

    /**
     * Development: livereload.
     *
     * Boolean, any truthy or falsy values will suffice.
     */
    'enable-livereload' => 1,
];

