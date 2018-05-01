<?php

$page_title = $tools->render('page/page-title', [
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

echo $tools->render('layouts/squeeze', [
    'squeeze_content' => $page_title . $sample_lists,
]);