<?php

use \Michelf\Markdown;

// ----------------------------------------------------------------------------
// Sample grids.

$text = apputils_import_file_content(
  APS_CONTENTS . '/arbitrary/sample-grid-layouts.php'
);
$component_args = [
  'title'   => 'Sample grid layouts',
  'content' => $text,
];
echo render_cd_item($component_args);


// ----------------------------------------------------------------------------
// On-demand grids.

$text = apputils_import_file_content(
  APS_CONTENTS . '/arbitrary/on-demand-grids-and-flexboxes.php'
);
$desc_raw = <<<EOT
NOTE: you can add `row--flexbox--wide` class in inspector to any `.row`s in this demo to flexboxify its children.
EOT;

$component_args = [
  'title'       => 'On-demand grids and flexboxes',
  'description' => Markdown::defaultTransform($desc_raw),
  'content'     => $text,
];
echo render_cd_item($component_args);


