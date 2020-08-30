<?php

$page_title = $tools->render('page/page-title', [
    'page_title_text' => 'Text styles: headings'
]);

// ----------------------------------------------------------------------------
// Demonstrate typography on sample texts.

$sample_text = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/styles-demo-texts-headings.php',
    'php'
);

// ----------------------------------------------------------------------------
// Output.

echo $tools->render('layouts/squeeze', [
    'squeeze_content' => $page_title . $sample_text,
]);
