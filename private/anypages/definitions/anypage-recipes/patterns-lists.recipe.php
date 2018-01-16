<?php


$page_title = $tools->render('page/page-title', [
    'page_title_text' => 'Custom lists'
]);

$ul_generic_items = [
    'keep still at red light',
    'prepare at the combo of red and yellow',
    'do move forward when it switches to green',
    "but of course let's not forget to add a significantly longer line of text here, so that we can see how it looks in this case"
];


// ----------------------------------------------------------------------------
// List with checkmarks.

$ul_with_checkmarks_title = '<h2>With checkmark icon prefix</h2>';

$ul_with_checkmarks = $tools->render('patterns/lists/ul-icon-prefix', [
    'wrapper_extra_classes'  => 'icons--green',
    'icon_id'                => 'icon-sprite__checkmark',
    'items'                  => $ul_generic_items
]);


// ----------------------------------------------------------------------------
// List with arrows.

$ul_with_arrows_title = '<h2>With arrow icon prefix</h2>';

$ul_with_arrows = $tools->render('patterns/lists/ul-icon-prefix', [
   'icon_id'                => 'icon-sprite__arrow-right',
   'items'                  => $ul_generic_items
]);


// ----------------------------------------------------------------------------
// Output.

$lists_layout = $tools->render('layouts/flex-grid', [
    'wrapper_extra_classes' => 'flex-grid--preset-2-cols',
    'items_extra_classes'   => 'fit-content',
    'items' => [
        [ 'item_content' => $ul_with_checkmarks_title . $ul_with_checkmarks ],
        [ 'item_content' => $ul_with_arrows_title . $ul_with_arrows ],
    ],
]);

echo $page_title . $lists_layout;
