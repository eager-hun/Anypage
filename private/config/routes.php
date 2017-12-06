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
    'demo/texts/headings' => [
        'resource-id'       => 'styles-demo-texts-headings',
        'resource-type'     => 'anypage',
        'html-filename'     => 'styles-demo-texts-headings',
        'menu'              => [
            'starts-topic'  => 'Texts',
            'link-text' => 'Headings',
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
    'demo/texts/misc' => [
        'resource-id'       => 'styles-demo-texts-misc',
        'resource-type'     => 'anypage',
        'html-filename'     => 'styles-demo-texts-misc',
        'menu'              => [
            'link-text' => 'Misc texts',
        ],
        'has-own-layout'    => true,
    ],
    'demo/grid' => [
        'resource-id'       => 'styles-demo-grid',
        'resource-type'     => 'anypage',
        'html-filename'     => 'styles-demo-grid',
        'menu'              => [
            'starts-topic'  => 'Grid and layouts',
            'link-text' => 'Cheap grid',
        ],
        'has-own-layout'    => true,
    ],
    'demo/layouts' => [
        'resource-id'       => 'layouts_demo',
        'resource-type'     => 'anypage',
        'html-filename'     => 'layouts-demo',
        'menu'              => [
            'link-text' => 'Layouts demo',
        ],
    ],
    'components/custom-components' => [
        'resource-id'       => 'custom_components',
        'resource-type'     => 'anypage',
        'html-filename'     => 'custom-components',
        'menu'              => [
            'starts-topic'  => 'Patterns and pages',
            'link-text' => 'Custom components',
        ],
    ],
    'demo/sample-page-1' => [
        'resource-id'       => 'sample_page_1',
        'resource-type'     => 'anypage',
        'html-filename'     => 'sample-page-1',
        'menu'              => [
            'link-text' => 'Sample page 1',
        ],
    ],
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
    'meta/goals-and-priorities' => [
        'resource-id'       => 'goals-and-priorities',
        'resource-type'     => 'metapage',
        'menu'              => [
            'starts-topic'  => 'Meta pages',
            'link-text' => 'Project goals and priorities',
        ],
    ],
];
