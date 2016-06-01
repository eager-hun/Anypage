<?php
/**
 * Common functions accessible from all page prescription files.
 */

// ----------------------------------------------------------------------------
// Shortcut to print a regular page header.

function render_page_header($Templating) {
  $template_name = 'page-header';
  $variables = [
    'site_name'      => 'This is the site name',
    'site_slogan'    => 'This is the site slogan',
    'header_widgets' => render_page_header_widgets($Templating),
  ];

  return $Templating->render($template_name, $variables);
}

function render_page_header_widgets($Templating) {
  $template_name = 'page-header-widgets';

  return $Templating->render($template_name, array());
}

// ----------------------------------------------------------------------------
// Shortcut to print a regular page footer.

function render_page_footer($Templating) {
  $template_name = 'page-footer';
  $variables = [
    'footer_widgets' => render_page_footer_widgets($Templating),
  ];

  return $Templating->render($template_name, $variables);
}

function render_page_footer_widgets($Templating) {
  $template_name = 'page-footer-widgets';

  return $Templating->render($template_name, array());
}

// ----------------------------------------------------------------------------
// Styleguide items' presentation.

/**
 * Demonstrates a component in a styleguide's component list page.
 *
 * Provides a component title, a component description, a code sample, and a
 * rendered instance of the component.
 *
 * @param array $arguments
 *   component_name:
 *     name of the template of the demonstrated component.
 *   title:
 *     the title of the demo.
 *   description:
 *     long text.
 *   component_variables:
 *     array of data that will populate the rendered demonstrated component.
 */
function demonstrate_component($Templating, $arguments) {
  $component_name = $arguments['component_name'];

  if (file_exists($Templating->locate_template($component_name))) {
    $view_code = htmlspecialchars(
      file_get_contents($Templating->locate_template($component_name))
    );
  }
  else {
    $view_code = 'Code not found.';
  }

  $variables_for_presentation = [
    'title'       => $arguments['title'],
    'description' => $arguments['description'],
    'code'        => 'Code:<br><pre><code>' . $view_code . '</code></pre>',
    'content'     => $Templating->render($component_name, $arguments['component_variables'])
  ];

  // Render the 'sg-item' template, that is one of the app's own templates.
  return $Templating->render('sg-item', $variables_for_presentation, 'app');
}

