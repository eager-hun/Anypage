<?php

use \Michelf\Markdown;

$content = "Hi from sample page's content.";
echo Markdown::defaultTransform($content);

