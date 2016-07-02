<?php

use \Michelf\Markdown;

aps_open_page_level();
aps_open_container();

// ############################################################################
// Main column content.

$main_col = '<h1 class="page__title">Sample page</h1>';

$accordion_args = [
  'wrapper_extra_classes' => 'hi',
  'items' => [
    [
      'extra_classes' => '',
      'title'         => 'Item title',
      'content'       => 'Item content',
    ],
    [
      'extra_classes' => '',
      'title'         => 'Item title',
      'content'       => 'Item content',
    ],
  ],
];

$accordion = $templating->render('accordion', $accordion_args);

$main_col .= $accordion;


// ############################################################################
// Sidebar boxes.

$box_1_args = [
  'wrapper_extra_classes' => 'box--simple',
  'box_title'             => 'Sample box',
  'box_content'           => $templating->add_filler_text('s', 1),
];
$box_1 = $templating->render('box', $box_1_args);

$box_2_args = [
  'wrapper_extra_classes' => 'box--simple',
  'box_title'             => 'Sample box two',
  'box_content'           => $templating->add_filler_text('s', 2),
];
$box_2 = $templating->render('box', $box_2_args);


// ############################################################################
// Main layout.

$layout_2sb_args = [
  'wrapper_extra_classes' => 'layout--2sb content-in-mid has-1-sb sb-1',
  'main_content'          => $main_col,
  'sidebar_1'             => $box_1 . $box_2,
];
echo $templating->render('meta-layout-2sb', $layout_2sb_args);

aps_close_container();
aps_close_page_level();

