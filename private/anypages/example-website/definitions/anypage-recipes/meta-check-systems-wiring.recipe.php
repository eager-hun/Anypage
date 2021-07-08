<?php

$tools->updateTemplateAssignment('page', 'page/page--fullwidth');
$tools->updateTemplateAssignment('page-header', 'page/page-header/page-header--alt-1');

$tools->addBodyClass('page--check-systems-wiring');

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
// Check page payload files' wiring.

$check_payload_title = '<h2 class="underlined">Files as page payload</h2>';

$check_payload_desc_raw = "Verify correctly handled payload files by seeing an image here:";
$check_payload_desc = $tools->markdown($check_payload_desc_raw);

$payload_img_src = $tools->pathToPayloadFiles() . '/demo/img1.png';

$check_payload = <<<EOT
    <img src="${payload_img_src}" alt="test-image">
EOT;

$check_payload_layout = <<<EOL
<div class="grid">
    <div class="grid-item grid-item--half fit-content">
        $check_payload_title $check_payload_desc
    </div>
    <div class="grid-item grid-item--half fit-content">
        $check_payload
    </div>
</div>
EOL;

$page_levels[] = [
    'page_level_content' => $check_payload_layout
];


// -----------------------------------------------------------------------------
// Check static assets' wiring when linked from HTML.

$sal_title = '<h2 class="underlined">Static assets referenced in HTML</h2>';

$sal_desc_raw = "Verify intact static asset wiring by seeing an image here:";
$sal_desc = $tools->markdown($sal_desc_raw);

$sal_img_src = $tools->pathToThemeStaticFiles() . '/demo/img2.png';

$sal_check = <<<EOT
    <img src="${sal_img_src}" alt="test-image">
EOT;

$check_sal_layout = <<<EOL
<div class="grid">
    <div class="grid-item grid-item--half fit-content">
        $sal_title $sal_desc
    </div>
    <div class="grid-item grid-item--half fit-content">
        $sal_check
    </div>
</div>
EOL;

$page_levels[] = [
    'page_level_content' => $check_sal_layout
];


// -----------------------------------------------------------------------------
// Check static assets' wiring when linked from CSS.

$sac_title = '<h2 class="underlined">Static assets referenced in CSS</h2>';

$sac_desc_raw = 'Verify intact CSS asset referencing by seeing an image here:';
$sac_desc = $tools->markdown($sac_desc_raw);

$sac_check = '<div class="meta-check-systems-wiring--css-bg-image"></div>';

$check_sac_layout = <<<EOL
<div class="grid">
    <div class="grid-item grid-item--half fit-content">
        $sac_title $sac_desc
    </div>
    <div class="grid-item grid-item--half fit-content">
        $sac_check
    </div>
</div>
EOL;

$page_levels[] = [
    'page_level_content' => $check_sac_layout
];


// ----------------------------------------------------------------------------
// Output.

foreach ($page_levels as $manifest) {
    echo $tools->render('layouts/page-level/page-level', $manifest);
}
