<?php

use \Michelf\Markdown;

echo $apsHelper->page_level_start();

echo $apsHelper->container_start();
echo $apsHelper->render_page_title('Custom components');
echo $apsHelper->container_end();


// ############################################################################
// Demo item definitions.

$demos = [];

// ----------------------------------------------------------------------------
// Demonstrate a dummy component with a twig template.

$desc_raw = <<<EOT
Sample component with twig template.

Also, this text is processed by Markdown.
EOT;

$component_args = [
  'title'               => 'Sample dummy component 1',
  'description'         => Markdown::defaultTransform($desc_raw),
  'template_name'       => 'sample-dummy-component-1',
  'component_variables' => [
    'top'    => 'Content in the top slot of this layout.',
    'bottom' => 'Content in the bottom slot of this layout.',
  ],
];
$demos[] = $apsHelper->render_components_demo_item($component_args);

// ----------------------------------------------------------------------------
// Demonstrate another dummy component with a php template.

$desc_raw = <<<EOT
Sample component with php template.
EOT;

$component_args = [
  'title'               => 'Sample dummy component 2',
  'description'         => Markdown::defaultTransform($desc_raw),
  'template_name'       => 'sample-dummy-component-2',
  'component_variables' => [
    'left'  => 'Left content.',
    'right' => 'Right content.',
  ],
];
$demos[] = $apsHelper->render_components_demo_item($component_args, $is_twig = FALSE);



// ############################################################################
// Printing demo items.

echo $apsHelper->render_component_demos($demos);

echo $apsHelper->page_level_end();

