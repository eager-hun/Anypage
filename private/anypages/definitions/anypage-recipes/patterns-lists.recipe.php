<?php

$demos = '';

$page_title = $tools->render('page-title', [
    'page_title_text' => 'Custom lists'
]);


// ----------------------------------------------------------------------------
// List 1.

$list_title = '<h2 class="page-level__title">Unordered list with icon prefix</h2>';

$list_items = [
    'surprisingly enough, one of the most difficult tasks',
    'is to be able to come up with random strings',
    'on the sudden demand of feeding the page',
    'with sufficient amount of dummy text'
];

$ul_with_arrows = $tools->render('patterns/lists/ul-icon-prefix', [
   'wrapper_extra_classes'  => '',
   'icon_id'                => 'icon-sprite__arrow-right',
   'items'                  => $list_items
]);

$demos .= "<div class='stackable'>$list_title $ul_with_arrows</div>";


// ----------------------------------------------------------------------------
// Output.

echo $tools->render('layouts/page-level', [
    'page_level_content' => "<div class='squeeze'>$page_title $demos</div>"
]);
