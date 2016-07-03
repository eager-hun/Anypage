<?php

use \Michelf\Markdown;

echo aps_page_level_start();

// ----------------------------------------------------------------------------
// Sample grids.

$text = apputils_import_file_content(
  APS_CONTENTS . '/arbitrary/sample-grid-layouts.php'
);
$component_args = [
  'title'          => 'Sample grid layouts',
  'direct_content' => $text,
];
echo render_cd_item($component_args);


// ----------------------------------------------------------------------------
// On-demand grids.

$text = apputils_import_file_content(
  APS_CONTENTS . '/arbitrary/on-demand-grids-and-flexboxes.php'
);

$component_args = [
  'title'          => 'On-demand grids and flexboxes',
  'direct_content' => $text,
];
echo render_cd_item($component_args);

echo aps_page_level_end();

