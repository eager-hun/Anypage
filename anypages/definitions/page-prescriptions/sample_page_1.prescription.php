<?php

use \Michelf\Markdown;

echo $apsHelper->page_level_start();
echo $apsHelper->container_start();


// ############################################################################
// Main column content.

$main_col = $apsHelper->render_page_title('Sample page');

$accordion_args = [
  'wrapper_extra_classes' => 'hi',
  'items' => [
    [
      'extra_classes' => '',
      'title'         => 'Item title',
      'content'       => $apsHelper->add_filler_text('m', 1),
    ],
    [
      'extra_classes' => '',
      'title'         => 'Item title',
      'content'       => $apsHelper->add_filler_text('m', 2),
    ],
  ],
];

$accordion = $apsHelper->render('components/accordion', $accordion_args);

$main_col .= $accordion;


// ############################################################################
// Sidebar boxes.

$box_1_args = [
  'wrapper_extra_classes' => 'box--simple',
  'box_title'             => 'Sample box',
  'box_content'           => $apsHelper->add_filler_text('s', 1)
];
$box_1 = $apsHelper->render('components/box', $box_1_args);

$box_2_args = [
  //'wrapper_extra_classes' => 'box--simple',
  'box_title'             => 'Sample box two with a bit longer title',
  'box_content'           => $apsHelper->add_filler_text('s', 2),
];
$box_2 = $apsHelper->render('components/box', $box_2_args);


// ############################################################################
// Main layout.

$layout_2sb_args = [
  'wrapper_extra_classes' => 'layout--2sb content-in-mid has-1-sb sb-1',
  'main_content'          => $main_col,
  'sidebar_1'             => $box_1 . $box_2,
];
echo $apsHelper->render('layouts/layout-2sb', $layout_2sb_args);

echo $apsHelper->container_end();
echo $apsHelper->page_level_end();

