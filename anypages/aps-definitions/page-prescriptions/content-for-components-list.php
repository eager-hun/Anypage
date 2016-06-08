<?php

use \Michelf\Markdown;


// ############################################################################
// List of component demos.

// ----------------------------------------------------------------------------
// Demonstrate header and footer.

$args_for_header_demo = [
  'template_name'       => 'page-header',
  'title'               => 'Page header',
  'description'         => 'This is the demonstration of the page header.',
  'component_variables' => [
    'site_name' => 'Component demo site name',
    'site_slogan' => 'Component demo site slogan',
    'header_widgets' => render_page_header_widgets(),
  ],
];
echo render_cd_item($args_for_header_demo);

$args_for_footer_demo = [
  'template_name'       => 'page-footer',
  'title'               => 'Page footer',
  'description'         => 'This is the demonstration of the page footer.',
  'component_variables' => [
    'footer_widgets' => render_page_footer_widgets(),
  ],
];
echo render_cd_item($args_for_footer_demo);


// ----------------------------------------------------------------------------
// Demonstrate a dummy layout.

$description_for_layout_demo = <<<EOT
This is the description text for the demonstration of a sample dummy layout.

Also, this text is processed by Markdown.
EOT;

$args_for_layout_demo = [
  'template_name'       => 'sample-dummy-layout',
  'title'               => 'Sample dummy layout',
  'description'         => Markdown::defaultTransform($description_for_layout_demo),
  'component_variables' => [
    'top'    => 'Content in the top slot of this layout.',
    'bottom' => 'Content in the bottom slot of this layout.',
  ],
];
echo render_cd_item($args_for_layout_demo);


// ----------------------------------------------------------------------------
// Demonstrate arbitrary text.

// TODO: this should be made a function/method shomehow.
$raw_text = file_get_contents(APS_CONTENTS . '/arbitrary/arbitrary-text.md');
$text = Markdown::defaultTransform($raw_text);

$args_for_text_demo = [
  'title'   => 'Demo with arbitrary text',
  'content' => $text,
];
echo render_cd_item($args_for_text_demo);

