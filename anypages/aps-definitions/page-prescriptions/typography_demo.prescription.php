<?php

use \Michelf\Markdown;

echo aps_page_level_start();

echo aps_container_start();
echo aps_render_page_title('Typography demo');
echo aps_container_end();


// ############################################################################
// Demo item definitions.

$demos = [];

// ----------------------------------------------------------------------------
// Demonstrate typography on basic texts.

$text = apputils_import_file_content(
  APS_CONTENTS . '/arbitrary/sample-texts.php'
);
$component_args = [
  'title'          => 'Texts for checking typography',
  'direct_content' => $text,
];
$demos[] = render_cd_item($component_args);


// ----------------------------------------------------------------------------
// Demonstrate typography on lists.

$text = apputils_import_file_content(
  APS_CONTENTS . '/arbitrary/sample-lists.php'
);
$component_args = [
  'title'          => 'Lists for checking typography',
  'direct_content' => $text,
];
$demos[] = render_cd_item($component_args);


// ############################################################################
// Printing demo items.

echo aps_render_component_demos($demos);

echo aps_page_level_end();

