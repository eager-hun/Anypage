<?php

return [
    'plain-theme' => [
        'dev-mode' => 0,
        'add-js-settings-object-to' => 'body',
        'cache-bust-str' => '20210707-1',
        'template-defaults' => [
            'page'        => 'page/page--default',
            'page-header' => 'page/page-header/page-header',
            'page-footer' => 'page/page-footer/page-footer',
        ],
        'stylesheets' => [
            [
                'source'    => 'app',
                'file'      => 'anypage-app.css',
                'use-as'    => 'reference',
            ],
            [
                'source'    => 'theme',
                'file'      => 'assets-built/styles/libs.css',
                'is-bundle' => true,
                'use-as'    => 'reference',
                'omit'      => 'never',
            ],
            [
                'source'    => 'theme',
                'file'      => 'assets-built/styles/default.css',
                'is-bundle' => true,
                'use-as'    => 'reference',
            ],
        ],
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
                    'file'      => 'assets-built/scripts/libs.js',
                    'is-bundle' => true,
                    'use-as'    => 'reference',
                    'omit'      => 'never',
                ],
                [
                    'source'    => 'theme',
                    'file'      => 'assets-built/scripts/default.js',
                    'is-bundle' => true,
                    'use-as'    => 'reference',
                ],
            ],
        ],
        'svgSprites' => [],
    ],
];

