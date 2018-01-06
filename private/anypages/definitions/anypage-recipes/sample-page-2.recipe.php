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

$hero = '<div class="hero-block">'
    . $tools->addFillerText('s', 1, true)
    . '</div>';

$squeeze = $tools->render('layouts/squeeze', [
    'squeeze_content' => $hero . $tools->addFillerText('m', 2, true)
]);

$page_levels[] = [
    'wrapper_extra_classes' => '',
    'page_level_content' => $squeeze
];


// ----------------------------------------------------------------------------
// Another level.

$prefix = $tools->render('layouts/squeeze', [
    'wrapper_extra_classes' => 'stackable',
    'squeeze_content' => '<h2 class="page-level__title">A cluster of boxes</h2>'
]);

$boxes_manifest = [
    [
        'wrapper_extra_classes' => 'tile color-zone color-zone--brand',
        'box_title'             => 'Super box 1',
        'box_content'           => $tools->addFillerText('xs', 1, true)
    ],
    [
        'wrapper_extra_classes' => 'tile color-zone color-zone--accent-1',
        'box_title'             => 'Super box 2',
        'box_content'           => $tools->addFillerText('xs', 2, true)
    ],
    [
        'wrapper_extra_classes' => 'tile color-zone color-zone--accent-2',
        'box_title'             => 'Super box 3',
        'box_content'           => $tools->addFillerText('xs', 3, true)
    ],
];

$box_grid = $tools->render('layouts/flex-grid', [
    'wrapper_extra_classes' => 'flex-grid--preset-3-cols payload-as-tiles',
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

$suffix = $tools->render('layouts/squeeze', [
    'wrapper_extra_classes' => 'stackable',
    'squeeze_content' => $tools->render('patterns/lists/ul-icon-prefix', [
        'items' => [
            'What happens next, you will never belive'
        ]
    ])
]);

$page_levels[] = [
    'wrapper_extra_classes' => 'has-bg has-bg--blockfill',
    'page_level_content' => $prefix . $box_grid . $suffix
];

// ----------------------------------------------------------------------------
// Another level.

$level_title = '<h2 class="page-level__title">Some colourful content</h2>';

$squeeze = $tools->render('layouts/squeeze', [
    'squeeze_content' => $level_title . $tools->addFillerText('m', 1, true)
]);

$page_levels[] = [
    'wrapper_extra_classes' => 'has-bg color-zone color-zone--accent-2',
    'page_level_content' => $squeeze
];


// ----------------------------------------------------------------------------
// Output.

foreach ($page_levels as $manifest) {
    echo $tools->render('layouts/page-level', $manifest);
}
