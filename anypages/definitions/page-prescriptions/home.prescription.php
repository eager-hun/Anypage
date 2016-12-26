<?php

use \Michelf\Markdown;

echo $apsHelper->render_page_title('Home page');

$text = <<<EOT
This website consists of two specifically developed projects: "anypage" and "theme-seed".

Below are included the contents of these projects' `README.md` files.
EOT;

echo Markdown::defaultTransform($text);

echo $apsHelper->import_file_content('README.md', 'md');

echo $apsHelper->import_file_content('themes/theme-seed/README.md', 'md');

