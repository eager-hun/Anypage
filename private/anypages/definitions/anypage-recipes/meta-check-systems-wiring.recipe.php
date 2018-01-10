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
    'page_level_content' => "$page_title"
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

$check_sa_layout = $tools->render('layouts/flex-grid', [
    'wrapper_extra_classes' => 'flex-grid--preset-2-cols',
    'items_extra_classes'   => 'fit-content',
    'items' => [
        [ 'item_content' => $sa_title . $sa_desc, ],
        [ 'item_content' => $sa_check, ],
    ],
]);

$page_levels[] = [
    'page_level_content' => $check_sa_layout
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

$check_vue_layout = $tools->render('layouts/flex-grid', [
    'wrapper_extra_classes' => 'flex-grid--preset-2-cols',
    'items_extra_classes'   => 'fit-content',
    'items' => [
        [ 'item_content' => $vue_title . $vue_desc, ],
        [ 'item_content' => $vue_check, ],
    ],
]);

$page_levels[] = [
    'page_level_content' => $check_vue_layout
];


// -----------------------------------------------------------------------------
// Check Styleguide's assets' wiring.

$sg_assets_title = '<h2 class="underlined">Styleguide assets</h2>';

$sg_assets_desc_raw = "Verify intact styleguide asset wiring by seeing nicely colourful markup here:";
$sg_assets_desc = $tools->markdown($sg_assets_desc_raw);

$sample_markup = <<<EOT
<div>
    <span class="foo bar">All the colours!</span>
</div>
EOT;

$code_demo = $tools->render('patterns/texts/code', [
    'code_classes' => 'language-markup',
    'code' => $sample_markup
]);

$check_sg_assets_layout = $tools->render('layouts/flex-grid', [
    'wrapper_extra_classes' => 'flex-grid--preset-2-cols',
    'items_extra_classes'   => 'fit-content',
    'items' => [
        [ 'item_content' => $sg_assets_title . $sg_assets_desc, ],
        [ 'item_content' => $code_demo, ],
    ],
]);

$page_levels[] = [
    'page_level_content' => $check_sg_assets_layout
];


// ----------------------------------------------------------------------------
// Output.

foreach ($page_levels as $manifest) {
    echo $tools->render('layouts/page-level', $manifest);
}
