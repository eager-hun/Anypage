<?php

$page_title = $tools->render('page-title', [
    'page_title_text' => 'Text styles: essentials'
]);

// ----------------------------------------------------------------------------
// Demonstrate typography on sample texts.

$demo_content = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/styles-demo-texts-essentials.php',
    'php'
);

// ----------------------------------------------------------------------------
// Output.

$page_content = $tools->render('page-level', [
   'page_level_content' => $page_title . $demo_content,
]);

echo $page_content;
