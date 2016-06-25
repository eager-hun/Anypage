<?php

use \Michelf\Markdown;

aps_open_container(['additional', 'classes', 'yay']);

$content = "Hi, this is the home page's content.";
echo Markdown::defaultTransform($content);

aps_close_container();

