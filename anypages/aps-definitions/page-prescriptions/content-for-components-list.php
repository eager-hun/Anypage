<?php

use \Michelf\Markdown;


// ############################################################################
// List of component demos.

// ----------------------------------------------------------------------------
// Demonstrate a dummy layout.

$desc_raw = <<<EOT
This is the description text for the demonstration of a sample dummy layout.

Also, this text is processed by Markdown.
EOT;

$component_args = [
  'template_name'       => 'sample-dummy-layout',
  'title'               => 'Sample dummy layout',
  'description'         => Markdown::defaultTransform($desc_raw),
  'component_variables' => [
    'top'    => 'Content in the top slot of this layout.',
    'bottom' => 'Content in the bottom slot of this layout.',
  ],
];
echo render_cd_item($component_args);

// ----------------------------------------------------------------------------
// Demonstrate typography on basic texts.

$text = apputils_import_file_content(
  APS_CONTENTS . '/arbitrary/sample-texts.php'
);
$component_args = [
  'title'   => 'Texts for checking typography',
  'content' => $text,
];
echo render_cd_item($component_args);


// ----------------------------------------------------------------------------
// Demonstrate typography on lists.

$text = apputils_import_file_content(
  APS_CONTENTS . '/arbitrary/sample-lists.php'
);
$component_args = [
  'title'   => 'Lists for checking typography',
  'content' => $text,
];
echo render_cd_item($component_args);


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
  'content' => $text,
];
echo render_cd_item($component_args);


