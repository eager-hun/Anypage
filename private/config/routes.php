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
    'demo/typography/texts' => [
        'resource-id'       => 'typography-demo-texts',
        'resource-type'     => 'anypage',
        'html-filename'     => 'typography-demo-texts',
        'menu'              => [
            'starts-topic'  => 'Typography',
            'link-text' => 'Texts',
        ],
        'has-own-layout'    => true,
    ],
    'demo/typography/lists' => [
        'resource-id'       => 'typography-demo-lists',
        'resource-type'     => 'anypage',
        'html-filename'     => 'typography-demo',
        'menu'              => [
            'link-text' => 'Lists',
        ],
        'has-own-layout'    => true,
    ],
    'demo/grid' => [
        'resource-id'       => 'grid_demo',
        'resource-type'     => 'anypage',
        'html-filename'     => 'grid-demo',
        'menu'              => [
            'starts-topic'  => 'Grid and layouts',
            'link-text' => 'Grid demo',
        ],
    ],
    'test/grid-test' => [
        'resource-id'       => 'grid_test',
        'resource-type'     => 'anypage',
        'html-filename'     => 'grid-test',
        'menu'              => [
            'link-text' => 'Grid test',
        ],
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
            'link-text' => 'List static sites',
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
