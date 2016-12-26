<?php

use \Michelf\Markdown;

echo $apsHelper->page_level_start();
echo $apsHelper->container_start();
echo $apsHelper->render_page_title('Typography demo');
echo $apsHelper->container_end();
echo $apsHelper->page_level_end();


// ############################################################################
// Demo item definitions.

$demos = [];

// ----------------------------------------------------------------------------
// Demonstrate typography on basic texts.

$text = $apsHelper->import_file_content(
  APS_CONTENTS . '/arbitrary/sample-texts.php', 
  'php'
);
$component_args = [
  'title'          => 'Texts for checking typography',
  'direct_content' => $text,
];
$demos[] = $apsHelper->render_components_demo_item($component_args);


// ----------------------------------------------------------------------------
// Demonstrate typography on lists.

$text = $apsHelper->import_file_content(
  APS_CONTENTS . '/arbitrary/sample-lists.php',
  'php'
);
$component_args = [
  'title'          => 'Lists for checking typography',
  'direct_content' => $text,
];
$demos[] = $apsHelper->render_components_demo_item($component_args);


// ############################################################################
// Printing demo items.

echo $apsHelper->render_component_demos($demos);
