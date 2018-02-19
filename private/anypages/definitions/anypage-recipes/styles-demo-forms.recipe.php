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
// Inventory of widget states.

$widgets_states_title = '<h2 class="underlined">Widget states</h2>';

$widgets_states = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/styles-demo-form-widget-states.php',
    'php'
);

$page_levels[] = [
    'page_level_content' => $widgets_states_title . $widgets_states
];


// -----------------------------------------------------------------------------
// Form arrangement.

$freetext_tinkering_title = '<h2 class="underlined">Form arrangement</h2>';

$freetext_tinkering = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/styles-demo-form-arrangement.php',
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
