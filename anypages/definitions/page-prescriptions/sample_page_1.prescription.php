<?php

use \Michelf\Markdown;

echo $apsHelper->page_level_start();
echo $apsHelper->page_level_content_start();


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
  'box_title'             => 'Sample box',
  'box_content'           => $apsHelper->add_filler_text('s', 1)
];
$box_1 = $apsHelper->render('components/box', $box_1_args);

$box_2_args = [
  'wrapper_extra_classes' => 'has-bg has-bg--color-accent-2',
  'box_title'             => 'Sample box two with a bit longer title',
  'box_content'           => $apsHelper->add_filler_text('xs', 2),
];
$box_2 = $apsHelper->render('components/box', $box_2_args);

$box_3_args = [
  'wrapper_extra_classes' => 'has-bg has-bg--color-accent-1',
  'box_title'             => 'Sample box two with a bit longer title',
  'box_content'           => $apsHelper->add_filler_text('xs', 3),
];
$box_3 = $apsHelper->render('components/box', $box_3_args);


// ############################################################################
// Main layout.

$layout_2sb_args = [
  'wrapper_extra_classes' => 'layout--2sb content-in-mid has-1-sb sb-1',
  'main_content'          => $main_col,
  'sidebar_1'             => $box_1 . PHP_EOL . $box_2 . PHP_EOL . $box_3,
];
echo $apsHelper->render('layouts/layout-2sb', $layout_2sb_args);

echo $apsHelper->page_level_content_end();
echo $apsHelper->page_level_end();


// ############################################################################
// Extra "stripe" at the bottom.

echo $apsHelper->page_level_start(['has-bg', 'has-bg--color-blockfill']);
echo $apsHelper->page_level_content_start();

echo '<h2>A stripe with background</h2>';
echo $apsHelper->add_filler_text('m', 2);
echo '<a href="#">Sample link here.</a>';

echo $apsHelper->page_level_content_end();
echo $apsHelper->page_level_end();

