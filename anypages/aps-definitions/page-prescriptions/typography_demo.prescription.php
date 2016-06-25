<?php

use \Michelf\Markdown;

// ----------------------------------------------------------------------------
// Demonstrate typography on basic texts.

$text = apputils_import_file_content(
  APS_CONTENTS . '/arbitrary/sample-texts.php'
);
$component_args = [
  'title'          => 'Texts for checking typography',
  'direct_content' => $text,
];
echo render_cd_item($component_args);


// ----------------------------------------------------------------------------
// Demonstrate typography on lists.

$text = apputils_import_file_content(
  APS_CONTENTS . '/arbitrary/sample-lists.php'
);
$component_args = [
  'title'          => 'Lists for checking typography',
  'direct_content' => $text,
];
echo render_cd_item($component_args);

