<?php

use \Michelf\Markdown;

echo aps_page_level_start();

echo aps_container_start();
echo aps_render_page_title('Grids demo');
echo aps_container_end();


// ############################################################################
// Demo item definitions.

$demos = [];

// ----------------------------------------------------------------------------
// Sample grids.

$text = apputils_import_file_content(
  APS_CONTENTS . '/arbitrary/sample-grid-layouts.php'
);
$component_args = [
  'title'          => 'Grids based on generated sets of HTML classes',
  'direct_content' => $text,
];
$demos[] = render_cd_item($component_args);

// ----------------------------------------------------------------------------
// On-demand grids.

$text = apputils_import_file_content(
  APS_CONTENTS . '/arbitrary/on-demand-grids-and-flexboxes.php'
);

$component_args = [
  'title'          => 'On-demand grids and flexboxes',
  'direct_content' => $text,
];
$demos[] = render_cd_item($component_args);


// ############################################################################
// Printing demo items.

echo aps_render_component_demos($demos);

echo aps_page_level_end();

