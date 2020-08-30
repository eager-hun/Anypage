<?php

$tools->usePageTemplate('page/page--fullwidth');


$page_title = $tools->render('page/page-title', [
    'page_title_text' => 'Color zones'
]);

// ----------------------------------------------------------------------------
// Demo content.

$demo_content = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/styles-demo-color-zones.php',
    'php'
);

// ----------------------------------------------------------------------------
// Output.

$page_content = $tools->render('layouts/page-level', [
    'page_level_content' => $page_title . $demo_content,
]);

echo $page_content;
