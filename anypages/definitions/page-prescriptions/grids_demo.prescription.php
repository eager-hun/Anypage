<?php

use \Michelf\Markdown;

echo $apsHelper->page_level_start();
echo $apsHelper->page_level_content_start();
echo $apsHelper->render_page_title('Grids demo');
echo $apsHelper->page_level_content_end();
echo $apsHelper->page_level_end();


// ############################################################################
// Demo item definitions.

$demos = [];

$text = $apsHelper->import_file_content(
  APS_CONTENTS . '/arbitrary/on-demand-grids-and-flexboxes.php',
  'php'
);

$component_args = [
  'title'          => 'On-demand grids and flexboxes',
  'direct_content' => $text,
];
$demos[] = $apsHelper->render_components_demo_item($component_args);


// ############################################################################
// Printing demo items.

echo $apsHelper->render_component_demos($demos);

