<?php

$readme_file = PUBLIC_RESOURCES . '/themes/frontend-seed/README.md';

$readme = $tools->importFileContent($readme_file, 'md');

echo $readme;
