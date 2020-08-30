<?php

$tools->usePageTemplate('page/page--fullwidth');
$tools->addBodyClass('page--home');


$page_levels = [];

// ----------------------------------------------------------------------------
// Page title.

$page_title = $tools->render('page/page-title', [
    'page_title_text' => 'Welcome'
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
            'bg' => $img_path_prefix . 'files-payload/images/unsplash-george-hiles.jpg',
        ],
        [
            'wrapper_extra_classes' => 'grid-item grid-item--half',
            'label' => 'Other things',
            'href' => $page_2_href,
            'bg' => $img_path_prefix . 'files-payload/images/unsplash-sergey-pesterev.jpg',
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

