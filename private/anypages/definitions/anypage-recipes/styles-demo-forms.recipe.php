<?php

$tools->usePageTemplate('page/page--fullwidth');


$page_levels = [];


// -----------------------------------------------------------------------------
// Page title.

$page_levels[] = $tools->render('page/page-title', [
    'page_title_text' => "Forms"
]);


// -----------------------------------------------------------------------------
// Inventory of widgets.

$widgets_inventory_title = '<h2 class="underlined">Widgets inventory</h2>';

$widgets_inventory = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/forms/styles-demo-form-widget-inventory.php',
    'php'
);

$page_levels[] = $widgets_inventory_title . $widgets_inventory;


// -----------------------------------------------------------------------------
// Inventory of widget states.

$widgets_states_title = '<h2 class="underlined">Widget states</h2>';

$widgets_states = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/forms/styles-demo-form-widget-states.php',
    'php'
);

$page_levels[] = $widgets_states_title . $widgets_states;


// -----------------------------------------------------------------------------
// Inventory of buttons and states.

$buttons_title = '<h2 class="underlined">Buttons</h2>';

$button_variants = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/forms/styles-demo-button-variants.php',
    'php'
);

$button_shapes = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/forms/styles-demo-button-shapes.php',
    'php'
);

$buttons_demo = <<<EOT

<h3>Button variants</h3>

<form action="#">
    $button_variants
</form>

<h3>Button shapes</h3>

<form action="#">
    $button_shapes
</form>
EOT;


$page_levels[] = $buttons_title . $buttons_demo;


// -----------------------------------------------------------------------------
// Form arrangement.

$form_arrangement_title = '<h2 class="underlined">Form arrangement</h2>';

$form_arrangement = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/forms/styles-demo-form-arrangement.php',
    'php'
);

$page_levels[] = $form_arrangement_title . $form_arrangement;


// -----------------------------------------------------------------------------
// Form size variants.

$form_size_variants_title = '<h2 class="underlined">Form size variants</h2>';

$form_arrangement = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/forms/styles-demo-form-arrangement.php',
    'php'
);

$button_shapes = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/forms/styles-demo-button-shapes.php',
    'php'
);

$form_size_demos = <<<EOT
<h3>Small form</h3>
<form action="#" class="form--small">$form_arrangement</form>
<form action="#" class="form--small stackable--major">$button_shapes</form>

<h3>Big form</h3>
<form action="#" class="form--big">$form_arrangement</form>
<form action="#" class="form--big stackable--major">$button_shapes</form>
EOT;

$page_levels[] = $form_size_variants_title . $form_size_demos;


// ----------------------------------------------------------------------------
// Output.

foreach ($page_levels as $payload) {
    echo $tools->render('layouts/page-level', [
        'page_level_content' => $tools->render('layouts/squeeze', [
            'squeeze_content' => $payload
        ])
    ]);
}
