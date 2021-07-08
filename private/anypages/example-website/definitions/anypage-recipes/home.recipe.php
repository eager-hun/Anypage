<?php

$tools->updateTemplateAssignment('page', 'page/page--fullwidth');
$tools->addBodyClass('page--home');

$page_levels = [];

// ----------------------------------------------------------------------------
// Page title.

$page_title = $tools->render('page/page-title', [
    'page_title_text' => 'Welcome',
    'extra_classes' => 'squeeze',
]);

$page_levels[] = [
    'page_level_content' => $page_title,
];


// FIXME or not?
$img_path_prefix = empty(BUILDING_STATIC_PAGE) ? '/' : '';

// This should be a feature.
$page_1_href = empty(BUILDING_STATIC_PAGE) ? 'pages/1' : 'page-1.html';
$page_2_href = empty(BUILDING_STATIC_PAGE) ? 'pages/2' : 'page-2.html';

$homepage_content = $tools->render('homepage/homepage-content', [
    'wrapper_extra_classes' => 'grid',
    'tiles' => [
        [
            'wrapper_extra_classes' => 'grid-item grid-item--half',
            'label' => 'Some things',
            'href' => $page_1_href,
            'bg' => $img_path_prefix . 'files-payload/demo/img1.png',
        ],
        [
            'wrapper_extra_classes' => 'grid-item grid-item--half',
            'label' => 'Other things',
            'href' => $page_2_href,
            'bg' => $img_path_prefix . 'files-payload/demo/img2.png',
        ],
    ],
]);

$page_levels[] = [
    'page_level_content' => $homepage_content,
];


// ----------------------------------------------------------------------------
// Output.

foreach ($page_levels as $manifest) {
    echo $tools->render('layouts/page-level/page-level', $manifest);
}

