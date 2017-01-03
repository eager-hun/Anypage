<?php

use \Michelf\Markdown;

echo $apsHelper->page_level_start();
echo $apsHelper->page_level_content_start();
echo $apsHelper->render_page_title('Custom components');
echo $apsHelper->page_level_content_end();
echo $apsHelper->page_level_end();


// ############################################################################
// Demo item definitions.

$demos = [];


// ----------------------------------------------------------------------------
// Component: "Hero mosaic".

$component_args = [
  'title'               => 'Hero mosaic',
  'template_name'       => 'components/hero-mosaic',
  'component_variables' => [
    'wrapper_extra_classes' => '',
    'major' => $apsHelper->render('components/box', ['box_content' => '<p>Major</p>' . $apsHelper->add_filler_text('xs', 1)]),
    'minor' => [
      $apsHelper->render('components/box', ['box_content' => '<p>Minor 1</p>' . $apsHelper->add_filler_text('xs', 1)]),
      $apsHelper->render('components/box', ['box_content' => '<p>Minor 2</p>']),
      $apsHelper->render('components/box', ['box_content' => '<p>Minor 3</p>' . $apsHelper->add_filler_text('xs', 3)]),
      $apsHelper->render('components/box', ['box_content' => '<p>Minor 4</p>' . $apsHelper->add_filler_text('xs', 4)]),
    ],
  ],
];
$demos[] = $apsHelper->render_components_demo_item($component_args);

// ----------------------------------------------------------------------------
// Demonstrate a dummy component with a twig template.

$desc_raw = <<<EOT
Sample component with twig template.

Also, this text is processed by Markdown.
EOT;

$component_args = [
  'title'               => 'Sample dummy component 1',
  'description'         => Markdown::defaultTransform($desc_raw),
  'template_name'       => 'components/sample-dummy-component-1',
  'component_variables' => [
    'top'    => 'Content in the top slot of this component.',
    'bottom' => 'Content in the bottom slot of this component.',
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
  'template_name'       => 'components/sample-dummy-component-2',
  'component_variables' => [
    'left'  => 'Left content.',
    'right' => 'Right content.',
  ],
];
$demos[] = $apsHelper->render_components_demo_item($component_args, $is_twig = FALSE);



// ############################################################################
// Printing demo items.

echo $apsHelper->render_component_demos($demos);

