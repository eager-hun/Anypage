<?php

$tools->usePageTemplate('page/page--fullwidth');

$page_levels = [];

// ----------------------------------------------------------------------------
// Page title.

$page_title = $tools->render('page/page-title', [
    'page_title_text' => 'Example page with images',
]);

$hero = $tools->render('text-patterns/hero/hero', [
    'hero_content' => $tools->addFillerText('s', 1)
        . ' ' . $tools->addFillerText('s', 2),
]);

$page_levels[] = [
    'page_level_content' => $tools->render('layouts/squeeze/squeeze', [
        'squeeze_content' => $page_title . $hero,
    ]),
];


// ----------------------------------------------------------------------------
// Content.

$image_display = $tools->render('images-display/images-display', [
    'title_html' => 'Images, <span class="color-text-weak">that are nice</span>',
    'description_html' => $tools->addFillerText('m', 1),
    'squeeze_texts' => true,
    'images' => [
        [
            'src' => $tools->pathToPayloadFiles() . '/demo/img2.png',
            'desc_html' => $tools->addFillerText('xs', 3),
        ],
        [
            'src' => $tools->pathToPayloadFiles() . '/demo/img3.png',
            // Let's try one without caption.
            //'desc_html' => $tools->addFillerText('xs', 4),
        ],
        [
            'src' => $tools->pathToPayloadFiles() . '/demo/img4.png',
            'desc_html' => $tools->addFillerText('s', 4),
        ],
    ],
]);

$page_levels[] = [
    'page_level_content' => $image_display,
];


$image_display = $tools->render('images-display/images-display', [
    'title_html' => 'More photos <span class="color-text-weak">of the eyepleasing kind</span>',
    'description_html' => $tools->addFillerText('s', 2),
    'squeeze_texts' => true,
    'images' => [
        [
            'src' => $tools->pathToPayloadFiles() . '/demo/img5.png',
            'desc_html' => $tools->addFillerText('m', 1),
        ],
        [
            'src' => $tools->pathToPayloadFiles() . '/demo/img6.png',
            'desc_html' => $tools->addFillerText('m', 2),
        ],
    ],
]);

$page_levels[] = [
    'page_level_content' => $image_display,
];


// ----------------------------------------------------------------------------
// Output.

foreach ($page_levels as $manifest) {
    echo $tools->render('layouts/page-level/page-level', $manifest);
}
