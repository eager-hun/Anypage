<?php

function sg_component_sample($Templating) {

  $template_name = 'layout-sample';
  $variables = [
    'top'    => 'Content in top',
    'bottom' => 'Content in bottom',
  ];

  return $Templating->render($template_name, $variables);
}

function sg_item_sample($Templating) {

  $template_name = 'sg-item';

  $view_code = 'Code not found.'; // Fallback.
  if (file_exists($Templating->locate_template('layout-sample'))) {
    $view_code = htmlspecialchars(
      file_get_contents($Templating->locate_template('layout-sample'))
    );
  }

  $variables = [
    'title'       => 'Sample item title',
    'description' => 'Sample item description.',
    'code'        => 'Code:<br><pre><code>' . $view_code . '</code></pre>',
    'content'     => sg_component_sample($Templating),
  ];

  return $Templating->render($template_name, $variables, 'app');
}

// Dummy content.
echo sg_item_sample($Templating);
echo sg_item_sample($Templating);

