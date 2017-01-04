<?php

use \Michelf\Markdown;

echo $apsHelper->page_level_start();
echo $apsHelper->page_level_content_start();

echo $apsHelper->render_page_title('Grids demo');

$text = <<<EOT
## Predefined grid layouts

These grids use the `.row` and `.column` classes, but **_nothing like_** `.medium-4` or `.large-3`.

The widths (essentially, the column count), and the vertical margins for these grid items are defined in the custom `scss/layouts/_predefined-grid-layouts.scss` stylesheet.
EOT;

echo Markdown::defaultTransform($text);

echo $apsHelper->page_level_content_end();
echo $apsHelper->page_level_end();


?>


<?php

// ############################################################################
// Demos.

// ----------------------------------------------------------------------------
// 2-col flexboxified grid.

$text = $apsHelper->import_file_content(
  APS_CONTENTS . '/arbitrary/grid-demos/grid-demo-2-col.php',
  'php'
);

$cd_item_args = [
  'wrapper_extra_classes' => 'app-infra__grid-demos',
  'title'                 => '2 column predefined grid',
  'direct_content'        => $text,
];
echo $apsHelper->render_components_demo_item($cd_item_args);

// ----------------------------------------------------------------------------
// 3-col flexboxified grid.

$text = $apsHelper->import_file_content(
  APS_CONTENTS . '/arbitrary/grid-demos/grid-demo-3-col.php',
  'php'
);

$cd_item_args = [
  'wrapper_extra_classes' => 'app-infra__grid-demos',
  'title'               => '3 column predefined grid',
  'direct_content'      => $text,
];
echo $apsHelper->render_components_demo_item($cd_item_args);

// ----------------------------------------------------------------------------
// 4-col flexboxified grid.

$text = $apsHelper->import_file_content(
  APS_CONTENTS . '/arbitrary/grid-demos/grid-demo-4-col.php',
  'php'
);

$cd_item_args = [
  'wrapper_extra_classes' => 'app-infra__grid-demos',
  'title'               => '4 column predefined grid',
  'direct_content'      => $text,
];
echo $apsHelper->render_components_demo_item($cd_item_args);

// ----------------------------------------------------------------------------
// 4-col flexboxified grid.

$text = $apsHelper->import_file_content(
  APS_CONTENTS . '/arbitrary/grid-demos/grid-demo-4-col-flex.php',
  'php'
);

$cd_item_args = [
  'wrapper_extra_classes' => 'app-infra__grid-demos',
  'title'               => 'A flexboxified grid',
  'direct_content'      => $text,
];
echo $apsHelper->render_components_demo_item($cd_item_args);

