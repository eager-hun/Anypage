<?php

use \Michelf\Markdown;

echo $apsHelper->page_level_start();
echo $apsHelper->page_level_content_start();
echo $apsHelper->render_page_title('Layouts demo');
echo $apsHelper->page_level_content_end();
echo $apsHelper->page_level_end();


// ############################################################################
// Demo item definitions.

$demos = [];

// ----------------------------------------------------------------------------
// Layout 2 sidebars.

$text = $apsHelper->import_file_content(
  APS_CONTENTS . '/arbitrary/layout-2-sidebars.php',
  'php'
);

$component_args = [
  'title'          => '"Layout 2 sidebars" demo',
  'direct_content' => $text,
];
$demos[] = $apsHelper->render_components_demo_item($component_args);


// ############################################################################
// Printing demo items.

echo $apsHelper->render_component_demos($demos);
