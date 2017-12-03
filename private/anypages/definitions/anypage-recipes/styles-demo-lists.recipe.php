<?php

$page_content = '';

$page_title = $tools->render('page-title', [
    'page_title_text' => 'Text styles: lists'
]);

// ----------------------------------------------------------------------------
// Demonstrate typography on sample lists.

$sample_lists = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/styles-demo-lists.php',
    'php'
);

// ----------------------------------------------------------------------------
// Output.

$page_content .= $tools->render('page-level', [
    'page_level_content' => $page_title . $sample_lists,
]);

echo $page_content;

