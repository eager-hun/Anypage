<?php

$tools->usePageTemplate('page/page--fullwidth');

$page_levels = [];

// ----------------------------------------------------------------------------
// Page title.

$page_title = $tools->render('page/page-title', [
    'page_title_text' => 'Example page with some content'
]);

$hero = $tools->render('text-patterns/hero/hero', [
    'hero_content' => $tools->addFillerText('s', 1)
        . ' ' . $tools->addFillerText('xs', 1)
]);

$page_levels[] = [
    'page_level_content' => $page_title . $hero,
];


// ----------------------------------------------------------------------------
// Content.

$page_levels[] = [
    'page_level_content' => $tools->addFillerText('m', 1, true)
];

$image_display = $tools->render('images-display/images-display', [
    'images' => [
        [
            'src' => $tools->pathToPayloadFiles() . '/demo/img1.png',
            'desc_html' => $tools->addFillerText('xs', 2),
        ],
    ],
]);

$page_levels[] = [
    'page_level_content' => $image_display,
];

$page_levels[] = [
    'page_level_content' => $tools->addFillerText('l', 1, true)
        . $tools->addFillerText('l', 2, true)
];

// ----------------------------------------------------------------------------
// Output.

foreach ($page_levels as $manifest) {
    echo $tools->render('layouts/page-level/page-level', $manifest);
}

