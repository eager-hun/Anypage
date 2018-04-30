<?php

$readme_file = DIRECTOR_DIR . '/README.md';

$readme = $tools->importFileContent($readme_file, 'md');

echo $readme;
