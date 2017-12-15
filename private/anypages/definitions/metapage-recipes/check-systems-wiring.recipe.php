<?php

$page_levels = [];


// -----------------------------------------------------------------------------
// Page title.

$page_title = $tools->render('page-title', [
    'page_title_text' => "Check systems' wiring"
]);

$page_levels[] = [
    'page_level_content' => $page_title
];


// -----------------------------------------------------------------------------
// Check Vue wiring.

$vue_title = '<h2 class="underlined">Vue.js single-file-component</h2>';

$vue_desc = "Verify an intact Vue.js build setup by seeing a healthy-enough Vue component here:";

$vue_desc = $tools->markdown($vue_desc);

$vue_check = <<<EOT
    <div id="example-vue__mount">
        <p><strong>Vue component did not mount.</strong></p>
        <p>(This text should have been replaced by a successfully mounted Vue component.)</p>
    </div>
EOT;

$page_levels[] = [
    'page_level_content' => $vue_title . $vue_desc . $vue_check
];

// ----------------------------------------------------------------------------
// Output.

foreach ($page_levels as $manifest) {
    echo $tools->render('layouts/page-level', $manifest);
}
