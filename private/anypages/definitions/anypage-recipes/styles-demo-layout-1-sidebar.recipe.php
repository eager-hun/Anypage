<?php

$page_levels = [];


// #############################################################################
// Page title.

$page_title = $tools->render('page-title', [
    'page_title_text' => 'Layout with 1 sidebar'
]);

$page_levels[] = [
    'page_level_content' => $page_title
];


// #############################################################################
// Samples.

$main_content = $tools->addFillerText('s', 1, true);

$box_for_sidebar = $tools->render('patterns/box', [
    'wrapper_extra_classes' => 'tile color-zone color-zone--brand',
    'box_title' => 'Sidebar content',
    'box_content' => '<p>' . $tools->addFillerText('xxs', 1, false) . ' . </p>'
]);

// -----------------------------------------------------------------------------
// Next level.

$title1 = '<h2 class="underlined">Sidebar is present, on the right</h2>';

$sample1 = $tools->render('layouts/layout-1-sidebar', [
    'wrapper_extra_classes' => 'sidebar-on-right has-sidebar',
    'main_content'          => $title1 . $main_content,
    'sidebar_content'       => $box_for_sidebar,
]);

$page_levels[] = [
    'page_level_content' => $sample1
];

// -----------------------------------------------------------------------------
// Next level.

$title2 = '<h2 class="underlined">Sidebar is present, on the left</h2>';

$sample1 = $tools->render('layouts/layout-1-sidebar', [
    'wrapper_extra_classes' => 'sidebar-on-left has-sidebar',
    'main_content'          => $title2 . $main_content,
    'sidebar_content'       => $box_for_sidebar,
]);

$page_levels[] = [
    'page_level_content' => $sample1
];

// -----------------------------------------------------------------------------
// Next level.

$title3 = '<h2 class="underlined">Sidebar is not present</h2>';

$sample1 = $tools->render('layouts/layout-1-sidebar', [
    'main_content' => $title3 . $main_content,
]);

$page_levels[] = [
    'page_level_content' => $sample1
];

// #############################################################################
// Output.

foreach ($page_levels as $manifest) {
    echo $tools->render('layouts/page-level', $manifest);
}







