<?php

$tools->updateTemplateAssignment('page', 'page/page--fullwidth');

$page_levels = [];

// ----------------------------------------------------------------------------
// Page title.

$page_title = $tools->render('page/page-title', [
    'page_title_text' => 'Example page with some content',
    'extra_classes' => 'squeeze',
]);

$hero = $tools->render('text-patterns/hero/hero', [
    'hero_content' => $tools->addFillerText('s', 1)
        . ' ' . $tools->addFillerText('xs', 1),
    'wrapper_extra_classes' => 'squeeze',
]);

$page_levels[] = [
    'page_level_content' => $page_title . $hero,
];


// ----------------------------------------------------------------------------
// Content.

$page_levels[] = [
    'page_level_content' => $tools->render('layouts/squeeze/squeeze', [
        'squeeze_content' => $tools->addFillerText('m', 1, true),
    ]),
];

$image_display = $tools->render('images-display/images-display', [
    'squeeze_texts' => true,
    'images' => [
        [
            'src' => $tools->pathToPayloadFiles() . '/demo/img1.png',
            'desc_html' => $tools->addFillerText('m', 2),
        ],
    ],
]);

$page_levels[] = [
    'page_level_content' => $image_display,
];

$page_levels[] = [
    'page_level_content' => $tools->render('layouts/squeeze/squeeze', [
        'squeeze_content' => $tools->addFillerText('l', 1, true)
            . $tools->addFillerText('l', 2, true)
    ]),
];

// ----------------------------------------------------------------------------
// Output.

foreach ($page_levels as $manifest) {
    echo $tools->render('layouts/page-level/page-level', $manifest);
}

