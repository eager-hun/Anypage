<?php

use \Michelf\Markdown;

echo $apsHelper->page_level_start();
echo $apsHelper->container_start();
echo $apsHelper->render_page_title('Grids demo');
echo $apsHelper->container_end();
echo $apsHelper->page_level_end();


// ############################################################################
// Demo item definitions.

$demos = [];

// ----------------------------------------------------------------------------
// Sample grids.

$text = $apsHelper->import_file_content(
  APS_CONTENTS . '/arbitrary/sample-grid-layouts.php',
  'php'
);
$component_args = [
  'title'          => 'Grids based on generated sets of HTML classes',
  'direct_content' => $text,
];
$demos[] = $apsHelper->render_components_demo_item($component_args);

// ----------------------------------------------------------------------------
// On-demand grids.

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
