<?php

$page_content = '';

$page_title = $tools->render('page-title', [
    'page_title_text' => 'Typography demo: texts'
]);

// ----------------------------------------------------------------------------
// Demonstrate typography on sample texts.

$sample_text = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/typography-sample-texts.php',
    'php'
);

// ----------------------------------------------------------------------------
// Output.

$page_content .= $tools->render('page-level', [
   'page_level_content' => $page_title . $sample_text,
]);

echo $page_content;
