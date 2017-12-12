<?php

return [
    '' => [
        'resource-id'       => 'home',
        'resource-type'     => 'anypage',
        'html-filename'     => 'index',
        'menu'              => [
            'link-text' => 'Home',
        ],
    ],

    // -------------------------------------------------------------------------
    // Demos: global styles.

    'demo/texts/headings' => [
        'resource-id'       => 'styles-demo-texts-headings',
        'resource-type'     => 'anypage',
        'html-filename'     => 'styles-demo-texts-headings',
        'menu'              => [
            'starts-topic'  => 'Global styles',
            'link-text'     => 'Headings',
        ],
        'has-own-layout'    => true,
    ],
    'demo/texts/essentials' => [
        'resource-id'       => 'styles-demo-texts-essentials',
        'resource-type'     => 'anypage',
        'html-filename'     => 'styles-demo-texts-essentials',
        'menu'              => [
            'link-text' => 'Essential texts',
        ],
        'has-own-layout'    => true,
    ],
    'demo/texts/lists' => [
        'resource-id'       => 'styles-demo-lists',
        'resource-type'     => 'anypage',
        'html-filename'     => 'styles-demo-lists',
        'menu'              => [
            'link-text' => 'Lists',
        ],
        'has-own-layout'    => true,
    ],
    'demo/forms' => [
        'resource-id'       => 'styles-demo-forms',
        'resource-type'     => 'anypage',
        'html-filename'     => 'styles-demo-forms',
        'menu'              => [
            'link-text' => 'Forms',
        ],
    ],
    'demo/color-zones' => [
        'resource-id'       => 'styles-demo-color-zones',
        'resource-type'     => 'anypage',
        'html-filename'     => 'styles-demo-color-zones',
        'menu'              => [
            'link-text' => 'Color zones',
        ],
        'has-own-layout'    => true,
    ],
    'demo/misc-global' => [
        'resource-id'       => 'styles-demo-misc-global',
        'resource-type'     => 'anypage',
        'html-filename'     => 'styles-demo-misc-global',
        'menu'              => [
            'link-text' => 'Misc.',
        ],
    ],

    // -------------------------------------------------------------------------
    // Demos: grids and layouts.

    'demo/grid' => [
        'resource-id'       => 'styles-demo-grid',
        'resource-type'     => 'anypage',
        'html-filename'     => 'styles-demo-grid',
        'menu'              => [
            'starts-topic'  => 'Grids and layouts',
            'link-text'     => 'Cheap flex grid',
        ],
        'has-own-layout'    => true,
    ],
    'demo/layouts/layout-1-sidebar' => [
        'resource-id'       => 'styles-demo-layout-1-sidebar',
        'resource-type'     => 'anypage',
        'html-filename'     => 'styles-demo-layout-1-sidebar',
        'menu'              => [
            'link-text' => 'Layout 1 sidebar',
        ],
        'has-own-layout'    => true,
    ],

    // -------------------------------------------------------------------------
    // Demos: Custom UI Patterns.

    'demo/custom-ui-patterns/titles' => [
        'resource-id'       => 'patterns-titles',
        'resource-type'     => 'anypage',
        'html-filename'     => 'patterns-titles',
        'menu'              => [
            'starts-topic'  => 'Custom UI patterns',
            'link-text'     => 'Titles',
        ],
    ],
    'demo/custom-ui-patterns/lists' => [
        'resource-id'       => 'patterns-lists',
        'resource-type'     => 'anypage',
        'html-filename'     => 'patterns-lists',
        'menu'              => [
            'link-text'     => 'Lists',
        ],
        'has-own-layout'    => true,
    ],
    'demo/custom-ui-patterns/highlights-and-notifications' => [
        'resource-id'       => 'patterns-highlights',
        'resource-type'     => 'anypage',
        'html-filename'     => 'patterns-highlights',
        'menu'              => [
            'link-text'     => 'Highlights',
        ],
    ],
    'demo/custom-ui-patterns/hero-mosaic' => [
        'resource-id'       => 'patterns-hero-mosaic',
        'resource-type'     => 'anypage',
        'html-filename'     => 'patterns-hero-mosaic',
        'menu'              => [
            'link-text'     => 'Hero mosaic',
        ],
    ],

    // -------------------------------------------------------------------------
    // Demos: Pages.

    'demo/sample-page-1' => [
        'resource-id'       => 'sample-page-1',
        'resource-type'     => 'anypage',
        'html-filename'     => 'sample-page-1',
        'menu'              => [
            'starts-topic'  => 'Pages',
            'link-text' => 'Sample page 1',
        ],
        'has-own-layout'    => true,
    ],
    'demo/sample-page-2' => [
        'resource-id'       => 'sample-page-2',
        'resource-type'     => 'anypage',
        'html-filename'     => 'sample-page-2',
        'menu'              => [
            'link-text' => 'Sample page 2',
        ],
        'has-own-layout'    => true,
    ],

    // -------------------------------------------------------------------------
    // Static sites.

    'generator' => [
        'resource-id'       => 'generator',
        'resource-type'     => 'system_page',
        'menu'              => [
            'starts-topic'  => 'Generator',
            'link-text'     => 'Static site generator',
        ],
    ],
    'generated' => [
        'resource-id'       => 'list_generated',
        'resource-type'     => 'system_page',
        'menu'              => [
            'link-text' => 'List static snapshots',
        ],
    ],

    // -------------------------------------------------------------------------
    // Meta.

    'meta/goals-and-priorities' => [
        'resource-id'       => 'goals-and-priorities',
        'resource-type'     => 'metapage',
        'menu'              => [
            'starts-topic'  => 'Meta pages',
            'link-text'     => 'Project goals and priorities',
        ],
    ],
];
