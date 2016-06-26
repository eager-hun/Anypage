<?php

use \Michelf\Markdown;

// ----------------------------------------------------------------------------
// Layout 2 sidebars.

$text = apputils_import_file_content(
  APS_CONTENTS . '/arbitrary/layout-2-sidebars.php'
);

$component_args = [
  'title'          => 'Layout 2 sidebars demo',
  'direct_content' => $text,
];
echo render_cd_item($component_args);

