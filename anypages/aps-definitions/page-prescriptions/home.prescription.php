<?php

use \Michelf\Markdown;

echo aps_render_page_title('Home page');

$text = "Hi, this is the home page's content.";
echo Markdown::defaultTransform($text);

