<?php

$page_levels = [];


$page_title = $tools->render('page-title', [
    'page_title_text' => 'Custom lists'
]);

$page_levels[] = [
    'page_level_content' => $page_title
];


// ----------------------------------------------------------------------------
// Demo content.

$level_title = '<h2 class="page-level__title">Unordered list with icon prefix</h2>';

$list_items = [
    'surprisingly enough, one of the most difficult tasks',
    'is to be able to come up with random strings',
    'on the sudden demand of feeding the page',
    'with sufficient amount of dummy text'
];

$ul_with_arrows = $tools->render('patterns/lists/ul-icon-prefix', [
   'wrapper_extra_classes'  => '',
   'icon_id'                => 'arrow-right',
   'items'                  => $list_items
]);


$page_levels[] = [
    'page_level_content' => $level_title . $ul_with_arrows
];


// ----------------------------------------------------------------------------
// Output.

foreach ($page_levels as $manifest) {
    echo $tools->render('layouts/page-level', $manifest);
}
