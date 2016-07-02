<?php

use \Michelf\Markdown;


// ############################################################################
// List of component demos.

// ----------------------------------------------------------------------------
// Demonstrate a dummy component.

$desc_raw = <<<EOT
This is the description text for the demonstration of a sample dummy component.

Also, this text is processed by Markdown.
EOT;

$component_args = [
  'title'               => 'Sample dummy component',
  'description'         => Markdown::defaultTransform($desc_raw),
  'template_name'       => 'sample-dummy-layout',
  'component_variables' => [
    'top'    => 'Content in the top slot of this layout.',
    'bottom' => 'Content in the bottom slot of this layout.',
  ],
];
echo render_cd_item($component_args);

