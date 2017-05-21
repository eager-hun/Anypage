<?php

return [
    'generator' => [
        'resource-id'       => 'generator',
        'resource-type'     => 'system_page',
        'menu-link-text'    => 'Static site generator',
    ],
    'generated' => [
        'resource-id'       => 'list_generated',
        'resource-type'     => 'system_page',
        'menu-link-text'    => 'List static sites',
    ],
    '' => [
        'resource-id'       => 'home',
        'resource-type'     => 'anypage',
        'html-filename'     => 'index',
        'menu-link-text'    => 'Home',
        'has-own-layout'    => true,
    ],
    'demo/typography' => [
        'resource-id'       => 'typography_demo',
        'resource-type'     => 'anypage',
        'html-filename'     => 'typography-demo',
        'menu-link-text'    => 'Typography demo',
        'has-own-layout'    => true,
    ],
    'demo/grid' => [
        'resource-id'       => 'grid_demo',
        'resource-type'     => 'anypage',
        'html-filename'     => 'grid-demo',
        'menu-link-text'    => 'Grid demo',
        'has-own-layout'    => true,
    ],
    'demo/layouts' => [
        'resource-id'       => 'layouts_demo',
        'resource-type'     => 'anypage',
        'html-filename'     => 'layouts-demo',
        'menu-link-text'    => 'Layouts demo',
        'has-own-layout'    => true,
    ],
    'components/custom-components' => [
        'resource-id'       => 'custom_components',
        'resource-type'     => 'anypage',
        'html-filename'     => 'custom-components',
        'menu-link-text'    => 'Custom components',
        'has-own-layout'    => true,
    ],
    'demo/sample-page-1' => [
        'resource-id'       => 'sample_page_1',
        'resource-type'     => 'anypage',
        'html-filename'     => 'sample-page-1',
        'menu-link-text'    => 'Sample page 1',
        'has-own-layout'    => true,
    ],
    'test/grid-test' => [
        'resource-id'       => 'grid_test',
        'resource-type'     => 'anypage',
        'html-filename'     => 'grid-test',
        'menu-link-text'    => 'Grid test',
        'has-own-layout'    => true,
    ],
];
