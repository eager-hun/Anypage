<?php

$page_content = '';

$page_title = $tools->render('page-title', [
    'page_title_text' => 'Text styles: miscellaneous'
]);

// ----------------------------------------------------------------------------
// Demonstrate typography on sample texts.

$sample_text = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/styles-demo-texts-misc.php',
    'php'
);

// ----------------------------------------------------------------------------
// Output.

$page_content .= $tools->render('page-level', [
   'page_level_content' => $page_title . $sample_text,
]);

echo $page_content;
