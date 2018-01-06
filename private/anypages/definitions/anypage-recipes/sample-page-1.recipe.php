<?php

$page_levels = [];


// ----------------------------------------------------------------------------
// Page title.

$page_title = $tools->render('page-title', [
    'page_title_text' => 'Sample page numero uno'
]);


// ----------------------------------------------------------------------------
// Main content.

$main_content = '';
$main_content .= $page_title;
$main_content .= '<div class="hero-block">'
    . $tools->addFillerText('s', 1, true)
    . '</div>';
$main_content .= $tools->addFillerText('m', 1, true);
$main_content .= '<h2 class="underlined">An interesting title</h2>';
$main_content .= $tools->addFillerText('l', 2, true);


// ----------------------------------------------------------------------------
// Sidebar contents.

$boxes = [
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
    [
        'wrapper_extra_classes' => 'tile color-zone color-zone--dark',
        'box_title'             => 'Super box 4',
        'box_content'           => $tools->addFillerText('xs', 5, true)
    ],
    [
        'wrapper_extra_classes' => 'tile color-zone color-zone--blockfill',
        'box_title'             => 'Super box 5',
        'box_content'           => $tools->addFillerText('xs', 4, true)
    ],
];

array_walk($boxes, function(&$item) {
    $item = $this->capacities->get('tools')->render('patterns/box', $item);
});

$sidebar_content = $tools->render('layouts/sidebar-box-arrangement', [
    'wrapper_extra_classes' => 'payload-as-tiles',
    'items' => $boxes
]);

// ----------------------------------------------------------------------------
// Layout with sidebar.

$layout = $tools->render('layouts/layout-1-sidebar', [
    'wrapper_extra_classes' => 'has-sidebar sidebar-on-left',
    'main_content' => $main_content,
    'sidebar_content' => $sidebar_content,
]);


// ----------------------------------------------------------------------------
// Output.

echo $tools->render('layouts/page-level', [
    'page_level_content' => $layout
]);
