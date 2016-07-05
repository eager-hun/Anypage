<?php

use \Michelf\Markdown;

echo aps_page_level_start();
echo aps_container_start();

// ############################################################################
// Main column content.

$main_col = aps_render_page_title('Sample page');

$accordion_args = [
  'wrapper_extra_classes' => 'hi',
  'items' => [
    [
      'extra_classes' => '',
      'title'         => 'Item title',
      'content'       => $templating->add_filler_text('m', 1),
    ],
    [
      'extra_classes' => '',
      'title'         => 'Item title',
      'content'       => $templating->add_filler_text('m', 2),
    ],
  ],
];

$accordion = $templating->render('accordion', $accordion_args);

$main_col .= $accordion;


// ############################################################################
// Sidebar boxes.

$sample_dropdowns = apputils_import_file_content(
  APS_CONTENTS . '/arbitrary/sample-dropdowns.php'
);

$box_1_args = [
  'wrapper_extra_classes' => 'box--simple',
  'box_title'             => 'Sample box',
  'box_content'           => $templating->add_filler_text('s', 1)
                          . $sample_dropdowns,
];
$box_1 = $templating->render('box', $box_1_args);

$box_2_args = [
  'wrapper_extra_classes' => 'box--simple',
  'box_title'             => 'Sample box two with a bit longer title',
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

echo aps_container_end();
echo aps_page_level_end();

