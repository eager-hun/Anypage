<?php


$page_title = $tools->render('page-title', [
    'page_title_text' => 'Layout with 1 sidebar'
]);

// ----------------------------------------------------------------------------
// Demo content.

$demo_content = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/styles-demo-layout-1-sidebar.php',
    'php'
);


// ----------------------------------------------------------------------------
// Output.

$page_content = $tools->render('page-level', [
    'page_level_content' => $page_title . $demo_content,
]);

echo $page_content;
