<?php

$page_content = '';

$page_title = $tools->render('page-title', [
    'page_title_text' => 'Permanent flex grid'
]);

// ----------------------------------------------------------------------------
// Demo content.

$demo_content = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/styles-demo-flex-grid-permanent.php',
    'php'
);

// ----------------------------------------------------------------------------
// Output.

$page_content .= $tools->render('layouts/page-level', [
    'page_level_content' => $page_title . $demo_content,
]);

echo $page_content;
