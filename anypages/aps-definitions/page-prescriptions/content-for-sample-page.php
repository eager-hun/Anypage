<?php

use \Michelf\Markdown;


// ############################################################################
// Regular page header.

echo render_page_header();


// ############################################################################
// Actual page content.

$content = "Hi from sample page's content.";
echo Markdown::defaultTransform($content);


// ############################################################################
// Regular page footer.

echo render_page_footer();

