<?php

use \Michelf\Markdown;

echo $apsHelper->page_level_start();
echo $apsHelper->page_level_content_start();

echo $apsHelper->render_page_title('Home page');

$text = <<<EOT
This website consists of two specifically developed projects: "[anypage][anypage]" and "[theme-seed][theme-seed]".

Below are included the contents of these projects' `README.md` files.

[anypage]: https://github.com/eager-hun/anypage
[theme-seed]: https://github.com/eager-hun/theme-seed
EOT;

echo Markdown::defaultTransform($text);

echo $apsHelper->page_level_content_end();
echo $apsHelper->page_level_end();


// -----------------------------------------------------------------------------
// anypage README.md.

$text = $apsHelper->import_file_content('README.md', 'md');

$cd_item_args = [
  'wrapper_extra_classes' => 'app-infra__readmes',
  'direct_content'        => $text,
];
echo $apsHelper->render_components_demo_item($cd_item_args);

// -----------------------------------------------------------------------------
// theme-seed README.md.

$text = $apsHelper->import_file_content('themes/theme-seed/README.md', 'md');

$cd_item_args = [
  'wrapper_extra_classes' => 'app-infra__readmes',
  'direct_content'        => $text,
];
echo $apsHelper->render_components_demo_item($cd_item_args);

