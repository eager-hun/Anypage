<?php

use \Michelf\Markdown;

$content = "Hi, this is the home page's content.";
echo Markdown::defaultTransform($content);

