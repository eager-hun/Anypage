<?php

$page_levels = [];


// -----------------------------------------------------------------------------
// Page title.

$page_levels[] = [
    'page_level_content' => $tools->render('page/page-title', [
        'page_title_text' => "Forms"
    ]),
];


// -----------------------------------------------------------------------------
// Inventory of widgets.

$widgets_inventory_title = '<h2 class="underlined">Widgets inventory</h2>';

$widgets_inventory = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/styles-demo-form-widgets.php',
    'php'
);

$page_levels[] = [
    'page_level_content' => $widgets_inventory_title . $widgets_inventory
];


// -----------------------------------------------------------------------------
// Freetext tinkering.

$freetext_tinkering_title = '<h2 class="underlined">Freetext tinkering</h2>';

$freetext_tinkering = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/tinkering-forms-freetext.php',
    'php'
);

$page_levels[] = [
    'page_level_content' => $freetext_tinkering_title . $freetext_tinkering
];


// ----------------------------------------------------------------------------
// Output.

foreach ($page_levels as $manifest) {
    echo $tools->render('layouts/page-level', $manifest);
}
