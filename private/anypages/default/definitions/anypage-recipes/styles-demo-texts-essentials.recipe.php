<?php

$page_title = $tools->render('page/page-title', [
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

echo $tools->render('layouts/squeeze', [
    'squeeze_content' => $page_title . $demo_content,
]);
