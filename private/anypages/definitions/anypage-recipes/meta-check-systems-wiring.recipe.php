<?php

$tools->usePageTemplate('page/page--fullwidth');
$tools->usePageHeaderTemplate('page/page-header--alt-1');

$page_levels = [];


// -----------------------------------------------------------------------------
// Page title.

$page_title = $tools->render('page/page-title', [
    'page_title_text' => "Check systems' wiring"
]);

$page_levels[] = [
    'page_level_content' => "<div class='squeeze'>$page_title</div>"
];

// -----------------------------------------------------------------------------
// Check static assets' wiring.

$sa_title = '<h2 class="underlined">Static assets</h2>';

$sa_desc_raw = "Verify intact static asset wiring by seeing an image here:";
$sa_desc = $tools->markdown($sa_desc_raw);

$sa_img_src = $tools
        ->pathToThemeStaticFiles() . '/images/for-demo/photo-1-700.jpg';

$sa_check = <<<EOT
    <img src="${sa_img_src}" aria-hidden="true">
EOT;

$page_levels[] = [
    'page_level_content' => "<div class='squeeze'>$sa_title $sa_desc $sa_check</div>"
];


// -----------------------------------------------------------------------------
// Check Vue wiring.

$vue_title = '<h2 class="underlined">Vue.js single-file-component</h2>';

$vue_desc_raw = "Verify an intact Vue.js build setup by seeing a healthy-enough Vue component here:";
$vue_desc = $tools->markdown($vue_desc_raw);

$vue_check = <<<EOT
    <div id="example-vue__mount">
        <p><strong>Vue component did not mount.</strong></p>
        <p>(This text should have been replaced by a successfully mounted Vue component.)</p>
    </div>
EOT;

$page_levels[] = [
    'page_level_content' => "<div class='squeeze'>$vue_title $vue_desc $vue_check</div>"
];

// ----------------------------------------------------------------------------
// Output.

foreach ($page_levels as $manifest) {
    echo $tools->render('layouts/page-level', $manifest);
}
