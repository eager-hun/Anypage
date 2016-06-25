<?php

use \Michelf\Markdown;

// ----------------------------------------------------------------------------
// Layout 2 sidebars.

$text = apputils_import_file_content(
  APS_CONTENTS . '/arbitrary/layout-2-sidebars.php'
);
$desc_raw = <<<EOT
"Layout 2 sidebars" is a custom, complex component, based on on-demand grids.

It can be used to supply a variety of basic arrangements for page sections.
EOT;

$component_args = [
  'title'   => 'Layout 2 sidebars demo',
  'description' => Markdown::defaultTransform($desc_raw),
  'direct_content' => $text,
];
echo render_cd_item($component_args);

