<?php

use \Michelf\Markdown;

echo aps_page_level_start();

echo aps_container_start();
echo aps_render_page_title('Layouts demo');
echo aps_container_end();


// ############################################################################
// Demo item definitions.

$demos = [];

// ----------------------------------------------------------------------------
// Layout 2 sidebars.

$text = apputils_import_file_content(
  APS_CONTENTS . '/arbitrary/layout-2-sidebars.php'
);

$component_args = [
  'title'          => '"Layout 2 sidebars" demo',
  'direct_content' => $text,
];
$demos[] = render_cd_item($component_args);


// ############################################################################
// Printing demo items.

echo aps_render_component_demos($demos);

echo aps_page_level_end();

