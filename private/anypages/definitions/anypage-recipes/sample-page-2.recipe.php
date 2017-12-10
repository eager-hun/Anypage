<?php

$page_levels = [];


// ----------------------------------------------------------------------------
// Page title.

$page_title = $tools->render('page-title', [
    'page_title_text' => 'Sample page numero due'
]);

$squeeze = $tools->render('layouts/squeeze', [
    'squeeze_content' => $page_title
]);

$page_levels[] = [
    'page_level_content' => $squeeze
];


// ----------------------------------------------------------------------------
// Another level.

$squeeze = $tools->render('layouts/squeeze', [
    'squeeze_content' => $tools->addFillerText('m', 1, true)
]);

$page_levels[] = [
    'wrapper_extra_classes' => '',
    'page_level_content' => $squeeze
];


// ----------------------------------------------------------------------------
// Another level.

$level_title = $tools->render('layouts/squeeze', [
    'squeeze_content' => '<h2 class="page-level__title">A cluster of boxes</h2>'
]);

$boxes_manifest = [
    [
        'wrapper_extra_classes' => 'fill-flex color-zone color-zone--brand',
        'box_title'             => 'Super box 1',
        'box_content'           => $tools->addFillerText('xs', 1, true)
    ],
    [
        'wrapper_extra_classes' => 'fill-flex color-zone color-zone--accent-1',
        'box_title'             => 'Super box 2',
        'box_content'           => $tools->addFillerText('xs', 2, true)
    ],
    [
        'wrapper_extra_classes' => 'fill-flex color-zone color-zone--accent-2',
        'box_title'             => 'Super box 3',
        'box_content'           => $tools->addFillerText('xs', 3, true)
    ],
];

$box_grid = $tools->render('layouts/preset-flex-grid', [
    'wrapper_extra_classes' => 'cheap-grid--preset-3-cols flexboxify-items',
    'items_extra_classes' => 'collectively-added-class',
    'items' => [
        [
            'extra_classes' => 'individually-added-class',
            'item_content' => $tools->render('patterns/box', $boxes_manifest[0]),
        ],
        [
            'item_content' => $tools->render('patterns/box', $boxes_manifest[1]),
        ],
        [
            'item_content' => $tools->render('patterns/box', $boxes_manifest[2]),
        ],
    ],
]);

$page_levels[] = [
    'wrapper_extra_classes' => 'has-bg has-bg--blockfill',
    'page_level_content' => $level_title . $box_grid
];


// ----------------------------------------------------------------------------
// Output.

foreach ($page_levels as $manifest) {
    echo $tools->render('layouts/page-level', $manifest);
}
