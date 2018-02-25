<?php

$tools->usePageTemplate('page/page--fullwidth');


$page_levels = [];


// #############################################################################
// Page title.

$page_levels[] = $tools->render('page/page-title', [
    'page_title_text' => "Forms"
]);


// #############################################################################
// Importing reusable demo contents.

$widgets_inventory_html = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/forms/styles-demo-form-widget-inventory.php',
    'php'
);

$widgets_states_html = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/forms/styles-demo-form-widget-states.php',
    'php'
);

$button_variants_html = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/forms/styles-demo-button-variants.php',
    'php'
);

$button_shapes_html = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/forms/styles-demo-button-shapes.php',
    'php'
);

$form_arrangement_html = $tools->importFileContent(
    APS_CONTENTS . '/arbitrary/forms/styles-demo-form-arrangement.php',
    'php'
);


// #############################################################################
// Inventory of widgets.

$widgets_inventory_title = '<h2 class="underlined">Widgets inventory</h2>';

$widgets_inventory = "<form action='#'>$widgets_inventory_html</form>";

$page_levels[] = $widgets_inventory_title . $widgets_inventory;


// -----------------------------------------------------------------------------
// Inventory of widget states.

$widgets_states_title = '<h2 class="underlined">Widget states</h2>';

$widgets_states = "<form action='#'>$widgets_states_html</form>";

$page_levels[] = $widgets_states_title . $widgets_states;


// -----------------------------------------------------------------------------
// Inventory of buttons and states.

$buttons_title = '<h2 class="underlined">Buttons</h2>';

$buttons_demo = <<<EOT

<h3>Button variants</h3>

<form action="#">
    $button_variants_html
</form>

<h3>Button shapes</h3>

<form action="#">
    $button_shapes_html
</form>
EOT;

$page_levels[] = $buttons_title . $buttons_demo;

// -----------------------------------------------------------------------------
// Form arrangement.

$form_arrangement_title = '<h2 class="underlined">Form arrangement</h2>';

$form_arrangement = "<form action='#'>$form_arrangement_html</form>";

$page_levels[] = $form_arrangement_title . $form_arrangement;


// -----------------------------------------------------------------------------
// Form size variants.

$form_size_variants_title = '<h2 class="underlined">Form size variants</h2>';

$form_size_demos = <<<EOT
<h3>Small form</h3>
<form action="#" class="form--small">$form_arrangement_html</form>
<form action="#" class="form--small stackable--major">$button_shapes_html</form>

<h3>Big form</h3>
<form action="#" class="form--big">$form_arrangement_html</form>
<form action="#" class="form--big stackable--major">$button_shapes_html</form>
EOT;

$page_levels[] = $form_size_variants_title . $form_size_demos;


// #############################################################################
// Output for default color scheme.

foreach ($page_levels as $payload) {
    echo $tools->render('layouts/page-level', [
        'page_level_content' => $tools->render('layouts/squeeze', [
            'squeeze_content' => $payload
        ])
    ]);
}


// #############################################################################
// Forms in color zones.

$color_zones = [
    'brand',
    'accent-1',
    'accent-2',
    'dark',
    'blockfill'
];

$color_zone_form_demos = <<<EOT
<form action="#">
    $widgets_states_html
</form>

<form action="#" class="stackable--major">
    $button_variants_html
</form>
EOT;

foreach ($color_zones as $color_zone) {
    echo $tools->render('layouts/page-level', [
        'wrapper_extra_classes' => 'has-bg color-zone color-zone--' . $color_zone,
        'page_level_content' => $tools->render('layouts/squeeze', [
            'wrapper_extra_classes' => 'fit-content',
            'squeeze_content' => '<h2 class="page-level__title">'
                . "Color zone $color_zone</h2>"
                . $color_zone_form_demos
        ])
    ]);
}
