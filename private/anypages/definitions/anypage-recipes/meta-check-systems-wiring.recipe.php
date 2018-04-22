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
// Check Styleguide's assets' wiring.

$sg_assets_title = '<h2 class="underlined">Styleguide assets</h2>';

$sg_assets_desc_raw = <<<EOT
Verify intact styleguide asset wiring by seeing nicely colourful markup here:

(Note that other tests may rely on the success of this one.)
EOT;
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


// -----------------------------------------------------------------------------
// Check static assets' wiring when linked from HTML.

$sal_title = '<h2 class="underlined">Static assets referenced in HTML</h2>';

$sal_desc_raw = "Verify intact static asset wiring by seeing an image here:";
$sal_desc = $tools->markdown($sal_desc_raw);

$sal_img_src = $tools
        ->pathToThemeStaticFiles() . '/images/for-demo/photo-1-700.jpg';

$sal_check = <<<EOT
    <img src="${sal_img_src}" alt="test-image">
EOT;

$check_sal_layout = $tools->render('layouts/flex-grid', [
    'wrapper_extra_classes' => 'flex-grid--preset-2-cols',
    'items_extra_classes'   => 'fit-content',
    'items' => [
        [ 'item_content' => $sal_title . $sal_desc, ],
        [ 'item_content' => $sal_check, ],
    ],
]);

$page_levels[] = [
    'page_level_content' => $check_sal_layout
];


// -----------------------------------------------------------------------------
// Check static assets' wiring when linked from CSS.

$sac_title = '<h2 class="underlined">Static assets referenced in CSS</h2>';

$sac_desc_raw = "Verify intact CSS asset referencing by seeing an image here:";
$sac_desc = $tools->markdown($sac_desc_raw);

$sac_check = '<div class="meta-check-systems-wiring--css-bg-image"></div>';

$check_sac_layout = $tools->render('layouts/flex-grid', [
    'wrapper_extra_classes' => 'flex-grid--preset-2-cols',
    'items_extra_classes'   => 'fit-content',
    'items' => [
        [ 'item_content' => $sac_title . $sac_desc, ],
        [ 'item_content' => $sac_check, ],
    ],
]);

$page_levels[] = [
    'page_level_content' => $check_sac_layout
];


// -----------------------------------------------------------------------------
// Check Vue wiring.

$vue_title = '<h2 class="underlined">Vue.js single-file-component</h2>';

$vue_desc_raw = "Verify an intact Vue.js build setup by seeing at least one healthy-enough Vue component here:";
$vue_desc = $tools->markdown($vue_desc_raw);

$vue_check = <<<EOT
    <div class="vue-demo-1-runtime-mount">
        <p><strong>Runtime-mode Vue component did not mount.</strong></p>
    </div>

    <div class="vue-compiler-dependent-app">
        <vue-demo-1
          component-title="Compiler-dependent Vue component"
        >
            <p><strong>Compiler-dependent Vue component did not mount.</strong></p>
        </vue-demo-1>
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


// ----------------------------------------------------------------------------
// Output.

foreach ($page_levels as $manifest) {
    echo $tools->render('layouts/page-level', $manifest);
}
