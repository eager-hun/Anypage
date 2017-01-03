<?php

use \Michelf\Markdown;

echo $apsHelper->page_level_start();
echo $apsHelper->page_level_content_start();
echo $apsHelper->render_page_title('Grid test page');

$description = <<<EOT
This page is here to help making sure that (some of) the features of the custom library, [Foundation Lean Grid][flg-github] are intact and are in good working shape.

[flg-github]: https://github.com/eager-hun/foundation-lean-grid
EOT;

echo Markdown::defaultTransform($description);

echo $apsHelper->page_level_content_end();
echo $apsHelper->page_level_end();


echo $apsHelper->page_level_start();

$text = $apsHelper->import_file_content(
  APS_CONTENTS . '/arbitrary/grid-demos/grid-test.php',
  'php'
);

echo $text;

echo $apsHelper->page_level_end();

